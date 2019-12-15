<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Karyawan;
use App\Department;
use App\Leveling;
use App\Lembur;
use App\Absensi;
use App\ChangeJadwal;
use Carbon\Carbon;
use App\StatusKaryawan;
use App\JadwalOff;
use App\JadwalShift;
use App\JadwalAktifKaryawan;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;
use App\Imports\JadwalAktifImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class JadwalManageController extends Controller
{
    public function create_importJadwal()
    {
        $jadwal = JadwalAktifKaryawan::orderBy('id_karyawan')->orderBy('tanggal')->get();
        $karyawan = Karyawan::all();
        $shift = JadwalShift::all();
    	return view('admin.importjadwal',compact('jadwal','karyawan','shift'));
    }
    public function import_jadwal(Collection $rows, Request $request)
    {
    	$validator = Validator::make($request->all(), [
            'file' => 'required|file|max:1024|mimes:xls,xlsx',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        JadwalAktifKaryawan::truncate();
        $array = Excel::import(new JadwalAktifImport,request()->file('file'));
        $message = 'Jadwal imported successfully.';
        return redirect()->route('importer.jadwal')
                        ->with('success',$message);
    }
    public function store_jadwal(Request $request)
    {
        $this->validate($request, [
            'id_karyawan' => 'required',
            'tanggal' => 'required',
            'id_jadwal' => 'required',
        ]);

        $jadwal = JadwalAktifKaryawan::create([
            'tanggal' => $request->tanggal,
            'id_jadwal' => $request->id_jadwal,
            'id_karyawan' => $request->id_karyawan,
        ]);
        $message = 'Jadwal '.$jadwal->karyawan->nama.' Tanggal '.$jadwal->tanggal.' added successfully.';
        return redirect()->route('importer.jadwal')
                        ->with('success',$message);
    }
    public function update_jadwal(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
            'shift_lama' => 'required',
            'shift_baru' => 'required',
        ]);
        $jadwal = JadwalAktifKaryawan::find($request->id);
        $jadwal->update([
            'id_jadwal' => $request->shift_baru
        ]);
        $message = 'Jadwal '.$jadwal->karyawan->nama.' Tanggal '.$jadwal->tanggal.' updated successfully.';
        return redirect()->route('importer.jadwal')
                        ->with('success',$message);
    }
    public function delete_jadwal($id)
    {
        $jadwal = JadwalAktifKaryawan::find($id);
        $jadwal->delete();
        $message = 'Jadwal '.$jadwal->karyawan->nama.' Tanggal '.$jadwal->tanggal.' deleted successfully.';
        return redirect()->route('importer.jadwal')
                        ->with('success',$message);
    }
    public function index_lembur()
    {
        $lemburs = Lembur::all();
        return view('admin.lembur',compact('lemburs'));
    }
    public function acc_lembur(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mulai_lembur'  => 'required',
            'selesai_lembur'    => 'required',
            'durasi'    => 'required',
            'status'    => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $approve = 0;
        if ($request->status != 'Denied') {
            $approve = 1;
        }
        $lembur = Lembur::find($request->lembur_id);
        $lembur->update([
            'status' => $request->status,
            'durasi' => $request->durasi,
            'approve' => $approve,
        ]);
        $message = 'Lembur Karyawan '.$request->karyawan.' '.$request->status.' successfully.';
        return redirect()->route('index.lembur')
                        ->with('success',$message);
    }
    public function index_absen()
    {
        $absensi = Absensi::all();
        $karyawan = Karyawan::all();
        return view('admin.absensi',compact('absensi','karyawan'));
    }
    public function store_absen(Request $request)
    {
        $this->validate($request, [
            'id_karyawan' => 'required',
            'tanggal' => 'required',
            'jam_masuk' => 'required',
            'jam_keluar' => 'required'
        ]);
        $aktif = JadwalAktifKaryawan::where('tanggal',$request->tanggal)
                    ->where('id_karyawan',$request->id_karyawan)->first();

        $jam_mulai = Carbon::createFromFormat('H:s:i', $aktif->aktif->jam_mulai);
        $jam_masuk = Carbon::createFromFormat('H:s', $request->jam_masuk);
        $jam_keluar = Carbon::createFromFormat('H:s', $request->jam_keluar);
        $selisih = $jam_mulai->diff($jam_masuk);


        if ($jam_masuk <= $jam_mulai) {
            $kode = 'E';
        }
        elseif ($selisih->h <= 1) {
            $kode = 'V';
        }
        elseif ($selisih->h > 1) {
            $kode = 'L';
        }
        else{
            $kode = 'A';
        }

        $absensi = Absensi::create([
            'karyawans_id' => $request->id_karyawan,
            'tanggal' => $request->tanggal,
            'jadwalaktif_id' => $aktif->id,
            'jam_masuk' => $request->jam_masuk,
            'jam_keluar' => $request->jam_keluar,
            'kode' => $kode,
        ]);
        $message = 'Absensi '.$aktif->karyawan->nama.' tanggal '.$aktif->tanggal.' added successfully.';
        return redirect()->route('index.absen')
                        ->with('success',$message);
    }
    public function import_absen(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|file|max:1024|mimes:xls,xlsx',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $array = Excel::ToArray(new JadwalAktifImport,request()->file('file'))[0];
        $kode='';
        for ($i=0; $i < count($array) ; $i++) { 
            $jadwal = JadwalAktifKaryawan::where('tanggal',$array[$i]['tanggal'])->first();
            $jam_mulai = Carbon::createFromFormat('H:s:i', $jadwal->aktif->jam_mulai);
            $jam_masuk = Carbon::createFromFormat('H:s', $array[$i]['jam_masuk']);
            $jam_keluar = Carbon::createFromFormat('H:s', $array[$i]['jam_keluar']);
            $selisih = $jam_mulai->diff($jam_masuk);


            if ($jam_masuk <= $jam_mulai) {
                $kode = 'E';
            }
            elseif ($selisih->h <= 1) {
                $kode = 'V';
            }
            elseif ($selisih->h > 1) {
                $kode = 'L';
            }
            else{
                $kode = 'A';
            }

            Absensi::create([
                'karyawans_id'  => $array[$i]['id_karyawan'],
                'jadwalaktif_id'=> $jadwal->id,
                'jam_masuk'     => $jam_masuk,
                'jam_keluar'    => $jam_keluar,
                'kode'          => $kode
            ]);
            $tanggal = $array[$i]['tanggal'];
        }
        $message = 'Import Absensi tanggal '.$tanggal.' successfully.';
        return redirect()->route('index.absen')
                        ->with('success',$message);
    }
    public function update_absen(Request $request)
    {
        $this->validate($request, [
            'id_absensi' => 'required',
            'kode' => 'required',
        ]);
        $absen = Absensi::find($request->id_absensi);
        $absen->kode = $request->kode;
        $absen->save();
        return redirect()->route('index.absen')
                        ->with('success','Absensi '.$absen->karyawan->nama.' tanggal '.$absen->jadwal->tanggal.' updated successfully.');
    }
    public function delete_absen($id)
    {
        $absen = Absensi::find($id);
        $message = 'Absensi '.$absen->karyawan->nama.' tanggal '.$absen->jadwal->tanggal.' deleted successfully.';
        $absen->delete();
        return redirect()->route('index.absen')
                        ->with('success',$message);

    }
    public function data_lembur()
    {
        $lembur = Lembur::all();
        $data = [];
        for ($i=0; $i < count($lembur); $i++) { 
            $data [] = [
                'id'    => $lembur[$i]->id,
                'karyawan' => $lembur[$i]->karyawan->nama,
                'mulai_lembur' => Carbon::createFromFormat('Y-m-d H:i:s', $lembur[$i]->mulai_lembur)->format('d F Y, H:i'),
                'selesai_lembur' => Carbon::createFromFormat('Y-m-d H:i:s', $lembur[$i]->selesai_lembur)->format('d F Y, H:i'),
                'durasi' => $lembur[$i]->durasi,
                'detail' => $lembur[$i]->detail,
                'status' => $lembur[$i]->status,
                'created_at' => $lembur[$i]->created_at->format('d F Y, H:i'),
            ];
        }
        $row = [
            'total' => $lembur->count(),
            'totalNotFiltered' => $lembur->count(),
            'rows' => $data
        ];
        return $row;
    }
    public function data_jadwal()
    {
        $jadwal = JadwalAktifKaryawan::orderBy('id_karyawan')->orderBy('tanggal')->get();
        $data = [];
        for ($i=0; $i < count($jadwal); $i++) { 
            $data [] = [
                'id'    => $jadwal[$i]->id,
                'tanggal' => $jadwal[$i]->tanggal,
                'karyawan' => $jadwal[$i]->karyawan->nama,
                'shift' => $jadwal[$i]->aktif->name,
            ];
        }
        $row = [
            'total' => $jadwal->count(),
            'totalNotFiltered' => $jadwal->count(),
            'rows' => $data
        ];
        return $row;
    }
    public function index_jadwal_off()
    {
        $jadwal_offs = JadwalOff::all();
        $judul = "Jadwal Off";
        return view('admin.index_jadwaloff',compact('jadwal_offs','judul'));
    }
    public function update_jadwal_off(Request $request)
    {
        $jadwal_off = JadwalOff::find($request->id);
        $this->validate($request, [
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'status' => 'required',
            'jenis' => 'required',
            'durasi' => 'required|numeric'
        ]);
        if ($request->status == "Approve") {
            switch ($jadwal_off->jenis) {
                case 'cuti':
                    $karyawan = $jadwal_off->karyawan;
                    $kuota_cuti = $karyawan->sisa_quota_cuti;
                    $karyawan->sisa_quota_cuti = $kuota_cuti - $jadwal_off->durasi;
                    $jadwal_off->status = $request->status;
                    $karyawan->save();
                    $jadwal_off->save();
                    $message = 'Pengajuan '.$request->jenis.' oleh karyawan '.$karyawan->nama.' '.$request->status.' successfully.';
                    break;
                
                default:
                    # code...
                    break;
            }
        }
        return redirect()->route('index.jadwal_off')
                        ->with('success',$message);
    }
    public function destroy_jadwal_off($id)
    {
        $jadwal_off = JadwalOff::find($id);
        $message = "Pengajuan ".$jadwal_off->jenis." oleh ".$jadwal_off->karyawan->nama." deleted successfully.";
        $jadwal_off->delete();

        return redirect()->route('index.jadwal_off')
                        ->with('success',$message);
    }
    public function index_cuti()
    {
        $jadwal_offs = JadwalOff::all()->where('jenis','cuti');
        $judul = "Cuti";
        return view('admin.index_jadwaloff',compact('jadwal_offs','judul'));
    }
    public function index_izin()
    {
        $jadwal_offs = JadwalOff::all()->where('jenis','izin');
        $judul = "Izin";
        return view('admin.index_jadwaloff',compact('jadwal_offs','judul'));
    }
    public function index_ganti_shift()
    {
        $ganti_shift = ChangeJadwal::all();

        return view('admin.index_ganti_shift',compact('ganti_shift'));
    }
    public function index_report_shift(Request $request)
    {
        $karyawans = Karyawan::all();
        $karyawan = null;
        if (isset($request->id)) {
            $karyawan = Karyawan::find($request->id);
        }
        return view('admin.report_shift',compact('karyawan','karyawans'));
    }
    public function index_report_absen(Request $request)
    {
        $karyawans = Karyawan::all();
        $karyawan = null;
        if (isset($request->id)) {
            $karyawan = Karyawan::find($request->id);
        }
        return view('admin.report_absen',compact('karyawan','karyawans'));
    }
}
