<?php

namespace App\Http\Services;

use Illuminate\Support\Carbon;
use App\Model\Penjualan;
use DataTables;

class penjualanService
{
    private $penjualan;

    /**
     * Construct init class
     *
     * @param Model Class dll
     */
    public function __construct(Penjualan $penjualan)
    {
        $this->penjualan = $penjualan;
    }

    /**
     * Get all data.
     *
     * @return StringJSON
     */
    public function getAll()
    {
        $data = $this->penjualan->select('*')->get();
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
        $data = $this->penjualan->where('kode_transaksi', $id)
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
            'kode_transaksi' => $request->kode_transaksi,
            'nama_penjualan' => $request->nama_penjualan,
        ];
        $create = $this->penjualan->create($data);
        return $create;
    }

     /**
     * Action delete.
     *
     * @param Request
     * @return Boolean
     */
    public function delete($id){
        $delete = $this->penjualan->where('kode_transaksi', $id)->delete();
        return $delete;
    }

     /**
     * Action update.
     *
     * @param Request
     * @return Boolean
     */
    public function update($id, $request){
        $update = $this->penjualan->where('kode_transaksi', $id)
                 ->update([
                    'nama_penjualan' => $request->nama_penjualan,
                    ]);
        return $update;
    }

    /**
     * Fill data for storing.
     *
     * @param Request
     * @return Array
     */
    public function fillDataStore($request){
        // HEADER DATA //
        $data['header']['kode_transaksi'] = $request->kode_transaksi;
        $data['header']['user_id'] = $request->user;
        $data['header']['tgl_transaksi'] = Carbon::parse($request->tanggal)->format('Y-m-d H:i:s');
        $data['header']['kode_pelanggan'] = $request->pelanggan;
        $data['header']['jenis_pembayaran'] = $request->jenis_pembayaran;
        $data['header']['keterangan'] = $request->keterangan;
        $data['header']['total_sub_total'] = $request->total_sub_total;
        $data['header']['total_diskon'] = $request->total_diskon;
        $data['header']['pajak'] = $request->pajak;
        $data['header']['dll'] = $request->dll;
        $data['header']['grand_total'] = $request->grand_total;
        $data['header']['bayar'] = $request->bayar;
        $data['header']['kembali'] = $request->kembali;
        // END HEADER DATA //

        // ARRAY DATA FROM TABLE BARANG //
        $data['detail']['kode_barang'] = $request->input('kode_barang.*'); // call array example -> $kode_barang[0]
        $data['detail']['harga'] = $request->input('harga.*');
        $data['detail']['qty'] = $request->input('qty.*');
        $data['detail']['diskon'] = $request->input('diskon.*');
        $data['detail']['sub_total'] = $request->input('sub_total.*');
        // END ARRAY DATA FROM TABLE BARANG //

        return $data;

    }

    /**
    * Make invoice code.
    *
    * @return String
    */
    public function getKodeInvoice(){
          // PEMBUATAN KODE INVOICE //
          $bulan = Carbon::now()->format('m');
          $bulan_romawi = ["00" => "", "01" => "I", "02" => "II", "03" => "III", "04" => "IV", "05" => "V",
                          "06" => "VI", "07" => "VII", "08" => "VIII", "09" => "IX", "10" => "X",
                          "11" => "XI", "12" => "XII"];
          $tahun = Carbon::now()->format('Y');

          $penjualan = $this->penjualan->get();
          $kode_transaksi = "INVC/PENJUALAN/".$bulan_romawi[$bulan]."/".$tahun."/";

          if(!$penjualan){
              $kode_transaksi .= 1;
          }else{
              $kode_transaksi .= count($penjualan) + 1;
          }

          // END PEMBUATAN KODE INVOICE //

          return $kode_transaksi;
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
                        return '<a id="btn_show" title="Lihat Data" href="'.route('penjualan.show', $data->kode_transaksi).'"> <i class="fa fa-search"></i> </a> |
                        <a id="btn_edit" title="Ubah Data" href="'.route('penjualan.edit', $data->kode_transaksi).'"> <i class="fa fa-edit"></i> </a> |
                        <a id="btn_delete" title="Hapus Data" href="'. route('penjualan.destroy', $data->kode_transaksi).'"> <i class="fa fa-trash"></i> </a>';
                    })
                    ->make(true);

        return $dataTable;
    }

}
