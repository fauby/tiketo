<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Barang;
use App\Pesanan;
use App\Payment;
use App\PesananDetail;
use App\Category;
use RealRashid\SweetAlert\Facades\Alert;


class AdminController extends Controller
{
    public function user()
    {
        $users = User::all();

        return view('admin.user')->with('users',$users);
    }

    public function product()
    {
        $barangs = Barang::all();

        return view('admin.product')->with('barangs',$barangs);
    }

    public function userdelete($id)
    {
        //
    }


    public function productaddshow()
    {
        $categories = Category::all();
        $barangs = Barang::all();
        return view('admin.addproduct', compact('barangs', 'categories'));
    }

    public function productadd(Request $request)
    {

        // dd($request->file('img'));
        // $categories = Category::all();
        // $barangs = new Barang;
        // $barangs->nama_barang = $request->input('nama_produk');
        // $barangs->harga = $request->input('harga');
        // $barangs->stok = $request->input('stok');
        // $barangs->cat_id = $request->input('category');
        // $barangs->img = $request->input('img');
        // $barangs->keterangan = $request->input('keterangan');
        // $barangs->save();

        $categories = Category::all();
        $barangs = new Barang;
        $barangs->nama_barang = $request->input('nama_produk');
        $barangs->harga = $request->input('harga');
        $barangs->stok = $request->input('stok');
        $barangs->cat_id = $request->input('category');
        $barangs->keterangan = $request->input('keterangan');

        if($request->hasfile('img')){
            $file = $request->file('img');
            $extension = $file->extension();
            $filename = time() . '.' .$extension;
            $file->move('uploads', $filename);
            $barangs->img = $filename;

        }else {
            $barangs->img = '';
        }

        $barangs->save();

        Alert::success('Produk Sukses di Tambahkan', 'Success');
        return redirect('admin-product');
    }

    public function productdetail($id)
    {
        $barangs = Barang::where('id', $id)->first();
        $categories = Category::all();

        return view('admin.productdetail', compact('barangs', 'categories'));
    }

    public function productupdate(Request $request, $id)
    {
        $barangs = Barang::where('id', $id)->first();
        $categories = Category::all();

        // if(empty($request->img))
        // {
        //     $barangs->nama_barang = $request->input('nama_produk');
        //     $barangs->harga = $request->input('harga');
        //     $barangs->stok = $request->input('stok');
        //     $barangs->cat_id = $request->category;
        //     $barangs->keterangan = $request->input('keterangan');
        //     $barangs->update();

        // }else {

        // $barangs->nama_barang = $request->input('nama_produk');
        // $barangs->harga = $request->input('harga');
        // $barangs->stok = $request->input('stok');
        // $barangs->img = $request->input('img');
        // $barangs->cat_id = $request->input('category');
        // $barangs->keterangan = $request->input('keterangan');
        // $barangs->update();
        // }

        $barangs->nama_barang = $request->input('nama_produk');
        $barangs->harga = $request->input('harga');
        $barangs->stok = $request->input('stok');
        $barangs->cat_id = $request->input('category');
        $barangs->keterangan = $request->input('keterangan');

        if($request->hasFile('img')){
            $file = $request->file('img');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' .$extension;
            $file->move('uploads', $filename);
            $barangs->img = $filename;

        }else {
            $barangs->img = '';
        }
        $barangs->update();

        Alert::success('Produk Sukses di Update', 'Success');
        return redirect('admin-product');
    }

    public function productdelete($id)
    {
        $barangs = Barang::where('id', $id)->first();
        $barangs->delete();

        Alert::error('Barang Sukses Dihapus', 'Hapus');
        return redirect('admin-product');
    }

    public function pesanan()
    {
        $pesanans = Pesanan::all();

        return view('admin.pesanan', compact('pesanans'));
    }

    public function pesanandetail($id)
    {
        $pesanan = Pesanan::where('id', $id)->first();
        $pesanan_details = PesananDetail::where('pesanan_id', $pesanan->id)->get();
        $trs_id = Payment::where('pesanan_id', $pesanan->id)->get();
        return view('admin.pesanandetail', compact('pesanan', 'pesanan_details','trs_id'));
    }
}
