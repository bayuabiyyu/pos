<?php

namespace App\Http\Services;

use App\Model\Satuan;
use DataTables;

class SatuanService
{
    private $satuan;

   /**
     * Construct init class
     *
     * @param Model Class dll
     */
    public function __construct(Satuan $satuan)
    {
        $this->satuan = $satuan;
    }

    /**
     * Get all data.
     *
     * @return StringJSON
     */
    public function getAll()
    {
        $data = $this->satuan->select('*')->get();
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
        $data = $this->satuan->where('kode_satuan', $id)
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
            'kode_satuan' => $request->kode_satuan,
            'nama_satuan' => $request->nama_satuan,
            'alamat' => $request->nama_satuan,
            'no_telp' => $request->nama_satuan,
        ];
        $create = $this->satuan->create($data);
        return $create;
    }

     /**
     * Action delete.
     *
     * @param Request
     * @return Boolean
     */
    public function delete($id){
        $delete = $this->satuan->where('kode_satuan', $id)->delete();
        return $delete;
    }

     /**
     * Action update.
     *
     * @param Request
     * @return Boolean
     */
    public function update($id, $request){
        $update = $this->satuan->where('kode_satuan', $id)
                 ->update([
                    'nama_satuan' => $request->nama_satuan,
                    'alamat' => $request->nama_satuan,
                    'no_telp' => $request->nama_satuan,
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
                        return '<a id="btn_show" title="Lihat Data" href="'.route('satuan.show', $data->kode_satuan).'"> <i class="fa fa-search"></i> </a> |
                        <a id="btn_edit" title="Ubah Data" href="'.route('satuan.edit', $data->kode_satuan).'"> <i class="fa fa-edit"></i> </a> |
                        <a id="btn_delete" title="Hapus Data" href="'. route('satuan.destroy', $data->kode_satuan).'"> <i class="fa fa-trash"></i> </a>';
                    })
                    ->make(true);

        return $dataTable;
    }

}
