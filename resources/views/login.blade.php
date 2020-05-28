@extends('assets')
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Welcome Page</title>
    @section('headAssets')
    @endsection
    <style>
        img { width: 100%; }
    </style>
</head>
<body>
    @if(Session::get('alert_type') != '')
    <div class="alert {{Session::get('alert_type')}} fade in m-b-15">
        <strong>{{Session::get('alert_header')}}</strong>
        {{Session::get('alert_message')}}
        <span class="close" data-dismiss="alert">&times;</span>
        <?php 
        session([
            'alert_type'    => '',
            'alert_header'  => '',
            'alert_message' => ''
        ]); ?>
    </div>
    @endif
    <!-- begin #page-loader -->
    <div id="page-loader" class="fade in"><span class="spinner"></span></div>
    <!-- end #page-loader -->

    <!-- begin #page-container -->
    <div id="page-container" class="fade">
        <!-- begin login -->
        <div class="login login-with-news-feed">
            <!-- begin news-feed -->
            <div class="news-feed">
                <div class="news-image">
                    <img src="{{ asset('/img/login-bg/logo.png') }}" data-id="login-cover-image" alt=""/>
                </div>
            </div>
            <!-- end news-feed -->
            <!-- begin right-content -->
            <div class="right-content">
                <br><br><br><br>
                <!-- begin login-header -->
                <div class="login-header">
                    <div class="brand">
                        <span class="logo"></span>Login
                        <small>Masukkan Nomor Induk Pegawai & Kata Sandi</small>
                    </div>
                    <div class="icon">
                        <i class="fa fa-sign-in"></i>
                    </div>
                </div>
                <!-- end login-header -->

                <!-- begin login-content -->
                <div class="login-content">
                    <form method="post" action="{{action('LoginController@loginAction')}}" class="margin-bottom-0">
                        {{csrf_field()}}
                        <div class="form-group m-b-15">
                            <input type="text" name="username" class="form-control input-lg" placeholder="NIP" required />
                        </div>
                        <div class="form-group m-b-15">
                            <input type="password" name="password" class="form-control input-lg" placeholder="Kata Sandi" data-toggle="password" data-placement="after" required />
                        </div>
                        <div class="form-group m-b-15">
                            <select name="role" class="form-control input-lg" required>
                                <option value="" disabled selected>LOGIN SEBAGAI</option>
                                <option value="1|KEPALA TATA USAHA">KEPALA TATA USAHA</option>
                                <option value="2|SUB.BAG PERENCANAAN DAN KEUANGAN">SUB.BAG PERENCANAAN DAN KEUANGAN</option>
                                <option value="3|SUB.BAG UMUM">SUB.BAG UMUM</option>
                                <option value="4|PEGAWAI BKN">PEGAWAI BKN</option>
                            </select>
                        </div>
                        <div class="login-buttons">
                            <button type="submit" class="btn btn-success btn-block btn-lg" name="submit">Masuk</button>
                        </div>
                        <div class="m-t-20 m-b-40 p-b-40 text-inverse">
                            Lupa password? Klik <a href="#" data-toggle="modal">di sini</a> untuk petunjuk.
                        </div>
                    </form>
                </div>
                <!-- end login-content -->
            </div>
            <!-- end right-container -->
        </div>
        <!-- end login -->
    </div>
    <!-- #modal-dialog -->
    <div class="modal fade" id="modal-dialog-lupapassword">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Lupa Password</h4>
                </div>
                <form class="form-horizontal" method="POST" action="{{action('LoginController@resetPassword')}}" data-parsley-validate="true">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="col-md-2 control-label">NIP</label>
                            <div class="col-md-9">
                                <input class="form-control" type="text" name="nip" placeholder="Nomor Induk Pegawai (NIP)" required />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Email</label>
                            <div class="col-md-9">
                                <input class="form-control" type="text" id="email" name="email" data-parsley-type="email" placeholder="Email yang terdaftar pada akun anda" data-parsley-required="true" />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-sm btn-danger">Reset</button>
                        <button type="submit" class="btn btn-sm btn-success" name="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @section('bodyAssets')
    @endsection
    <script src="{{ asset('/js/login-v2.demo.min.js') }}"></script>
    <script src="{{ asset('/js/apps.min.js') }}"></script>
</body>
</html>