<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Akun;
use App\Pegawai;
use App\Transaksi;
use App\Barang;
use App\UnitKerja;
use DB;

class LaporanController extends Controller 
{

	public function printLaporanTahun(Request $request)
    {
        $awal = date("Y-m-d", strtotime($request->awal));
        $akhir = date("Y-m-d", strtotime($request->akhir));

        $barang1 = Barang::select('*', 'barang.jumlah as br_jml', 'transaksi.tanggal as tr_tgl', 'barang.tanggal as br_tgl')
            ->leftJoin('transaksi', 'barang.kdbarang', '=', 'transaksi.kdbarang')->get();
        $barang = Barang::select('*', 'barang.jumlah as br_jml', 'transaksi.tanggal as tr_tgl', 'barang.tanggal as br_tgl', DB::raw('SUM(tambah) as jml_tambah'), DB::raw('SUM(kurang) as jml_kurang'))
            ->leftJoin('transaksi', 'barang.kdbarang', '=', 'transaksi.kdbarang')
            ->whereBetween('transaksi.tanggal', [$awal, $akhir])
            ->where(function($query) {
                $query->where('transaksi.status', 5)->orWhere('transaksi.status', 8);
            })
            ->groupBy('transaksi.kdbarang')->get();
        $unitkepala = UnitKerja::select('*', DB::raw('SUM(transaksi.kurang) as ok'))
            ->join('transaksi', 'unit_kerja.kode_unit', '=', 'transaksi.kode_unit')
            ->where('transaksi.kode_unit', 1)
            ->where('transaksi.status', 8)->get();
        $unit = UnitKerja::select('*', DB::raw('SUM(transaksi.kurang) as ok'))
            ->join('transaksi', 'unit_kerja.kode_unit', '=', 'transaksi.kode_unit')
            ->where('transaksi.kode_unit', 2)
            ->where('transaksi.status', 8)->get();
        $unitumum = UnitKerja::select('*', DB::raw('SUM(transaksi.kurang) as ok'))
            ->join('transaksi', 'unit_kerja.kode_unit', '=', 'transaksi.kode_unit')
            ->where('transaksi.kode_unit', 3)
            ->where('transaksi.status', 8)->get();
        $unit1 = UnitKerja::select('*', DB::raw('SUM(transaksi.kurang) as ok'))
            ->join('transaksi', 'unit_kerja.kode_unit', '=', 'transaksi.kode_unit')
            ->where('transaksi.kode_unit', 4)
            ->where('transaksi.status', 8)->get();
        $unit5 = UnitKerja::select('*', DB::raw('SUM(transaksi.kurang) as ok'))
            ->join('transaksi', 'unit_kerja.kode_unit', '=', 'transaksi.kode_unit')
            ->where('transaksi.kode_unit', 5)
            ->where('transaksi.status', 8)->get();
        $unit6 = UnitKerja::select('*', DB::raw('SUM(transaksi.kurang) as ok'))
            ->join('transaksi', 'unit_kerja.kode_unit', '=', 'transaksi.kode_unit')
            ->where('transaksi.kode_unit', 6)
            ->where('transaksi.status', 8)->get();
        $unit7 = UnitKerja::select('*', DB::raw('SUM(transaksi.kurang) as ok'))
            ->join('transaksi', 'unit_kerja.kode_unit', '=', 'transaksi.kode_unit')
            ->where('transaksi.kode_unit', 7)
            ->where('transaksi.status', 8)->get();
        $unit8 = UnitKerja::select('*', DB::raw('SUM(transaksi.kurang) as ok'))
            ->join('transaksi', 'unit_kerja.kode_unit', '=', 'transaksi.kode_unit')
            ->where('transaksi.kode_unit', 8)
            ->where('transaksi.status', 8)->get();
        $unit9 = UnitKerja::select('*', DB::raw('SUM(transaksi.kurang) as ok'))
            ->join('transaksi', 'unit_kerja.kode_unit', '=', 'transaksi.kode_unit')
            ->where('transaksi.kode_unit', 9)
            ->where('transaksi.status', 8)->get();
        $unit10 = UnitKerja::select('*', DB::raw('SUM(transaksi.kurang) as ok'))
            ->join('transaksi', 'unit_kerja.kode_unit', '=', 'transaksi.kode_unit')
            ->where('transaksi.kode_unit', 10)
            ->where('transaksi.status', 8)->get();
        $unit11 = UnitKerja::select('*', DB::raw('SUM(transaksi.kurang) as ok'))
            ->join('transaksi', 'unit_kerja.kode_unit', '=', 'transaksi.kode_unit')
            ->where('transaksi.kode_unit', 11)
            ->where('transaksi.status', 8)->get();
        $unit12 = UnitKerja::select('*', DB::raw('SUM(transaksi.kurang) as ok'))
            ->join('transaksi', 'unit_kerja.kode_unit', '=', 'transaksi.kode_unit')
            ->where('transaksi.kode_unit', 12)
            ->where('transaksi.status', 8)->get();
        $unit13 = UnitKerja::select('*', DB::raw('SUM(transaksi.kurang) as ok'))
            ->join('transaksi', 'unit_kerja.kode_unit', '=', 'transaksi.kode_unit')
            ->where('transaksi.kode_unit', 13)
            ->where('transaksi.status', 8)->get();
        $unit14 = UnitKerja::select('*', DB::raw('SUM(transaksi.kurang) as ok'))
            ->join('transaksi', 'unit_kerja.kode_unit', '=', 'transaksi.kode_unit')
            ->where('transaksi.kode_unit', 14)
            ->where('transaksi.status', 8)->get();
        $unit15 = UnitKerja::select('*', DB::raw('SUM(transaksi.kurang) as ok'))
            ->join('transaksi', 'unit_kerja.kode_unit', '=', 'transaksi.kode_unit')
            ->where('transaksi.kode_unit', 15)
            ->where('transaksi.status', 8)->get();
        $unit16 = UnitKerja::select('*', DB::raw('SUM(transaksi.kurang) as ok'))
            ->join('transaksi', 'unit_kerja.kode_unit', '=', 'transaksi.kode_unit')
            ->where('transaksi.kode_unit', 16)
            ->where('transaksi.status', 8)->get();
        $unit17 = UnitKerja::select('*', DB::raw('SUM(transaksi.kurang) as ok'))
            ->join('transaksi', 'unit_kerja.kode_unit', '=', 'transaksi.kode_unit')
            ->where('transaksi.kode_unit', 17)
            ->where('transaksi.status', 8)->get();

        return view('laporan.laporanTahun', compact('unitkepala', 'unit', 'unitumum', 'unit1', 'unit5', 'unit6', 'unit7', 'unit8', 'unit9', 'unit10', 'unit11', 'unit12', 'unit13', 'unit14', 'unit15', 'unit16', 'unit17', 'barang', 'barang1', 'awal', 'akhir'));
    }

    public function printLaporanBulan(Request $request)
    {
    	$bulan = $request->bulan;
    	$barang = Barang::select('*', 'barang.jumlah as br_jml', 'transaksi.tanggal as tr_tgl', 'barang.tanggal as br_tgl', DB::raw('SUM(tambah) as jml_tambah'), DB::raw('SUM(kurang) as jml_kurang'))
    		->leftJoin('transaksi', 'barang.kdbarang', '=', 'transaksi.kdbarang')
    		->whereMonth('transaksi.tanggal', $bulan)
    		->where(function($query) {
                $query->where('transaksi.status', 5)->orWhere('transaksi.status', 8);
            })
            ->groupBy('transaksi.kdbarang')->get();

        return view('laporan.laporanBulan', compact('bulan', 'barang'));
    }
}

/* End of file LaporanController.php */
/* Location: .//C/xampp/htdocs/laravel/bkn/app/Http/Controllers/LaporanController.php */