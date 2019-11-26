<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

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
            'stok_min' => 'required|numeric|max:10000000',
            'harga_beli' => 'required|numeric|max:10000000',
            'harga_jual' => 'required|numeric|max:10000000',
            'keterangan' => 'required|max:300',
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:512',
        ];
        return $rules;
    }

    public function updateRules(){
        $rules = [
            'kode_barang' => 'max:128|unique:barang,kode_barang,'.$this->route('id'),
            'kode_kategori' => 'required|max:128',
            'kode_satuan' => 'required|max:128',
            'nama_barang' => 'required|max:50',
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
            'required' => ':attribute tidak boleh kosong',
            'unique' => ':attribute sudah ada, masukkan kode lain',
            'image' => ':attribute format tidak sesuai',
            'mimes' => ':attribute format tidak sesuai',
            'max' => ':attribute panjang melebihi batas',
        ];
    }

    public function attributes()
    {
        return [
            'kode_barang' => 'Kode Barang',
            'kode_kategori' => 'Kode Kategori',
            'kode_satuan' => 'Kode Satuan',
            'nama_barang' => 'Nama Barang',
            'stok_min' => 'Stok Minimal',
            'harga_beli' => 'Harga Beli',
            'harga_jual' => 'Harga Jual',
            'keterangan' => 'Keterangan',
            'foto' => 'Foto',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $response = [
            'success' => false,
            'error-code' => 422,
            'errors' => $validator->errors()->all(),
        ];
        throw new HttpResponseException(response()->json($response, 422));
    }

}
