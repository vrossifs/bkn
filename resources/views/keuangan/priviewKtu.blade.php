@extends('keuangan/master')
<!DOCTYPE html>
<html lang="en">
<header>
	<title>Lihat Barang</title>
</header>
@section('content')
	<!-- begin breadcrumb -->
	<ol class="breadcrumb pull-right">
		<li><a href="{{url('keuangan/index')}}">Home</a></li>
		<li><a href="{{url('keuangan/lihatLaporanTahunan')}}">Lihat Laporan Tahunan</a></li>
		<li class="active">Data Barang Pegawai</li>
	</ol>
	<!-- end breadcrumb -->
	
	@foreach($data as $row)
		<?php $unitkerja = $row->nama_unit;?>
	@endforeach	

	<h1 class="page-header m-b-10">Unit Kerja : {{$unitkerja}}</h1><hr />
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
					<h4 class="panel-title">Data Barang Pegawai</h4>
				</div>
				<div class="panel-body">
					<table id="data-table" class="table table-striped table-bordered">
						<thead>
							<tr>
								<th>No</th>
								<th>Nama Barang</th>
								<th>Tanggal</th>
								<th>Jumlah</th>
							</tr>
						</thead>
						<tbody>
							<?php $no = 1;?>
							@foreach($data as $row)
								<tr>
									<td>{{$no++}}</td>
									<td>{{$row->namabarang}}</td>
									<td>{{$row->tgl_transaksi}}</td>
									<td>{{$row->kurang}}</td>
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
