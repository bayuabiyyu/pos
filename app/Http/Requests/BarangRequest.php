<?php

namespace App\Http\Requests;

use App\Barang;
use Illuminate\Foundation\Http\FormRequest;

class BarangRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if( $this->isMethod('POST') ){
            return $this->createRules();
        }elseif( $this->isMethod('PUT') ){
            return $this->updateRules();
        }
    }

    public function createRules(){
        $rules = [
            'kode_barang' => 'required|max:128|unique:barang,kode_barang',
            'kode_kategori' => 'required|max:128',
            'kode_satuan' => 'required|max:128',
            'nama_barang' => 'required|max:50',
            'stok' => 'required|numeric|max:10000000',
            'stok_min' => 'required|numeric|max:10000000',
            'harga_beli' => 'required|numeric|max:10000000',
            'harga_jual' => 'required|numeric|max:10000000',
            'keterangan' => 'required|max:300',
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:1024',
        ];
        return $rules;
    }

    public function updateRules(){
        $rules = [
            'kode_barang' => 'max:128|unique:barang,kode_barang,'.$this->get('id'),
            'kode_kategori' => 'required|max:128',
            'kode_satuan' => 'required|max:128',
            'nama_barang' => 'required|max:50',
            'stok' => 'required|numeric|max:10000000',
            'stok_min' => 'required|numeric|max:10000000',
            'harga_beli' => 'required|numeric|max:10000000',
            'harga_jual' => 'required|numeric|max:10000000',
            'keterangan' => 'required|max:300',
            'foto' => 'image|mimes:jpeg,png,jpg|max:1024',
        ];
        return $rules;
    }

    public function messages(){
        return [
            // 'kode_barang.required' => 'Kode barang wajib diisi',
            // 'nama_barang.required' => 'Nama barang wajib diisi',
        ];
    }
}
