@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <a href="{{ url('history')}}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali </a>
        </div>
        <div class="col-md-12 mt-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{ url('home')}}">Home</a></li>
                  <li class="breadcrumb-item"><a href="{{ url('history')}}">Riwayat</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Detail Pemesanan</li>
                </ol>
              </nav>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h3>Sukses Checkout</h3>
                    <h5>Pesanan Anda Sukses di Checkout </strong>
                        {{-- dengan Nominal : --}}
                        {{-- <strong>¥{{number_format($pesanan->kode+$pesanan->jumlah_harga)}}</strong> --}}
                        Kode Transaksi :
                    <strong>{{$pesanan->payment->transaction_id}}</strong>
                    </h5>
                </div>
            </div>
            <div class="card mt-2">
                <div class="card-body">
                    <h3><i class="fa fa-shopping-cart" ></i>Detail Pemesanan</h3>
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
                                <td align="left">{{$pesanan_detail->jumlah}} Barang</td>
                                <td align="left">${{number_format($pesanan_detail->barang->harga)}}</td>
                                <td align="left">${{number_format($pesanan_detail->jumlah_harga)}}</td>
                            @endforeach
                            <tr>
                                <td colspan="4" align="right"><strong>Total Harga:</strong></td>
                                <td><strong>¥{{number_format($pesanan->jumlah_harga)}}</strong></td>
                            </tr>
                            <tr>
                                <td colspan="4" align="right"><strong>Kode Unik:</strong></td>
                                <td><strong>#{{number_format($pesanan->kode)}}</strong></td>
                            </tr>
                            <tr>
                                <td colspan="4" align="right"><strong>Total Bayar:</strong></td>
                                <td><strong>¥{{number_format($pesanan->kode+$pesanan->jumlah_harga)}}</strong></td>
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
