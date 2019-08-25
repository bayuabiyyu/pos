<?php

namespace App\Http\Requests;

use App\Supplier;
use Illuminate\Foundation\Http\FormRequest;

class SupplierRequest extends FormRequest
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
            'kode_supplier' => 'required|max:128|unique:supplier,kode_supplier',
            'nama_supplier' => 'required|max:50',
            'alamat' => 'required|max:300',
            'no_telp' => 'required|max:20',
        ];
        return $rules;
    }

    public function updateRules(){
        $rules = [
            'kode_supplier' => 'max:128|unique:supplier,kode_supplier,'.$this->get('id'),
            'nama_supplier' => 'required|max:50',
            'alamat' => 'required|max:300',
            'no_telp' => 'required|max:20',
        ];
        return $rules;
    }

    public function messages(){
        return [
            'kode_supplier.required' => 'Kode supplier wajib diisi',
            'nama_supplier.required' => 'Nama supplier wajib diisi',
            'alamat.required' => 'Nama supplier wajib diisi',
            'no_telp.required' => 'Nama supplier wajib diisi',
        ];
    }
}
