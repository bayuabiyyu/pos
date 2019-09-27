<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
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
        // PEMBUATAN CODE INVOICE //
        $bulan = Carbon::now()->format('m');
        $bulan_romawi = ["00" => "", "01" => "I", "02" => "II", "03" => "III", "04" => "IV", "05" => "V",
                        "06" => "VI", "07" => "VII", "08" => "VIII", "09" => "IX", "10" => "X",
                        "11" => "XI", "12" => "XII"];
        $tahun = Carbon::now()->format('Y');
        // PEMBUATAN CODE INVOICE //

        $penjualan = $this->penjualan->get();
        $kode_transaksi = "INVC/PENJUALAN/".$bulan_romawi[$bulan]."/".$tahun."/";
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

        $kode_transaksi = $request->kode_transaksi;
        $user_id = $request->user;
        $tanggal = Carbon::parse($request->tanggal)->format('Y-m-d');
        $pelanggan = $request->pelanggan;
        $jenis_pembayaran = $request->jenis_pembayaran;
        $keterangan = $request->keterangan;
        $total_sub_total = $request->total_sub_total;
        $total_diskon = $request->total_diskon;
        $pajak = $request->pajak;
        $dll = $request->dll;
        $total_harga = $request->total_harga;
        $bayar = $request->bayar;
        $kembali = $request->kembali;

        // ARRAY DATA FROM TABLE BARANG //
        $kode_barang = $request->input('kode_barang.*'); // call array example -> $kode_barang[0]
        $harga = $request->input('harga.*');
        $qty = $request->input('qty.*');
        $diskon = $request->input('diskon.*');
        $sub_total = $request->input('sub_total.*');
        // END ARRAY DATA FROM TABLE BARANG //

        // INSERT MASS DATA //
        DB::beginTransaction();
        try{

            // INSERT HEADER //
            $header = [
                "kode_transaksi" => $kode_transaksi,
                "user_id" => $user_id,
                "kode_pelanggan" => $pelanggan,
                "tgl_transaksi" => $tanggal,
                "total_sub_total" => $total_sub_total,
                "pajak" => $pajak,
                "total_diskon" => $total_diskon,
                "dll" => $dll,
                "total_harga" => $total_harga,
                "jenis_pembayaran" => $jenis_pembayaran,
                "bayar" => $bayar,
                "kembali" => $kembali,
                "keterangan" => $keterangan
            ];
            // END INSERT HEADER //

            foreach ($kode_barang as $key => $value) {

            }

        } catch (\Exception $e){
            DB::rollback();
        }
        // INSERT MASS DATA //

        return response()->json($request);
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
