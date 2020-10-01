<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function barang()
    {
        return $this->hasMany('App\Barang','cat_id','id');
    }
}
