<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User','user_id','id');
    }

    public function pesanan()
    {
        return $this->hasMany('App\PesananDetail','pesanan_id','id');
    }

    public function payment()
    {
        return $this->hasOne('App\Payment','pesanan_id','id');
    }
}
