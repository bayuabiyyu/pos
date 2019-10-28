<?php

namespace App\Http\Services;

use App\Model\Pelanggan;
use DataTables;

class PelangganService
{
    private $pelanggan;

    /**
     * Construct init class
     *
     * @param Model Class dll
     */
    public function __construct(Pelanggan $pelanggan)
    {
        $this->pelanggan = $pelanggan;
    }

    /**
     * Get all data.
     *
     * @return StringJSON
     */
    public function getAll()
    {
        $data = $this->pelanggan->select('*')->get();
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
        $data = $this->pelanggan->where('kode_pelanggan', $id)
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
            'kode_pelanggan' => $request->kode_pelanggan,
            'nama_pelanggan' => $request->nama_pelanggan,
            'alamat' => $request->nama_pelanggan,
            'no_telp' => $request->nama_pelanggan,
        ];
        $create = $this->pelanggan->create($data);
        return $create;
    }

     /**
     * Action delete.
     *
     * @param Request
     * @return Boolean
     */
    public function delete($id){
        $delete = $this->pelanggan->where('kode_pelanggan', $id)->delete();
        return $delete;
    }

     /**
     * Action update.
     *
     * @param Request
     * @return Boolean
     */
    public function update($id, $request){
        $update = $this->pelanggan->where('kode_pelanggan', $id)
                 ->update([
                    'nama_pelanggan' => $request->nama_pelanggan,
                    'alamat' => $request->nama_pelanggan,
                    'no_telp' => $request->nama_pelanggan,
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
                        return '<a id="btn_show" title="Lihat Data" href="'.route('pelanggan.show', $data->kode_pelanggan).'"> <i class="fa fa-search"></i> </a> |
                        <a id="btn_edit" title="Ubah Data" href="'.route('pelanggan.edit', $data->kode_pelanggan).'"> <i class="fa fa-edit"></i> </a> |
                        <a id="btn_delete" title="Hapus Data" href="'. route('pelanggan.destroy', $data->kode_pelanggan).'"> <i class="fa fa-trash"></i> </a>';
                    })
                    ->make(true);

        return $dataTable;
    }

}
