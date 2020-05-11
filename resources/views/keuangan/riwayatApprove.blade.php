@extends('keuangan/master')
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Riwayat Pembelian Barang</title>
</head>
@section('content')
	<!-- begin breadcrumb -->
	<ol class="breadcrumb pull-right">
		<li><a href="{{url('keuangan/index')}}">Home</a></li>
		<li><a href="{{url('keuangan/approvalBarang')}}">Approval Beli Barang</a></li>
		<li class="active">Riwayat Pembelian Barang</li>
	</ol>
	<!-- end breadcrumb -->
	<h1 class="page-header m-b-10">Riwayat Pembelian Barang</h1><hr />
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
					<h4 class="panel-title">Data Barang</h4>
				</div>
				<div class="panel-body">
					<table id="data-table" class="table table-striped table-bordered">
						<thead>
							<tr>
								<th>No </th>
								<th>Nama Barang</th>
								<th>Jenis</th>
								<th>Jumlah</th>
								<th>Pegawai</th>
								<th>Tanggal</th>
								<th>Approval</th>
							</tr>
						</thead>
						<tbody>
							<?php $no = 1; ?>
							@foreach($barang as $row)
								<tr>
									<td>{{$no++}}</td>
									<td>{{$row->namabarang}}</td>
									<td>{{$row->jenis}}</td>
									<td>{{$row->tambah." ".$row->satuan}}</td>
									<td>{{$row->nama_unit}}</td>
									<td>{{date("d-m-Y", strtotime($row->tgl_approve))}}</td>
									<td>{{$row->nama_status}}</td>
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
