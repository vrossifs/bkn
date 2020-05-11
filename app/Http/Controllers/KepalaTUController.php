<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Transaksi;
use App\Barang;
use App\UnitKerja;
use DB;

class KepalaTUController extends Controller
{
    //
    public function index()
    {
    	//
    	return view('kepala.dashboard');
    }

    public function lihatBarang()
    {
    	//
    	$barang = Barang::all();
        return view('kepala.lihatBarang', compact('barang'));
    }

    public function beliBarang()
    {
    	// 
    	$barang = Barang::all();
        return view('kepala.beliBarang', compact('barang'));
    }

    public function dialogBeliBarang($kdbarang)
    {
    	$barang = Barang::where(['kdbarang' => $kdbarang])->get();
        return view('kepala.dialogBeliBarang', compact('barang'));
    }

    public function aksiBeliBarang()
    {
    	// 
        $data = array(
            'kdbarang' => $this->input->post('kdbarang'),
            'kode_unit' => $this->session->userdata('kode_unit'),
            'tanggal' => date('Y-m-d'),
            'status' => 6,
            'jenistransaksi' => 'Beli',
            'tambah' => $this->input->post('jumlah'),
            'kurang' => 0
        );
        $this->M_kepalaTU->tambah('transaksi', $data);

        $query = $this->db->query("SELECT kdtransaksi FROM transaksi WHERE kode_unit = ".$this->session->userdata('kode_unit')." ORDER BY kdtransaksi DESC LIMIT 1")->result();

        foreach ($query as $key) {
            $kdtransaksi = $key->kdtransaksi;
        }

        $data_notif = array(
            'pengirim'  => $kdtransaksi,
            'penerima'  => 2,
            'header'    => "Pengajuan Pembelian",
            'pesan'     => "Pengajuan pembelian barang<br> dari ".$this->session->userdata('unit_kerja'),
            'tanggal'   => date("Y-m-d H:i:s"),
            'status'    => 6
        );
        $this->M_kepalaTU->tambah('notif_khusus', $data_notif);

        $this->session->set_userdata('pesan_beli', '<div class="alert alert-success fade in m-b-15">
            <strong>Success!</strong>
             Pengajuan Telah Dikirim!
            <span class="close" data-dismiss="alert">&times;</span>
            </div>');
        redirect($this->agent->referrer());
        // redirect('c_kepalaTU/inputbarangdibeliscs');
    }

    public function ambilBarang()
    {
    	$barang = Barang::all();
        return view('kepala.ambilBarang', compact('barang'));
    }

    public function dialogAmbilBarang($kdbarang)
    {
        $barang = Barang::where(['kdbarang' => $kdbarang])->get();
        return view('kepala.dialogAmbilBarang', compact('barang'));
    }

    public function aksiAmbilBarang()
    {
    	// 
        $data = array (
            'kdbarang' => $this->input->post('id'),
            'kode_unit' => $this->session->userdata('kode_unit'),
            'tanggal' => date('Y-m-d'),
            'status' => 6,
            'jenistransaksi' => 'Ambil',
            'tambah' => 0,
            'kurang' => $this->input->post('jumlah')
        );
        $this->M_kepalaTU->inputbarangambil($data);

        $query = $this->db->query("SELECT kdtransaksi FROM transaksi WHERE kode_unit = ".$this->session->userdata('kode_unit')." ORDER BY kdtransaksi DESC LIMIT 1")->result();

        foreach ($query as $key) {
            $kdtransaksi = $key->kdtransaksi;
        }

        $data_notif = array(
            'pengirim'  => $kdtransaksi,
            'penerima'  => 3,
            'header'    => "Pengajuan Pengambilan",
            'pesan'     => "Pengajuan pengambilan barang<br> dari ".$this->session->userdata('unit_kerja'),
            'tanggal'   => date("Y-m-d H:i:s"),
            'status'    => 6
        );
        $this->M_kepalaTU->tambah('notif_khusus', $data_notif);

        $this->session->set_userdata('pesan_ambil', '<div class="alert alert-success fade in m-b-15">
            <strong>Success!</strong>
             Pengajuan Telah Dikirim!
            <span class="close" data-dismiss="alert">&times;</span>
            </div>');
        redirect($this->agent->referrer());
    }

    public function dialogDetailBarang($kdbarang)
    {
    	$barang = Barang::where(['kdbarang' => $kdbarang])->get();
        return view('kepala.dialogDetailBarang', compact('barang'));
    }

    public function lihatLaporan()
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
        return view('kepala.lihatLaporan', compact('unitkepala', 'unit', 'unitumum', 'unit1', 'unit5', 'unit6', 'unit7', 'unit8', 'unit9', 'unit10', 'unit11', 'unit12', 'unit13', 'unit14', 'unit15', 'unit16', 'unit17', 'barang'));
    }

    public function priviewKtu($kodeUnit)
    {
        $data = Transaksi::select('*', 'transaksi.tanggal as tgl_transaksi')
            ->join('barang', 'transaksi.kdbarang', '=', 'barang.kdbarang')
            ->join('unit_kerja', 'transaksi.kode_unit', '=', 'unit_kerja.kode_unit')
            ->where('transaksi.kode_unit', $kodeUnit)
            ->where('transaksi.status', 8)->get();
        return view('kepala.priviewKtu', compact('data'));
    }
}
