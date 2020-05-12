<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Transaksi;
use App\Barang;
use App\UnitKerja;
use DB;

class KeuanganTUController extends Controller
{
    //
    public function index()
    {
    	//
    	return view('keuangan.dashboard');
    }

    public function lihatBarang()
    {
    	//
    	$barang = Barang::all();
        return view('keuangan.lihatBarang', compact('barang'));
    }

    public function beliBarang()
    {
    	// 
    	$barang = Barang::all();
        return view('keuangan.beliBarang', compact('barang'));
    }

    public function dialogBeliBarang($kdbarang)
    {
    	$barang = Barang::where(['kdbarang' => $kdbarang])->get();
        return view('keuangan.dialogBeliBarang', compact('barang'));
    }

    public function aksiBeliBarang(Request $request)
    {
        // 
        Transaksi::create([
            'kdbarang' => $request->kdbarang,
            'kode_unit' => $request->session()->get('kode_unit'),
            'tanggal' => date('Y-m-d'),
            'status' => 6,
            'jenistransaksi' => 'Beli',
            'tambah' => $request->jumlah,
            'kurang' => 0
        ]);

        $query = Transaksi::where('kode_unit', $request->session()->get('kode_unit'))
            ->orderBy('kdtransaksi')->limit(1)->get();

        foreach ($query as $key) {
            $kdtransaksi = $key->kdtransaksi;
        }

        DB::table('notif_khusus')
            ->insert([
                'pengirim'  => $kdtransaksi,
                'penerima'  => 2,
                'header'    => "Pengajuan Pembelian",
                'pesan'     => "Pengajuan pembelian barang<br> dari ".$request->session()->get('kode_unit'),
                'tanggal'   => date("Y-m-d H:i:s"),
                'status'    => 6
            ]);

        session([
            'alert_type'    => 'alert-success',
            'alert_header'  => 'Success!',
            'alert_message' => 'Pengajuan Telah Dikirim!'
        ]);

        return redirect()->action('KeuanganTUController@beliBarang');
    }

    public function ambilBarang()
    {
    	$barang = Barang::all();
        return view('keuangan.ambilBarang', compact('barang'));
    }

    public function dialogAmbilBarang($kdbarang)
    {
        $barang = Barang::where(['kdbarang' => $kdbarang])->get();
        return view('keuangan.dialogAmbilBarang', compact('barang'));
    }

    public function aksiAmbilBarang(Request $request)
    {
    	// 
        Transaksi::create([
            'kdbarang' => $request->kdbarang,
            'kode_unit' => $request->session()->get('kode_unit'),
            'tanggal' => date('Y-m-d'),
            'status' => 6,
            'jenistransaksi' => 'Ambil',
            'tambah' => 0,
            'kurang' => $request->jumlah
        ]);

        $query = Transaksi::where('kode_unit', $request->session()->get('kode_unit'))
            ->orderBy('kdtransaksi')->limit(1)->get();

        foreach ($query as $key) {
            $kdtransaksi = $key->kdtransaksi;
        }

        DB::table('notif_khusus')
            ->insert([
                'pengirim'  => $kdtransaksi,
                'penerima'  => 3,
                'header'    => "Pengajuan Pengambilan",
                'pesan'     => "Pengajuan pengambilan barang<br> dari ".$request->session()->get('kode_unit'),
                'tanggal'   => date("Y-m-d H:i:s"),
                'status'    => 6
            ]);

        session([
            'alert_type'    => 'alert-success',
            'alert_header'  => 'Success!',
            'alert_message' => 'Pengajuan Telah Dikirim!'
        ]);

        return redirect()->action('KeuanganTUController@ambilBarang');
    }

    public function dialogDetailBarang($kdbarang)
    {
    	$barang = Barang::where(['kdbarang' => $kdbarang])->get();
        return view('keuangan.dialogDetailBarang', compact('barang'));
    }

