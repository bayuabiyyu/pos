<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    public $incrementing = false;
    protected $table = "pembelian";
    protected $primaryKey = 'kode_transaksi'; // or null

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'kode_transaksi', 'user_id', 'kode_supplier',
        'tgl_transaksi', 'total_harga', 'total_diskon',
        'dll', 'bayar', 'kembali',
    ];
}
