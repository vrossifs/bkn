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
            ->orderBy('kdtransaksi')->limit(1)->get();

        foreach ($query as $key) {
            $kdtransaksi = $key->kdtransaksi;
        }

        DB::table('notif_khusus')
            ->insert([
                'pengirim'  => $kdtransaksi,
                'penerima'  => 2,
                'header'    => "Pengajuan Pembelian",
                'pesan'     => "Pengajuan pembelian barang<br> dari ".session('kode_unit'),
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
            ->orderBy('kdtransaksi')->limit(1)->get();

        foreach ($query as $key) {
            $kdtransaksi = $key->kdtransaksi;
        }

        DB::table('notif_khusus')
            ->insert([
                'pengirim'  => $kdtransaksi,
                'penerima'  => 3,
                'header'    => "Pengajuan Pengambilan",
                'pesan'     => "Pengajuan pengambilan barang<br> dari ".session('kode_unit'),
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
}
