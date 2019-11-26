<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BarangRequest;
use App\Http\Services\BarangService;
use App\Http\Services\KategoriService;
use App\Http\Services\SatuanService;
use App\Model\Barang;


class BarangController extends Controller
{

    protected $barangService, $kategoriService, $satuanService;

    public function __construct(BarangService $barangService, KategoriService $kategoriService, SatuanService $satuanService)
    {
        $this->barangService = $barangService;
        $this->kategoriService = $kategoriService;
        $this->satuanService = $satuanService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.master.barang.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['barang'] = new Barang();
        $data['kategori'] = $this->kategoriService->getAll();
        $data['satuan'] = $this->satuanService->getAll();
        return view('admin.master.barang.form', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BarangRequest $request)
    {
        $create = $this->barangService->save($request);
        if($create){
            $response['success'] = true;
            $response['message'] = "Data berhasil ditambahkan";
        }else{
            $response['success'] = false;
            $response['message'] = "Data gagal ditambahkan";
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
        $data = $this->barangService->getByID($id);
        return view('admin.master.barang.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['barang'] = $this->barangService->getByID($id);
        $data['kategori'] = $this->kategoriService->getAll();
        $data['satuan'] = $this->satuanService->getAll();
        return view('admin.master.barang.form', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BarangRequest $request, $id)
    {
        $update = $this->barangService->update($id, $request);
        if($update){
            $response['success'] = true;
            $response['message'] = "Data berhasil diubah";
        }else{
            $response['success'] = false;
            $response['message'] = "Data gagal diubah";
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
        $delete = $this->barangService->delete($id);
        if($delete){
            $response['success'] = true;
            $response['message'] = "Data berhasil dihapus";
        }else{
            $response['success'] = false;
            $response['message'] = "Data gagal dihapus";
        }
        return response()->json($response, 200);

    }

    public function dataTable(){
        $dataTable = $this->barangService->dataTable();
        return $dataTable;
    }

    public function getAllBarang(){
        $response['data'] = $this->barangService->getAll();
        return response()->json($response);
    }

}
