<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SupplierRequest;
use App\Http\Services\SupplierService;
use App\Model\Supplier;

class SupplierController extends Controller
{

    protected $supplierService;

    public function __construct(SupplierService $supplierService)
    {
        $this->supplierService = $supplierService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.master.supplier.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = new supplier();
        return view('admin.master.supplier.form', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SupplierRequest $request)
    {

        $create = $this->supplierService->save($request);
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
        $data = $this->supplierService->getByID($id);
        return view ('admin.master.supplier.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = $this->supplierService->getByID($id);
        return view('admin.master.supplier.form', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SupplierRequest $request, $id)
    {

        $update = $this->supplierService->update($id, $request);
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

        $delete = $this->supplierService->delete($id);
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
        $dataTable = $this->supplierService->dataTable();
        return $dataTable;
    }

}
