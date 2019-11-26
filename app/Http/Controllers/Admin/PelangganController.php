<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PelangganRequest;
use App\Http\Services\PelangganService;
use App\Model\Pelanggan;

class PelangganController extends Controller
{

    private $pelangganService;

    /**
     * Class init.
     *
     * @param Model class dll
     */
    public function __construct(PelangganService $pelangganService)
    {
        $this->pelangganService = $pelangganService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.master.pelanggan.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = new Pelanggan;
        return view('admin.master.pelanggan.form', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PelangganRequest $request)
    {
        $create = $this->pelangganService->save($request);
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
        $data = $this->pelangganService->getByID($id);
        return view ('admin.master.pelanggan.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = $this->pelangganService->getByID($id);
        return view('admin.master.pelanggan.form', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PelangganRequest $request, $id)
    {
        $update = $this->pelangganService->update($id, $request);
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
        $delete = $this->pelangganService->delete($id);
        if($delete){
            $response['success'] = true;
            $response['message'] = "Data berhasil dihapus";
        }else{
            $response['success'] = false;
            $response['message'] = "Data gagal dihapus";
        }
        return response()->json($response, 200);
    }

    /**
     * Show datatables yajra server side.
     *
     * @return Datatables make
     */
    public function dataTable(){
        $dataTable = $this->pelangganService->dataTable();
        return $dataTable;
    }

}
