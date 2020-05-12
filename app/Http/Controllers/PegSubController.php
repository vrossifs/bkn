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

        return redirect()->action('PegSubController@beliBarang');
    }

    public function dialogDetailBarang($kdbarang)
    {
    	$barang = Barang::where(['kdbarang' => $kdbarang])->get();
        return view('pegsub.dialogDetailBarang', compact('barang'));
    }

    public function hapusBarang($kdbarang)
    {

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
                        $jml_barang = $x->jml_barang;
                        $kurang = $x->kurang;
                        $kdbarang = $x->kd_barang;
                        $namabarang = $x->namabarang;
                    }

                    if ($jml_barang != 0) {
                        if ($jml_barang >= $kurang) {
                            Barang::where('kdbarang', $kdbarang)
                                ->update(['jumlah' => $jml_barang - $kurang]);

                            Transaksi::where('kdtransaksi', $kdtransaksi)
                                ->update(['status' => 8]);  

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
                                    'header'    => "AMBIL BARANG DISETUJUI",
                                    'pesan'     => "Barang telah diberikan, jumlah<br> barang ".$kurang." dari ".$kurang,
                                    'tanggal'   => date("Y-m-d H:i:s"),
                                    'status'    => 6]);
                        }elseif ($jml_barang < $kurang) {
                            Barang::where('kdbarang', $kdbarang)
                                ->update(['jumlah' => $jml_barang - $jml_barang]);

                            Transaksi::where('kdtransaksi', $kdtransaksi)
                                ->update([
                                    'status' => 8,
                                    'kurang' => $jml_barang
                                ]);  

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
                                    'header'    => "AMBIL BARANG DISETUJUI",
                                    'pesan'     => "Barang telah diberikan, jumlah<br> barang ".$jml_barang." dari ".$kurang,
                                    'tanggal'   => date("Y-m-d H:i:s"),
                                    'status'    => 6]);
                        }
                    }elseif ($jml_barang == 0) {
                        Transaksi::where('kdtransaksi', $kdtransaksi)->delete();

                        DB::table('notifikasi')
                            ->insert([
                                'pengirim'  => $request->session()->get('kode_unit'),
                                'penerima'  => $kdtransaksi,
                                'header'    => "STOK BARANG HABIS",
                                'pesan'     => "Stok ".$namabarang." telah habis",
                                'tanggal'   => date("Y-m-d H:i:s"),
                                'status'    => 6]);
                    }
                }
            }
            return redirect()->action('PegSubController@approvalAmbil');
        }elseif (isset($_POST['dec_all'])) {
            $submittedData = $request->post();
            foreach ($submittedData as $key => $value) {
                if (strpos($key, "check|") !== false) {
                    $kdtransaksi = explode("|", $key)[1];

                    $query = Transaksi::select('*', 'transaksi.kdbarang as kd_barang', 'barang.jumlah as jml_barang')
                        ->join('barang', 'transaksi.kdbarang', '=', 'barang.kdbarang')
                        ->where('kdtransaksi', $kdtransaksi)->get();

                    foreach ($query as $x) {
                        $jml_barang = $x->jml_barang;
                        $kurang = $x->kurang;
                        $kdbarang = $x->kd_barang;
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
                            'header'    => "AMBIL BARANG TIDAK DISETUJUI",
                            'pesan'     => "Permintaan anda tidak disetujui",
                            'tanggal'   => date("Y-m-d H:i:s"),
                            'status'    => 6]);
                }
            }
            return redirect()->action('PegSubController@approvalAmbil');
        }
    }

    public function approveSingle($kdtransaksi, Request $request)
    {
        $query = Transaksi::select('*', 'transaksi.kdbarang as kd_barang', 'barang.jumlah as jml_barang')
            ->join('barang', 'transaksi.kdbarang', '=', 'barang.kdbarang')
            ->where('kdtransaksi', $kdtransaksi)->get();

        foreach ($query as $x) {
            $jml_barang = $x->jml_barang;
            $kurang = $x->kurang;
            $kdbarang = $x->kd_barang;
        }

        if ($jml_barang != 0) {
            if ($jml_barang >= $kurang) {
                Barang::where('kdbarang', $kdbarang)
                    ->update(['jumlah' => $jml_barang - $kurang]);

                Transaksi::where('kdtransaksi', $kdtransaksi)
                    ->update(['status' => 8]);  

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
                        'header'    => "AMBIL BARANG DISETUJUI",
                        'pesan'     => "Barang telah diberikan, jumlah<br> barang ".$kurang." dari ".$kurang,
                        'tanggal'   => date("Y-m-d H:i:s"),
                        'status'    => 6]);
            }elseif ($jml_barang < $kurang) {
                Barang::where('kdbarang', $kdbarang)
                    ->update(['jumlah' => $jml_barang - $jml_barang]);

                Transaksi::where('kdtransaksi', $kdtransaksi)
                    ->update([
                        'status' => 8,
                        'kurang' => $jml_barang
                    ]);  

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
                        'header'    => "AMBIL BARANG DISETUJUI",
                        'pesan'     => "Barang telah diberikan, jumlah<br> barang ".$jml_barang." dari ".$kurang,
                        'tanggal'   => date("Y-m-d H:i:s"),
                        'status'    => 6]);
            }
        }elseif ($jml_barang == 0) {
            Transaksi::where('kdtransaksi', $kdtransaksi)->delete();

            DB::table('notifikasi')
            ->insert([
                'pengirim'  => $request->session()->get('kode_unit'),
                'penerima'  => $kdtransaksi,
                'header'    => "STOK BARANG HABIS",
                'pesan'     => "Stok ".$namabarang." telah habis",
                'tanggal'   => date("Y-m-d H:i:s"),
                'status'    => 6]);
        }
        return redirect()->action('PegSubController@approvalAmbil');
    }

    public function declineSingle($kdtransaksi, Request $request)
    {
        $query = Transaksi::select('*', 'transaksi.kdbarang as kd_barang', 'barang.jumlah as jml_barang')
            ->join('barang', 'transaksi.kdbarang', '=', 'barang.kdbarang')
            ->where('kdtransaksi', $kdtransaksi)->get();

        foreach ($query as $x) {
            $jml_barang = $x->jml_barang;
            $kurang = $x->kurang;
            $kdbarang = $x->kd_barang;
            $namabarang = $x->namabarang;
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
                'header'    => "AMBIL BARANG TIDAK DISETUJUI",
                'pesan'     => "Permintaan anda tidak disetujui",
                'tanggal'   => date("Y-m-d H:i:s"),
                'status'    => 6]);

        return redirect()->action('PegSubController@approvalAmbil');
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
