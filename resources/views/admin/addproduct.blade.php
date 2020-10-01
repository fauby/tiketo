@extends('admin.inc.navbar')

@section('content')

<div class="col-11 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Detail Product</h4>
        <form class="forms-sample" action="{{url('admin-product-add')}}" method="POST" enctype="multipart/form-data">
            @csrf
          <div class="form-group">
            <label for="exampleInputName1">Nama Produk</label>
            <input type="text" class="form-control" name="nama_produk" id="nama_produk" required>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail3">Harga</label>
            <input type="text" class="form-control" name="harga" id="harga" required>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword4">Stok</label>
            <input type="text" class="form-control" name="stok" id="stok" required>
          </div>

            <div class="form-group">
              <label for="category">Category</label>
              <select class="form-control" name="category" id="category">
                @foreach ($categories as $category)
              <a href="{{url('admin-product/'. $category->id)}}"></a>
              <option value="{{$category->id}}">{{$category->category}}</option>
                @endforeach
              </select>
            </div>
          <div class="form-group">
            <label>File upload</label>
            <div class="input-group col-xs-12">
                <input type="file" name="img" id="img" >
            </div>
          </div>
          <div class="form-group">
            <label >Keterangan</label>
            <textarea class="form-control" name="keterangan" id="keterangan" rows="4" required></textarea>
          </div>
          <button type="submit" class="btn btn-success ">Submit</button>
          <button type="submit" class="btn btn-danger"><a href="/admin-product"></a> Cancel </button>
        </form>
      </div>
    </div>
  </div>

@endsection
