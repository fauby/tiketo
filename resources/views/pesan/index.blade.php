@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <a href="{{ url('home')}}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali </a>
        </div>
        <div class="col-md-12 mt-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{ url('home')}}">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">{{$barang->nama_barang}}</li>
                </ol>
              </nav>
        </div>
        <div class="col-md-12 mt-1">
            <div class="card">
                <div class="card-header">
                    <h2>{{$barang->nama_barang}} </h2>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="{{ url('uploads') }}/{{ $barang->img}}" width="400">
                        </div>
                        <div class="col-md-6 mt-4">
                            <h3>{{$barang->nama_barang}} </h3>
                            <table class="table">

                                <tbody>
                                    <tr>
                                        <td>Harga</td>
                                        <td>:</td>
                                        <td>{{$barang->harga}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Stok</td>
                                        <td>:</td>
                                        <td>{{$barang->stok}} </td>
                                    </tr>
                                    <tr>
                                        <td>Keterangan</td>
                                        <td>:</td>
                                        <td>{{$barang->keterangan}} </td>
                                    </tr>

                                        <tr>
                                            <td>Jumlah Pesan</td>
                                            <td>:</td>
                                            <td>
                                                <form action="{{ url('pesan') }}/{{ $barang->id }} " method="post">
                                                    @csrf
                                                <input type="text" name="jumlah_pesan" class="form-control " id="" required>
                                                <button type="submit" class="btn btn-primary mt-3"><i class="fas fa-shopping-cart"></i> Masukkan Keranjang</button>
                                                </form>
                                            </td>
                                        </tr>

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
