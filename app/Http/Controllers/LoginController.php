<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Akun;
use DB;
use Mail;

class LoginController extends Controller
{
    public $email_akun;

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
            'username'  =>  'required',
            'password'  =>  'required'
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
                session([
                    'alert_type'    => 'alert-warning',
                    'alert_header'  => 'Warning!',
                    'alert_message' => 'Status akun anda Non-Aktif, hubungi admin'
                ]);

                return redirect()->action('LoginController@index');
            }elseif ($kode_role != $kdrole) {
                session([
                    'alert_type'    => 'alert-warning',
                    'alert_header'  => 'Warning!',
                    'alert_message' => 'Akun anda tidak memiliki akses sebagai '.$nmrole
                ]);

                return redirect()->action('LoginController@index');
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
            session([
                'alert_type'    => 'alert-danger',
                'alert_header'  => 'Error!',
                'alert_message' => 'Nama Pengguna atau Kata Sandi salah.'
            ]);

            return redirect()->action('LoginController@index');
        }
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

    public function ubahPassword(Request $request)
    {
        if ($request->lama != session('password')) {
            echo "<script type='text/javascript'>window.alert('Kata Sandi Lama tidak sesuai');history.back(self);</script>";
        }else{
            DB::table('akun')->where('nip', session('nip'))->update(['password' => $request->baru]);
            session(['password' => $request->baru]);
            echo "<script type='text/javascript'>window.alert('Kata Sandi Berhasil Diubah');history.back(self);</script>";
        }
    }

    public function resetPassword(Request $request){
        $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
        $charactersLength = strlen($characters);
        $pass = '';
        for ($i = 0; $i < 8; $i++) {
            $pass .= $characters[rand(0, $charactersLength - 1)];
        }
        
        $query = DB::table('pegawai')->where('nip', $request->nip)->get();
        foreach ($query as $key) {
            $email_akun = $key->email;
        }

        if ($request->email == $email_akun) {
            $data = array(
                'pass'  =>  $pass
            );

            session([
                'nip'           => $request->nip,
                'email'         => $request->email,
                'pass'          => $pass,
                'alert_type'    => 'alert-info',
                'alert_header'  => 'Info!',
                'alert_message' => 'Petunjuk Login telah dikirim ke Email '.$request->email
            ]);

            return redirect('sendMail');
        }else {
            session([
                'alert_type'    => 'alert-danger',
                'alert_header'  => 'Error!',
                'alert_message' => 'Maaf, email yang anda masukkan berbeda dengan email yang terdaftar'
            ]);
            return redirect()->action('LoginController@index');
        }
    }
}
