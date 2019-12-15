<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Karyawan;
use App\Department;
use App\Leveling;
use App\StatusKaryawan;
use App\User;
use App\Mutasi;
use Hash;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class ManageKaryawanController extends Controller
{
    public function index()
    {
        $karyawan = Karyawan::all();
        return view("admin.karyawan",compact('karyawan'));
    }
    public function create()
    {
    	$departments = Department::all();
    	$levelings = Leveling::all();
    	$status_karyawans = StatusKaryawan::all();
    	return view('admin.create_karyawan', compact('departments','levelings','status_karyawans'));
    }
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'nama' => 'required|max:80',
            'nickname' => 'required',
            'email' => 'required|email|unique:users',
            'photo_profile' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $randompass = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,8);
        $user = User::create([
            'name' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($randompass),
            'is_admin' => false
        ]);
        $photo_profile = 'photo_'.$user->id.'.'.$request->photo_profile->getClientOriginalExtension();
        Karyawan::create([
            'users_id' => $user->id,
            'nama' => $request['nama'],
            'nickname'=> $request['nickname'],
            'department_id'=> $request['department_id'],
            'level_id'=> $request['leveling'],
            'jabatan'=> $request['jabatan'],
            'nik'=> $request['nik'],
            'status_id'=> $request['status_karyawan'],
            'tanggal_training'=> $request['tanggal_training'],
            'tanggal_masuk'=> $request['tanggal_masuk'],
            'tanggal_keluar'=> $request['tanggal_keluar'],
            'alamat_ktp'=> $request['alamat_ktp'],
            'alamat_tinggal'=> $request['alamat_tinggal'],
            'no_telp'=> $request['no_telp'],
            'tanggal_lahir'=> $request['tanggal_lahir'],
            'usia'=> $request['usia'],
            'no_ktp'=> $request['no_ktp'],
            'no_npwp'=> $request['no_npwp'],
            'klasifikasi_pajak'=> $request['klasifikasi_pajak'],
            'kpj_bpjs'=> $request['kpj_bpjs'],
            'bpjs_kesehatan'=> $request['bpjs_kesehatan'],
            'no_rek'=> $request['no_rek'],
            'jenis_kelamin'=> $request['jenis_kelamin'],
            'status_nikah'=> $request['status_nikah'],
            'jumlah_anak'=> $request['jumlah_anak'],
            'jenjang_pendidikan'=> $request['jenjang_pendidikan'],
            'asal_sekolah'=> $request['asal_sekolah'],
            'jurusan'=> $request['jurusan'],
            'tahun_masuk_pendidikan'=> $request['tahun_masuk_pendidikan'],
            'tahun_keluar_pendidikan'=> $request['tahun_keluar_pendidikan'],
            'golongan_darah'=> $request['golongan_darah'],
            'nama_kerabat'=> $request['nama_kerabat'],
            'notelp_kerabat'=> $request['notelp_kerabat'],
            'benefit_karyawan'=> $request['benefit_karyawan'],
            'photo_profile'=> $photo_profile,
            'base_salary'=> $request['base_salary'],
            'quota_cuti'=> $request['quota_cuti'],
        ]);
        $request->photo_profile->move('resources/images/photo_profile/', $photo_profile);
        $message = 'Karyawan '.$request['nama'].' added successfully.';
        $message1 = 'Email: '.$user->email.' || Password : '.$randompass;
        return redirect()->route('index.karyawan')
                        ->with('success',$message)
                        ->with('add', $message1);
    }
    public function data_karyawan()
    {
        $karyawan = Karyawan::all();
        return $karyawan;
    }
    public function edit($id)
    {
        $karyawan = Karyawan::find($id);
        $departments = Department::all();
        $levelings = Leveling::all();
        $status_karyawans = StatusKaryawan::all();
        return view('admin.edit_karyawan',compact('karyawan','departments','levelings','status_karyawans'));
    }
    public function update($id, Request $request)
    {
        $karyawan = Karyawan::find($id);
        $karyawan->users->update(['email' => $request->email]);

        $photo_profile = 'photo_'.$karyawan->users->id.'.'.$request->photo_profile->getClientOriginalExtension();

        $request->photo_profile->move('resources/images/photo_profile/', $photo_profile);

        $karyawan->update($request->except('email','photo_profile'));
        $message = 'Karyawan '.$karyawan->nama.' updated successfully.';
        return redirect()->route('index.karyawan')
                        ->with('success',$message);
    }
    public function delete($id)
    {

        $karyawan = Karyawan::find($id);
        $karyawan->users->delete();
        $karyawan->delete();

        $message = 'Karyawan '.$karyawan->nama.' deleted successfully.';
        return redirect()->route('index.karyawan')
                        ->with('success',$message);
    }
    public function index_mutasi()
    {
        $mutasi = Mutasi::all();
        $karyawan = Karyawan::all();

        return view('admin.mutasi',compact('mutasi','karyawan'));
    }
    public function create_mutasi($id)
    {
        $karyawan = Karyawan::find($id);
        $levelings = Leveling::all();
        return view('admin.create_mutasi',compact('karyawan','levelings'));
    }
    public function store_mutasi($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|max:50',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $karyawan = Karyawan::find($id);
        $mutasi = Mutasi::create([
            'karyawans_id' => $karyawan->id,
            'status' => $request->status,
            'tanggal' => $request->tanggal_masuk,
            'adjustments' => $request->adjustments,
        ]);
        $karyawan->update([
            'jabatan' => $request->jabatan,
            'level_id' => $request->level_id,
            'tanggal_masuk' => $request->tanggal_masuk,
        ]);

        $message = 'Buat Surat '.$mutasi->status;
        return redirect()->route('index.mutasi')
                        ->with('success',$message);
    }
    public function update_mutasi(Request $request){
        $validator = Validator::make($request->all(), [
            'id'   => 'required',
            'id_karyawan'   => 'required',
            'nama' => 'required|max:50',
            'status' => 'required|max:50',
            'tanggal' => 'required',

        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $mutasi = Mutasi::find($request->id);
        $mutasi->update([
            'karyawans_id'  => $request->id_karyawan,
            'status' => $request->status,
            'tanggal' => $request->tanggal,
        ]);
        $message = 'Edit Surat '.$mutasi->status.' Karyawan'. $mutasi->karyawan->nama;
        return redirect()->route('index.mutasi')
                        ->with('success',$message);
    }
    public function delete_mutasi($id){
        $mutasi = Mutasi::find($id);
        $message = 'Delete Surat '.$mutasi->status.' Karyawan'. $mutasi->karyawan->nama;
        $mutasi->delete();
        return redirect()->route('index.mutasi')
                        ->with('success',$message);
    }
    public function index_quota()
    {
        $karyawans = Karyawan::all();
        return view('admin.index_quota',compact('karyawans'));
    }
    public function update_quota(Request $request)
    {
        $this->validate($request, [
            'quota_cuti' => 'required|numeric',
        ]);
        $karyawan = Karyawan::find($request->id_karyawan);
        $karyawan->quota_cuti = $request->quota_cuti;
        $karyawan->save();

        return redirect()->route('admin.index.quota')
                        ->with('success','Quota cuti '.$karyawan->nama.' updated successfully.');
    }

}
