@extends('pegsub/master')
<!DOCTYPE html>
<html lang="en">
<header>
	<title>Manajemen Admin</title>
</header>
@section('content')
	<!-- begin breadcrumb -->
	<ol class="breadcrumb pull-right">
		<li><a href="{{url('pegsub/index')}}">Home</a></li>
		<li class="active">Manajemen Admin</li>
	</ol>
	<!-- end breadcrumb -->
	<h1 class="page-header m-b-10">Manajemen Admin</h1><hr />
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
	<!-- begin row -->
	<div class="row">
		<!-- begin col-12 -->
		<div class="col-md-12">
		<a href="{{url('pegsub/tambahAkun')}}"><button type="submit" class="btn btn-primary">Tambah Akun Baru</button></a><br><br>
			<!-- begin panel -->
			<div class="panel panel-inverse">
				<div class="panel-heading">
					<div class="panel-heading-btn">
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
					</div>
					<h4 class="panel-title">Data Akun Pegawai</h4>
				</div>
				<div class="panel-body">
					<table id="data-table" class="table table-striped table-bordered">
						<thead>
							<tr>
								<th>No</th>
								<th>NIP</th>
								<th>Nama Pegawai</th>
								<th>Bagian</th>
								<th>No. Handphone</th>
								<th>Kata Sandi</th>
								<th>Status</th>
								<th style="width: 12%">Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php $no = 1;?>
							@foreach($akun as $row)
								<tr>
									<td>{{$no++}} </td>
									<td>{{$row->nip}}</td>
									<td>{{$row->namalengkap}}</td>
									<td>{{$row->nama_unit}}</td>
									<td>{{$row->nohp}}</td>
									<td>{{$row->password}}</td>
									<td>{{$row->nama_status}}</td>
									<td><a href="{{url('pegsub/editAkun', $row->nip)}}" class="btn-primary btn-sm"><i class="fa fa-edit" title="Edit"></i></a> | <a href="{{url('pegsub/hapusAkun',$row->nip)}}" onclick="return confirm('Apakah anda yakin?')" class="btn-danger btn-sm" title="Hapus"><i class="fa fa-trash-o"></i></a></td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
@stop
</html>
