<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class StokMasuk extends Model
{

    public $incrementing = true;
    protected $table = "stok_masuk";
    protected $primaryKey = 'id'; // or null

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tanggal', 'kode_barang', 'kode_supplier', 'qty', 'keterangan',
    ];

    // public function barang(){
    //     return $this->belongsTo('App\Model\Barang', 'kode_barang');
    // }

    // public function supplier(){
    //     return $this->belongsTo('App\Model\Supplier', 'kode_supplier');
    // }

}
