<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Lembur;
use App\Karyawan;
use App\Gaji;
use App\PenambahanGaji;
use App\PenguranganGaji;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;
use App\Imports\JadwalAktifImport;
use App\Imports\TambahGajiImport;
use App\Imports\KurangGajiImport;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;


class GajiKaryawanController extends Controller
{
    public function index(Request $request)
    {
    	$karyawans = Karyawan::all();
        $karyawan = null;
        $now = Carbon::now();
        $tambah_gaji = null;
        $kurang_gaji = null;
        if ($request->id != null) {
            $karyawan = Karyawan::find($request->id);
            $tambah_gaji = PenambahanGaji::where('karyawans_id',$karyawan->id)->where('gaji_id',null)->whereMonth('created_at',$now->month)->whereYear('created_at',$now->year)->get();
            $kurang_gaji = PenguranganGaji::where('karyawans_id',$karyawan->id)->where('gaji_id',null)->whereMonth('created_at',$now->month)->whereYear('created_at',$now->year)->get();
        }
        return view('admin.penggajian',compact('karyawans','karyawan','tambah_gaji','kurang_gaji','now'));
    }
    public function store(Request $request)
    {
    	$validator = Validator::make($request->all(), [
            'base_salary' => 'required|numeric',
            'penambahan' => 'required|numeric',
            'pengurangan' => 'required|numeric',
            'total' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $now = Carbon::now();
        $karyawan = Karyawan::find($request->karyawan_id);
        $cek = Gaji::where('karyawans_id',$karyawan->id)->whereMonth('created_at',$now->month)->whereYear('created_at',$now->year)->first();
        if ($cek != null) {
            return redirect()->back()->withErrors(['Penggajian '.$karyawan->nama.' sudah terhitung. coba hitung gaji karyawan lain.'])->withInput();
        }
    	$gaji = Gaji::create([
    		'karyawans_id'	=> $request->karyawan_id,
    		'penambahan'	=> $request->penambahan,
    		'pengurangan'	=> $request->pengurangan,
    		'total'			=> $request->total,
    	]);
        $tambah_gaji = PenambahanGaji::where('karyawans_id',$karyawan->id)->where('gaji_id',null)->whereMonth('created_at',$now->month)->whereYear('created_at',$now->year)->get();
        $kurang_gaji = PenguranganGaji::where('karyawans_id',$karyawan->id)->where('gaji_id',null)->whereMonth('created_at',$now->month)->whereYear('created_at',$now->year)->get();
        foreach ($tambah_gaji as $tambah) {
            $tambah->gaji_id = $gaji->id;
            $tambah->save();
        }
        foreach ($kurang_gaji as $kurang) {
            $kurang->gaji_id = $gaji->id;
            $kurang->save();
        }
    	$message = 'Penggajian karyawan '.$karyawan->nama.' added successfully.';
        return redirect()->back()
                        ->with('success',$message);
    }
    public function index_penambahangaji(Request $request)
    {
        $karyawans = Karyawan::all();
        $gajis = PenambahanGaji::all();
        if (isset($request->bulan)) {
            $gajis = PenambahanGaji::whereMonth('created_at','=',$request->bulan)->get();
        }
        return view('admin.tambah_gaji',compact('karyawans','gajis'));
    }
    public function store_penambahangaji(Request $request)
    {
        if ($request->hasFile('file')) {
            $this->validate($request, [
                'file' => 'required|file|max:1024|mimes:xls,xlsx',
            ]);
            return 'import';
            $import = Excel::import(new TambahGajiImport,request()->file('file'));
            $message = 'Penambahan Gaji imported successfully.';
        }
        else{
            $this->validate($request, [
                'karyawans_id' => 'required',
                'detail' => 'required',
                'nominal' => 'required|numeric',
            ]);
            $tambah_gaji = PenambahanGaji::create([
                'karyawans_id' => $request->karyawans_id,
                'nominal' => $request->nominal,
                'detail' => $request->detail
            ]);
            $message = 'Penambahan Gaji '.$tambah_gaji->detail.' Karyawan '.$tambah_gaji->karyawan->nama.' added successfully.';
        }
        return redirect()->route('index.tambah_gaji')
                        ->with('success',$message);
    }
    public function update_penambahangaji(Request $request)
    {
        $this->validate($request, [
            'karyawans_id' => 'required',
            'detail' => 'required',
            'nominal' => 'required|numeric'
        ]);
        $gaji = PenambahanGaji::find($request->id);
        $gaji->update([
            'nominal' => $request->nominal,
            'detail' => $request->detail
        ]);
        $message = 'Penambahan Gaji '.$gaji->karyawan->nama.' updated successfully.';
        return redirect()->route('index.tambah_gaji')
                        ->with('success',$message);
    }
    public function delete_penambahangaji($id)
    {
        $gaji = PenambahanGaji::find($id);
        $gaji->delete();
        $message = 'Pengurangan Gaji '.$gaji->detail.' Karyawan '.$gaji->karyawan->nama.' deleted successfully.';
        return redirect()->route('index.tambah_gaji')
                        ->with('success',$message);
    }
    public function index_pengurangangaji()
    {
        $karyawans = Karyawan::all();
        $gajis = PenguranganGaji::all();
        return view('admin.kurang_gaji',compact('karyawans','gajis'));
    }
    public function store_pengurangangaji(Request $request)
    {
        if ($request->hasFile('file')) {
            $this->validate($request, [
                'file' => 'required|file|max:1024|mimes:xls,xlsx',
            ]);
            $array = Excel::import(new KurangGajiImport,request()->file('file'));
            $message = 'Pengurangan Gaji imported successfully.';
        }else{
             $this->validate($request, [
                'karyawans_id' => 'required',
                'detail' => 'required',
                'nominal' => 'required|numeric',
            ]);
            $kurang_gaji = PenguranganGaji::create([
                'karyawans_id' => $request->karyawans_id,
                'nominal' => $request->nominal,
                'detail' => $request->detail
            ]);
            $message = 'Pengurangan Gaji '.$kurang_gaji->detail.' Karyawan '.$kurang_gaji->karyawan->nama.' added successfully.';
        }
        return redirect()->route('index.kurang_gaji')
                        ->with('success',$message);
    }
    public function update_pengurangangaji(Request $request)
    {
        $this->validate($request, [
            'karyawans_id' => 'required',
            'detail' => 'required',
            'nominal' => 'required|numeric'
        ]);
        $gaji = PenguranganGaji::find($request->id);
        $gaji->update([
            'nominal' => $request->nominal,
            'detail' => $request->detail
        ]);
        $message = 'Pengurangan Gaji '.$gaji->karyawan->nama.' updated successfully.';
        return redirect()->route('index.kurang_gaji')
                        ->with('success',$message);
    }
    public function delete_pengurangangaji($id)
    {
        $gaji = PenguranganGaji::find($id);
        $gaji->delete();
        $message = 'Pengurangan Gaji '.$gaji->detail.' Karyawan '.$gaji->karyawan->nama.' deleted successfully.';
        return redirect()->route('index.kurang_gaji')
                        ->with('success',$message);
    }
    public function index_report_gaji(Request $request)
    {
        $reports = Gaji::all();
        if (isset($request->bulan) && isset($request->tahun)) {
            $reports = Gaji::whereMonth('created_at',$request->bulan)->whereYear('created_at',$request->tahun)->get();
        }
        elseif (isset($request->bulan)) {
            $reports = Gaji::whereMonth('created_at',$request->bulan)->get();
        }
        elseif (isset($request->tahun)) {
            $reports = Gaji::whereYear('created_at',$request->tahun)->get();
        }
        $total = $reports->sum('total');
        return view('admin.report_gaji',compact('reports','total'));
    }
    public function index_report_gaji_karyawan(Request $request)
    {   
        $karyawans = Karyawan::all();
        $karyawan = null;
        $gaji = null;
        if (isset($request->id)) {
            $karyawan = Karyawan::find($request->id);
            $gaji = Gaji::where('karyawans_id',$karyawan->id)->orderby('created_at','desc')->first();
            if (isset($request->bulan) && isset($request->tahun)) {
                $gaji = Gaji::where('karyawans_id',$karyawan->id)->whereMonth('created_at',$request->bulan)->whereYear('created_at',$request->tahun)->first();
            }
            elseif (isset($request->bulan)) {
                $gaji = Gaji::where('karyawans_id',$karyawan->id)->whereMonth('created_at',$request->bulan)->first();
            }
            elseif (isset($request->tahun)) {
                $gaji = Gaji::where('karyawans_id',$karyawan->id)->whereYear('created_at',$request->tahun)->first();
            }
        }
        return view('admin.report_gaji_karyawan',compact('karyawans','karyawan','gaji'));
    }
    public function index_report_penambahan(Request $request)
    {   
        $karyawans = Karyawan::all();
        $karyawan = null;
        $gaji = null;
        if (isset($request->id)) {
            $karyawan = Karyawan::find($request->id);
            $gaji = Gaji::where('karyawans_id',$karyawan->id)->orderby('created_at','desc')->first();
            if (isset($request->bulan) && isset($request->tahun)) {
                $gaji = Gaji::where('karyawans_id',$karyawan->id)->whereMonth('created_at',$request->bulan)->whereYear('created_at',$request->tahun)->first();
            }
            elseif (isset($request->bulan)) {
                $gaji = Gaji::where('karyawans_id',$karyawan->id)->whereMonth('created_at',$request->bulan)->first();
            }
            elseif (isset($request->tahun)) {
                $gaji = Gaji::where('karyawans_id',$karyawan->id)->whereYear('created_at',$request->tahun)->first();
            }
        }
        return view('admin.report_penambahan',compact('karyawans','karyawan','gaji'));
    }
    public function index_report_pengurangan(Request $request)
    {   
        $karyawans = Karyawan::all();
        $karyawan = null;
        $gaji = null;
        if (isset($request->id)) {
            $karyawan = Karyawan::find($request->id);
            $gaji = Gaji::where('karyawans_id',$karyawan->id)->orderby('created_at','desc')->first();
            if (isset($request->bulan) && isset($request->tahun)) {
                $gaji = Gaji::where('karyawans_id',$karyawan->id)->whereMonth('created_at',$request->bulan)->whereYear('created_at',$request->tahun)->first();
            }
            elseif (isset($request->bulan)) {
                $gaji = Gaji::where('karyawans_id',$karyawan->id)->whereMonth('created_at',$request->bulan)->first();
            }
            elseif (isset($request->tahun)) {
                $gaji = Gaji::where('karyawans_id',$karyawan->id)->whereYear('created_at',$request->tahun)->first();
            }
        }
        return view('admin.report_pengurangan',compact('karyawans','karyawan','gaji'));
    }
    public function index_report_lembur(Request $request)
    {
        $karyawan = Karyawan::all();
        $r_bulan = Carbon::now()->month;
        $r_tahun = Carbon::now()->year;
        if ((isset($request->bulan) && $request->bulan != 'semua') && (isset($request->tahun) && $request->tahun != 'semua')) {
            $r_bulan = $request->bulan;
            $r_tahun = $request->tahun;
        }
        elseif (isset($request->bulan)  && $request->bulan != 'semua'){
            $r_bulan = $request->bulan;
        }
        elseif (isset($request->tahun) && $request->tahun != 'semua'){
            $r_tahun = $request->tahun;
        }
        return view('admin.report_lembur',compact('karyawan','r_bulan','r_tahun'));
    }
}
