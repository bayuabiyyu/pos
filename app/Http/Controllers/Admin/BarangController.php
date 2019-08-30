<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\BarangRequest;
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
    public function store(BarangRequest $request)
    {

        $foto = $request->file('foto');
        // upload ke folder storage/app
        $path_foto = $foto->store('public/foto_barang');

        $data = [
            'kode_barang' => $request->kode_barang,
            'kode_kategori' => $request->kode_kategori,
            'kode_satuan' => $request->kode_satuan,
            'nama_barang' => $request->nama_barang,
            'stok' => $request->stok,
            'stok_min' => $request->stok_min,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual,
            'keterangan' => $request->keterangan,
            'foto' => $path_foto,
        ];

        $create = $this->barang->create($data);

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
        $data = $this->barang->getBarangByKode($id);
        return view('admin.master.barang.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['barang'] = $this->barang->where('kode_barang', $id)
                            ->first();
        $data['kategori'] = $this->kategori->get();
        $data['satuan'] = $this->satuan->get();
        return view('admin.master.barang.form', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BarangRequest $request, $id)
    {
        $barang = $this->barang->where('kode_barang', $id);
        $getBarang = $barang->first();

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
            'stok' => $request->stok,
            'stok_min' => $request->stok_min,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual,
            'keterangan' => $request->keterangan,
            'foto' => $path_foto,
        ];

        $update = $barang->update($data);

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
        $barang = $this->barang->where('kode_barang', $id);
        $getBarang = $barang->first();
        $delete = $barang->delete();

        if($delete){
            if(Storage::exists($getBarang->foto)){
                Storage::delete($getBarang->foto);
            }
        }

        $response['status'] = true;
        $response['msg'] = "Data berhasil dihapus";
        return response()->json($response);
    }


    public function dataTable(){
        $data = $this->barang->getAllBarang();

        return DataTables::of($data)
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
    }

}
