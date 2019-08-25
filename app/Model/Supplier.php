<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    public $incrementing = false;
    protected $table = "supplier";
    protected $primaryKey = 'kode_supplier'; // or null

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'kode_supplier', 'nama_supplier', 'no_telp', 'alamat'
    ];
}
