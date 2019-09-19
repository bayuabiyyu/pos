<?php

namespace App\Http\Controllers\Api;

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
        $response['data'] = $this->barang->getAllBarang();
        return response()->json($response);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $response['data'] = $this->barang->getBarangByKode($id);
        return response()->json($response);
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

    public function dataBarang(){
        $data = $this->barang->getAllBarang();
        return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('image', function($data){
                    $path = Storage::url($data->foto);
                    return Storage::exists($data->foto) ? '<img src="'. $path .'" height="42" width="42">' : '<span class="badge badge-info"> Foto tidak ditemukan </span>';
                })
                ->rawColumns(['image'])
                ->make(true);
    }
}
