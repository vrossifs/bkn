@extends('pegsub/master')
<!DOCTYPE html>
<html lang="en">
<header>
	<title>Tambah Akun Baru</title>
</header>
@section('content')
	<!-- begin breadcrumb -->
	<ol class="breadcrumb pull-right">
		<li><a href="{{url('pegsub/index')}}">Home</a></li>
		<li><a href="{{url('pegsub/manajemenAdmin')}}">Manajemen Admin</a></li>
		<li class="active">Tambah Akun Baru</li>
	</ol>
	<!-- end breadcrumb -->
	<h1 class="page-header m-b-10">Tambah Barang Baru</h1><hr />
	<!-- begin row -->
	<div class="row">
		<!-- begin col-12 -->
		<div class="col-md-12">
			<!-- begin panel -->
			<div class="panel panel-inverse" data-sortable-id="form-stuff-1">
				<div class="panel-heading">
					<h4 class="panel-title">Input Data Akun</h4>
				</div>
				<div class="panel-body">
					<form class="form-horizontal" method="POST" action="#" data-parsley-validate="true">
						<div class=" col-md-6">
							<div class="form-group">
								<label class="col-md-3 control-label">Nomor Induk Pegawai (NIP)</label>
								<div class="col-md-9">
									<input name="nip" type="text" class="form-control" placeholder="Nomor Induk Pegawai (NIP)" required />
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Nama Pegawai</label>
								<div class="col-md-9">
									<input name="nama" type="text" class="form-control" placeholder="Nama Pegawai" required/>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Unit Kerja</label>
								<div class="col-md-9">
									<select name="unit_kerja" class="form-control" required>
										<option value="" disabled selected>Unit Kerja</option>
										@foreach($unit as $key)
											<option value="{{$key->kode_unit}}">{{$key->nama_unit}}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Jenis Kelamin</label>
								<div class="col-md-9">
									<select name="jenis_kelamin" class="form-control" required>
										<option value="" disabled selected>Jenis Kelamin</option>
										<option value="Laki-laki">Laki-laki</option>
										<option value="Perempuan">Perempuan</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Status Pernikahan</label>
								<div class="col-md-9">
									<select name="status_nikah" class="form-control" required>
										<option value="" disabled selected>Status Pernikahan</option>
										<option value="3">Menikah</option>
										<option value="4">Belum Menikah</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Email</label>
								<div class="col-md-9">
									<input class="form-control" type="text" id="email" name="email" data-parsley-type="email" placeholder="Email" data-parsley-required="true" />
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="col-md-3 control-label">Nomor Handphone</label>
								<div class="col-md-9">
									<input name="nohp" type="text" class="form-control" placeholder="Nomor Handphone" required/>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Alamat</label>
								<div class="col-md-9">
									<textarea name="alamat" class="form-control" placeholder="Alamat" rows="5" required></textarea>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Kata Sandi (Password)</label>
								<div class="col-md-9">
									<input name="password" type="text" class="form-control" placeholder="Kata Sandi (Password)" required/>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Status Akun</label>
								<div class="col-md-9">
									<span class="text-muted m-l-5">Non-aktif </span>
									<input name="status_akun" type="checkbox" data-render="switchery" data-theme="blue" data-change="check-switchery-state-text"/>
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
				</div>
			</div>
			<!-- end panel -->
		</div>
	</div>
@stop
</html>
