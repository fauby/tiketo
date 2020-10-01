<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User','user_id','id');
    }

    public function pesanan()
    {
        return $this->belongsTo('App\Pesanan','pesanan_id','id');
    }
}
