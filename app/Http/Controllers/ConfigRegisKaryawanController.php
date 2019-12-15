<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department;
use Illuminate\Support\Facades\Validator;
use App\Leveling;
use App\User;
use App\Karyawan;
use App\StatusKaryawan;

class ConfigRegisKaryawanController extends Controller
{
	//Department
    public function index_department()
    {
        $karyawans = Karyawan::all();
        $departments = Department::all();
    	return view('admin.department',compact('departments','karyawans'));
    }
    public function store_department(Request $request)
    {
    	$validator = Validator::make($request->all(), [
            'name' => 'required|max:50',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        Department::create([
            'name' => $request['name'],
        ]);
        $message = 'Department '.$request['name'].' added successfully.';
        return redirect()->route('index.department')
                        ->with('success',$message);
    }
    public function update_department(Request $request)
    {
    	$validator = Validator::make($request->all(), [
            'name' => 'required|max:50',
            'users_id' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $department = Department::find($request->id);
        $department->update([
        	'name' => $request->name,
        	'users_id' => $request->users_id,
        ]);
        $message = 'Department '.$department->name.' updated successfully.';
        return redirect()->route('index.department')
                        ->with('success',$message);
    }
    public function destroy_department($id)
    {
    	$department = Department::find($id);
    	$department->delete();

        $message = 'Department '.$department->name.' deleted successfully.';
        return redirect()->route('index.department')
                        ->with('success',$message);
    }
    //Leveling
    public function index_leveling()
    {
        $leveling = Leveling::all();
    	return view('admin.leveling',compact('leveling'));
    }
    public function store_leveling(Request $request)
    {
    	$validator = Validator::make($request->all(), [
            'name' => 'required|max:50',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        Leveling::create([
            'name' => $request['name'],
        ]);
        $message = 'Leveling '.$request['name'].' added successfully.';
        return redirect()->route('index.leveling')
                        ->with('success',$message);
    }
    public function update_leveling(Request $request)
    {
    	$validator = Validator::make($request->all(), [
            'name' => 'required|max:50',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $leveling = Leveling::find($request->id);
        $leveling->update([
        	'name' => $request->name
        ]);
     	$message = 'Leveling '.$request['name'].' updated successfully.';
        return redirect()->route('index.leveling')
                        ->with('success',$message);
    }
    public function destroy_leveling($id)
    {
    	$leveling = Leveling::find($id);
    	$leveling->delete();

        $message = 'Leveling '.$leveling->name.' deleted successfully.';
        return redirect()->route('index.leveling')
                        ->with('success',$message);
    }
    //Status Karyawan
    public function index_status()
    {
        $status = StatusKaryawan::all();
    	return view('admin.status',compact('status'));
    }
    public function store_status(Request $request)
    {
    	$validator = Validator::make($request->all(), [
            'name' => 'required|max:50',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        StatusKaryawan::create([
            'name' => $request['name'],
        ]);
        $message = 'Status Karyawan '.$request['name'].' added successfully.';
        return redirect()->route('index.status')
                        ->with('success',$message);
    }
    public function edit_status($id)
    {
        $status = StatusKaryawan::find($id);
        return view('admin.edit_statuskaryawan',compact('status'));
    }
    public function update_status(Request $request)
    {
    	$validator = Validator::make($request->all(), [
            'id' => 'required',
            'name' => 'required|max:50',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $status = StatusKaryawan::find($request->id);
        $status->update([
        	'name' => $request->name
        ]);
     	$message = 'Leveling '.$request['name'].' updated successfully.';
        return redirect()->route('index.status')
                        ->with('success',$message);
    }
    public function destroy_status($id)
    {
    	$status = StatusKaryawan::find($id);
    	$status->delete();

        $message = 'Leveling '.$status->name.' deleted successfully.';
        return redirect()->route('index.status')
                        ->with('success',$message);
    }
    public function data_department()
    {
        $department = Department::all();
        $row = [
            'total' => $department->count(),
            'totalNotFiltered' => $department->count(),
            'rows' => $department
        ];
        return $row;
    }
    public function data_leveling()
    {
        $leveling = Leveling::all();
        $row = [
            'total' => $leveling->count(),
            'totalNotFiltered' => $leveling->count(),
            'rows' => $leveling
        ];
        return $row;
    }
    public function data_status()
    {
        $status = StatusKaryawan::all();
        $row = [
            'total' => $status->count(),
            'totalNotFiltered' => $status->count(),
            'rows' => $status
        ];
        return $row;
    }
}
