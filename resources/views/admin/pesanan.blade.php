@extends('admin.inc.navbar')

@section('content')

<div class="col-lg-11 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Pesanan</h4>
        <div class="table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                  <th>No.</th>
                <th>Nama </th>
                <th>Total Bayar</th>
                <th>Kode</th>
                <th>Action</th>
                <th>Delete</th>
              </tr>
            </thead>
            <?php
                $no = 1;
            ?>
            <tbody>
            @foreach ($pesanans as $pesanan)
              <tr>
                <td>{{$no++}} </td>
                <td >{{$pesanan->user->name}} </td>
                <td>${{$pesanan->jumlah_harga}} </td>
                <td>{{$pesanan->kode}} </td>
                <td>
                    @csrf
                    <a href="{{url('admin-pesanan')}}/{{$pesanan->id}} " class="btn btn-primary btn-sm">
                    <i class="fas fa-info"></i> Detail
                    </a>
                </td>
                <td>
                    <form action="{{url('admin-product')}}/{{$pesanan->id}} " method="post">
                        @csrf
                        {{method_field('DELETE')}}
                    <button type="submit" class="btn btn-danger btn-sm" value="update" onclick="return confirm('anda yakin akan menghapus data ?');"><i class="fa fa-trash" ></i></button>
                    </form></td>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  @endsection
