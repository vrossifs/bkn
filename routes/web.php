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

//login
Route::resource('/', 'LoginController');

Route::post('/login/loginAction', [
	'uses' => 'LoginController@loginAction'
]);

Route::post('/login/reset_password', [
	'uses' => 'LoginController@reset_password'
]);

Route::get('/login/logout', [
	'uses' => 'LoginController@logout'
]);

// -----

//KepalaTU
Route::resource('kepala/index', 'KepalaTUController');

// View
Route::get('kepala/lihatBarang', 'KepalaTUController@lihatBarang');
Route::get('kepala/beliBarang', 'KepalaTUController@beliBarang');
Route::get('kepala/ambilBarang', 'KepalaTUController@ambilBarang');

Route::get('kepala/aksiBeliBarang', 'KepalaTUController@aksiBeliBarang');
Route::get('kepala/aksiAmbilBarang', 'KepalaTUController@aksiAmbilBarang');
Route::get('kepala/lihatLaporan', 'KepalaTUController@lihatLaporan');
Route::get('kepala/priviewKtu/{kodeUnit}', 'KepalaTUController@priviewKtu');

// Dialog KepalaTU
Route::get('kepala/dialogBeliBarang/{kdbarang}', 'KepalaTUController@dialogBeliBarang');
Route::get('kepala/dialogAmbilBarang/{kdbarang}', 'KepalaTUController@dialogAmbilBarang');
Route::get('kepala/dialogDetailBarang/{kdbarang}', 'KepalaTUController@dialogDetailBarang');

// -----

//KeuanganTU
Route::resource('keuangan/index', 'KeuanganTUController');

// View
Route::get('keuangan/lihatBarang', 'KeuanganTUController@lihatBarang');
Route::get('keuangan/beliBarang', 'KeuanganTUController@beliBarang');
Route::get('keuangan/ambilBarang', 'KeuanganTUController@ambilBarang');
Route::get('keuangan/approvalBeli', 'KeuanganTUController@approvalBeli');
Route::get('keuangan/riwayatApprove', 'KeuanganTUController@riwayatApprove');
Route::get('keuangan/lihatLaporanTahunan', 'KeuanganTUController@lihatLaporanTahunan');
Route::get('keuangan/lihatLaporanBulanan', 'KeuanganTUController@lihatLaporanBulanan');
Route::get('keuangan/priviewKtu/{kodeUnit}', 'KeuanganTUController@priviewKtu');
Route::get('keuangan/riwayatTambahBarang', 'KeuanganTUController@riwayatTambahBarang');

Route::get('keuangan/aksiBeliBarang', 'KeuanganTUController@aksiBeliBarang');
Route::get('keuangan/aksiAmbilBarang', 'KeuanganTUController@aksiAmbilBarang');

// Dialog KeuanganTU
Route::get('keuangan/dialogBeliBarang/{kdbarang}', 'KeuanganTUController@dialogBeliBarang');
Route::get('keuangan/dialogAmbilBarang/{kdbarang}', 'KeuanganTUController@dialogAmbilBarang');
Route::get('keuangan/dialogDetailBarang/{kdbarang}', 'KeuanganTUController@dialogDetailBarang');

// -----

//PegSub
Route::resource('pegsub/index', 'PegSubController');

// View
Route::get('pegsub/lihatBarang', 'PegSubController@lihatBarang');
Route::get('pegsub/approvalAmbil', 'PegSubController@approvalAmbil');
Route::get('pegsub/riwayatApprove', 'PegSubController@riwayatApprove');
Route::get('pegsub/tambahBarangBaru', 'PegSubController@tambahBarangBaru');
Route::get('pegsub/tambahBarangLama', 'PegSubController@tambahBarangLama');
Route::get('pegsub/tambahBarangPembelian', 'PegSubController@tambahBarangPembelian');
Route::get('pegsub/manajemenAdmin', 'PegSubController@manajemenAdmin');
Route::get('pegsub/tambahAkun', 'PegSubController@tambahAkun');
Route::get('pegsub/riwayatTambahBarang', 'PegSubController@riwayatTambahBarang');

// DIalog PegSub
Route::get('pegsub/dialogBeliBarang/{kdbarang}', 'PegSubController@dialogBeliBarang');
Route::get('pegsub/dialogDetailBarang/{kdbarang}', 'PegSubController@dialogDetailBarang');
Route::get('pegsub/dialogLaporanTahun/', 'PegSubController@dialogLaporanTahun');
Route::get('pegsub/dialogLaporanBulan/', 'PegSubController@dialogLaporanBulan');

// -----

//PegBkn
Route::resource('pegbkn/index', 'PegBknController');

Route::get('pegbkn/lihatBarang', 'PegBknController@lihatBarang');
Route::get('pegbkn/beliBarang', 'PegBknController@beliBarang');
Route::get('pegbkn/ambilBarang', 'PegBknController@ambilBarang');

Route::get('pegbkn/aksiBeliBarang', 'PegBknController@aksiBeliBarang');
Route::get('pegbkn/aksiAmbilBarang', 'PegBknController@aksiAmbilBarang');

// Dialog KepalaTU
Route::get('pegbkn/dialogBeliBarang/{kdbarang}', 'PegBknController@dialogBeliBarang');
Route::get('pegbkn/dialogAmbilBarang/{kdbarang}', 'PegBknController@dialogAmbilBarang');
Route::get('pegbkn/dialogDetailBarang/{kdbarang}', 'PegBknController@dialogDetailBarang');

// -----