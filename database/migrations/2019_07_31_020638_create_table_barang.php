<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableBarang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang', function (Blueprint $table) {
            $table->string('kode_barang');
            $table->string('kode_kategori');
            $table->string('kode_satuan');
            $table->string('nama_barang');
            $table->integer('stok');
            $table->integer('stok_min');
            $table->double('harga_beli');
            $table->double('harga_jual');
            $table->string('keterangan');
            $table->string('foto');
            $table->timestamps();
            $table->primary('kode_barang');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('barang');
    }
}
