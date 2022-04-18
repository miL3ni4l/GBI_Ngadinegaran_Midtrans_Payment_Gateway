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




//DASHBOARD
// !@rogUGErj^iOMY^sA3d
Route::get('/home', 'HomeController@index')->name('home');  
Auth::routes();
Route::get('/404', 'ErrorController@index');
// UTAMA
Route::get('profil-gereja', 'ProfilGerejaController@index')->name('profil-ibadah'); 
Route::get('ibadah-gereja', 'IbadahGerejaController@index')->name('warta-ibadah'); 
Route::get('warta-gereja', 'WartaGerejaController@index')->name('warta-gereja'); 
Route::get('/', 'PublicController@index');

Route::get('utama/form_payment', 'PublicController@form_payment');
Route::get('/payment', 'WebController@payment');
Route::post('/payment', 'WebController@payment_post');
// Route::get('/payment', [WebController::class, 'payment']);
// Route::post('/payment', [WebController::class, 'payment_post']);


// PENDETA
Route::resource('pendeta', 'PendetaController');


// DONASI
// Route::get('/', 'DonationController@index')->name('donation.index');
Route::get('/donation', 'DonationController@create')->name('donation.create');
Route::get('/donasi', 'DonationAdminController@index')->name('donasi'); 



// USER
Route::get('auth/passwords/reset', 'UserController@password')->name('password');
Route::post('/password/update', 'UserController@password_update')->name('password.update');
Route::get('/user', 'UserController@index');
Route::get('/user-register', 'UserController@create');
Route::post('/user-register', 'UserController@store');
Route::get('/user-edit/{id}', 'UserController@edit');
Route::resource('user', 'UserController');


// PETUGAS
Route::resource('petugas', 'PetugasController');


//DETAIL_KATEGORI
Route::resource('detail_kategori', 'DetailKategoriController');
Route::get('/laporan/detail_kategori', 'LaporanDetailKategoriController@detail_kategori');
Route::get('/laporan/detail_kategori/pdf', 'LaporanDetailKategoriController@detail_kategoriPdf');
Route::get('/laporan/detail_kategori/excel', 'LaporanDetailKategoriController@detail_kategoriExcel');
Route::get('/format_detail_kategori', 'DetailKategoriController@format');
Route::post('/import_detail_kategori', 'DetailKategoriController@import');
Route::get('/laporan', 'LaporanDetailKategoriController@laporan')->name('laporan');
Route::get('/laporan/excel', 'LaporanDetailKategoriController@laporan_excel')->name('laporan_excel');
Route::get('/laporan/pdf', 'LaporanDetailKategoriController@laporan_pdf')->name('laporan_pdf');
Route::get('/laporan/print', 'LaporanDetailKategoriController@laporan_print')->name('laporan_print');
Route::get('create_rutin', 'DetailKategoriController@create_rutin')->name('create_rutin');
Route::post('store_rutin', 'DetailKategoriController@store_rutin')->name('store_rutin');
Route::get('create_khusus', 'DetailKategoriController@create_khusus')->name('create_khusus');
Route::post('store_khusus', 'DetailKategoriController@store_khusus')->name('store_khusus');
Route::get('/rutin', 'DetailKategoriController@rutin')->name('rutin');

//DETAIL_KATEGORI_PENGELUARAN
Route::resource('detail_pengeluaran', 'DetailPengeluaranController');
Route::get('/laporan/detail_pengeluaran', 'LaporanDetailPengeluaranController@detail_pengeluaran');
Route::get('/laporan/detail_pengeluaran/pdf', 'LaporanDetailPengeluaranController@detail_pengeluaranPdf');
Route::get('/laporan/detail_pengeluaran/excel', 'LaporanDetailPengeluaranController@detail_pengeluaranExcel');
Route::get('/format_detail_pengeluaran', 'DetailPengeluaranController@format');
Route::post('/import_detail_pengeluaran', 'DetailPengeluaranController@import');
Route::get('/laporan', 'LaporanDetailPengeluaranController@laporan')->name('laporan');
Route::get('/laporan/excel', 'LaporanDetailPengeluaranController@laporan_excel')->name('laporan_excel');
Route::get('/laporan/pdf', 'LaporanDetailPengeluaranController@laporan_pdf')->name('laporan_pdf');
Route::get('/laporan/print', 'LaporanDetailPengeluaranController@laporan_print')->name('laporan_print');
Route::get('/rutin_pengeluaran', 'DetailPengeluaranController@rutin_pengeluaran')->name('rutin_pengeluaran');


