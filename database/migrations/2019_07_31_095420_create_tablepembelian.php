<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablepembelian extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembelian', function (Blueprint $table) {
            $table->string('kode_transaksi');
            $table->string('user_id');
            $table->string('kode_supplier');
            $table->dateTime('tgl_transaksi');
            $table->double('total_harga');
            $table->double('total_diskon');
            $table->double('dll');
            $table->double('bayar');
            $table->double('kembali');
            $table->timestamps();
            $table->primary('kode_transaksi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pembelian');
    }
}
