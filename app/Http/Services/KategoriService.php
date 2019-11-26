<?php

namespace App\Http\Services;

use App\Model\Kategori;
use DataTables;

class KategoriService
{
    private $kategori;

    /**
     * Construct init class
     *
     * @param Model Class dll
     */
    public function __construct(Kategori $kategori)
    {
        $this->kategori = $kategori;
    }

    /**
     * Get all data.
     *
     * @return StringJSON
     */
    public function getAll()
    {
        $data = $this->kategori->select('*')->get();
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
        $data = $this->kategori->where('kode_kategori', $id)
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
            'kode_kategori' => $request->kode_kategori,
            'nama_kategori' => $request->nama_kategori,
        ];
        $create = $this->kategori->create($data);
        return $create;
    }

     /**
     * Action delete.
     *
     * @param Request
     * @return Boolean
     */
    public function delete($id){
        $delete = $this->kategori->where('kode_kategori', $id)->delete();
        return $delete;
    }

     /**
     * Action update.
     *
     * @param Request
     * @return Boolean
     */
    public function update($id, $request){
        $update = $this->kategori->where('kode_kategori', $id)
                 ->update([
                    'nama_kategori' => $request->nama_kategori,
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
                        return '<a id="btn_show" title="Lihat Data" href="'.route('kategori.show', $data->kode_kategori).'"> <i class="fa fa-search"></i> </a> |
                        <a id="btn_edit" title="Ubah Data" href="'.route('kategori.edit', $data->kode_kategori).'"> <i class="fa fa-edit"></i> </a> |
                        <a id="btn_delete" title="Hapus Data" href="'. route('kategori.destroy', $data->kode_kategori).'"> <i class="fa fa-trash"></i> </a>';
                    })
                    ->make(true);

        return $dataTable;
    }

}
