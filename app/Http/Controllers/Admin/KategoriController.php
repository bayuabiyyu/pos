<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\KategoriRequest;
use App\Http\Services\KategoriService;
use App\Model\Kategori;

class kategoriController extends Controller
{

    protected $kategoriService;

    public function __construct(KategoriService $kategoriService)
    {
        $this->kategoriService = $kategoriService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.master.kategori.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = new kategori();
        return view('admin.master.kategori.form', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KategoriRequest $request)
    {

        $create = $this->kategoriService->save($request);
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
        $data = $this->kategoriService->getByID($id);
        return view ('admin.master.kategori.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = $this->kategoriService->getByID($id);
        return view('admin.master.kategori.form', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(KategoriRequest $request, $id)
    {

        $update = $this->kategoriService->update($id, $request);
        if($update){
            $response['success'] = true;
            $response['message'] = "Data berhasil diubah";
        }else{
            $response['success'] = false;
            $response['message'] = "Data gagal diubah";
        }
        return response()->json($response, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $delete = $this->kategoriService->delete($id);
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
        $dataTable = $this->kategoriService->dataTable();
        return $dataTable;
    }

}
