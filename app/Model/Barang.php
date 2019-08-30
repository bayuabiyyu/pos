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

    public function getAllBarang(){
        $data = $this->select('*')
                ->from('barang AS a')
                ->leftJoin('kategori AS b', 'a.kode_kategori', 'b.kode_kategori')
                ->leftJoin('satuan AS c', 'a.kode_satuan', 'c.kode_satuan')
                ->get();
        return $data;
    }

    public function getBarangByKode($kode){
        $data = $this->select('*')
                ->from('barang AS a')
                ->leftJoin('kategori AS b', 'a.kode_kategori', 'b.kode_kategori')
                ->leftJoin('satuan AS c', 'a.kode_satuan', 'c.kode_satuan')
                ->where('a.kode_barang', $kode)
                ->first();
        return $data;
    }

}
