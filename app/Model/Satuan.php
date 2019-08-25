<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Satuan extends Model
{
    public $incrementing = false;
    protected $table = "satuan";
    protected $primaryKey = 'kode_satuan'; // or null

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'kode_satuan', 'nama_satuan'
    ];

    public function barang(){
        return $this->belongsTo('App\Model\Barang', 'kode_satuan');
    }

}
