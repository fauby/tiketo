@extends('admin.inc.navbar')

@section('content')

<div class="col-lg-11 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Product
            <a href="{{url('admin-product-add')}}" class="btn btn-primary btn-sm left-align">
                <i class="fa fa-plus" aria-hidden="true"></i> ADD
                </a>
        </h4>
        <div class="table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>No.</th>
                <th>Foto </th>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>keterangan</th>
                <th>Action</th>
                <th>Delete</th>
              </tr>
            </thead>
            <?php
                $no = 1;
            ?>
            <tbody>
            @foreach ($barangs as $barang)
              <tr>
                <td>{{$no++}} </td>
                <td><img src="{{ url('uploads') }}/{{$barang->img}}" width="50"></td>
                <td >{{$barang->nama_barang}} </td>
                <td>${{$barang->harga}} </td>
                <td>{{$barang->keterangan}} </td>
                <td>
                    @csrf
                    <a href="{{url('admin-product')}}/{{$barang->id}} " class="btn btn-primary btn-sm">
                    <i class="fas fa-edit"></i> Edit
                    </a>
                </td>
                <td>
                    <form action="{{url('admin-product')}}/{{$barang->id}} " method="post">
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
