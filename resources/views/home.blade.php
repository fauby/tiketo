
@extends('layouts.inc')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @foreach ($barangs as $barang)
        <div class="col-md-4">
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                <img class="card-img-top" src="{{ url('uploads') }}/{{ $barang->img}} " sizes="100px" >
                  <h5 class="card-title" id="nama_barang">{{$barang->nama_barang}} </h5>
                  <p class="card-text" id="harga">$&nbsp;{{number_format ($barang->harga)}} </p>
                  <p class="card-text" id="keterangan" maxlength="30">
                      {{$barang->keterangan}}
                    </p>
                  <a href="{{url('pesan')}}/{{$barang->id}} " class="btn btn-primary"><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"> Pesan</a>
                </div>
              </div>
        </div>
        @endforeach
    </div>
</div>
{{$barangs->links()}}
@endsection



