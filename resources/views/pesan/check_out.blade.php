@extends('layouts.inc')

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
                  <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                </ol>
              </nav>
        </div>
        <div class="col-md-12 mt-3">
            <div class="card">
                <div class="card-body">
                    <h3><i class="fa fa-shopping-cart" ></i>Checkout</h3>
                    @if(!empty($pesanan))
                    <p align="right">Tanggal Pesan : {{$pesanan->tanggal}} </p>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <td>NO</td>
                                <td>Gambar</td>
                                <td>Nama Barang</td>
                                <td>Jumlah</td>
                                <td>Harga</td>
                                <td>Total Harga</td>
                                <td>Opsi</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $no = 1;
                            ?>
                            @foreach ($pesanan_details as $pesanan_detail)
                               <tr>
                                <td>{{$no++}} </td>
                                <td><img width="100" src="{{ url('uploads') }}/{{$pesanan_detail->barang->img}}"> </td>
                                <td>{{$pesanan_detail->barang->nama_barang}} </td>
                                <td align="left">{{$pesanan_detail->jumlah}} Barang
                                </td>
                                <td align="left">${{number_format($pesanan_detail->barang->harga)}}</td>
                                <td align="left">${{number_format($pesanan_detail->jumlah_harga)}}</td>
                                <td>
                                    <form action="{{url('check-out')}}/{{$pesanan_detail->id}} " method="post">
                                        @csrf
                                        {{method_field('DELETE')}}
                                    <button type="submit" class="btn btn-danger btn-sm" value="update" onclick="return confirm('anda yakin akan menghapus data ?');"><i class="fa fa-trash" ></i></button>
                                    </form></td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="4" align="right"><strong>Total Harga:</strong></td>
                                <td><strong>${{number_format($pesanan->jumlah_harga)}}</strong></td>
                                <td>
                                    <a href="{{ url('payment')}}" class="btn btn-success">
                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i> Checkout
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
