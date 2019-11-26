<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StokKeluarRequest;
use App\Http\Services\StokKeluarService;
use App\Model\Stokkeluar;

class StokkeluarController extends Controller
{

    protected $stokkeluarService;

    public function __construct(StokkeluarService $stokkeluarService)
    {
        $this->stokkeluarService = $stokkeluarService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.transaksi.stok_keluar.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['stok_keluar'] = new Stokkeluar();
        return view('admin.transaksi.stok_keluar.form', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StokkeluarRequest $request)
    {
        try {
            $this->stokkeluarService->save($request);
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
        $data = $this->stokkeluarService->getByID($id);
        return view ('admin.transaksi.stok_keluar.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['stok_keluar'] = $this->stokkeluarService->getByID($id);
        $data['supplier'] = $this->supplierService->getAll();
        return view('admin.transaksi.stok_keluar.form', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StokkeluarRequest $request, $id)
    {
        try {
            $this->stokkeluarService->update($id, $request);
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
            $this->stokkeluarService->delete($id);
            $response['success'] = true;
            $response['message'] = "Data berhasil dihapus";
        } catch (\Exception $e) {
            $response['success'] = false;
            $response['message'] = $e->getMessage();
        }
        return response()->json($response);

    }

    public function dataTable(){
        $dataTable = $this->stokkeluarService->dataTable();
        return $dataTable;
    }

    public function dataBarang(){
        return view('admin.transaksi.stok_keluar.data_barang');
    }

}
