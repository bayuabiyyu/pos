<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class StokKeluar extends Model
{

    public $incrementing = true;
    protected $table = "stok_keluar";
    protected $primaryKey = 'id'; // or null

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tanggal', 'kode_barang', 'qty', 'keterangan',
    ];


}
