<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Karyawan;
use App\JadwalAktifKaryawan;
use App\Meal;
use Carbon;

class JatahMakan extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'remind:jatahmakan';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reminder Daily Jatah Makan';

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
        $karyawans = Karyawan::all();
        $tanggal = Carbon::now()->format('j');
        $mealA = Meal::select('makanans.name','jadwalaktif_karyawans.tanggal','makanans.harga')
            ->join('jadwal_shift','jadwal_shift.id_makanan','=','makanans.id')
            ->join('jadwalaktif_karyawans','jadwalaktif_karyawans.id_jadwal','=','jadwal_shift.id')
            ->where('makanans.name','meal A')
            ->where('take_meal',true)
            ->where('jadwalaktif_karyawans.tanggal',$tanggal)
            ->get();
        $mealB = Meal::select('makanans.name','jadwalaktif_karyawans.tanggal','makanans.harga')
            ->join('jadwal_shift','jadwal_shift.id_makanan','=','makanans.id')
            ->join('jadwalaktif_karyawans','jadwalaktif_karyawans.id_jadwal','=','jadwal_shift.id')
            ->where('makanans.name','meal B')
            ->where('take_meal',true)
            ->where('jadwalaktif_karyawans.tanggal',$tanggal)
            ->get();
        $total = $mealA->sum('harga') + $mealB->sum('harga');
        $data = array(
            'mealA' => count($mealA),
            'mealB' => count($mealB),
            'total' => $total,
            'tanggal' => $tanggal, 
        );
        $message = "".Carbon::now()->format('l').", tanggal ".$tanggal." Jumlah Meal A: ".$data['mealA'].", Meal B: ".$data['mealB'].", Total Fee: "."Rp. " . number_format($total, 0, ".", ".").".";
        \Slack::to('#website')->send($message);
        $this->info($message);
    }
}
