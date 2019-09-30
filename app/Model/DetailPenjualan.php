<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class DetailPenjualan extends Model
{

    protected $table = "detail_penjualan";
    public $incrementing = false;

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
