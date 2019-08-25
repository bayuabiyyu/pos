<?php

namespace App\Http\Requests;

use App\Barang;
use Illuminate\Foundation\Http\FormRequest;

class barangRequest extends FormRequest
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
            'nama_barang' => 'required|max:50',
        ];
        return $rules;
    }

    public function updateRules(){
        $rules = [
            'kode_barang' => 'max:128|unique:barang,kode_barang,'.$this->get('id'),
            'nama_barang' => 'required|max:50',
        ];
        return $rules;
    }

    public function messages(){
        return [
            'kode_barang.required' => 'Kode barang wajib diisi',
            'nama_barang.required' => 'Nama barang wajib diisi',
        ];
    }
}
