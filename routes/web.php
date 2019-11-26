<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('admin.auth.login');
});


Route::group(['prefix' => 'admin'], function () {

    Route::get('logout', 'Auth\LoginController@logout')->name('logout');
    // Route::post('login', 'Auth\LoginController@login')->name('login');
    Auth::routes();

Route::group(['middleware' => ['auth']], function () {

    Route::get('home', 'Admin\HomeController@index')->name('home');

    // MASTER DATA
    Route::group(['prefix' => 'master'], function () {
        // BARANG
        Route::resource('barang', 'Admin\BarangController');
        Route::post('barang/datatable', 'Admin\BarangController@dataTable')->name('barang.datatables');
        Route::post('barang/getall', 'Admin\BarangController@getAllBarang')->name('barang.getall');
        // END BARANG

        // KATEGORI
        Route::resource('kategori', 'Admin\KategoriController');
        Route::post('kategori/datatable', 'Admin\KategoriController@dataTable')->name('kategori.datatables');
        // END KATEGORI

        // SATUAN
        Route::resource('satuan', 'Admin\SatuanController');
        Route::post('satuan/datatable', 'Admin\SatuanController@dataTable')->name('satuan.datatables');
        // END SATUAN

        // SUPPLIER
        Route::resource('supplier', 'Admin\SupplierController');
        Route::post('supplier/datatable', 'Admin\SupplierController@dataTable')->name('supplier.datatables');
        // END SUPPLIER

        // PELANGGAN
        Route::resource('pelanggan', 'Admin\PelangganController');
        Route::post('pelanggan/datatable', 'Admin\PelangganController@dataTable')->name('pelanggan.datatables');
        // END PELANGGAN
    });
    // END MASTER DATA

    // TRANSAKSI
    Route::group(['prefix' => 'transaksi'], function () {
        // PENJUALAN
        Route::get('penjualan/report/invoice/{id}', 'Admin\PenjualanController@reportInvoice')->where('id', '.*')->name('penjualan.report_invoice');
        Route::resource('penjualan', 'Admin\PenjualanController');
        Route::get('penjualan/{id}', 'Admin\PenjualanController@show')->where('id', '.*'); // Overwrite from resource, untuk allow tanda slash di variabel paramter
        Route::post('penjualan/data_barang', 'Admin\PenjualanController@dataBarang')->name('penjualan.data_barang');
        Route::post('penjualan/datatable', 'Admin\PenjualanController@dataTable')->name('penjualan.datatables');
        // PENJUALAN

        // STOK MASUK
        Route::resource('stokmasuk', 'Admin\StokMasukController');
        Route::post('stokmasuk/datatable', 'Admin\StokMasukController@dataTable')->name('stokmasuk.datatables');
        Route::post('stokmasuk/databarang', 'Admin\StokMasukController@dataBarang')->name('stokmasuk.data_barang');
        // END STOK MASUK

        // STOK KELUAR
        Route::resource('stokkeluar', 'Admin\StokKeluarController');
        Route::post('stokkeluar/datatable', 'Admin\StokKeluarController@dataTable')->name('stokkeluar.datatables');
        Route::post('stokkeluar/databarang', 'Admin\StokKeluarController@dataBarang')->name('stokkeluar.data_barang');
        // END STOK KELUAR


    });
    // END TRANSAKSI

});

});
