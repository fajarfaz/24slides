<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Karyawan;
use App\Department;
use App\Leveling;
use App\StatusKaryawan;
use App\User;
use App\Meal;
use App\Mutasi;
use App\JadwalShift;
use App\JadwalAktifKaryawan;
use Hash;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;

class MealManageController extends Controller
{
	public function index(){
		if (Auth::user()->is_admin == 1) {
			$karyawans = Karyawan::all();
			$tanggals = JadwalAktifKaryawan::select('tanggal')->groupBy('tanggal')->get();
			$data = [];
			for ($i=1; $i <=31 ; $i++) { 
				$j = 0;
				$mealA = Meal::select('makanans.name','jadwalaktif_karyawans.tanggal','makanans.harga')
					->join('jadwal_shift','jadwal_shift.id_makanan','=','makanans.id')
					->join('jadwalaktif_karyawans','jadwalaktif_karyawans.id_jadwal','=','jadwal_shift.id')
					->where('makanans.name','meal A')
					->where('take_meal',true)
					->where('jadwalaktif_karyawans.tanggal',$i)
					->get();
				$mealB = Meal::select('makanans.name','jadwalaktif_karyawans.tanggal','makanans.harga')
					->join('jadwal_shift','jadwal_shift.id_makanan','=','makanans.id')
					->join('jadwalaktif_karyawans','jadwalaktif_karyawans.id_jadwal','=','jadwal_shift.id')
					->where('makanans.name','meal B')
					->where('take_meal',true)
					->where('jadwalaktif_karyawans.tanggal',$i)
					->get();
					$total = $mealA->sum('harga') + $mealB->sum('harga');
					$data [] = [
						'mealA' => count($mealA),
						'mealB' => count($mealB),
						'total'	=> $total,
						'tanggal' => $i,
					];
				$j++;
			}
			$datas = collect($data)->map(function ($data) {
			    return (object) $data;
			});
			$num = 1;
			return view('admin.jatah_makan',compact('karyawans','tanggals','datas','num'));
		}
		else{
			$meal = [];
			$id = Auth::user()->karyawan->id;
			$meal = Meal::select('makanans.name','jadwalaktif_karyawans.tanggal','jadwalaktif_karyawans.take_meal')
					->join('jadwal_shift','jadwal_shift.id_makanan','=','makanans.id')
					->join('jadwalaktif_karyawans','jadwalaktif_karyawans.id_jadwal','=','jadwal_shift.id')
					->where('jadwalaktif_karyawans.id_karyawan',$id)
					->orderBy('jadwalaktif_karyawans.tanggal')
					->get();
			for ($i=0; $i <count($meal) ; $i++) { 
					if($meal[$i]->take_meal == 0){
						$meal[$i]->name = 'tidak dapat';
					}
			}
		}
		return view('user.jatah_makan',compact('meal'));
	}
	public function ref_meal(Request $request)
	{
		$validator = Validator::make($request->all(), [
            'karyawans_id' => 'required',
            'tanggal' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
		$jatah = JadwalAktifKaryawan::where('id_karyawan',$request->karyawans_id)
				->where('tanggal',$request->tanggal)
				->first();
		$jatah->update(['take_meal' => '0']);
		$message = $jatah->karyawan->nama.' tidak ambil meal tanggal '.$jatah->tanggal;
        return redirect()->route('index.jatah_makan')
                        ->with('success',$message);

	}
    public function data_jatah_makan()
    {

		$data = [];
		for ($i=1; $i <=31 ; $i++) { 
			$j = 0;
			$mealA = Meal::select('makanans.name','jadwalaktif_karyawans.tanggal','makanans.harga')
				->join('jadwal_shift','jadwal_shift.id_makanan','=','makanans.id')
				->join('jadwalaktif_karyawans','jadwalaktif_karyawans.id_jadwal','=','jadwal_shift.id')
				->where('makanans.name','meal A')
				->where('take_meal',true)
				->where('jadwalaktif_karyawans.tanggal',$i)
				->get();
			$mealB = Meal::select('makanans.name','jadwalaktif_karyawans.tanggal','makanans.harga')
				->join('jadwal_shift','jadwal_shift.id_makanan','=','makanans.id')
				->join('jadwalaktif_karyawans','jadwalaktif_karyawans.id_jadwal','=','jadwal_shift.id')
				->where('makanans.name','meal B')
				->where('take_meal',true)
				->where('jadwalaktif_karyawans.tanggal',$i)
				->get();
				$total = $mealA->sum('harga') + $mealB->sum('harga');
				$data [] = [
					'mealA' => count($mealA),
					'mealB' => count($mealB),
					'total'	=> $total,
					'tanggal' => $i,
				];
			$j++;
		}
		return $data;
		
    }
    public function datak_jatah_makan()
    {
    	$data = [];
		$id = Auth::user()->karyawan->id;
		$meal = Meal::select('makanans.name','jadwalaktif_karyawans.tanggal','jadwalaktif_karyawans.take_meal')
				->join('jadwal_shift','jadwal_shift.id_makanan','=','makanans.id')
				->join('jadwalaktif_karyawans','jadwalaktif_karyawans.id_jadwal','=','jadwal_shift.id')
				->where('jadwalaktif_karyawans.id_karyawan',$id)
				->orderBy('jadwalaktif_karyawans.tanggal')
				->get();
		for ($i=0; $i <count($meal) ; $i++) { 
			
				if($meal[$i]->take_meal == 0){
					$meal[$i]->name = 'tidak dapat';
				}
				$data [] = [
					'name' => $meal[$i]->name,
					'tanggal' => $meal[$i]->tanggal,
				];

		}
		return $data;
    }
}
