<?php

namespace App\Http\Services;

use App\Model\Supplier;
use DataTables;

class SupplierService
{
    private $supplier;

   /**
     * Construct init class
     *
     * @param Model Class dll
     */
    public function __construct(Supplier $supplier)
    {
        $this->supplier = $supplier;
    }

    /**
     * Get all data.
     *
     * @return StringJSON
     */
    public function getAll()
    {
        $data = $this->supplier->select('*')->get();
        return $data;
    }

    /**
     * Get data by ID.
     *
     * @param id
     * @return StringJSON
     */
    public function getByID($id)
    {
        $data = $this->supplier->where('kode_supplier', $id)
                ->first();
        return $data;
    }

    /**
     * Action save.
     *
     * @param Request
     * @return Boolean
     */
    public function save($request){
        $data = [
            'kode_supplier' => $request->kode_supplier,
            'nama_supplier' => $request->nama_supplier,
            'alamat' => $request->nama_supplier,
            'no_telp' => $request->nama_supplier,
        ];
        $create = $this->supplier->create($data);
        return $create;
    }

     /**
     * Action delete.
     *
     * @param Request
     * @return Boolean
     */
    public function delete($id){
        $delete = $this->supplier->where('kode_supplier', $id)->delete();
        return $delete;
    }

     /**
     * Action update.
     *
     * @param Request
     * @return Boolean
     */
    public function update($id, $request){
        $update = $this->supplier->where('kode_supplier', $id)
                 ->update([
                    'nama_supplier' => $request->nama_supplier,
                    'alamat' => $request->nama_supplier,
                    'no_telp' => $request->nama_supplier,
                    ]);
        return $update;
    }

     /**
     * Make datatables yajra.
     *
     * @return DatatablesYajra
     */
    public function dataTable(){
        $data = $this->getAll();
        $dataTable = DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($data){
                        return '<a id="btn_show" title="Lihat Data" href="'.route('supplier.show', $data->kode_supplier).'"> <i class="fa fa-search"></i> </a> |
                        <a id="btn_edit" title="Ubah Data" href="'.route('supplier.edit', $data->kode_supplier).'"> <i class="fa fa-edit"></i> </a> |
                        <a id="btn_delete" title="Hapus Data" href="'. route('supplier.destroy', $data->kode_supplier).'"> <i class="fa fa-trash"></i> </a>';
                    })
                    ->make(true);

        return $dataTable;
    }

}
