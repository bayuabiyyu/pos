<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'kode_transaksi' => 'required|unique:penjualan,kode_transaksi',
            'user' => 'required',
            'tanggal' => 'required|date_format:d-m-Y',
            'pelanggan' => 'required',
            'jenis_pembayaran' => 'required',
            'keterangan' => 'required',
            'total_sub_total' => 'required|numeric',
            'total_diskon' => 'required|numeric',
            'pajak' => 'required|numeric',
            'dll' => 'required|numeric',
            'total_harga' => 'required|numeric',
            'bayar' => 'required|numeric',
            'kembali' => 'required|numeric',
            'kode_barang' => 'required',
            'harga' => 'required',
            'qty' => 'required',
            'diskon' => 'required',
            'sub_total' => 'required'
        ];

        return $rules;

    }

    public function attributes()
    {
        return [
            'kode_transaksi' => 'Kode Transaksi',
            'user' => 'User',
            'tanggal' => 'Tanggal',
            'pelanggan' => 'Pelanggan',
            'jenis_pembayaran' => 'Jenis Pembayaran',
            'keterangan' => 'Keterangan',
            'total_sub_total' => 'Total Sub. Total',
            'total_diskon' => 'Total Diskon',
            'pajak' => 'Pajak/PPN',
            'dll' => 'DLL',
            'total_harga' => 'Total Harga',
            'bayar' => 'Bayar',
            'kembali' => 'Kembali',
            'kode_barang' => 'Kode Barang',
            'harga' => 'Harga',
            'qty' => 'Qty',
            'diskon' => 'Diskon',
            'sub_total' => 'Sub. Total'
        ];
    }

    public function messages(){
        return [
            'required' => ':attribute wajib diisi',
            'date_format' => ':attribute format tidak sesuai',
            'numeric' => ':attribute wajib angka/numerik'
        ];
    }

}
