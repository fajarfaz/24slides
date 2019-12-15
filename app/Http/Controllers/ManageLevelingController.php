<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Leveling;
use Illuminate\Support\Facades\Validator;

class ManageLevelingController extends Controller
{
    public function create()
    {
    	return view('admin.create_leveling');
    }
    public function store(Request $request)
    {
    	$validator = Validator::make($request->all(), [
            'nama' => 'required|max:50',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        Leveling::create([
            'nama' => $request['nama'],
        ]);
        $message = 'Leveling '.$request['nama'].' added successfully.';
        return redirect()->route('department.index')
                        ->with('success',$message);
    }
}
