@extends('pegsub/master')
<!DOCTYPE html>
<html lang="en">
<header>
	<title>Lihat Barang</title>
</header>
@section('content')
	<!-- begin breadcrumb -->
	<ol class="breadcrumb pull-right">
		<li><a href="{{url('pegsub/index')}}">Home</a></li>
		<li class="active">Lihat Barang</li>
	</ol>
	<!-- end breadcrumb -->
	<h1 class="page-header m-b-10">Lihat Barang</h1><hr />
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
								<th style="width: 5%">No</th>
								<th>Nama Barang</th>
								<th>Jenis</th>
								<th>Jumlah</th>
								<th style="width: 18%">Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php $no = 1;?>
							@foreach($barang as $row)
							<tr>
								<td>{{$no++}}</td>
								<td>{{$row->namabarang}}</td>
								<td>{{$row->jenis}}</td>
								<td>{{$row->jumlah." ".$row->satuan}}</td>
								<td align="center"><a href="{{url('pegsub/dialogBeliBarang',$row->kdbarang)}}" data-toggle="modal" data-target="#myModal" class="btn-success btn-sm" title="Beli"><i class="fa fa-money"></i></a> | <a href="{{url('pegsub/hapusBarang',$row->kdbarang)}}" onclick="return confirm('Apakah anda yakin?')" class="btn-danger btn-sm" title="Hapus"><i class="fa fa-trash-o"></i></a> | <a href="{{url('pegsub/dialogDetailBarang',$row->kdbarang)}}" data-toggle="modal" data-target="#myModal" class="btn-primary btn-sm" title="Detail"><i class="fa fa-angle-double-right"></i></a></td>
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
