<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Lembur;
use App\Karyawan;
use App\JadwalShift;
use App\JadwalOff;
use App\ChangeJadwal;
use App\JadwalAktifKaryawan;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use App\Imports\JadwalAktifImport;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;


class KaryawanActController extends Controller
{
    public function index_lembur()
    {
        $auth = Auth::user()->karyawan->id;
        $lembur = Lembur::where('karyawans_id',$auth)->get();
    	return view('user.lembur',compact('lembur'));
    }
    public function store_lembur(Request $request)
    {
        $messages = [
            'between' => "The durasi must be between 1-13 hour.",
        ];
        $validator = Validator::make($request->all(), [
            'mulai_lembur'  => 'required',
            'selesai_lembur'    => 'required',
            'durasi'    => 'required|numeric|between:1,13',
            'detail'    => 'required',
            'status'    => 'required',
        ],$messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $karyawan = Karyawan::where('users_id',Auth::user()->id)->first();
        $tanggal_mulai = substr($request->mulai_lembur,8,2);
        $jam_mulai = substr($request->mulai_lembur,11,5);
        $jam_selesai = substr($request->selesai_lembur,11,5);
        $jadwal = $karyawan->jadwal->where('tanggal',$tanggal_mulai)->first();
        if ($jadwal == null) {
            return redirect()->back()->with('error_lembur','You do not have an active schedule on that date.')->withInput();
        }
        if (($jam_mulai>=$jadwal->aktif->jam_mulai && $jam_selesai<=$jadwal->aktif->jam_selesai) || ($jam_mulai<=$jadwal->aktif->jam_selesai && $jam_selesai>=$jadwal->aktif->jam_mulai)) {
            $message = 'Overtime hours may not be between shift hours !';
            return redirect()->back()->with('error_lembur',$message)->withInput();
        }
        
        $lembur = Lembur::create([
            'karyawans_id'  =>  Auth::user()->karyawan->id,
            'mulai_lembur'  =>  $request->mulai_lembur.=':00',
            'selesai_lembur'=>  $request->selesai_lembur.=':00',
            'durasi'        =>  $request->durasi,
            'detail'        =>  $request->detail,
            'status'        =>  $request->status,
        ]);
        $message = 'Pengajuan Lembur Tanggal '.$lembur->created_at->format('d-F-Y').' added successfully.';
        return redirect()->route('indexk.lembur')
                        ->with('success',$message);
    }
    public function update_lembur(Request $request)
    {
        $messages = [
            'between' => "Duration of overtime must be between 1-13 hour.",
        ];
        $validator = Validator::make($request->all(), [
            'mulai_lembur'  => 'required',
            'selesai_lembur'    => 'required',
            'durasi'    => 'required|numeric|between:1,13',
            'detail'    => 'required',
            'status'    => 'required',
        ],$messages);
        if ($jadwal == null) {
            return redirect()->back()->with('error_lembur','You do not have an active schedule on that date.')->withInput();
        }
        if (($jam_mulai>=$jadwal->aktif->jam_mulai && $jam_selesai<=$jadwal->aktif->jam_selesai) || ($jam_mulai<=$jadwal->aktif->jam_selesai && $jam_selesai>=$jadwal->aktif->jam_mulai)) {
            $message = 'Overtime hours may not be between shift hours !';
            return redirect()->back()->with('error_lembur',$message)->withInput();
        }
        $lembur = Lembur::find($request->lembur_id);
        $lembur->update([
            'mulai_lembur' => Carbon::parse($request->mulai_lembur),
            'selesai_lembur' => Carbon::parse($request->selesai_lembur),
            'durasi' => $request->durasi,
            'detail' => $request->detail,
        ]);
        $message = 'Submission Overtime Date '.$lembur->created_at->format('d-F-Y').' updated successfully.';
        return redirect()->route('indexk.lembur')
                        ->with('success',$message);
    }
    public function destroy_lembur($id)
    {
        $lembur = Lembur::find($id);
        $message = 'Submission Overtime Date '.$lembur->created_at->format('d-F-Y').'deleted successfully.';
        $lembur->delete();

        return redirect()->route('indexk.lembur')
                        ->with('success',$message);
        
    }
    public function index_jadwal_off()
    {
        $karyawan = Auth::user()->karyawan;
        $jadwal_off = JadwalOff::where('karyawans_id',$karyawan->id)->get();
        return view('user.cuti',compact('karyawan','jadwal_off'));
    }
    public function store_jadwal_off(Request $request)
    {
        $this->validate($request, [
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'status' => 'required',
            'jenis' => 'required',
            'durasi' => 'required|numeric'
        ]);
        if (isset($request->id_jadwaloff)) {
            
            $cuti = JadwalOff::find($request->id_jadwaloff);
            $cuti->update([
                'jenis' => $request->jenis,
                'tanggal_mulai' => $request->tanggal_mulai,
                'tanggal_selesai' => $request->tanggal_selesai,
                'durasi' => $request->durasi,
            ]);
            $message = 'Pengajuan '.$request->jenis.' Tanggal '.$cuti->tanggal_mulai.' sampai '.$cuti->tanggal_selesai.' updated successfully.';
        }
        else{
            if ($request->durasi >= 6 && $request->jenis == 'izin') {
                return redirect()->back()->withInput()->withErrors('permission',"Permission cannot be processed because the duration exceeds the provisions, Please use the leave form.");
            }
            $karyawan = Auth::user()->karyawan;
            $cuti = JadwalOff::create([
                'karyawans_id' => $karyawan->id,
                'jenis' => $request->jenis,
                'status' => $request->status,
                'tanggal_mulai' => $request->tanggal_mulai,
                'tanggal_selesai' => $request->tanggal_selesai,
                'durasi' => $request->durasi,
            ]);
            $message = 'Pengajuan '.$request->jenis.' Tanggal '.$cuti->tanggal_mulai->format('d F Y').' sampai '.$cuti->tanggal_selesai->format('d F Y').' successfully.';
        }
        
        return redirect()->route('indexk.jadwal_off')
                        ->with('success',$message);
        
    }
    public function update_jadwal_off()
    {

    }
    public function index_jadwal()
    {
        $auth = Auth::user()->karyawan;
        $jadwal = $auth->jadwal;
        $data = [];
        for ($i=0; $i < count($jadwal); $i++) { 
            $jam_mulai = Carbon::createFromFormat('H:i:s',$jadwal[$i]->aktif->jam_mulai)->format('H:i');
            $jam_selesai = Carbon::createFromFormat('H:i:s',$jadwal[$i]->aktif->jam_selesai)->format('H:i');
            $jadwal->jam_mulai = $jam_mulai;
            $jadwal->jam_selesai = $jam_selesai;
        }
        $shifts = JadwalShift::all()->where('id','!=',17)->where('id','!=',18);
        return view('user.jadwal',compact('jadwal','shifts'));
    }
    public function data_lembur()
    {
        $auth = Auth::user()->karyawan->id;
        $lembur = Lembur::where('karyawans_id',$auth)->get();
        return $lembur;
    }
    public function data_jadwal()
    {
        $auth = Auth::user()->karyawan->id;
        $karyawan = Karyawan::where('id',$auth)->first();
        $jadwal = $karyawan->jadwal;
        $data = [];
        for ($i=0; $i < count($jadwal); $i++) { 
            $jam_mulai = Carbon::createFromFormat('H:i:s',$jadwal[$i]->aktif->jam_mulai)->format('H:i');
            $jam_selesai = Carbon::createFromFormat('H:i:s',$jadwal[$i]->aktif->jam_selesai)->format('H:i');
            $data[] = [
                'tanggal'  => $jadwal[$i]->tanggal,
                'jadwal'       => $jadwal[$i]->aktif->name,
                'jam_mulai' => $jam_mulai,
                'jam_selesai' => $jam_selesai,
            ];
        }
        return $data;

    }
    public function get_karyawan(Request $request)
    {
        $karyawan = Auth::user()->karyawan;
        $jadwal = JadwalAktifKaryawan::where('tanggal',$request->tanggal)->where('id_jadwal',$request->shift)->get();
        $karyawans = [];
        if ($request->id == 4 || $request->id == 5 || $request->id == 15 || $request->id == 16) {
            foreach ($jadwal as $karyawan) {
                $karyawans [] = [
                    'id' => $karyawan->karyawan->id,
                    'nama' => $karyawan->karyawan->nama
                ];
            }
        }
        return $karyawans;
    }
    public function index_ganti_shift()
    {   
        $user = Auth::user()->karyawan;
        $shifts = JadwalShift::all()->where('id','!=',17)->where('id','!=',18);
        $ganti_shift = ChangeJadwal::where('karyawans_id',$user->id)->orWhere('id_pengganti',$user->id)->get();
        return view('user.ganti_shift',compact('ganti_shift','shifts'));
    }
    public function store_gantishift(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id'  => 'required',
            'id_jadwal'    => 'required',
            'tanggal'    => 'required|numeric',
            'karyawans_id'    => 'required',
        ]);
        $approve = null;
        if (($request->id == 4 || $request->id == 5 || $request->id == 15 || $request->id == 16) && $request->karyawans_id == 'null') {
            return redirect()->back()->withErrors('error','Jika Shift awal adalah D,E,O,P. Maka harus ada karyawan pengganti.');
        }
        elseif ($request->karyawans_id == 'null') {
            
            $karyawan_pengganti = "Tanpa Karyawan Pengganti";
            $request->karyawans_id = null;
            $message = 'Pengajuan ganti Jadwal dengan'.$karyawan_pengganti.' successfully.';
            $approve = 1;
        }else{
            $karyawan_pengganti = Karyawan::find($request->karyawans_id);
            $message = 'Pengajuan ganti Jadwal dengan'.$karyawan_pengganti->nama.' successfully.';
        }
        $karyawan = Auth::user()->karyawan;
        $ganti = ChangeJadwal::create([
            'tanggal' => $request->tanggal,
            'shift_awal' => $request->id,
            'shift_ganti' => $request->id_jadwal,
            'karyawans_id' => $karyawan->id,
            'id_pengganti' => $request->karyawans_id,
            'approve' => $approve,
        ]);
        return redirect()->route('index.ganti_shift')
                        ->with('success',$message);
    }
    public function update_gantishift(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id'  => 'required',
            'id_jadwal'    => 'required',
            'tanggal'    => 'required|numeric',
            'karyawans_id'    => 'required',
        ]);
        if (($request->id == 4 || $request->id == 5 || $request->id == 15 || $request->id == 16) && $request->karyawans_id == 'null') {
            return redirect()->back()->withErrors('error','Jika Shift awal adalah D,E,O,P. Maka harus ada karyawan pengganti.');
        }
        elseif($request->karyawans_id == 'null') {
            
            $approve = 1;
            $karyawan_pengganti = "Tanpa Karyawan Pengganti";
            $request->karyawans_id = null;
            $message = 'Pengajuan ganti Jadwal dengan'.$karyawan_pengganti.' updated successfully.';
        }else{
            $approve = null;
            $karyawan_pengganti = Karyawan::find($request->karyawans_id);
            $message = 'Pengajuan ganti Jadwal dengan'.$karyawan_pengganti->nama.' updated successfully.';
        }
        $jadwal = JadwalAktifKaryawan::find($request->id);
        $ganti = ChangeJadwal::find($request->id_ganti)->update([
            'tanggal' => $jadwal->tanggal,
            'shift_ganti' => $request->id_jadwal,
            'karyawans_id' => $jadwal->id_karyawan,
            'id_pengganti' => $request->karyawans_id,
            'approve' => $approve,
        ]);
        return redirect()->route('index.ganti_shift')
                        ->with('success',$message);
    }
    public function konfirm_gantishift(Request $request)
    {
        $jadwal = ChangeJadwal::find($request->id);
        switch ($request->status) {
            case 'accept':
                $acc = $jadwal->update([
                    'approve' => 1
                ]);
                if ($acc == true) {
                    $ganti_shift = JadwalAktifKaryawan::where('tanggal',$jadwal->tanggal)
                                    ->where('id_karyawan',$jadwal->karyawans_id)->first();
                    $ganti_shift->update(['id_jadwal' => $jadwal->shift_ganti]);
                }
                $message = 'Konfirmasi Ganti Jadwal successfully.';
                return redirect()->route('index.ganti_shift')->with('success',$message);
                break;
            case 'decline':
                $acc = $jadwal->update([
                    'approve' => 2
                ]);
                $message = 'Penolakan Ganti Jadwal successfully.';
                return redirect()->route('index.ganti_shift')->with('success',$message);
                break;
            case 'cancel':
                $jadwal->delete();
                $message = 'Pembatalan Ganti Jadwal successfully.';
                return redirect()->route('index.ganti_shift')->with('success',$message);
                break;
            
            default:
                $message = 'Something Wrong, Try Again.';
                return redirect()->route('index.ganti_shift')->with('success',$message);
                break;
        }
    }
    public function profile()
    {
        $karyawan = Auth::user()->karyawan;
        return view('user.profile',compact('karyawan'));
    }
}
