<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department;
use Illuminate\Support\Facades\Validator;

class ManageDepartmentController extends Controller
{
    public function index()
    {
    	return view('admin.department');
    }
    public function create()
    {
    	return view('admin.create_department');
    }
    public function store(Request $request)
    {
    	$validator = Validator::make($request->all(), [
            'nama' => 'required|max:50',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        Department::create([
            'nama' => $request['nama'],
        ]);
        $message = 'Department '.$request['nama'].' added successfully.';
        return redirect()->route('department.index')
                        ->with('success',$message);
    }
}
