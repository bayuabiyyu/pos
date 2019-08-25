<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SatuanRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Barang;
use App\Model\Satuan;
use DataTables;

class SatuanController extends Controller
{

    protected $barang, $satuan;

    public function __construct(Barang $barang, satuan $satuan)
    {
        $this->barang = $barang;
        $this->satuan = $satuan;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.master.satuan.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = new Satuan();
        return view('admin.master.satuan.form', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SatuanRequest $request)
    {
        $data = [
                    'kode_satuan' => $request->kode_satuan,
                    'nama_satuan' => $request->nama_satuan,
                ];

        $create = $this->satuan->create($data);

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
        $data = $this->satuan->where('kode_satuan', $id)
                ->first();
        return view ('admin.master.satuan.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = $this->satuan->where('kode_satuan', $id)
                            ->first();
        return view('admin.master.satuan.form', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SatuanRequest $request, $id)
    {

        $update = $this->satuan->where('kode_satuan', $id)
                    ->update([
                        'nama_satuan' => $request->nama_satuan,
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

        $delete = $this->satuan->where('kode_satuan', $id)
                    ->delete();

        $response['status'] = true;
        $response['msg'] = "Data berhasil dihapus";
        return response()->json($response);

    }

    public function dataTable(){
        $data = $this->satuan->select('*')->get();

        return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($data){
                    return '<a id="btn_show" title="Lihat Data" href="'.route('satuan.show', $data->kode_satuan).'"> <i class="fa fa-search"></i> </a> |
                    <a id="btn_edit" title="Ubah Data" href="'.route('satuan.edit', $data->kode_satuan).'"> <i class="fa fa-edit"></i> </a> |
                    <a id="btn_delete" title="Hapus Data" href="'. route('satuan.destroy', $data->kode_satuan).'"> <i class="fa fa-trash"></i> </a>';
                })
                ->make(true);
    }

}
