<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Karyawan;
use App\PenambahanGaji;
use App\PenguranganGaji;
use App\Gaji;
use Carbon\Carbon;

class Penggajian extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gaji:bulanan';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Penggajian Bulanan';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $karyawans = karyawan::all();
        $now = Carbon::now();
        
        foreach ($karyawans as $karyawan) {
            $cekgaji = Gaji::where('karyawans_id',$karyawan->id)->whereMonth('created_at','=',$now->month)->whereYear('created_at','=',$now->year)->get();
            if (count($cekgaji) > 0) {
                $this->info('Penggajian '.$karyawan->nama.' Bulanan ini Sudah terhitung, silahkan coba lagi bulan depan.');
            }
            else{
                $tambah_gaji = PenambahanGaji::where('karyawans_id',$karyawan->id)->where('gaji_id',null)->whereMonth('created_at',$now->month)->whereYear('created_at',$now->year)->get();
                $kurang_gaji = PenguranganGaji::where('karyawans_id',$karyawan->id)->where('gaji_id',null)->whereMonth('created_at',$now->month)->whereYear('created_at',$now->year)->get();

                $tambah = $tambah_gaji->sum('nominal');
                $kurang = $kurang_gaji->sum('nominal');
                $total = (double) ($karyawan->base_salary - $kurang) + $tambah;
                $gaji = Gaji::create([
                    'karyawans_id' => $karyawan->id,
                    'penambahan' => $tambah,
                    'pengurangan' => $kurang,
                    'total' => $total
                ]);
                foreach ($tambah_gaji as $tambah) {
                    $tambah->gaji_id = $gaji->id;
                    $tambah->save();
                }
                foreach ($kurang_gaji as $kurang) {
                    $kurang->gaji_id = $gaji->id;
                    $kurang->save();
                }
                $this->info('Penggajian '.$karyawan->nama.' Bulanan Sudah terhitung silahkan cek di pelaporan gaji.');
            }
        }
        $this->info('Penggajian Bulanan Sudah terhitung silahkan cek di menu penggajian.');
    
    }
}
