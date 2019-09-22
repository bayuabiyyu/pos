<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use Faker\Generator as Faker;
use App\Model\Barang;
use App\Model\Kategori;
use App\Model\Satuan;

$factory->define(Barang::class, function (Faker $faker) {
    return [
        'kode_barang' => $faker->name,
        'kode_kategori' => 'kategori1',
        'kode_satuan' => 'satuan1',
        'nama_barang' => $faker->name
    ];
});
