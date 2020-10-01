<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function index()
    {
        $user = User::where('id', Auth::user()->id)->first();

        return view('profile.index', compact('user'));
    }

    public function update(Request $request)
    {
        // dd($request);
        $this->validate($request,  [
            'password' => 'confirmed',
        ]);
        $user = User::where('id', Auth::user()->id)->first();
        $user->nohp = $request->nohp;
        $user->alamat = $request->alamat;
        if(!empty($request->password)){
            $user->password = Hash::make($request->password);
        }
        $user->update();

        Alert::success('User Sukses di Update', 'Success');
        return redirect('profile');
    }
}
