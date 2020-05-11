<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Akun;
use App\Transaksi;
use App\Barang;
use App\Pegawai;
use App\UnitKerja;
use DB;

class PegSubController extends Controller
{
    //
    public function index()
    {
    	//
    	return view('pegsub.dashboard');
    }

    public function lihatBarang()
    {
    	//
    	$barang = Barang::all();
        return view('pegsub.lihatBarang', compact('barang'));
    }

    public function dialogBeliBarang($kdbarang)
    {
        $barang = Barang::where(['kdbarang' => $kdbarang])->get();
        return view('pegsub.dialogBeliBarang', compact('barang'));
    }

    public function dialogDetailBarang($kdbarang)
    {
    	$barang = Barang::where(['kdbarang' => $kdbarang])->get();
        return view('pegsub.dialogDetailBarang', compact('barang'));
    }

    public function approvalAmbil()
    {
        $barang = Transaksi::select('*', 'transaksi.tanggal as tgl_transaksi')
            ->join('barang', 'transaksi.kdbarang', '=', 'barang.kdbarang')
            ->join('unit_kerja', 'transaksi.kode_unit', '=', 'unit_kerja.kode_unit')
            ->where([
                'jenistransaksi' => 'Ambil', 
                'status' => 6
            ])
            ->orderBy('kdtransaksi', 'asc')->get();
        return view('pegsub.approvalAmbil', compact('barang'));
    }

    public function riwayatApprove()
    {
        $barang = Transaksi::select('*', 'history.tanggal as tgl_approve')
            ->join('barang', 'transaksi.kdbarang', '=', 'barang.kdbarang')
            ->join('unit_kerja', 'transaksi.kode_unit', '=', 'unit_kerja.kode_unit')
            ->join('history', 'history.kdtransaksi', '=', 'transaksi.kdtransaksi')
            ->join('status', 'history.status', '=', 'status.kode_status')
            ->where('jenistransaksi', 'Ambil')
            ->groupBy('history.kdtransaksi')
            ->orderBy('kdhistory', 'desc')->get();
        return view('pegsub.riwayatApprove', compact('barang'));
    }

    public function tambahBarangBaru()
    {
    	return view('pegsub.tambahBarangBaru');
    }

    public function tambahBarangLama()
    {
    	$barang = Transaksi::join('barang', 'transaksi.kdbarang', '=', 'barang.kdbarang')
            ->join('unit_kerja', 'transaksi.kode_unit', '=', 'unit_kerja.kode_unit')
            ->where([
                'jenistransaksi' => 'Beli', 
                'status' => 5,
                'transaksi.kode_unit' => 3
            ])->get();
        return view('pegsub.tambahBarangLama', compact('barang'));
    }

    public function tambahBarangPembelian()
    {
    	$barang = Transaksi::join('barang', 'transaksi.kdbarang', '=', 'barang.kdbarang')
            ->join('unit_kerja', 'transaksi.kode_unit', '=', 'unit_kerja.kode_unit')
            ->where([
                'jenistransaksi' => 'Beli', 
                'status' => 5
            ])
            ->where('transaksi.kode_unit', '!=', 3)->get();
        return view('pegsub.tambahBarangPembelian', compact('barang'));
    }

    public function dialogLaporanTahun()
    {
        //
        return view('pegsub.dialogLaporanTahun');
    }

    public function dialogLaporanBulan()
    {
        //
        return view('pegsub.dialogLaporanBulan');
    }

    public function manajemenAdmin()
    {
    	$akun = Pegawai::join('unit_kerja', 'pegawai.kode_unit', '=', 'unit_kerja.kode_unit')
            ->join('akun', 'pegawai.nip', '=', 'akun.nip')
            ->join('status', 'akun.status', '=', 'status.kode_status')->get();
        return view('pegsub.manajemenAdmin', compact('akun'));
    }

    public function tambahAkun()
    {
    	$unit = DB::table('unit_kerja')->get();
        return view('pegsub.tambahAkun', compact('unit'));
    }

    public function riwayatTambahBarang()
    {
    	$barang = Transaksi::select('*', 'transaksi.tanggal as tgl_transaksi')
    		->join('barang', 'transaksi.kdbarang', '=', 'barang.kdbarang')
            ->join('unit_kerja', 'transaksi.kode_unit', '=', 'unit_kerja.kode_unit')
            ->where([
                'jenistransaksi' => 'Beli', 
                'status' => 8
            ])->get();
        return view('pegsub.riwayatTambahBarang', compact('barang'));
    }
}