//KATEGORI PEMASUKAN
Route::resource('kategori', 'KategoriController');
Route::get('/kategori_filter', 'KategoriController@kategori_filter')->name('kategori_filter');

//KATEGORI PENGELUARAN
Route::resource('kategori_pengeluaran', 'KategoriPengeluaranRutinController');
Route::get('/kategori_pengeluaran_filter', 'KategoriPengeluaranRutinController@kategori_pengeluaran_filter')->name('kategori_pengeluaran_filter');


//KAS
Route::resource('kas', 'KasController');
Route::get('/periode_kas', 'KasController@periode_kas')->name('periode_kas');
Route::get('/format_kas', 'KasController@format');
Route::post('/import_kas', 'KasController@import');
Route::get('/lapiran', 'LaporanKasController@lapiran')->name('lapiran');
Route::get('/lapiran/excel', 'LaporanKasController@lapiran_excel')->name('lapiran_excel');
Route::get('/lapiran/pdf', 'LaporanKasController@lapiran_pdf')->name('lapiran_pdf');
Route::get('/lapiran/print', 'LaporanKasController@lapiran_print')->name('lapiran_print');

// IBADAH
Route::resource('ibadah', 'IbadahController');
Route::get('/ibadah_filter', 'IbadahController@ibadah_filter')->name('ibadah_filter');
Route::get('ibadah/status/{id}','IbadahController@status');


// RIWAYAT
Route::resource('riwayat', 'RiwayatController');
Route::get('/period', 'RiwayatController@period')->name('period');
Route::resource('riwayat', 'RiwayatController');


// LAPORAN
Route::get('/lapiran/kas', 'LaporanController@kas');
Route::get('/lapiran/kas/pdf', 'LaporanController@kasPdf');
Route::get('/lapiran/kas/excel', 'LaporanController@kasExcel');
Route::get('/laporan/gwl', 'LaporanController@gerwil');
Route::get('/laporan/gwl/pdf', 'LaporanController@gerwilPdf');
// pemasukan_rutin=====LAPORAN
Route::get('/laporan/trs', 'LaporanController@pemasukan_rutin');
Route::get('/laporan/trs/pdf', 'LaporanController@pemasukan_rutinPdf');
Route::get('/laporan/trs/excel', 'LaporanController@pemasukan_rutinExcel');


//PEMASUKAN_KHUSUS
Route::resource('pemasukan_khusus', 'PemasukanKhususController');
Route::get('/konfirmasi_pemasukan_khusus', 'PemasukanKhususController@konfirmasi_pemasukan_khusus')->name('konfirmasi_pemasukan_khusus');
Route::get('/periode_pemasukan_khusus', 'PemasukanKhususController@periode_pemasukan_khusus')->name('periode_pemasukan_khusus');
Route::get('/periode_tanggal', 'PemasukanKhususController@periode_tanggal')->name('periode_tanggal');
// PEMASUKAN_KHUSUS=====ROUTE DOWNLOAD BERDASARKAN ID
Route::get('pemasukan_khusus/pdf/{id}', ['as' => 'pemasukan_khusus.laporan', 'uses' => 'PemasukanKhususController@cetak_pdf_pemasukan_khusus']);
Route::get('pemasukan_khusus/status/{id}','PemasukanKhususController@status');


