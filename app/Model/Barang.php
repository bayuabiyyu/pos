<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    public $incrementing = false;
    protected $table = "barang";
    protected $primaryKey = 'kode_barang'; // or null

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'kode_barang', 'kode_kategori', 'kode_satuan', 'nama_barang',
        'stok', 'stok_min', 'harga_beli', 'harga_jual',
        'keterangan', 'foto',
    ];

    public function kategori(){
        return $this->hasOne('App\Model\Kategori', 'kode_kategori');
    }

    public function satuan(){
        return $this->hasOne('App\Model\Satuan', 'kode_satuan');
    }

}
