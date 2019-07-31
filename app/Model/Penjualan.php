<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    public $incrementing = false;
    protected $table = "penjualan";
    protected $primaryKey = 'kode_transaksi'; // or null

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'kode_transaksi', 'user_id', 'kode_pelanggan',
        'tgl_transaksi', 'total_harga', 'total_diskon',
        'dll', 'bayar', 'kembali',
    ];
}
