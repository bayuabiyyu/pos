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
        'tgl_transaksi', 'total_sub_total', 'pajak',' total_harga', 'total_diskon',
        'dll', 'bayar', 'kembali', 'keterangan', 'jenis_pembayaran',
    ];

    public function pelanggan(){
        return $this->hasOne('App\Model\Pelanggan', 'kode_pelanggan');
    }

    public function user(){
        return $this->hasOne('App\Model\User', 'id');
    }

    /**
     * Fungsi Penjualan
     *
     * return json array
     */

    public function getAllPenjualan(){

        $user_id = Auth::user()->id;

        $data = $this->select('*')
                ->from('penjualan')
                ->leftJoin('pelanggan', 'penjualan.kode_pelanggan', '=', 'pelanggan.kode_pelanggan')
                ->leftJoin('users', 'penjualan.user_id', '=', 'users.id')
                ->get();

        // $data = $this->with('pelanggan', 'user')->get();

        return $data;
    }

    public function getPenjualanByID($id){

        $user_id = Auth::user()->id;

        $data = $this->select('*')
                ->from('penjualan')
                ->leftJoin('pelanggan', 'penjualan.kode_pelanggan', '=', 'pelanggan.kode_pelanggan')
                ->leftJoin('users', 'penjualan.user_id', '=', 'users.id')
                ->where('penjualan.kode_transaksi', '=', $id)
                ->first();

        return $data;

    }

}
