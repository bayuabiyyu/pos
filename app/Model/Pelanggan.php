<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    public $incrementing = false;
    protected $table = "pelanggan";
    protected $primaryKey = 'kode_pelanggan'; // or null

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'kode_pelanggan', 'nama_pelanggan', 'no_telp', 'alamat'
    ];

    public function penjualan()
    {
        return $this->belongsTo('App\Model\Penjualan', 'kode_pelanggan');
    }

}
