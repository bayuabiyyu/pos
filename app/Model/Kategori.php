<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{

    public $incrementing = false;
    protected $table = "kategori";
    protected $primaryKey = 'kode_kategori'; // or null

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'kode_kategori', 'nama_kategori',
    ];

}
