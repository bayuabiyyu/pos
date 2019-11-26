<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StokKeluarRequest extends FormRequest
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
            'kode_barang' => 'required|max:50|unique:stok_keluar,id',
            'qty' => 'required|numeric|min:1|max:5000',
            'keterangan' => 'required|max:50',
        ];
        return $rules;
    }

    public function updateRules(){
        $rules = [
            'kode_barang' => 'required|max:50|unique:stok_keluar,id,'.$this->route('id'),
            'qty' => 'required|numeric|max:5000',
            'keterangan' => 'required|max:50',
        ];
        return $rules;
    }

    public function messages(){
        return [
            'required' => ':attribute tidak boleh kosong',
            'unique' => ':attribute sudah ada, keluarkan kode lain',
            'numeric' => ':attribute harus angka',
            'max' => ':attribute panjang melebihi batas',
            'min' => ':attribute panjang kurang dari batas'
        ];
    }

    public function attributes()
    {
        return [
            'kode_barang' => 'Kode Barang',
            'qty' => 'Qty',
            'keterangan' => 'Keterangan',
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
