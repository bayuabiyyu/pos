<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PelangganRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Barang;
use App\Model\Pelanggan;
use DataTables;

class PelangganController extends Controller
{

    protected $pelanggan;

    public function __construct(Pelanggan $pelanggan)
    {
        $this->pelanggan = $pelanggan;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.master.pelanggan.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = new pelanggan();
        return view('admin.master.pelanggan.form', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PelangganRequest $request)
    {
        $data = [
                    'kode_pelanggan' => $request->kode_pelanggan,
                    'nama_pelanggan' => $request->nama_pelanggan,
                    'alamat' => $request->nama_pelanggan,
                    'no_telp' => $request->nama_pelanggan,
                ];

        $create = $this->pelanggan->create($data);

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
        $data = $this->pelanggan->where('kode_pelanggan', $id)
                ->first();
        return view ('admin.master.pelanggan.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = $this->pelanggan->where('kode_pelanggan', $id)
                            ->first();
        return view('admin.master.pelanggan.form', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PelangganRequest $request, $id)
    {

        $update = $this->pelanggan->where('kode_pelanggan', $id)
                    ->update([
                        'nama_pelanggan' => $request->nama_pelanggan,
                        'alamat' => $request->nama_pelanggan,
                        'no_telp' => $request->nama_pelanggan,
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

        $delete = $this->pelanggan->where('kode_pelanggan', $id)
                    ->delete();

        $response['status'] = true;
        $response['msg'] = "Data berhasil dihapus";
        return response()->json($response);

    }

    public function dataTable(){
        $data = $this->pelanggan->select('*')->get();

        return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($data){
                    return '<a id="btn_show" title="Lihat Data" href="'.route('pelanggan.show', $data->kode_pelanggan).'"> <i class="fa fa-search"></i> </a> |
                    <a id="btn_edit" title="Ubah Data" href="'.route('pelanggan.edit', $data->kode_pelanggan).'"> <i class="fa fa-edit"></i> </a> |
                    <a id="btn_delete" title="Hapus Data" href="'. route('pelanggan.destroy', $data->kode_pelanggan).'"> <i class="fa fa-trash"></i> </a>';
                })
                ->make(true);
    }

}
