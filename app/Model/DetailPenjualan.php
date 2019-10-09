<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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

    public function getDetailPenjualanByID($id){

        $user_id = Auth::user()->id;

        $data = $this->select('*')
                ->from('detail_penjualan')
                ->join('penjualan', 'detail_penjualan.kode_transaksi', '=', 'penjualan.kode_transaksi')
                ->join('barang', 'detail_penjualan.kode_barang', '=', 'barang.kode_barang')
                ->where('detail_penjualan.kode_transaksi', '=', $id)
                ->get();

        return $data;

    }

}
