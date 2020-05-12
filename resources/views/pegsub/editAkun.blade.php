@extends('pegsub/master')
<!DOCTYPE html>
<html lang="en">
<header>
    <title>Edit Data Akun</title>
</header>
@section('content')
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li><a href="{{url('pegsub/index')}}">Home</a></li>
        <li><a href="{{url('pegsub/manajemenAdmin')}}">Manajemen Admin</a></li>
        <li class="active">Edit Data Akun</li>
    </ol>
    <!-- end breadcrumb -->
    <h1 class="page-header m-b-10">Edit Data Akun</h1><hr />
    <!-- begin row -->
    <div class="row">
        <!-- begin col-12 -->
        <div class="col-md-12">
            <!-- begin panel -->
            <div class="panel panel-inverse" data-sortable-id="form-stuff-1">
                <div class="panel-heading">
                    <h4 class="panel-title">Edit Data Akun</h4>
                </div>
                <div class="panel-body">
                    @foreach($tampil as $key)
                    <form action="{{action('PegSubController@aksiEditAkun', $key->nip)}}" method="GET" class="form-horizontal" data-parsley-validate="true">
                        @csrf
                        <div class=" col-md-6">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Nomor Induk Pegawai (NIP)</label>
                                <div class="col-md-9">
                                    <input name="nip" type="text" class="form-control" placeholder="Nomor Induk Pegawai (NIP)" value="{{$key->nip}}" required />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Nama Pegawai</label>
                                <div class="col-md-9">
                                    <input name="nama" type="text" class="form-control" placeholder="Nama Pegawai" value="{{$key->namalengkap}}" required/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Unit Kerja</label>
                                <div class="col-md-9">
                                    <select name="unit_kerja" class="form-control" required>
                                        <option value="{{$key->kode_unit}}" hidden>{{$key->nama_unit}}</option>
                                        <?php foreach ($unit as $unit) { ?>
                                            <option value="{{$unit->kode_unit}}">{{$unit->nama_unit}}</option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Jenis Kelamin</label>
                                <div class="col-md-9">
                                    <select name="jenis_kelamin" class="form-control" required>
                                        <option value="{{$key->jeniskelamin}}" hidden>{{$key->jeniskelamin}}</option>
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Status Pernikahan</label>
                                <div class="col-md-9">
                                    <select name="status_nikah" class="form-control" required>
                                        <option value="{{$key->statusnikah}}" hidden>{{$key->nama_status_nikah}}</option>
                                        <option value="3">Menikah</option>
                                        <option value="4">Belum Menikah</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Email</label>
                                <div class="col-md-9">
                                    <input class="form-control" type="text" id="email" name="email" data-parsley-type="email" placeholder="Email" value="{{$key->email}}" data-parsley-required="true" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Nomor Handphone</label>
                                <div class="col-md-9">
                                    <input name="nohp" type="text" class="form-control" placeholder="Nomor Handphone" value="{{$key->nohp}}" required/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Alamat</label>
                                <div class="col-md-9">
                                    <textarea name="alamat" class="form-control" placeholder="Alamat" rows="5" required>{{$key->alamat}}</textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Kata Sandi (Password)</label>
                                <div class="col-md-9">
                                    <input name="password" type="text" class="form-control" placeholder="Kata Sandi (Password)" value="{{$key->password}}" required/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Status Akun</label>
                                <div class="col-md-9">
                                    <span class="text-muted m-l-5">Non-aktif </span>
                                    <?php 
                                    if ($key->status == 1) { ?>
                                        <input name="status_akun" type="checkbox" data-render="switchery" data-theme="blue" data-change="check-switchery-state-text" checked/>
                                    <?php }else { ?>
                                        <input name="status_akun" type="checkbox" data-render="switchery" data-theme="blue" data-change="check-switchery-state-text"/>
                                    <?php   } ?>
                                    <span class="text-muted m-l-5">Aktif</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label"></label>
                                <div class="col-md-9">
                                    <button type="reset" class="btn btn-sm btn-danger" style="width: 100px">Reset</button>
                                    <button type="submit" class="btn btn-sm btn-success" style="width: 100px">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    @endforeach
                </div>
            <!-- end panel -->
        </div>
    </div>
@stop
</html>