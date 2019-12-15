<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use app\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Auth::user()->is_admin == 1){
            return view('admin.home');
        }
        $karyawan = Auth::user()->karyawan;
        return view('user.home',compact('karyawan'));
    }
    public function update_admin($id,Request $request)
    {
        if(Auth::user()->is_admin != 1){
            return view('admin.home');
        }
        $user = User::find($id);
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
            'name' => 'required|min:6',
            'photo_profile' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);
        if ($user->email != $request->email) {
            $this->validate($request, [
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|confirmed|min:6',
                'name' => 'required|min:6',
                'photo_profile' => 'image|mimes:jpeg,png,jpg|max:2048',
            ]);
        }
        if (isset($request->photo_profile)) {
            $photo_profile = 'photo_'.$user->id.'.'.$request->photo_profile->getClientOriginalExtension();
            $request->photo_profile->move('resources/images/photo_profile/', $photo_profile);
            $user->photo_profile = $photo_profile;
            $user->save();
        }
        if (isset($request->password)) {
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);
        }
        else{

            $user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);
        }
        return redirect()->back()
                        ->with('profile','Admin Profile updated successfully.');
    }
}
