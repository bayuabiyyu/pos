<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\KategoriRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Barang;
use App\Model\Kategori;
use DataTables;

class KategoriController extends Controller
{

    protected $barang, $kategori;

    public function __construct(Barang $barang, Kategori $kategori)
    {
        $this->barang = $barang;
        $this->kategori = $kategori;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.master.kategori.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = new Kategori();
        return view('admin.master.kategori.form', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KategoriRequest $request)
    {
        $data = [
                    'kode_kategori' => $request->kode_kategori,
                    'nama_kategori' => $request->nama_kategori,
                ];

        $create = $this->kategori->create($data);

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
        $data = $this->kategori->where('kode_kategori', $id)
                ->first();
        return view ('admin.master.kategori.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = $this->kategori->where('kode_kategori', $id)
                            ->first();
        return view('admin.master.kategori.form', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(KategoriRequest $request, $id)
    {

        $update = $this->kategori->where('kode_kategori', $id)
                    ->update([
                        'nama_kategori' => $request->nama_kategori,
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

        $delete = $this->kategori->where('kode_kategori', $id)
                    ->delete();

        $response['status'] = true;
        $response['msg'] = "Data berhasil dihapus";
        return response()->json($response);

    }

    public function dataTable(){
        $data = $this->kategori->select('*')->get();

        return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($data){
                    return '<a id="btn_show" title="Lihat Data" href="'.route('kategori.show', $data->kode_kategori).'"> <i class="fa fa-search"></i> </a> |
                    <a id="btn_edit" title="Ubah Data" href="'.route('kategori.edit', $data->kode_kategori).'"> <i class="fa fa-edit"></i> </a> |
                    <a id="btn_delete" title="Hapus Data" href="'. route('kategori.destroy', $data->kode_kategori).'"> <i class="fa fa-trash"></i> </a>';
                })
                ->make(true);
    }

}