//pemasukan_rutin
Route::post('/pemasukan_rutin/destroy/{id}','pemasukan_rutinController@destroy');
Route::resource('pemasukan_rutin', 'pemasukan_rutinController');
Route::get('pemasukan_rutin_create_rutin', 'pemasukan_rutinController@pemasukan_rutin_create_rutin')->name('pemasukan_rutin_create_rutin');
Route::post('pemasukan_rutin_store_rutin', 'pemasukan_rutinController@pemasukan_rutin_store_rutin')->name('pemasukan_rutin_store_rutin');
Route::get('pemasukan_rutin_create_khusus', 'pemasukan_rutinController@pemasukan_rutin_create_khusus')->name('pemasukan_rutin_create_khusus');
Route::post('pemasukan_rutin_store_khusus', 'pemasukan_rutinController@pemasukan_rutin_store_khusus')->name('pemasukan_rutin_store_khusus');
Route::get('/konfirmasi', 'pemasukan_rutinController@konfirmasi')->name('konfirmasi');
Route::get('/periode', 'pemasukan_rutinController@periode')->name('periode');
Route::get('/periode_tanggal', 'pemasukan_rutinController@periode_tanggal')->name('periode_tanggal');
// pemasukan_rutin=====ROUTE DOWNLOAD BERDASARKAN ID
Route::get('pemasukan_rutin/pdf/{id}', ['as' => 'pemasukan_rutin.laporan', 'uses' => 'pemasukan_rutinController@cetak_pdf']);
Route::get('pemasukan_rutin/status/{id}','pemasukan_rutinController@status');


//PENGELUARAN KHUSUS
Route::resource('pengeluaran_khusus', 'PengeluaranKhususController');
Route::get('pemasukan_rutin_create_rutin', 'PengeluaranKhususController@pemasukan_rutin_create_rutin')->name('pemasukan_rutin_create_rutin');
Route::post('pemasukan_rutin_store_rutin', 'PengeluaranKhususController@pemasukan_rutin_store_rutin')->name('pemasukan_rutin_store_rutin');
Route::get('pemasukan_rutin_create_khusus', 'PengeluaranKhususController@pemasukan_rutin_create_khusus')->name('pemasukan_rutin_create_khusus');
Route::post('pemasukan_rutin_store_khusus', 'PengeluaranKhususController@pemasukan_rutin_store_khusus')->name('pemasukan_rutin_store_khusus');
Route::get('/konfirmasi_khusus', 'PengeluaranKhususController@konfirmasi_khusus')->name('konfirmasi_khusus');
Route::get('/periode_khusus', 'PengeluaranKhususController@periode_khusus')->name('periode_khusus');
// Route::get('/periode_tanggal', 'PengeluaranKhususController@periode_tanggal')->name('periode_tanggal');

//PENGELUARAN KHUSUS=====ROUTE DOWNLOAD BERDASARKAN ID
Route::get('pengeluaran_khusus/pdf/{id}', ['as' => 'pengeluaran_khusus.laporan', 'uses' => 'PengeluaranKhususController@cetak_pdf']);
Route::get('pengeluaran_khusus/status/{id}','PengeluaranKhususController@status');


//PENGELUARAN RUTIN
Route::resource('pengeluaran_rutin', 'PengeluaranRutinController');
Route::get('pemasukan_rutin_create_rutin', 'PengeluaranRutinController@pemasukan_rutin_create_rutin')->name('pemasukan_rutin_create_rutin');
Route::post('pemasukan_rutin_store_rutin', 'PengeluaranRutinController@pemasukan_rutin_store_rutin')->name('pemasukan_rutin_store_rutin');
Route::get('pemasukan_rutin_create_rutin', 'PengeluaranRutinController@pemasukan_rutin_create_rutin')->name('pemasukan_rutin_create_rutin');
Route::post('pemasukan_rutin_store_rutin', 'PengeluaranRutinController@pemasukan_rutin_store_rutin')->name('pemasukan_rutin_store_rutin');
Route::get('/konfirmasi_rutin', 'PengeluaranRutinController@konfirmasi_rutin')->name('konfirmasi_rutin');
Route::get('/periode_rutin', 'PengeluaranRutinController@periode_rutin')->name('periode_rutin');
// Route::get('/periode_tanggal', 'PengeluaranRutinController@periode_tanggal')->name('periode_tanggal');

//PENGELUARAN KHUSUS=====ROUTE DOWNLOAD BERDASARKAN ID
Route::get('pengeluaran_rutin/pdf/{id}', ['as' => 'pengeluaran_rutin.laporan', 'uses' => 'PengeluaranRutinController@cetak_pdf']);
Route::get('pengeluaran_rutin/status/{id}','PengeluaranRutinController@status');


Route::resource('export', 'ExportController');