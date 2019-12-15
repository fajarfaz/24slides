<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    protected $table = 'karyawans';
    protected $fillable = [
        'nama', 'users_id', 'nickname', 'department_id', 'level_id', 'jabatan', 'nik', 'status_id', 'tanggal_training', 'tanggal_masuk', 'tanggal_keluar', 'alamat_ktp', 'alamat_tinggal', 'tanggal_lahir', 'no_telp','usia', 'no_ktp', 'no_npwp', 'klasifikasi_pajak', 'kpj_bpjs', 'bpjs_kesehatan', 'no_rek', 'jenis_kelamin', 'status_nikah', 'jumlah_anak', 'jenjang_pendidikan', 'asal_sekolah', 'jurusan', 'tahun_masuk_pendidikan', 'tahun_keluar_pendidikan', 'golongan_darah', 'nama_kerabat', 'notelp_kerabat', 'benefit_karyawan', 'base_salary', 'quota_cuti', 'sisa_quota_cuti'
    ];
    protected $dates = ['tanggal_training','tanggal_masuk','tanggal_keluar','tanggal_lahir',''];
 
    /**
     * Untuk mendapatkan data box yang berelasi dengan item.
     */
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
    public function leveling()
    {
        return $this->belongsTo(Leveling::class,'level_id');
    }
    public function status_karyawan()
    {
        return $this->belongsTo(StatusKaryawan::class, 'status_id');
    }
    public function users()
    {
        return $this->belongsTo(User::class,'users_id');
    }
    public function jadwal()
    {
        return $this->hasMany(JadwalAktifKaryawan::class,'id_karyawan');
    }
    public function gaji_kurang()
    {
        return $this->hasMany(PenguranganGaji::class,'karyawans_id');
    }
    public function gaji_tambah()
    {
        return $this->hasMany(PenambahanGaji::class,'karyawans_id');
    }
    public function mutasi()
    {
        return $this->hasOne(Mutasi::class,'karyawans_id');
    }
    public function gaji()
    {
        return $this->hasMany(Gaji::class,'karyawans_id');
    }
    public function durasi_lembur($bulan, $tahun)
    {
        return $this->hasMany(Lembur::class,'karyawans_id')->where('approve',1)->whereMonth('created_at',$bulan)->whereYear('created_at',$tahun);
    }
}
