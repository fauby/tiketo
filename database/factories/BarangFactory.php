<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Barang;
use Faker\Generator as Faker;

$factory->define(Barang::class, function (Faker $faker) {
    return [
        'nama_barang' =>  $faker->sentence(2),
        'keterangan' =>  $faker->sentence(10),
        'harga' =>  $faker->numberBetween(100, 5000),
        'stok' =>  $faker->numberBetween(5, 15),
    ];
});
