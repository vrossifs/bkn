@extends('keuangan/master')
<!DOCTYPE html>
<html lang="en">
<header>
	<title>Notifikasi</title>
</header>
@section('content')
	<!-- begin breadcrumb -->
	<ol class="breadcrumb pull-right">
		<li><a href="{{url('keuangan/index')}}">Home</a></li>
		<li class="active">Notifikasi</li>
	</ol>
	<!-- end breadcrumb -->
	<h1 class="page-header m-b-10">Notifikasi</h1><hr />
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
					<h4 class="panel-title">Data Notifikasi</h4>
				</div>
				<div class="panel-body">
					<form action="{{url('keuangan/readNotif')}}" method="POST">
						@csrf
						<table id="data-table" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>No </th>
									<th>Permintaan</th>
									<th>Tanggal Permintaan</th>
									<th>Nama Barang</th>
									<th>Jenis</th>
									<th>Jumlah</th>
									<th>Approval</th>
									<th>Tanggal Approval</th>
									<th>Status</th>
								</tr>
							</thead>
							<tbody>
								<?php $no=1; ?>
								@foreach($notifikasi as $row)
									<?php if ($row->notif_status == 6) {
										$status = "Belum Dibaca";
									}else {
										$status = "Telah Dibaca";
									} ?>

									<?php if ($row->tambah != 0) {
										$jumlah = $row->tambah;
									}elseif ($row->kurang != 0) {
										$jumlah = $row->kurang;
									}else{
										$jumlah = 0;
									} ?>

									<?php $kata = explode(' ', $row->pesan);?>

									<?php if(sizeof($kata)==8){
										$pesan = $kata[5]." dari ".$kata[7]." ".$row->satuan;
									}elseif (sizeof($kata)==4) {
										$pesan = "-";
									}else {
										$pesan = $kata[4]." ".$row->satuan;
									} ?>
									<tr>
										<td>{{$no++}}</td>
										<td>{{$row->jenistransaksi}}</td>
										<td>{{date('d-m-Y', strtotime($row->tgl_transaksi))}}</td>
										<td>{{$row->namabarang}}</td>
										<td>{{$row->jenis}}</td>
										<td>{{$pesan}}</td>
										<td>{{$row->header}}</td>
										<td>{{date('H:i, d-m-Y', strtotime($row->tgl_approve))}}</td>
										<td>{{$status}}</td>
									</tr>
								@endforeach
							</tbody>
						</table>
						<button type="submit" class="btn btn-sm btn-success" name="read_all"><i class="fa fa-check"></i> Tandai semua terbaca</button>
					</form>
				</div>
			</div>
		</div>
	</div>
@stop
</html>
