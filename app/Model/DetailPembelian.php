<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class DetailPembelian extends Model
{

    protected $table = "detail_pembelian";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'kode_transaksi', 'kode_barang', 'qty',
        'diskon', 'sub_total',
    ];

}
