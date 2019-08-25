<?php

namespace App\Http\Requests;

use App\Kategori;
use Illuminate\Foundation\Http\FormRequest;

class KategoriRequest extends FormRequest
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
            'kode_kategori' => 'required|max:128|unique:kategori,kode_kategori',
            'nama_kategori' => 'required|max:50',
        ];
        return $rules;
    }

    public function updateRules(){
        $rules = [
            'kode_kategori' => 'max:128|unique:kategori,kode_kategori,'.$this->get('id'),
            'nama_kategori' => 'required|max:50',
        ];
        return $rules;
    }

    public function messages(){
        return [
            'kode_kategori.required' => 'Kode kategori wajib diisi',
            'nama_kategori.required' => 'Nama kategori wajib diisi',
        ];
    }
}
