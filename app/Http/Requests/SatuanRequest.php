<?php

namespace App\Http\Requests;

use App\Satuan;
use Illuminate\Foundation\Http\FormRequest;

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
            'kode_satuan.required' => 'Kode satuan wajib diisi',
            'nama_satuan.required' => 'Nama satuan wajib diisi',
        ];
    }
}
