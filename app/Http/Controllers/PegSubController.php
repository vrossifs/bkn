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

        return redirect()->action('PegSubController@lihatBarang');
    }

    public function dialogDetailBarang($kdbarang)
    {
    	$barang = Barang::where(['kdbarang' => $kdbarang])->get();
        return view('pegsub.dialogDetailBarang', compact('barang'));
    }

    public function hapusBarang($kdbarang)
    {
        $query = Barang::where('kdbarang', $kdbarang)->get();
        foreach ($query as $key) {
            $nama_barang = $key->namabarang;
            $keterangan = $key->keterangan;
        }

        Barang::where('kdbarang', $kdbarang)->delete();
        
        session([
            'alert_type'    => 'alert-success',
            'alert_header'  => 'Success!',
            'alert_message' => $nama_barang.' '.$keterangan.' telah dihapus!'
        ]);

        return back();
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
                                    'pengirim'  => session('kode_unit'),
                                    'penerima'  => $kdtransaksi,
                                    'header'    => "AMBIL BARANG DISETUJUI",
                                    'pesan'     => "Barang telah diberikan, jumlah<br> barang ".$kurang." dari ".$kurang,
                                    'tanggal'   => date("Y-m-d H:i:s"),
                                    'status'    => 6]);

                            session([
                                'alert_type'    => 'alert-success',
                                'alert_header'  => 'Success!',
                                'alert_message' => 'Pengajuan telah disetujui!'
                            ]);
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
                                    'pengirim'  => session('kode_unit'),
                                    'penerima'  => $kdtransaksi,
                                    'header'    => "AMBIL BARANG DISETUJUI",
                                    'pesan'     => "Barang telah diberikan, jumlah<br> barang ".$jml_barang." dari ".$kurang,
                                    'tanggal'   => date("Y-m-d H:i:s"),
                                    'status'    => 6]);

                            session([
                                'alert_type'    => 'alert-success',
                                'alert_header'  => 'Success!',
                                'alert_message' => 'Pengajuan telah disetujui!'
                            ]);
                        }
                    }elseif ($jml_barang == 0) {
                        Transaksi::where('kdtransaksi', $kdtransaksi)->delete();

                        DB::table('notifikasi')
                            ->insert([
                                'pengirim'  => session('kode_unit'),
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
                            'pengirim'  => session('kode_unit'),
                            'penerima'  => $kdtransaksi,
                            'header'    => "AMBIL BARANG TIDAK DISETUJUI",
                            'pesan'     => "Permintaan anda tidak disetujui",
                            'tanggal'   => date("Y-m-d H:i:s"),
                            'status'    => 6]);

                    session([
                        'alert_type'    => 'alert-warning',
                        'alert_header'  => 'Success!',
                        'alert_message' => 'Pengajuan telah anda tolak!'
                    ]);
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
                        'pengirim'  => session('kode_unit'),
                        'penerima'  => $kdtransaksi,
                        'header'    => "AMBIL BARANG DISETUJUI",
                        'pesan'     => "Barang telah diberikan, jumlah<br> barang ".$kurang." dari ".$kurang,
                        'tanggal'   => date("Y-m-d H:i:s"),
                        'status'    => 6]);

                session([
                    'alert_type'    => 'alert-success',
                    'alert_header'  => 'Success!',
                    'alert_message' => 'Pengajuan telah disetujui!'
                ]);
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
                        'pengirim'  => session('kode_unit'),
                        'penerima'  => $kdtransaksi,
                        'header'    => "AMBIL BARANG DISETUJUI",
                        'pesan'     => "Barang telah diberikan, jumlah<br> barang ".$jml_barang." dari ".$kurang,
                        'tanggal'   => date("Y-m-d H:i:s"),
                        'status'    => 6]);

                session([
                    'alert_type'    => 'alert-success',
                    'alert_header'  => 'Success!',
                    'alert_message' => 'Pengajuan telah disetujui!'
                ]);
            }
        }elseif ($jml_barang == 0) {
            Transaksi::where('kdtransaksi', $kdtransaksi)->delete();

            DB::table('notifikasi')
            ->insert([
                'pengirim'  => session('kode_unit'),
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
                'pengirim'  => session('kode_unit'),
                'penerima'  => $kdtransaksi,
                'header'    => "AMBIL BARANG TIDAK DISETUJUI",
                'pesan'     => "Permintaan anda tidak disetujui",
                'tanggal'   => date("Y-m-d H:i:s"),
                'status'    => 6]);

        session([
            'alert_type'    => 'alert-warning',
            'alert_header'  => 'Success!',
            'alert_message' => 'Pengajuan telah anda tolak!'
        ]);

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

    public function aksiTambahBarangBaru(Request $request)
    {
        $tanggal = date("Y-m-d", strtotime($request->tanggal));

        Barang::insert([
            'namabarang' => ucwords($request->nama_barang),
            'jenis' => $request->jenis_barang,
            'tanggal' => $tanggal,
            'jumlah' => $request->jumlah,
            'satuan' => $request->satuan,
            'keterangan' => $request->keterangan
        ]);

        $get_kdbarang = Barang::orderBy('kdbarang', 'desc')
            ->limit(1)->get();

        foreach ($get_kdbarang as $key) {
            $kdbarang = $key->kdbarang;
        }

        Transaksi::insert([
            'kdbarang' => $kdbarang,
            'kode_unit' => session('kode_unit'),
            'tanggal' => date('Y-m-d'),
            'status' => 8,
            'jenistransaksi' => 'Beli',
            'tambah' => $request->jumlah,
            'kurang' => 0
        ]);

        $get_kdtransaksi = Transaksi::where('kode_unit', session('kode_unit'))
            ->orderBy('kdtransaksi', 'desc')
            ->limit(1)->get();

        foreach ($get_kdtransaksi as $row) {
            $kdtransaksi = $row->kdtransaksi;
        }

        DB::table('history')->insert([
            'kdtransaksi' => $kdtransaksi,
            'status' => 8,
            'tanggal' => date("Y-m-d")
        ]);

        session([
            'alert_type'    => 'alert-success',
            'alert_header'  => 'Success!',
            'alert_message' => ucwords($request->nama_barang).' '.$request->keterangan.' berhasil ditambahkan!'
        ]);

        return redirect()->action('PegSubController@lihatBarang');
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

    public function aksiTambahBarang(Request $request)
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
                        $tambah = $x->tambah;
                        $kdbarang = $x->kd_barang;
                    }

                    Barang::where('kdbarang', $kdbarang)->update(['jumlah' => $jml_barang + $tambah]);
                    Transaksi::where('kdtransaksi', $kdtransaksi)->update(['status' => 8]);

                    session([
                        'alert_type'    => 'alert-success',
                        'alert_header'  => 'Success!',
                        'alert_message' => 'Barang berhasil ditambahkan!'
                    ]);
                }
            }
            return redirect()->action('PegSubController@lihatBarang');
        }
    }

    public function aksiTambahBarangSingle($kdtransaksi, Request $request)
    {
        $query = Transaksi::select('*', 'transaksi.kdbarang as kd_barang', 'barang.jumlah as jml_barang')
            ->join('barang', 'transaksi.kdbarang', '=', 'barang.kdbarang')
            ->where('kdtransaksi', $kdtransaksi)->get();

        foreach ($query as $x) {
            $jml_barang = $x->jml_barang;
            $tambah = $x->tambah;
            $kdbarang = $x->kd_barang;
        }

        Barang::where('kdbarang', $kdbarang)->update(['jumlah' => $jml_barang + $tambah]);
        Transaksi::where('kdtransaksi', $kdtransaksi)->update(['status' => 8]);

        session([
            'alert_type'    => 'alert-success',
            'alert_header'  => 'Success!',
            'alert_message' => 'Barang berhasil ditambahkan!'
        ]);

        return redirect()->action('PegSubController@lihatBarang');
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
        $unit = UnitKerja::all();
        return view('pegsub.tambahAkun', compact('unit'));
    }

    public function aksiTambahAkun(Request $request)
    {
        Pegawai::insert([
            'nip' => $request->nip,
            'namalengkap' => ucwords($request->nama),
            'kode_unit' => $request->unit_kerja,
            'jeniskelamin' => $request->jenis_kelamin,
            'statusnikah' => $request->status_nikah,
            'email' => $request->email,
            'nohp' => $request->nohp,
            'alamat' => $request->alamat
        ]);

        // input ke table akun
        $status_akun = 0;
        if ($request->status_akun != "on") {
            $status_akun = 2;
        }else{
            $status_akun = 1;
        }

        Akun::insert([
            'nip' => $request->nip,
            'password' => $request->password,
            'status' => $status_akun
        ]);

        session([
            'alert_type'    => 'alert-success',
            'alert_header'  => 'Success!',
            'alert_message' => 'Akun '.$request->nip.' berhasil dibuat!'
        ]);

        return redirect()->action('PegSubController@manajemenAdmin');
    }

    public function editAkun($nip, Request $requests)
    {
        $tampil = Pegawai::select('*', DB::raw('(
                select nama_status 
                from status 
                join pegawai on status.kode_status = pegawai.statusnikah
                where nip = '.$nip.'
            ) as nama_status_nikah'))
            ->join('unit_kerja','pegawai.kode_unit', '=', 'unit_kerja.kode_unit')
            ->join('akun','pegawai.nip', '=', 'akun.nip')
            ->join('status','akun.status', '=', 'status.kode_status')
            ->where('pegawai.nip', $nip)->get();

        $unit = UnitKerja::all();

        return view('pegsub.editAkun', compact('tampil', 'unit'));
    }

    public function aksiEditAkun($nip, Request $request)
    {
        Pegawai::where('nip', $nip)
            ->update([
                'nip' => $request->nip,
                'namalengkap' => ucwords($request->nama),
                'kode_unit' => $request->unit_kerja,
                'jeniskelamin' => $request->jenis_kelamin,
                'statusnikah' => $request->status_nikah,
                'email' => $request->email,
                'nohp' => $request->nohp,
                'alamat' => $request->alamat
            ]);

        // input ke table akun
        if ($request->status_akun != "on") {
            $status_akun = 2;
        }else{
            $status_akun = 1;
        }

        Akun::where('nip', $nip)
            ->update([
                'nip' => $request->nip,
                'password' => $request->password,
                'status' => $status_akun
            ]);

        session([
            'alert_type'    => 'alert-success',
            'alert_header'  => 'Success!',
            'alert_message' => 'Akun '.$request->nip.' telah diubah!'
        ]);

        return redirect()->action('PegSubController@manajemenAdmin');
    }

    public function hapusAkun($nip)
    {
        Pegawai::where('nip', $nip)
            ->delete();

        session([
            'alert_type'    => 'alert-success',
            'alert_header'  => 'Success!',
            'alert_message' => 'Akun '.$nip.' berhasil dihapus!'
        ]);
        
        return redirect()->action('PegSubController@manajemenAdmin');
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

    public function notifikasi($kdNotifikasi)
    {
      if ($kdNotifikasi != "all") {
            DB::table('notifikasi')->where('kdnotifikasi', $kdNotifikasi)->update(['status' => 8]);
            return redirect()->action('PegSubController@notifikasi', 'all');
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
            return view('pegsub.notifikasi', compact('notifikasi'));
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

        return redirect()->action('PegSubController@notifikasi', 'all');
    }
}
