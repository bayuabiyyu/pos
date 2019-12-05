<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class PenjualanRequest extends FormRequest
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
        return $this->createRules();
    }

    public function createRules(){
        $rules = [
            'pelanggan' => 'required',
            'jenis_pembayaran' => 'required',
            'keterangan' => 'required',
            'sub_total' => 'required|numeric',
            'pajak' => 'required|numeric',
            'pajak_rp' => 'required|numeric',
            'dll' => 'required|numeric',
            'grand_total' => 'required|numeric',
            'bayar' => 'required|numeric',
            'kembali' => 'required|numeric',
            'kode_barang' => 'required',
            'harga' => 'required',
            'qty' => 'required',
            'sub_total_barang' => 'required',
        ];

        return $rules;

    }

    public function attributes()
    {
        return [
            'pelanggan' => 'Pelanggan',
            'jenis_pembayaran' => 'Jenis Pembayaran',
            'keterangan' => 'Keterangan',
            'sub_total' => 'Sub. Total',
            'pajak' => 'Pajak/PPN',
            'pajak_rp' => 'Pajak/PPN Rp.',
            'dll' => 'DLL',
            'total_harga' => 'Total Harga',
            'bayar' => 'Bayar',
            'kembali' => 'Kembali',
            'kode_barang' => 'Kode Barang',
            'harga' => 'Harga',
            'qty' => 'Qty',
            'sub_total_barang' => 'Sub. Total Barang',
        ];
    }

    public function messages(){
        return [
            'required' => ':attribute wajib diisi',
            'numeric' => ':attribute wajib angka/numerik'
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
