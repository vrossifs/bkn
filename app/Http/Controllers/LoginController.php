<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Akun;
use DB;

class LoginController extends Controller
{
    //
    public function index()
    {
        //
        if (session('status_login') != 'login') {
            return view('login');
        }elseif (session('kode_role') == "1") {
            return redirect()->action('KepalaTUController@index');
        }elseif (session('kode_role') == "2") {
            return redirect()->action('KeuanganTUController@index');
        }elseif (session('kode_role') == "3") {
            return redirect()->action('PegSubController@index');
        }elseif (session('kode_role') == "4") {
            return redirect()->action('PegBknController@index');
        }
    }

    public function loginAction(Request $request)
    {
    	//
        $this->validate($request, [
            'username'	=>	'required',
            'password'	=>	'required'
        ]);

        $checkLogin = DB::table('pegawai')
            ->join('akun', 'pegawai.nip', '=', 'akun.nip')
            ->join('status', 'akun.status', '=', 'status.kode_status')
            ->join('unit_kerja', 'pegawai.kode_unit', '=', 'unit_kerja.kode_unit')
            ->join('role', 'unit_kerja.kode_role', '=', 'role.kode_role')
            ->where([
            	'akun.nip' =>  $request->get('username'),
                'password' =>  $request->get('password')
            ])->get();

        if(count($checkLogin) > 0){
            $data       = explode("|", $request->get('role'));
            $kdrole     = $data[0];
            $nmrole     = $data[1];

            foreach ($checkLogin as $datalogin) {
                $nip            = $datalogin->nip;
                $nama           = $datalogin->namalengkap;
                $jeniskelamin   = $datalogin->jeniskelamin;
                $alamat         = $datalogin->alamat;
                $nohp           = $datalogin->nohp;
                $username       = $datalogin->nip;
                $password       = $datalogin->password;
                $kode_unit      = $datalogin->kode_unit;
                $unit_kerja     = $datalogin->nama_unit;
                $kode_role      = $datalogin->kode_role;
                $nama_role      = $datalogin->nama_role;
                $status_akun    = $datalogin->nama_status;
            }

            if ($status_akun != "Aktif") {
                echo "Login Berhasil, tetapi Status akun anda Non-Aktif, hubungi admin";
            }elseif ($kode_role != $kdrole) {
                echo "Login Berhasil, tetapi Akun anda tidak memiliki akses sebagai $nmrole";
            }else {
                // data user
                session([
                    'nip'           => $nip,
                    'nama'          => $nama,
                    'jeniskelamin'  => $jeniskelamin,
                    'alamat'        => $alamat,
                    'nohp'          => $nohp,
                    'username'      => $username,
                    'password'      => $password,
                    'kode_unit'     => $kode_unit,
                    'unit_kerja'    => $unit_kerja,
                    'kode_role'     => $kode_role,
                    'nama_role'     => $nama_role,
                    'status_akun'   => $status_akun,
                    'status_login'  => 'login'
                ]);

                // data alert
                session([
                    'alert_type'    => 'alert-success',
                    'alert_header'  => 'Login Berhasil!',
                    'alert_message' => 'Selamat datang '.$nama
                ]);
                
                if (session('kode_role') == "1") {
                    return redirect()->action('KepalaTUController@index');
                }elseif (session('kode_role') == "2") {
                    return redirect()->action('KeuanganTUController@index');
                }elseif (session('kode_role') == "3") {
                    return redirect()->action('PegSubController@index');
                }elseif (session('kode_role') == "4") {
                    return redirect()->action('PegBknController@index');
                }else {
                    return view('login');
                }
            }
        }else {
        	echo "Login Gagal, Data tidak diketahui";
        }


        // $username   = $this->input->post('username');
        // $password   = $this->input->post('password');
        // $data = explode("|", $this->input->post('role'));
        // $kdrole     = $data[0];
        // $nmrole     = $data[1];

        // $cek = $this->m_login->cek_login($username, $password)->num_rows();
        // if ($cek>0) {
        //     $query = $this->m_login->cek_login($username, $password)->result();
        //     foreach ($query as $datalogin) {
        //         $nip            = $datalogin->nip;
        //         $nama           = $datalogin->namalengkap;
        //         $jeniskelamin   = $datalogin->jeniskelamin;
        //         $statusnikah    = $datalogin->nama_status_nikah;
        //         $alamat         = $datalogin->alamat;
        //         $nohp           = $datalogin->nohp;
        //         $username       = $datalogin->nip;
        //         $password       = $datalogin->password;
        //         $kode_unit      = $datalogin->kode_unit;
        //         $unit_kerja     = $datalogin->nama_unit;
        //         $kode_role      = $datalogin->kode_role;
        //         $nama_role      = $datalogin->nama_role;
        //         $status_akun    = $datalogin->nama_status;
        //     }

        //     if ($status_akun != "Aktif") {
        //         $this->session->set_userdata('pesan_login', '<div class="alert alert-warning fade in m-b-15">
        //                         <strong>Warning!</strong>
        //                         Status akun anda Non-Aktif, hubungi admin
        //                         <span class="close" data-dismiss="alert">&times;</span>
        //                     </div>');
        //         redirect($this->agent->referrer());
        //     }elseif ($kode_role != $kdrole) {
        //         $this->session->set_userdata('pesan_login', '<div class="alert alert-warning fade in m-b-15">
        //                         <strong>Warning!</strong>
        //                         Akun anda tidak memiliki akses sebagai '.$nmrole.'
        //                         <span class="close" data-dismiss="alert">&times;</span>
        //                     </div>');
        //         redirect($this->agent->referrer());
        //     }else {
        //         $data_session = array(
        //             'nip'           => $nip,
        //             'nama'          => $nama,
        //             'jeniskelamin'  => $jeniskelamin,
        //             'statusnikah'   => $statusnikah,
        //             'alamat'        => $alamat,
        //             'nohp'          => $nohp,
        //             'username'      => $username,
        //             'password'      => $password,
        //             'kode_unit'     => $kode_unit,
        //             'unit_kerja'    => $unit_kerja,
        //             'kode_role'     => $kode_role,
        //             'nama_role'     => $nama_role,
        //             'status_akun'   => $status_akun,
        //             'status_login'  => 'login'
        //         );

        //         $this->session->set_userdata($data_session);

        //         if ($this->session->userdata('kode_role')== "1"){
        //             redirect('c_kepalaTU/index');
        //         }elseif($this->session->userdata('kode_role')== "2") {
        //             redirect('c_keuanganTU/index');
        //         }elseif($this->session->userdata('kode_role')== "3"){
        //             redirect('c_pegsub/index');
        //         }elseif($this->session->userdata('kode_role')== "4"){
        //             redirect('c_pegbkn/index');
        //         }else{
        //             redirect('welcome/index');
        //         }
        //     }
        // }else {
        //     $this->session->set_userdata('pesan_login','<div class="alert alert-danger fade in m-b-15">
        //         <strong>Error!</strong>
        //         Nama Pengguna atau Kata Sandi salah.
        //         <span class="close" data-dismiss="alert">&times;</span>
        //     </div>');
        //     redirect($this->agent->referrer());
        // }
    }

    public function logout()
    {
    	session([
            'username'  =>  "",
            'password'  =>  "",
            'status_login'    =>  "",
        ]);
    	return redirect()->action('LoginController@index');
    }


}
