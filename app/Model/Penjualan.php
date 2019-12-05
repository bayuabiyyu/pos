<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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
        'tgl_transaksi', 'sub_total', 'pajak', 'pajak_rp',' grand_total',
        'dll', 'bayar', 'kembali', 'keterangan', 'jenis_pembayaran',
    ];

    public function pelanggan(){
        return $this->hasOne('App\Model\Pelanggan', 'kode_pelanggan');
    }

    public function user(){
        return $this->hasOne('App\Model\User', 'id');
    }

}
