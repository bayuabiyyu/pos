<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Barang;
use App\Model\Kategori;
use App\Model\Satuan;
use DataTables;

class BarangController extends Controller
{

    protected $barang, $kategori, $satuan;

    public function __construct(Barang $barang, Kategori $kategori, Satuan $satuan)
    {
        $this->barang = $barang;
        $this->kategori = $kategori;
        $this->satuan = $satuan;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $data['barang'] = $this->barang->select('a.kode_barang', 'a.nama_barang', 'a.kode_kategori', 'b.nama_kategori')
        //                     ->from('barang AS a')
        //                     ->leftJoin('kategori AS b', 'a.kode_kategori', 'b.kode_kategori')
        //                     // ->where('b.kode_kategori', '=', )
        //                     ->get();
        // // $data['kategori'] = $this->kategori->where('kode_kategori' , 1)->first()
        // //                     ->barang->where('kode_barang', 'BRG001');


        return view('admin.master.barang.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['barang'] = new Barang();
        $data['kategori'] = $this->kategori->get();
        $data['satuan'] = $this->satuan->get();
        return view('admin.master.barang.form', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        dd($request->file('foto')->getClientOriginalExtension());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function dataTable(){
        $data = $this->barang->select('*')
                        ->from('barang AS a')
                        ->leftJoin('kategori AS b', 'a.kode_kategori', 'b.kode_kategori')
                        ->leftJoin('satuan AS c', 'a.kode_satuan', 'c.kode_satuan')
                        ->get();
        return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($data){
                    return '<a id="btn_show" title="Lihat Data" href="'.route('barang.show', $data->kode_barang).'"> <i class="fa fa-search"></i> </a> |
                    <a id="btn_edit" title="Ubah Data" href="'.route('barang.edit', $data->kode_barang).'"> <i class="fa fa-edit"></i> </a> |
                    <a id="btn_delete" title="Hapus Data" href="'. route('barang.destroy', $data->kode_barang).'"> <i class="fa fa-trash"></i> </a>';
                })
                ->make(true);
    }

}
