<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Storage;
use App\Model\Barang;
use DataTables;

class BarangService
{
    private $barang;

    /**
     * Construct init class
     *
     * @param Model Class dll
     */
    public function __construct(Barang $barang)
    {
        $this->barang = $barang;
    }

    /**
     * Get all data.
     *
     * @return StringJSON
     */
    public function getAll()
    {
        $data = $this->barang->select('*')
                ->from('barang AS a')
                ->leftJoin('kategori AS b', 'a.kode_kategori', 'b.kode_kategori')
                ->leftJoin('satuan AS c', 'a.kode_satuan', 'c.kode_satuan')
                ->get();
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
        $data = $this->barang->select('*')
                ->from('barang AS a')
                ->leftJoin('kategori AS b', 'a.kode_kategori', 'b.kode_kategori')
                ->leftJoin('satuan AS c', 'a.kode_satuan', 'c.kode_satuan')
                ->where('a.kode_barang', $id)
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
        $foto = $request->file('foto');
        // upload ke folder storage/app
        $path_foto = $foto->store('public/foto_barang');

        $data = [
            'kode_barang' => $request->kode_barang,
            'kode_kategori' => $request->kode_kategori,
            'kode_satuan' => $request->kode_satuan,
            'nama_barang' => $request->nama_barang,
            'stok' => 0,
            'stok_min' => $request->stok_min,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual,
            'keterangan' => $request->keterangan,
            'foto' => $path_foto,
        ];

        $create = $this->barang->create($data);
        return $create;
    }

     /**
     * Action delete.
     *
     * @param Request
     * @return Boolean
     */
    public function delete($id){
        $barang = $this->getByID($id);
        $delete = $barang->delete();
        if($delete){
            if(Storage::exists($barang->foto)){
                Storage::delete($barang->foto);
            }
        }
        return $delete;
    }

     /**
     * Action update.
     *
     * @param Request
     * @return Boolean
     */
    public function update($id, $request){

        $getBarang = $this->getByID($id);

        if($request->has('foto') && Storage::exists($getBarang->foto)){
            if(Storage::delete($getBarang->foto)){
                $foto = $request->file('foto');
                $path_foto = $foto->store('public/foto_barang');
            }
        }else{
            $path_foto = $getBarang->foto;
        }

            $data = [
                'kode_kategori' => $request->kode_kategori,
                'kode_satuan' => $request->kode_satuan,
                'nama_barang' => $request->nama_barang,
                'stok_min' => $request->stok_min,
                'harga_beli' => $request->harga_beli,
                'harga_jual' => $request->harga_jual,
                'keterangan' => $request->keterangan,
                'foto' => $path_foto,
            ];

            $update = $this->barang->where('kode_barang', $id)
                    ->update($data);
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
                    ->addColumn('image', function($data){
                        $path = Storage::url($data->foto);
                        return Storage::exists($data->foto) ? '<img src="'. $path .'" height="42" width="42">' : '<span class="badge badge-info"> Foto tidak ditemukan </span>';
                    })
                    ->addColumn('action', function($data){
                        return '<a id="btn_show" title="Lihat Data" href="'.route('barang.show', $data->kode_barang).'"> <i class="fa fa-search"></i> </a> |
                        <a id="btn_edit" title="Ubah Data" href="'.route('barang.edit', $data->kode_barang).'"> <i class="fa fa-edit"></i> </a> |
                        <a id="btn_delete" title="Hapus Data" href="'. route('barang.destroy', $data->kode_barang).'"> <i class="fa fa-trash"></i> </a>';
                    })
                    ->rawColumns(['image', 'action'])
                    ->make(true);

        return $dataTable;

    }

}