    public function approvalBeli()
    {
        $barang = Transaksi::select('*', 'transaksi.tanggal as tgl_transaksi')
            ->join('barang', 'transaksi.kdbarang', '=', 'barang.kdbarang')
            ->join('unit_kerja', 'transaksi.kode_unit', '=', 'unit_kerja.kode_unit')
            ->where([
                'jenistransaksi' => 'Beli', 
                'status' => 6
            ])
            ->orderBy('kdtransaksi', 'asc')->get();
        return view('keuangan.approvalBeli', compact('barang'));
    }

    public function approve(Request $request)
    {
        if (isset($_POST['acc_all'])) {
            $submittedData = $request->post();
            foreach ($submittedData as $key => $value) {
                if (strpos($key, "check|") !== false) {
                    $kdtransaksi = explode("|", $key)[1];

                    $query = Transaksi::select('*', 'transaksi.kdbarang as kd_barang', 'barang.jumlah as jml_barang')
                        ->join('barang', 'transaksi.kdbarang', '=', 'barang.kdbarang')
                        ->where('kdtransaksi', $kdtransaksi)->get();

                    foreach ($query as $x) {
                        $kdbarang = $x->kd_barang;
                        $jml_barang = $x->jml_barang;
                        $tambah = $x->tambah;
                    }

                    Transaksi::where('kdtransaksi', $kdtransaksi)
                        ->update(['status' => 5]);  

                    DB::table('notif_khusus')
                        ->where('pengirim', $kdtransaksi)
                        ->update(['status' => 8]);

                    DB::table('history')
                        ->insert([
                            'kdtransaksi'  => $kdtransaksi,
                            'status'  => 5,
                            'tanggal'    => date("Y-m-d")]);

                    DB::table('notifikasi')
                        ->insert([
                            'pengirim'  => $request->session()->get('kode_unit'),
                            'penerima'  => $kdtransaksi,
                            'header'    => "BELI BARANG DISETUJUI",
                            'pesan'     => "Barang telah dibeli, sejumlah ".$tambah,
                            'tanggal'   => date("Y-m-d H:i:s"),
                            'status'    => 6]);
                }
            }
            return redirect()->action('KeuanganTUController@approvalBeli');
        }elseif (isset($_POST['dec_all'])) {
            $submittedData = $request->post();
            foreach ($submittedData as $key => $value) {
                if (strpos($key, "check|") !== false) {
                    $kdtransaksi = explode("|", $key)[1];

                    $query = Transaksi::select('*', 'transaksi.kdbarang as kd_barang', 'barang.jumlah as jml_barang')
                        ->join('barang', 'transaksi.kdbarang', '=', 'barang.kdbarang')
                        ->where('kdtransaksi', $kdtransaksi)->get();

                    foreach ($query as $x) {
                        $kdbarang = $x->kd_barang;
                        $jml_barang = $x->jml_barang;
                        $tambah = $x->tambah;
                    }

                    Transaksi::where('kdtransaksi', $kdtransaksi)
                        ->update(['status' => 7]);  

                    DB::table('notif_khusus')
                        ->where('pengirim', $kdtransaksi)
                        ->update(['status' => 8]);

                    DB::table('history')
                        ->insert([
                            'kdtransaksi'  => $kdtransaksi,
                            'status'  => 7,
                            'tanggal'    => date("Y-m-d")]);

                    DB::table('notifikasi')
                        ->insert([
                            'pengirim'  => $request->session()->get('kode_unit'),
                            'penerima'  => $kdtransaksi,
                            'header'    => "BELI BARANG DISETUJUI",
                            'pesan'     => "Barang telah dibeli, sejumlah ".$tambah,
                            'tanggal'   => date("Y-m-d H:i:s"),
                            'status'    => 6]);
                }
            }
            return redirect()->action('KeuanganTUController@approvalBeli');
        }
    }

