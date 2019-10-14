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

    // MASTER DATA ROUTE
    Route::group(['prefix' => 'master'], function () {

        // BARANG
        Route::resource('barang', 'Admin\BarangController');
        Route::post('barang/datatable', 'Admin\BarangController@dataTable')->name('barang.datatables');
        // Route::post('barang/{id}', [
        //     'as' => 'barang.update',
        //     'uses' => 'Admin\BarangController@update'
        // ]);
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

        // SUPPLIER
        Route::resource('pelanggan', 'Admin\PelangganController');
        Route::post('pelanggan/datatable', 'Admin\PelangganController@dataTable')->name('pelanggan.datatables');
        // END SUPPLIER

    });
    // END MASTER DATA ROUTE

    // PENJUALAN ROUTE
    Route::group(['prefix' => 'transaksi'], function () {

        // PENJUALAN
        Route::get('penjualan/report/invoice/{id}', 'Admin\PenjualanController@reportInvoice')->where('id', '.*')->name('penjualan.report_invoice');
        Route::resource('penjualan', 'Admin\PenjualanController');
        Route::get('penjualan/{id}', 'Admin\PenjualanController@show')->where('id', '.*'); // Overwrite from resource, untuk allow tanda slash di variabel paramter
        Route::post('penjualan/data_barang', 'Admin\PenjualanController@dataBarang')->name('penjualan.data_barang');
        Route::post('penjualan/datatable', 'Admin\PenjualanController@dataTable')->name('penjualan.datatables');
        // PENJUALAN

    });
    // END PENJUALAN ROUTE

    });

});
