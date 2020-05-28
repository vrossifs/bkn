<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;
use App\Akun;
use App\Transaksi;
use App\Barang;
use App\Pegawai;
use App\UnitKerja;
use DB;

class PegBknController extends Controller
{
    //
    public function index()
    {
    	//
    	return view('pegbkn.dashboard');
    }

    public function lihatBarang()
    {
    	//
    	$barang = DB::table('barang')->get();
        return view('pegbkn.lihatBarang', compact('barang'));
    }

    public function beliBarang()
    {
    	// 
    	$barang = DB::table('barang')->get();
        return view('pegbkn.beliBarang', compact('barang'));
    }

    public function dialogBeliBarang($kdbarang)
    {
    	$barang = DB::table('barang')
    		->where(['kdbarang' => $kdbarang])->get();
        return view('pegbkn.dialogBeliBarang', compact('barang'));
    }

    public function aksiBeliBarang(Request $request)
    {
        // 
        Transaksi::create([
            'kdbarang' => $request->kdbarang,
            'kode_unit' => session('kode_unit'),
            'tanggal' => date('Y-m-d'),
            'status' => 6,
            'jenistransaksi' => 'Beli',
            'tambah' => $request->jumlah,
            'kurang' => 0
        ]);

        $query = Transaksi::where('kode_unit', session('kode_unit'))
            ->orderBy('kdtransaksi', 'desc')->limit(1)->get();

        foreach ($query as $key) {
            $kdtransaksi = $key->kdtransaksi;
        }

        DB::table('notif_khusus')
            ->insert([
                'pengirim'  => $kdtransaksi,
                'penerima'  => 2,
                'header'    => "Pengajuan Pembelian",
                'pesan'     => "Pengajuan pembelian barang<br> dari ".session('unit_kerja'),
                'tanggal'   => date("Y-m-d H:i:s"),
                'status'    => 6
            ]);

        session([
            'alert_type'    => 'alert-success',
            'alert_header'  => 'Success!',
            'alert_message' => 'Pengajuan Telah Dikirim!'
        ]);

        return redirect()->action('PegBknController@beliBarang');
    }

    public function ambilBarang()
    {
    	$barang = DB::table('barang')->get();
        return view('pegbkn.ambilBarang', compact('barang'));
    }

    public function dialogAmbilBarang($kdbarang)
    {
        $barang = DB::table('barang')
            ->where(['kdbarang' => $kdbarang])->get();
        return view('pegbkn.dialogAmbilBarang', compact('barang'));
    }

    public function aksiAmbilBarang(Request $request)
    {
        // 
        Transaksi::create([
            'kdbarang' => $request->kdbarang,
            'kode_unit' => session('kode_unit'),
            'tanggal' => date('Y-m-d'),
            'status' => 6,
            'jenistransaksi' => 'Ambil',
            'tambah' => 0,
            'kurang' => $request->jumlah
        ]);

        $query = Transaksi::where('kode_unit', session('kode_unit'))
            ->orderBy('kdtransaksi', 'desc')->limit(1)->get();

        foreach ($query as $key) {
            $kdtransaksi = $key->kdtransaksi;
        }

        DB::table('notif_khusus')
            ->insert([
                'pengirim'  => $kdtransaksi,
                'penerima'  => 3,
                'header'    => "Pengajuan Pengambilan",
                'pesan'     => "Pengajuan pengambilan barang<br> dari ".session('unit_kerja'),
                'tanggal'   => date("Y-m-d H:i:s"),
                'status'    => 6
            ]);

        session([
            'alert_type'    => 'alert-success',
            'alert_header'  => 'Success!',
            'alert_message' => 'Pengajuan Telah Dikirim!'
        ]);

        return redirect()->action('PegBknController@ambilBarang');
    }

    public function dialogDetailBarang($kdbarang)
    {
    	$barang = DB::table('barang')
    		->where(['kdbarang' => $kdbarang])->get();
        return view('pegbkn.dialogDetailBarang', compact('barang'));
    }

    public function notifikasi($kdNotifikasi)
    {
      if ($kdNotifikasi != "all") {
            DB::table('notifikasi')->where('kdnotifikasi', $kdNotifikasi)->update(['status' => 8]);
            return redirect()->action('PegBknController@notifikasi', 'all');
        }else {
            $notifikasi = DB::table('notifikasi')
                ->select('*', DB::raw('transaksi.tanggal AS tgl_transaksi'), DB::raw('notifikasi.tanggal AS tgl_approve'), DB::raw('notifikasi.status AS notif_status'))
                ->join('unit_kerja', 'notifikasi.pengirim', '=', 'unit_kerja.kode_unit')
                ->join('transaksi', 'notifikasi.penerima', '=', 'transaksi.kdtransaksi')
                ->join('barang', 'transaksi.kdbarang', '=', 'barang.kdbarang')
                ->join('status', 'transaksi.status', '=', 'status.kode_status')
                ->where('transaksi.kode_unit', session('kode_unit'))
                ->groupBy('kdnotifikasi')
                ->orderBy('notifikasi.tanggal', 'desc')->get();
            return view('pegbkn.notifikasi', compact('notifikasi'));
        }
    }

    public function readNotif(){
        $query = DB::table('transaksi')->where('kode_unit', session('kode_unit'))->get();
        for ($i=0; $i < sizeof($query); $i++) { 
            foreach ($query as $key) {
                $where = "penerima = ".$key->kdtransaksi;
                DB::table('notifikasi')->where('penerima', $key->kdtransaksi)->update(['status' => 8]);
            }
        }

        return redirect()->action('PegBknController@notifikasi', 'all');
    }
}
