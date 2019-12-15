<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StatusKaryawan;
use Illuminate\Support\Facades\Validator;

class ManageStatusKaryawanController extends Controller
{
    public function create()
    {
    	return view('admin.create_statuskaryawan');
    }
    public function store(Request $request)
    {
    	$validator = Validator::make($request->all(), [
            'nama' => 'required|max:50',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        StatusKaryawan::create([
            'nama' => $request['nama'],
        ]);
        $message = 'Status Karyawan '.$request['nama'].' added successfully.';
        return redirect()->route('department.index')
                        ->with('success',$message);
    }
}
