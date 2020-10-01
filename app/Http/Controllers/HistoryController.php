<?php

namespace App\Http\Controllers;
use Auth;
use App\User;
use App\Barang;
use App\Pesanan;
use Carbon\Carbon;
use App\PesananDetail;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class HistoryController extends Controller
{
    public function index()
    {
        $pesanans = Pesanan::where('user_id', Auth::user()->id)->where('status',1)->get();

        return view('history.index', compact('pesanans'));
    }

    public function detail($id)
    {
        $pesanan = Pesanan::where('id', $id)->first();
        $pesanan_details = PesananDetail::where('pesanan_id', $pesanan->id)->get();

        return view('history.detail', compact('pesanan', 'pesanan_details'));
    }
}
