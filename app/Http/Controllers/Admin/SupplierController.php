<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SupplierRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Barang;
use App\Model\Supplier;
use DataTables;

class SupplierController extends Controller
{

    protected $supplier;

    public function __construct(Supplier $supplier)
    {
        $this->supplier = $supplier;
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
        $data = [
                    'kode_supplier' => $request->kode_supplier,
                    'nama_supplier' => $request->nama_supplier,
                    'alamat' => $request->nama_supplier,
                    'no_telp' => $request->nama_supplier,
                ];

        $create = $this->supplier->create($data);

        $response['status'] = true;
        $response['msg'] = "Data berhasil ditambahkan";
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
        $data = $this->supplier->where('kode_supplier', $id)
                ->first();
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
        $data = $this->supplier->where('kode_supplier', $id)
                            ->first();
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

        $update = $this->supplier->where('kode_supplier', $id)
                    ->update([
                        'nama_supplier' => $request->nama_supplier,
                        'alamat' => $request->nama_supplier,
                        'no_telp' => $request->nama_supplier,
                    ]);

        $response['status'] = true;
        $response['msg'] = "Data berhasil diubah";
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

        $delete = $this->supplier->where('kode_supplier', $id)
                    ->delete();

        $response['status'] = true;
        $response['msg'] = "Data berhasil dihapus";
        return response()->json($response);

    }

    public function dataTable(){
        $data = $this->supplier->select('*')->get();

        return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($data){
                    return '<a id="btn_show" title="Lihat Data" href="'.route('supplier.show', $data->kode_supplier).'"> <i class="fa fa-search"></i> </a> |
                    <a id="btn_edit" title="Ubah Data" href="'.route('supplier.edit', $data->kode_supplier).'"> <i class="fa fa-edit"></i> </a> |
                    <a id="btn_delete" title="Hapus Data" href="'. route('supplier.destroy', $data->kode_supplier).'"> <i class="fa fa-trash"></i> </a>';
                })
                ->make(true);
    }

}
