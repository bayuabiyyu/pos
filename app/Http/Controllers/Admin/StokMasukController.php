<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StokMasukRequest;
use App\Http\Services\StokMasukService;
use App\Http\Services\SupplierService;
use App\Model\StokMasuk;

class StokMasukController extends Controller
{

    protected $stokMasukService, $supplierService;

    public function __construct(StokMasukService $stokMasukService, SupplierService $supplierService)
    {
        $this->stokMasukService = $stokMasukService;
        $this->supplierService = $supplierService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.transaksi.stok_masuk.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['stok_masuk'] = new StokMasuk();
        $data['supplier'] = $this->supplierService->getAll();
        return view('admin.transaksi.stok_masuk.form', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StokMasukRequest $request)
    {
        try {
            $this->stokMasukService->save($request);
            $response['success'] = true;
            $response['message'] = "Data berhasil ditambahkan";
        } catch (\Exception $e) {
            $response['success'] = false;
            $response['message'] = $e->getMessage();
        }
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
        $data = $this->stokMasukService->getByID($id);
        return view ('admin.transaksi.stok_masuk.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['stok_masuk'] = $this->stokMasukService->getByID($id);
        $data['supplier'] = $this->supplierService->getAll();
        return view('admin.transaksi.stok_masuk.form', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StokMasukRequest $request, $id)
    {
        try {
            $this->stokMasukService->update($id, $request);
            $response['success'] = true;
            $response['message'] = "Data berhasil diubah";
        } catch (\Exception $e) {
            $response['success'] = false;
            $response['message'] = $e->getMessage();
        }
        return response()->json($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->stokMasukService->delete($id);
            $response['success'] = true;
            $response['message'] = "Data berhasil dihapus";
        } catch (\Exception $e) {
            $response['success'] = false;
            $response['message'] = $e->getMessage();
        }
        return response()->json($response);

    }

    public function dataTable(){
        $dataTable = $this->stokMasukService->dataTable();
        return $dataTable;
    }

    public function dataBarang(){
        return view('admin.transaksi.stok_masuk.data_barang');
    }

}
