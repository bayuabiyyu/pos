<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BarangRequest;
use App\Http\Services\BarangService;
use App\Http\Services\KategoriService;
use App\Http\Services\SatuanService;
use App\Model\Barang;
use DataTables;

class BarangController extends Controller
{

    protected $barangService, $kategoriService, $satuanService;

    public function __construct(BarangService $barangService, KategoriService $kategoriService, SatuanService $satuanService)
    {
        $this->barangService = $barangService;
        $this->kategoriService = $kategoriService;
        $this->satuanService = $satuanService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response['data'] = $this->barangService->getAll();
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
        $response['data'] = $this->kategoriService->getbyID($id);
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
        $data = $this->barangService->getAll();
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
