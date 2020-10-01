<?php

namespace App\Http\Controllers;
use App\Barang;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    // /**
    //  * Create a new controller instance.
    //  *
    //  * @return void
    //  */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    // /**
    //  * Show the application dashboard.
    //  *
    //  * @return \Illuminate\Contracts\Support\Renderable
    //  */
    public function index()
    {
        // $barangs = Barang::paginate(10);
        $barangs = Barang::paginate(10);
        // dd($barangs);
        // return view('home', compact('barangs'));
        return view('home', ['barangs' => $barangs]);
    }
    public function index_concert()
    {
        // $barangs = Barang::paginate(10);
        $barangs = Barang::where('cat_id', 1)->paginate(10);
        // dd($barangs);
        // return view('home', compact('barangs'));
        return view('home', ['barangs' => $barangs]);
    }

    public function index_sport()
    {
        // $barangs = Barang::paginate(10);
        $barangs = Barang::where('cat_id', 2)->paginate(10);
        // dd($barangs);
        // return view('home', compact('barangs'));
        return view('home', ['barangs' => $barangs]);
    }
}
