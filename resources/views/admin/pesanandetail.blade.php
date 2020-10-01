@extends('admin.inc.navbar')

@section('content')

<div class="col-lg-11 grid-margin stretch-card">
    <div class="card">
        <p class="card-description">
            Kode Transaksi :
            <strong>{{$pesanan->payment->transaction_id}}</strong>
          </p>
      <div class="card-body">
        <h4 class="card-title">Product</h4>
        <div class="table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                  <th>No.</th>
                <th>Foto </th>
                <th>Nama Produk</th>
                <th>Jumlah</th>
                <th>Harga</th>
                <th>Total</th>
              </tr>
            </thead>
            <?php
                $no = 1;
            ?>
            <tbody>
                @foreach ($pesanan_details as $pesanan_detail)
              <tr>
                <td>{{$no++}} </td>
                <td><img src="{{ url('uploads') }}/{{$pesanan_detail->barang->img}}" width="50"></td>
                <td>{{$pesanan_detail->barang->nama_barang}} </td>
                <td>{{$pesanan_detail->jumlah}} </td>
                <td>${{$pesanan_detail->barang->harga}} </td>
                <td>${{$pesanan_detail->jumlah_harga}} </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  @endsection
