<?php

namespace App\Http\Services;

use App\Model\StokMasuk;
use App\Model\Barang;
use Illuminate\Support\Carbon;
use DataTables;
use DB;
use Exception;

class StokMasukService
{
    private $stokMasuk, $barang;

    /**
     * Construct init class
     *
     * @param Model Class dll
     */
    public function __construct(StokMasuk $stokMasuk, Barang $barang)
    {
        $this->stokMasuk = $stokMasuk;
        $this->barang = $barang;
    }

    /**
     * Get all data.
     *
     * @return StringJSON
     */
    public function getAll()
    {
        $data = $this->stokMasuk->select('stok.id', 'stok.tanggal', 'brg.nama_barang', 'sup.nama_supplier', 'stok.qty', 'stok.keterangan')
                ->from('stok_masuk as stok')
                ->leftJoin('supplier as sup' , 'stok.kode_supplier', '=', 'sup.kode_supplier')
                ->leftJoin('barang as brg', 'stok.kode_barang', '=', 'brg.kode_barang')
                ->orderBy('stok.tanggal' , 'desc')
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
        $data = $this->stokMasuk->select('stok.*', 'brg.nama_barang')
                ->from('stok_masuk as stok')
                ->leftJoin('barang as brg', 'stok.kode_barang', '=', 'brg.kode_barang')
                ->where('stok.id', $id)
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
            'tanggal' => Carbon::now(),
            'kode_barang' => $request->kode_barang,
            'kode_supplier' => $request->kode_supplier,
            'qty' => $request->qty,
            'keterangan' => $request->keterangan,
        ];
        // dd($data);
        DB::beginTransaction();
        try{
            $this->stokMasuk->create($data);
            $this->barang->increment('stok', $data['qty']);
        DB::commit();
        return true;
        } catch (\Exception $e){
            DB::rollback();
            throw new \Exception($e->getMessage());
        }
    }

     /**
     * Action delete.
     *
     * @param Request
     * @return Boolean
     */
    public function delete($id){
        DB::beginTransaction();
        try{
            $stokMasuk = $this->getByID($id);
            $this->barang->decrement('stok', $stokMasuk->qty);
            $this->stokMasuk->where('id', $id)->delete();
            DB::commit();
            return true;
        } catch (\Exception $e){
            DB::rollback();
            throw new \Exception($e->getMessage());
        }
    }

     /**
     * Action update.
     *
     * @param Request
     * @return Boolean
     */
    public function update($id, $request){
        $data = [
            'kode_barang' => $request->kode_barang,
            'kode_supplier' => $request->kode_supplier,
            'qty' => $request->qty,
            'keterangan' => $request->keterangan,
        ];
        DB::beginTransaction();
        try{
            $stokMasuk = $this->getByID($id);
            $this->barang->decrement('stok', $stokMasuk->qty);
            $this->stokMasuk->where('id', $id)->update($data);
            $this->barang->increment('stok', $data['qty']);
        DB::commit();
        return true;
        } catch (\Exception $e){
            DB::rollback();
            throw new \Exception($e->getMessage());
        }
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
                        return '<a id="btn_edit" title="Ubah Data" href="'.route('stokmasuk.edit', $data->id).'"> <i class="fa fa-edit"></i> </a> |
                        <a id="btn_delete" title="Hapus Data" href="'. route('stokmasuk.destroy', $data->id).'"> <i class="fa fa-trash"></i> </a>';
                    })
                    ->make(true);

        return $dataTable;
    }

}
