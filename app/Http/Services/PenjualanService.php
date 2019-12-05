<?php

namespace App\Http\Services;

use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use App\Model\Penjualan;
use App\Model\DetailPenjualan;
use App\Model\Barang;
use DataTables;
use Auth;
use DB;

class PenjualanService
{
    private $penjualan, $detailPenjualan, $barang;

    /**
     * Construct init class
     *
     * @param Model Class dll
     */
    public function __construct(Penjualan $penjualan, DetailPenjualan $detailPenjualan, Barang $barang)
    {
        $this->penjualan = $penjualan;
        $this->detailPenjualan = $detailPenjualan;
        $this->barang = $barang;
    }

    /**
     * Get all data.
     *
     * @return StringJSON
     */
    public function getAll()
    {
        $data = $this->penjualan->select('*')
                ->from('penjualan')
                ->leftJoin('pelanggan', 'penjualan.kode_pelanggan', '=', 'pelanggan.kode_pelanggan')
                ->leftJoin('users', 'penjualan.user_id', '=', 'users.id')
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
        $data = $this->penjualan->where('kode_transaksi', $id)
                ->first();
        return $data;
    }


    // DETAIL
    public function getDetailByID($id){
        $data = $this->detailPenjualan->select('barang.nama_barang','detail_penjualan.*')
                ->from('detail_penjualan')
                ->join('penjualan', 'detail_penjualan.kode_transaksi', '=', 'penjualan.kode_transaksi')
                ->join('barang', 'detail_penjualan.kode_barang', '=', 'barang.kode_barang')
                ->where('detail_penjualan.kode_transaksi', '=', $id)
                ->get();

        return $data;
    }

    // END DETAIL

    /**
     * Action save.
     *
     * @param Request
     * @return Boolean
     */
    public function save($request){
        $data = $this->fillDataStore($request);

        // INSERT DATA TRANSAKSI //
        DB::beginTransaction();
        try{
            // INSERT HEADER //
            $this->penjualan->insert($data['header']);
            // END INSERT HEADER //

            // INSERT DETAIL //
            foreach ($data['detail']['kode_barang'] as $key => $value) {
                $this->detailPenjualan->insert([
                    'kode_transaksi'    => $data['header']['kode_transaksi'],
                    'kode_barang'       => $data['detail']['kode_barang'][$key],
                    'harga'             => $data['detail']['harga'][$key],
                    'qty'               => $data['detail']['qty'][$key],
                    'sub_total'         => $data['detail']['sub_total'][$key],
                    'created_at'        => Carbon::now(),
                    'updated_at'        => Carbon::now(),
                ]);
                $this->barang->where('kode_barang', '=', $data['detail']['kode_barang'][$key])
                                ->decrement('stok', $data['detail']['qty'][$key]);
            }
            // END INSERT DETAIL //
            DB::commit();
           return true;
        } catch (\Exception $e){
            DB::rollback();
            throw new \Exception($e->getMessage());
        }
        // END INSERT DATA TRANSAKSI //
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
        $data['header']['kode_transaksi'] = $this->getKodeInvoice();
        $data['header']['user_id'] = Auth::guard()->user()->id;
        $data['header']['tgl_transaksi'] = Carbon::now();
        $data['header']['kode_pelanggan'] = $request->pelanggan;
        $data['header']['jenis_pembayaran'] = $request->jenis_pembayaran;
        $data['header']['keterangan'] = $request->keterangan;
        $data['header']['sub_total'] = $request->sub_total;
        $data['header']['pajak'] = $request->pajak;
        $data['header']['pajak_rp'] = $request->pajak_rp;
        $data['header']['dll'] = $request->dll;
        $data['header']['grand_total'] = $request->grand_total;
        $data['header']['bayar'] = $request->bayar;
        $data['header']['kembali'] = $request->kembali;
        $data['header']['created_at'] = Carbon::now();
        $data['header']['updated_at'] = Carbon::now();
        // END HEADER DATA //

        // ARRAY DATA FROM TABLE BARANG //
        $data['detail']['kode_barang'] = $request->input('kode_barang.*'); // call array example -> $kode_barang[0]
        $data['detail']['harga'] = $request->input('harga.*');
        $data['detail']['qty'] = $request->input('qty.*');
        $data['detail']['sub_total'] = $request->input('sub_total_barang.*');
        $data['detail']['created_at'] = Carbon::now();
        $data['detail']['updated_at'] = Carbon::now();
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
    public function dataTable(Request $request){
        $mulai = Carbon::parse($request->mulai)->format('Y-m-d');
        $sampai = Carbon::parse($request->sampai)->format('Y-m-d');
        $data = $this->penjualan->select('*')
                ->from('penjualan')
                ->leftJoin('pelanggan', 'penjualan.kode_pelanggan', '=', 'pelanggan.kode_pelanggan')
                ->leftJoin('users', 'penjualan.user_id', '=', 'users.id')
                ->whereBetween( DB::raw('DATE(penjualan.tgl_transaksi)' ), [$mulai, $sampai])
                ->orderBy('penjualan.tgl_transaksi', 'ASC')
                ->get();
        $dataTable = DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($data){
                        return '<a id="btn_show" title="Lihat Data" href="'.route('penjualan.show', $data->kode_transaksi).'"> <i class="fa fa-search"></i> </a> |
                                <a target="_blank" id="btn_print" title="Print Data" href="'. route('penjualan.nota_penjualan', $data->kode_transaksi).'"> <i class="fa fa-print"></i> </a>';
                    })
                    ->editColumn('tgl_transaksi', function($data){
                        return Carbon::parse($data->tgl_transaksi)->format('d-M-Y | H:i:s');
                    })
                    ->make(true);

        return $dataTable;
    }

}
