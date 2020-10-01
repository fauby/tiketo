

@extends('layouts.inc')

{{-- <form action="{{ url('charge') }}" method="post">
    @csrf
    <input type="email" name="email" value="{{$user->email}} " >
    <input type="text" name="amount"  value="{{$pesanan->jumlah_harga+$pesanan->kode}}.00" >
    <input type="text" name="cc_number" placeholder="Card Number" />
    <input type="text" name="expiry_month" placeholder="Month" />
    <input type="text" name="expiry_year" placeholder="Year" />
    <input type="text" name="cvv" placeholder="CVV" />
    <input type="submit" name="submit" value="Submit" />
</form> --}}

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <form action="{{ url('charge') }}" method="post">
                    @csrf
                    <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control" name="email" value="{{$user->email}} ">
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>
                    <div class="form-group">
                    <label for="exampleInputPassword1">Amount &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                    <input type="text" name="amount"  value="{{$pesanan->jumlah_harga+$pesanan->kode}}.00">
                    </div>
                    <div class="form-group">
                    <label for="exampleInputPassword1">Card Number </label>
                    <input type="text" name="cc_number" >
                    </div>
                    <div class="form-group">
                    <label for="exampleInputPassword1">Exp. Month &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                    <input type="text" name="expiry_month" placeholder="MM" >
                    </div>
                    <div class="form-group">
                    <label for="exampleInputPassword1">Exp. Year &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                    <input type="text" name="expiry_year"  placeholder="YY">
                    </div>
                    <div class="form-group">
                    <label for="exampleInputPassword1">CVV &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                    <input type="text" name="cvv" placeholder="CVV">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