    public function approveSingle($kdtransaksi, Request $request)
    {
        $query = Transaksi::select('*', 'transaksi.kdbarang as kd_barang', 'barang.jumlah as jml_barang')
            ->join('barang', 'transaksi.kdbarang', '=', 'barang.kdbarang')
            ->where('kdtransaksi', $kdtransaksi)->get();

        foreach ($query as $x) {
            $kdbarang = $x->kd_barang;
            $jml_barang = $x->jml_barang;
            $tambah = $x->tambah;
        }

        Transaksi::where('kdtransaksi', $kdtransaksi)
            ->update(['status' => 5]);  

        DB::table('notif_khusus')
            ->where('pengirim', $kdtransaksi)
            ->update(['status' => 8]);

        DB::table('history')
            ->insert([
                'kdtransaksi'  => $kdtransaksi,
                'status'  => 5,
                'tanggal'    => date("Y-m-d")]);

        DB::table('notifikasi')
            ->insert([
                'pengirim'  => $request->session()->get('kode_unit'),
                'penerima'  => $kdtransaksi,
                'header'    => "BELI BARANG DISETUJUI",
                'pesan'     => "Barang telah dibeli, sejumlah ".$tambah,
                'tanggal'   => date("Y-m-d H:i:s"),
                'status'    => 6]);

        return redirect()->action('KeuanganTUController@approvalBeli');
    }

    public function declineSingle($kdtransaksi, Request $request)
    {
        $query = Transaksi::select('*', 'transaksi.kdbarang as kd_barang', 'barang.jumlah as jml_barang')
            ->join('barang', 'transaksi.kdbarang', '=', 'barang.kdbarang')
            ->where('kdtransaksi', $kdtransaksi)->get();

        foreach ($query as $x) {
            $kdbarang = $x->kd_barang;
            $jml_barang = $x->jml_barang;
            $tambah = $x->tambah;
        }

        Transaksi::where('kdtransaksi', $kdtransaksi)
            ->update(['status' => 7]);  

        DB::table('notif_khusus')
            ->where('pengirim', $kdtransaksi)
            ->update(['status' => 8]);

        DB::table('history')
            ->insert([
                'kdtransaksi'  => $kdtransaksi,
                'status'  => 7,
                'tanggal'    => date("Y-m-d")]);

        DB::table('notifikasi')
            ->insert([
                'pengirim'  => $request->session()->get('kode_unit'),
                'penerima'  => $kdtransaksi,
                'header'    => "BELI BARANG DISETUJUI",
                'pesan'     => "Barang telah dibeli, sejumlah ".$tambah,
                'tanggal'   => date("Y-m-d H:i:s"),
                'status'    => 6]);

        return redirect()->action('KeuanganTUController@approvalBeli');
    }

    public function riwayatApprove()
    {
        $barang = Transaksi::select('*', 'history.tanggal as tgl_approve')
            ->join('barang', 'transaksi.kdbarang', '=', 'barang.kdbarang')
            ->join('unit_kerja', 'transaksi.kode_unit', '=', 'unit_kerja.kode_unit')
            ->join('history', 'history.kdtransaksi', '=', 'transaksi.kdtransaksi')
            ->join('status', 'history.status', '=', 'status.kode_status')
            ->where('jenistransaksi', 'Beli')
            ->where('history.status', '!=', 8)
            ->groupBy('history.kdtransaksi')
            ->orderBy('kdhistory', 'desc')->get();
        return view('keuangan.riwayatApprove', compact('barang'));
    }

    public function lihatLaporanTahunan()
    {
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
        $barang = Barang::all();
        return view('keuangan.lihatLaporanTahunan', compact('unitkepala', 'unit', 'unitumum', 'unit1', 'unit5', 'unit6', 'unit7', 'unit8', 'unit9', 'unit10', 'unit11', 'unit12', 'unit13', 'unit14', 'unit15', 'unit16', 'unit17', 'barang'));
    }

    public function lihatLaporanBulanan()
    {
        $barang = Barang::all();
        return view('keuangan.lihatLaporanBulanan', compact('barang'));
    }

    public function priviewKtu($kodeUnit)
    {
        $data = Transaksi::select('*', 'transaksi.tanggal as tgl_transaksi')
            ->join('barang', 'transaksi.kdbarang', '=', 'barang.kdbarang')
            ->join('unit_kerja', 'transaksi.kode_unit', '=', 'unit_kerja.kode_unit')
            ->where('transaksi.kode_unit', $kodeUnit)
            ->where('transaksi.status', 8)->get();
        return view('keuangan.priviewKtu', compact('data'));
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
        return view('keuangan.riwayatTambahBarang', compact('barang'));
    }
}
