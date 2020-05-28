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
Route::post('login/loginAction', 'LoginController@loginAction');
Route::post('login/resetPassword', 'LoginController@resetPassword');
Route::post('login/ubahPassword', 'LoginController@ubahPassword');
Route::get('login/logout', 'LoginController@logout');

// -----

//KepalaTU
Route::resource('kepala/index', 'KepalaTUController');

// View
Route::get('kepala/lihatBarang', 'KepalaTUController@lihatBarang');
Route::get('kepala/beliBarang', 'KepalaTUController@beliBarang');
Route::get('kepala/ambilBarang', 'KepalaTUController@ambilBarang');
Route::get('kepala/lihatLaporan', 'KepalaTUController@lihatLaporan');
Route::get('kepala/priviewKtu/{kodeUnit}', 'KepalaTUController@priviewKtu');
Route::get('kepala/notifikasi/{kdNotifikasi}', 'KepalaTUController@notifikasi');

// Dialog KepalaTU
Route::get('kepala/dialogBeliBarang/{kdbarang}', 'KepalaTUController@dialogBeliBarang');
Route::get('kepala/dialogAmbilBarang/{kdbarang}', 'KepalaTUController@dialogAmbilBarang');
Route::get('kepala/dialogDetailBarang/{kdbarang}', 'KepalaTUController@dialogDetailBarang');

// Action
Route::post('kepala/aksiBeliBarang', 'KepalaTUController@aksiBeliBarang');
Route::post('kepala/aksiAmbilBarang', 'KepalaTUController@aksiAmbilBarang');
Route::post('kepala/readNotif', 'KepalaTUController@readNotif');

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
Route::get('keuangan/notifikasi/{kdNotifikasi}', 'KeuanganTUController@notifikasi');

// Dialog KeuanganTU
Route::get('keuangan/dialogBeliBarang/{kdbarang}', 'KeuanganTUController@dialogBeliBarang');
Route::get('keuangan/dialogAmbilBarang/{kdbarang}', 'KeuanganTUController@dialogAmbilBarang');
Route::get('keuangan/dialogDetailBarang/{kdbarang}', 'KeuanganTUController@dialogDetailBarang');

// Action
Route::post('keuangan/aksiBeliBarang', 'KeuanganTUController@aksiBeliBarang');
Route::post('keuangan/aksiAmbilBarang', 'KeuanganTUController@aksiAmbilBarang');
Route::post('keuangan/approve', 'KeuanganTUController@approve');
Route::get('keuangan/approveSingle/{kdtransaksi}', 'KeuanganTUController@approveSingle');
Route::get('keuangan/declineSingle/{kdtransaksi}', 'KeuanganTUController@declineSingle');
Route::post('keuangan/readNotif', 'KeuanganTUController@readNotif');

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
Route::get('pegsub/editAkun/{nip}', 'PegSubController@editAkun');
Route::get('pegsub/riwayatTambahBarang', 'PegSubController@riwayatTambahBarang');
Route::get('pegsub/notifikasi/{kdNotifikasi}', 'PegSubController@notifikasi');

// Dialog PegSub
Route::get('pegsub/dialogBeliBarang/{kdbarang}', 'PegSubController@dialogBeliBarang');
Route::get('pegsub/dialogDetailBarang/{kdbarang}', 'PegSubController@dialogDetailBarang');
Route::get('pegsub/dialogLaporanTahun/', 'PegSubController@dialogLaporanTahun');
Route::get('pegsub/dialogLaporanBulan/', 'PegSubController@dialogLaporanBulan');

// Action
Route::post('pegsub/aksiBeliBarang', 'PegSubController@aksiBeliBarang');
Route::post('pegsub/approve', 'PegSubController@approve');
Route::post('pegsub/aksiTambahBarangBaru', 'PegSubController@aksiTambahBarangBaru');
Route::post('pegsub/aksiTambahBarang', 'PegSubController@aksiTambahBarang');
Route::get('pegsub/hapusBarang/{kdbarang}', 'PegSubController@hapusBarang');
Route::get('pegsub/approveSingle/{kdtransaksi}', 'PegSubController@approveSingle');
Route::get('pegsub/declineSingle/{kdtransaksi}', 'PegSubController@declineSingle');
Route::get('pegsub/aksiTambahBarangSingle/{kdtransaksi}', 'PegSubController@aksiTambahBarangSingle');
Route::post('pegsub/aksiTambahAkun', 'PegSubController@aksiTambahAkun');
Route::get('pegsub/aksiEditAkun/{nip}', 'PegSubController@aksiEditAkun');
Route::get('pegsub/hapusAkun/{nip}', 'PegSubController@hapusAkun');
Route::post('pegsub/readNotif', 'PegSubController@readNotif');

// -----

//PegBkn
Route::resource('pegbkn/index', 'PegBknController');

Route::get('pegbkn/lihatBarang', 'PegBknController@lihatBarang');
Route::get('pegbkn/beliBarang', 'PegBknController@beliBarang');
Route::get('pegbkn/ambilBarang', 'PegBknController@ambilBarang');
Route::get('pegbkn/notifikasi/{kdNotifikasi}', 'PegBknController@notifikasi');

// Dialog KepalaTU
Route::get('pegbkn/dialogBeliBarang/{kdbarang}', 'PegBknController@dialogBeliBarang');
Route::get('pegbkn/dialogAmbilBarang/{kdbarang}', 'PegBknController@dialogAmbilBarang');
Route::get('pegbkn/dialogDetailBarang/{kdbarang}', 'PegBknController@dialogDetailBarang');

// Action
Route::post('pegbkn/aksiBeliBarang', 'PegBknController@aksiBeliBarang');
Route::post('pegbkn/aksiAmbilBarang', 'PegBknController@aksiAmbilBarang');
Route::post('pegbkn/readNotif', 'PegBknController@readNotif');

// -----

// Laporan
Route::post('laporan/printLaporanTahun', 'LaporanController@printLaporanTahun');
Route::post('laporan/printLaporanBulan', 'LaporanController@printLaporanBulan');

// -----