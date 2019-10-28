<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class PelangganRequest extends FormRequest
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
            'kode_pelanggan' => 'required|max:128|unique:pelanggan,kode_pelanggan',
            'nama_pelanggan' => 'required|max:50',
            'alamat' => 'required|max:300',
            'no_telp' => 'required|max:20',
        ];
        return $rules;
    }

    public function updateRules(){
        $rules = [
            'kode_pelanggan' => 'max:128|unique:pelanggan,kode_pelanggan,'.$this->get('id'),
            'nama_pelanggan' => 'required|max:50',
            'alamat' => 'required|max:300',
            'no_telp' => 'required|max:20',
        ];
        return $rules;
    }

    public function messages(){
        return [
            'required' => ':attribute tidak boleh kosong',
            'unique' => ':attribute sudah ada, masukkan kode lain',
            'max' => ':attribute panjang melebihi batas',
        ];
    }

    public function attributes()
    {
        return [
            'kode_pelanggan' => 'Kode Pelanggan',
            'nama_pelanggan' => 'Nama Pelanggan',
            'alamat' => 'Alamat',
            'no_telp' => 'No. Telp',
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
