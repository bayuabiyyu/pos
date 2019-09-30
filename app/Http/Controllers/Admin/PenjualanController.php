<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\PenjualanRequest;
use App\Model\Pelanggan;
use App\Model\Barang;
use App\Model\Penjualan;
use App\Model\DetailPenjualan;

class PenjualanController extends Controller
{

    protected $pelanggan, $penjualan, $detail_penjualan, $barang;

    public function __construct(
        Pelanggan $pelanggan,
        Penjualan $penjualan,
        DetailPenjualan $detail_penjualan,
        Barang $barang)
    {
        $this->pelanggan = $pelanggan;
        $this->penjualan = $penjualan;
        $this->detail_penjualan = $detail_penjualan;
        $this->barang = $barang;
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

        $data['pelanggan'] = $this->pelanggan->all();
        $data['kode_transaksi'] = $this->getKodeInvoice();
        return view('admin.transaksi.penjualan.form', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PenjualanRequest $request)
    {

        $data = $this->fillDataStore($request);

        // INSERT DATA TRANSAKSI //
        DB::beginTransaction();
        try{
            // INSERT HEADER //
            $insertHeader = $this->penjualan->insert($data['header']);
            // END INSERT HEADER //

            // INSERT DETAIL //
            foreach ($data['detail']['kode_barang'] as $key => $value) {
                $insertDetail = $this->detail_penjualan->insert([
                    'kode_transaksi'    => $data['header']['kode_transaksi'],
                    'kode_barang'       => $data['detail']['kode_barang'][$key],
                    'harga'             => $data['detail']['harga'][$key],
                    'qty'               => $data['detail']['qty'][$key],
                    'diskon'            => $data['detail']['diskon'][$key],
                    'sub_total'         => $data['detail']['sub_total'][$key],
                ]);
                $updateStok = $this->barang->where('kode_barang', '=', $data['detail']['kode_barang'][$key])
                                ->decrement('stok', $data['detail']['qty'][$key]);
            }
            // END INSERT DETAIL //
            DB::commit();
            $response['status'] = true;
            $response['msg'] = "Data transaksi berhasil disimpan";

        } catch (\Exception $e){
            DB::rollback();
            $response['status'] = false;
            $response['msg'] = $e->getMessage();
        }
        // END INSERT DATA TRANSAKSI //

        return response()->json($response);
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

    public function getKodeInvoice(){
        // PEMBUATAN KODE INVOICE //
        $bulan = Carbon::now()->format('m');
        $bulan_romawi = ["00" => "", "01" => "I", "02" => "II", "03" => "III", "04" => "IV", "05" => "V",
                        "06" => "VI", "07" => "VII", "08" => "VIII", "09" => "IX", "10" => "X",
                        "11" => "XI", "12" => "XII"];
        $tahun = Carbon::now()->format('Y');

        $penjualan = $this->penjualan->get();
        $kode_transaksi = "INVC/PENJUALAN/".$bulan_romawi[$bulan]."/".$tahun."/";

        if(!$penjualan){
            $kode_transaksi .= 1;
        }else{
            $kode_transaksi .= count($penjualan) + 1;
        }

        // END PEMBUATAN KODE INVOICE //

        return $kode_transaksi;

    }

    public function fillDataStore($request){

        // HEADER DATA //
        $data['header']['kode_transaksi'] = $request->kode_transaksi;
        $data['header']['user_id'] = $request->user;
        $data['header']['tgl_transaksi'] = Carbon::parse($request->tanggal)->format('Y-m-d');
        $data['header']['kode_pelanggan'] = $request->pelanggan;
        $data['header']['jenis_pembayaran'] = $request->jenis_pembayaran;
        $data['header']['keterangan'] = $request->keterangan;
        $data['header']['total_sub_total'] = $request->total_sub_total;
        $data['header']['total_diskon'] = $request->total_diskon;
        $data['header']['pajak'] = $request->pajak;
        $data['header']['dll'] = $request->dll;
        $data['header']['total_harga'] = $request->total_harga;
        $data['header']['bayar'] = $request->bayar;
        $data['header']['kembali'] = $request->kembali;
        // END HEADER DATA //

        // ARRAY DATA FROM TABLE BARANG //
        $data['detail']['kode_barang'] = $request->input('kode_barang.*'); // call array example -> $kode_barang[0]
        $data['detail']['harga'] = $request->input('harga.*');
        $data['detail']['qty'] = $request->input('qty.*');
        $data['detail']['diskon'] = $request->input('diskon.*');
        $data['detail']['sub_total'] = $request->input('sub_total.*');
        // END ARRAY DATA FROM TABLE BARANG //

        return $data;

    }

}
