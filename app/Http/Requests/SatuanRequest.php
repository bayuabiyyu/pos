<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class SatuanRequest extends FormRequest
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
            'kode_satuan' => 'required|max:5|unique:satuan,kode_satuan',
            'nama_satuan' => 'required|max:10',
        ];
        return $rules;
    }

    public function updateRules(){
        $rules = [
            'kode_satuan' => 'max:5|unique:satuan,kode_satuan,'.$this->get('id'),
            'nama_satuan' => 'required|max:10',
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
            'kode_satuan' => 'Kode Satuan',
            'nama_satuan' => 'Nama Satuan'
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
