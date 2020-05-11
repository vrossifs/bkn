@extends('keuangan/master')
<!DOCTYPE html>
<html lang="en">
<header>
	<title>Lihat Laporan Bulanan</title>
</header>
@section('content')
	<!-- begin breadcrumb -->
	<ol class="breadcrumb pull-right">
		<li><a href="{{url('keuangan/index')}}">Home</a></li>
		<li class="active">Lihat Laporan Bulanan</li>
	</ol>
	<!-- end breadcrumb -->
	<h1 class="page-header m-b-10">Lihat Laporan Bulanan</h1><hr />
	<!-- begin row -->
	<div class="row">
		<!-- begin col-12 -->
		<div class="col-md-12">
			<!-- begin panel -->
			<div class="panel panel-inverse">
				<div class="panel-heading">
					<div class="panel-heading-btn">
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
					</div>
					<h4 class="panel-title">Lihat Data Bulanan</h4>
				</div>
				<div class="panel-body">
					<form action="#" method="POST" class="form-horizontal" >
						<div class="form-group">
							<label class="col-md-2 control-label">Pilih Bulan</label>
							<div class="col-md-10">
								<select class="form-control" name="bulan" id="bulan">
									<option value="" disabled selected>Pilih Bulan</option>
									<option value="1">Januari</option>
									<option value="2">Februari</option>
									<option value="3">Maret</option>
									<option value="4">April</option>
									<option value="5">Mei</option>
									<option value="6">Juni</option>
									<option value="7">Juli</option>
									<option value="8">Agustus</option>
									<option value="9">September</option>
									<option value="10">Oktober</option>
									<option value="11">November</option>
									<option value="12">Desember</option>
								</select>
							</div>
						</div>
						<button class="btn btn-sm btn-success btn-sm pull-right" type="submit" id="submit">Lihat Laporan</button>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- begin row -->
	<div class="row">
		<!-- begin col-12 -->
		<div class="col-md-12">
			<!-- begin panel -->
			<div class="panel panel-inverse">
				<div class="panel-heading">
					<div class="panel-heading-btn">
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
					</div>
					<h4 class="panel-title">Data Laporan</h4>
				</div>
				<div class="panel-body">
					<table id="data-table" class="table table-striped table-bordered">
						<thead>
							<tr>
								<td>NO</td>
								<th>Nama Barang</th>
								<th>Jenis</th>
								<th>Jumlah</th>
							</tr>
						</thead>
						<tbody>
							<?php $no = 1; ?>
							@foreach($barang as $row)
								<tr>
									<td>{{$no++}}</td>
									<td>{{$row->namabarang}}</td>
									<td>{{$row->jenis}}</td>
									<td>{{$row->jumlah}}</td>
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
