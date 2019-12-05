<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PDF;
use App\Http\Requests\PenjualanRequest;
use App\Http\Services\PenjualanService;
use App\Model\Pelanggan;

class PenjualanController extends Controller
{

    protected $pelanggan, $penjualanService;

    public function __construct( Pelanggan $pelanggan, PenjualanService $penjualanService )
    {
        $this->pelanggan = $pelanggan;
        $this->penjualanService = $penjualanService;
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
        try {
            $this->penjualanService->save($request);
            $response['success'] = true;
            $response['message'] = "Data berhasil ditambahkan";
        } catch (\Exception $e) {
            $response['success'] = false;
            $response['message'] = $e->getMessage();
        }
        // $response = $this->penjualanService->fillDataStore($request);
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
        $data['header'] = $this->penjualanService->getPenjualanByID($id);
        $data['detail'] = $this->penjualanService->getDetailPenjualanByID($id);
        return view('admin.transaksi.penjualan.show', compact('data'));
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

    /**
     * Datatable
     *  @return Format YajraDatatables
     */
    public function dataTable(Request $request){
        $dataTable = $this->penjualanService->dataTable($request);
        return $dataTable;
    }

    /**
     * Report invoice by kode transaksi
     *
     *  @return view dari show
     *
     */
    public function reportInvoice($id){
        $data['header'] = $this->penjualanService->getPenjualanByID($id);
        $data['detail'] = $this->penjualanService->getDetailPenjualanByID($id);

        // $a = view('admin.transaksi.penjualan.report.invoice', compact('data'));

        $pdf = PDF::loadView('admin.transaksi.penjualan.report.invoice', compact('data'));
        return $pdf->stream('invoice_penjualan.pdf');
    }

    /**
     * Nota penjualan
     *
     * @param id_transaksi
     * @return view
     */
    public function notaPenjualan($id){
        $data['header'] = $this->penjualanService->getByID($id);
        $data['detail'] = $this->penjualanService->getDetailByID($id);
        // dd($data);

        $pdf = PDF::loadView('admin.transaksi.penjualan.report.nota', compact('data'))
                            ->setPaper('a4', 'portrait');
        $pdf->getDomPDF()->set_option("enable_php", true);
        return $pdf->stream('nota_penjualan.pdf');
    }

    public function dataBarang(){
        return view('admin.transaksi.penjualan.data_barang');
    }

}
