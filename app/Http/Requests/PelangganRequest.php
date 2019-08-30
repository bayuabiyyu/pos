<?php

namespace App\Http\Requests;

use App\Pelanggan;
use Illuminate\Foundation\Http\FormRequest;

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
            'kode_pelanggan.required' => 'Kode pelanggan wajib diisi',
            'nama_pelanggan.required' => 'Nama pelanggan wajib diisi',
            'alamat.required' => 'Nama pelanggan wajib diisi',
            'no_telp.required' => 'Nama pelanggan wajib diisi',
        ];
    }
}
