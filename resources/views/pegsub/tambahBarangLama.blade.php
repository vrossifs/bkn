@extends('pegsub/master')
<!DOCTYPE html>
<html lang="en">
<header>
	<title>Tambah Barang Lama</title>
</header>
@section('content')
	<!-- begin breadcrumb -->
	<ol class="breadcrumb pull-right">
		<li><a href="{{url('pegsub/index')}}">Home</a></li>
		<li class="active">Tambah Barang Lama</li>
	</ol>
	<!-- end breadcrumb -->
	<h1 class="page-header m-b-10">Tambah Barang Lama</h1><hr />
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
					<h4 class="panel-title">Tambah Barang Lama</h4>
				</div>
				<div class="panel-body">
					<form action="#" method="post">
						<table id="data-table" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th style="width: 5%"><input type="checkbox" class="checkAll" name="checkAll" /></th>
									<th>Kode Barang</th>
									<th>Nama Barang</th>
									<th>Jenis Barang</th>
									<th>Jumlah Penambahan</th>
									<th>Aksi</th>
								</tr>	
							</thead>
							<tbody>
								@foreach($barang as $row)
									<tr>
										<td><input type="checkbox" name="check|{{$row->kdtransaksi}}" value="checked"/></td>
										<td>{{$row->kdbarang}}</td>
										<td>{{$row->namabarang}}</td>
										<td>{{$row->jenis}}</td>
										<td>{{$row->tambah." ".$row->satuan}}</td>
										<td><a href="#" class="btn-success btn-sm" title="Tambah"><i class="fa fa-upload"></i></a></td>
									</tr>
								@endforeach
							</tbody>
						</table>
						<?php if ($barang != NULL): ?>
							<button type="submit" class="btn btn-sm btn-success" name="acc_all"><i class="fa fa-check"></i> Submit yang terceklis</button>
						<?php endif ?>
					</form>
				</div>
			</div>
		</div>
	</div>
@stop
</html>
