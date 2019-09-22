<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Pelanggan;
use App\Model\Penjualan;

class PenjualanController extends Controller
{

    protected $pelanggan, $penjualan;

    public function __construct(Pelanggan $pelanggan, Penjualan $penjualan)
    {
        $this->pelanggan = $pelanggan;
        $this->penjualan = $penjualan;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.transaksi.penjualan.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $penjualan = $this->penjualan->get();
        $kode_transaksi = "Invoice/Penjualan/";
        if($penjualan){
            $kode_transaksi .= 1;
        }else{
            $kode_transaksi .= count($penjualan) + 1;
        }

        $data['pelanggan'] = $this->pelanggan->all();
        $data['kode_transaksi'] = $kode_transaksi;
        return view('admin.transaksi.penjualan.form', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function dataBarang(){
        return view('admin.transaksi.penjualan.data_barang');
    }
}
