<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SatuanRequest;
use App\Http\Services\SatuanService;
use App\Model\Satuan;

class SatuanController extends Controller
{

    protected $satuanService;

    public function __construct(SatuanService $satuanService)
    {
        $this->satuanService = $satuanService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.master.satuan.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = new Satuan();
        return view('admin.master.satuan.form', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SatuanRequest $request)
    {

        $create = $this->satuanService->save($request);
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
        $data = $this->satuanService->getByID($id);
        return view ('admin.master.satuan.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = $this->satuanService->getByID($id);
        return view('admin.master.satuan.form', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SatuanRequest $request, $id)
    {

        $update = $this->satuanService->update($id, $request);
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

        $delete = $this->satuanService->delete($id);
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
        $dataTable = $this->satuanService->dataTable();
        return $dataTable;
    }

}
