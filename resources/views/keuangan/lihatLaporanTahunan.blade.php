@extends('keuangan/master')
<!DOCTYPE html>
<html lang="en">
<header>
	<title>Lihat Laporan Tahunan</title>
</header>
@section('content')
	<!-- begin breadcrumb -->
	<ol class="breadcrumb pull-right">
		<li><a href="{{url('keuangan/index')}}">Home</a></li>
		<li class="active">Lihat Laporan Tahunan</li>
	</ol>
	<!-- end breadcrumb -->
	<h1 class="page-header m-b-10">Lihat Laporan Tahunan</h1><hr />
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
					<h4 class="panel-title">Lihat Data Tahunan</h4>
				</div>
				<div class="panel-body">
					<form action="#" method="POST" class="form-horizontal" >
						<div class="form-group">
							<label class="col-md-2 control-label">Pilih Tanggal awal</label>
							<div class="col-md-10">
								<input type="date" class="form-control" placeholder="Tanggal Awal" id="awal" name="awal" required />
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-2 control-label">Pilih Tanggal akhir</label>
							<div class="col-md-10">
								<input type="date" class="form-control" placeholder="Tanggal Akhir" id="akhir" name="akhir" required/>
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
								<td align="center">NO</td>
								<td align="center">Unit Kerja</td>
								<td align="center">Jumlah Barang</td>
								<td align="center">Aksi</td>
							</tr>
						</thead>
						<tbody>
							@foreach($unitkepala as $row)
								<?php if ($row->ok != NULL) {
									$kepala = $row->ok;
								}else {
									$kepala = 0;
								} ?>
							@endforeach

							@foreach($unit as $row)
								<?php if ($row->ok != NULL) {
									$keuangan = $row->ok;
								}else {
									$keuangan = 0;
								}?>
							@endforeach

							@foreach($unitumum as $row)
								<?php if ($row->ok != NULL) {
									$umum = $row->ok;
								}else {
									$umum = 0;
								}?>
							@endforeach

							@foreach($unit1 as $row)
								<?php if ($row->ok != NULL) {
									$peg4 = $row->ok;  
								}else {
									$peg4 = 0;  
								}?>
							@endforeach

							@foreach($unit5 as $row)
								<?php if ($row->ok != NULL) {
									$peg5 = $row->ok;
								}else {
									$peg5 = 0;  
								}?>
							@endforeach

							@foreach($unit6 as $row)
								<?php if ($row->ok != NULL) {
									$peg6 = $row->ok;
								}else {
									$peg6 = 0;  
								}?>
							@endforeach

							@foreach($unit7 as $row)
								<?php if ($row->ok != NULL) {
									$peg7 = $row->ok;  
								}else {
									$peg7 = 0;  
								}?>
							@endforeach

							@foreach($unit8 as $row)
								<?php if ($row->ok != NULL) {
									$peg8 = $row->ok;  
								}else {
									$peg8 = 0;  
								}?>       
							@endforeach

							@foreach($unit9 as $row)
								<?php if ($row->ok != NULL) {
									$peg9 = $row->ok;  
								}else {
									$peg9 = 0;  
								}?>
							@endforeach

							@foreach($unit10 as $row)
								<?php if ($row->ok != NULL) {
									$peg10 = $row->ok;  
								}else {
									$peg10 = 0;  
								}?>
							@endforeach

							@foreach($unit11 as $row)
								<?php if ($row->ok != NULL) {
									$peg11 = $row->ok;  
								}else {
									$peg11 = 0;  
								}?>
							@endforeach

							@foreach($unit12 as $row)
								<?php if ($row->ok != NULL) {
									$peg12 = $row->ok;  
								}else {
									$peg12 = 0;  
								}?>
							@endforeach

							@foreach($unit13 as $row)
								<?php if ($row->ok != NULL) {
									$peg13 = $row->ok;  
								}else {
									$peg13 = 0;  
								}?>
							@endforeach

							@foreach($unit14 as $row)
								<?php if ($row->ok != NULL) {
									$peg14 = $row->ok;  
								}else {
									$peg14 = 0;  
								}?>
							@endforeach

							@foreach($unit15 as $row)
								<?php if ($row->ok != NULL) {
									$peg15 = $row->ok;  
								}else {
									$peg15 = 0;  
								}?>   
							@endforeach

							@foreach($unit16 as $row)
								<?php if ($row->ok != NULL) {
									$peg16 = $row->ok;  
								}else {
									$peg16 = 0;  
								}?>  
							@endforeach

							@foreach($unit17 as $row)
								<?php if ($row->ok != NULL) {
									$peg17 = $row->ok;  
								}else {
									$peg17 = 0;  
								}?>       
							@endforeach

							<tr>
								<td align="center">{{'00001'}}</td>
								<td align="center">{{'KEPALA TATA USAHA'}}</td>
								<td align="center">{{$kepala}}</td>
								<td align="center"><a href="{{url('keuangan/priviewKtu',1)}}" class="btn btn-outline btn-circle btn-sm purple"><i class="fa fa-edit"></i> Priview </a></td>
							</tr>
							<tr>
								<td align="center">{{'00002'}}</td>
								<td align="center">{{'SUB.BAG PERENCANAAN DAN KEUANGAN'}}</td>
								<td align="center">{{$keuangan}}</td>
								<td align="center"><a href="{{url('keuangan/priviewKtu',2)}}" class="btn btn-outline btn-circle btn-sm purple"><i class="fa fa-edit"></i> Priview </a></td>
							</tr>
							<tr>
								<td align="center">{{'00003'}}</td>
								<td align="center">{{'SUB.BAG UMUM'}}</td>
								<td align="center">{{$umum}}</td>
								<td align="center"><a href="{{url('keuangan/priviewKtu',3)}}" class="btn btn-outline btn-circle btn-sm purple"><i class="fa fa-edit"></i> Priview </a></td>
							</tr>
							<tr>
								<td align="center">{{'00004'}}</td>
								<td align="center">{{'SUB.BAG KEPEGAWAIAN'}}</td>
								<td align="center">{{$peg4}}</td>
								<td align="center"><a href="{{url('keuangan/priviewKtu',4)}}" class="btn btn-outline btn-circle btn-sm purple"><i class="fa fa-edit"></i> Priview </a></button></td>
							</tr>
							<tr>
								<td align="center">{{'00005'}}</td>
								<td align="center">{{'SEKSI VERIVIKASI & PELAPORAN MUTASI & STATUS KEPEGAWAIAN'}}</td>
								<td align="center">{{$peg5}}</td>
								<td align="center"><a href="{{url('keuangan/priviewKtu',5)}}" class="btn btn-outline btn-circle btn-sm purple"><i class="fa fa-edit"></i> Priview </a></td>
							</tr>
							<tr>
								<td align="center">{{'00006'}}</td>
								<td align="center">{{'SEKSI MUTASI INSTANSI VERIVIKASI & PROVINSI'}}</td>
								<td align="center">{{$peg6}}</td>
								<td align="center"><a href="{{url('keuangan/priviewKtu',6)}}" class="btn btn-outline btn-circle btn-sm purple"><i class="fa fa-edit"></i> Priview </a></td>
							</tr>
							<tr>
								<td align="center">{{'00007'}}</td>
								<td align="center">{{'SEKSI MUTASI INSTANSI KAB/KOTA'}}</td>
								<td align="center">{{$peg7}}</td>
								<td align="center"><a href="{{url('keuangan/priviewKtu',7)}}" class="btn btn-outline btn-circle btn-sm purple"><i class="fa fa-edit"></i> Priview </a></td>
							</tr>
							<tr>
								<td align="center">{{'00008'}}</td>
								<td align="center">{{'SEKSI STATUS KEPEGAWAIAN'}}</td>
								<td align="center">{{$peg8}}</td>
								<td align="center"><a href="{{url('keuangan/priviewKtu',8)}}" class="btn btn-outline btn-circle btn-sm purple"><i class="fa fa-edit"></i> Priview </a></td>
							</tr>
							<tr>
								<td align="center">{{'00009'}}</td>
								<td align="center">{{'SEKSI VERIVIKASI & PELAPORAN PENGANGKATAN & PENSION'}}</td>
								<td align="center">{{$peg9}}</td>
								<td align="center"><a href="{{url('keuangan/priviewKtu',9)}}" class="btn btn-outline btn-circle btn-sm purple"><i class="fa fa-edit"></i> Priview </a></td>
							</tr>
							<tr>
								<td align="center">{{'00010'}}</td>
								<td align="center">{{'SEKSI PENSION PEGAWAI NEGERI SIPIL INSTANSI KAB/KOTA'}}</td>
								<td align="center">{{$peg10}}</td>
								<td align="center"><a href="{{url('keuangan/priviewKtu',10)}}" class="btn btn-outline btn-circle btn-sm purple"><i class="fa fa-edit"></i> Priview </a></td>
							</tr>
							<tr>
								<td align="center">{{'00011'}}</td>
								<td align="center">{{'SEKSI PENGANGKATAN APARATUR SIPIL NEGARA'}}</td>
								<td align="center">{{$peg11}}</td>
								<td align="center"><a href="{{url('keuangan/priviewKtu',11)}}" class="btn btn-outline btn-circle btn-sm purple"><i class="fa fa-edit"></i> Priview </a></td>
							</tr>
							<tr>
								<td align="center">{{'00012'}}</td>
								<td align="center">{{'SEKSI PENGELOLAAN ARSIP KEPEGAWAIAN INSTANSI VERTICAL & PROVINSI'}}</td>
								<td align="center">{{$peg12}}</td>
								<td align="center"><a href="{{url('keuangan/priviewKtu',12)}}" class="btn btn-outline btn-circle btn-sm purple"><i class="fa fa-edit"></i> Priview </a></td>
							</tr>
							<tr>
								<td align="center">{{'00013'}}</td>
								<td align="center">{{'SEKSI PENGELOLAAN ARSIP KEPEGAWAIAN INSTANSI KAB/KOTA'}}</td>
								<td align="center">{{$peg13}}</td>
								<td align="center"><a href="{{url('keuangan/priviewKtu',13)}}" class="btn btn-outline btn-circle btn-sm purple"><i class="fa fa-edit"></i> Priview </a></td>
							</tr>
							<tr>
								<td align="center">{{'00014'}}</td>
								<td align="center">{{'SEKSI PENGELOLAAN DATA & DISEMINASI INFORMASI KEPEGAWAIAN'}}</td>
								<td align="center">{{$peg14}}</td>
								<td align="center"><a href="{{url('keuangan/priviewKtu',14)}}" class="btn btn-outline btn-circle btn-sm purple"><i class="fa fa-edit"></i> Priview </a></td>
							</tr>
							<tr>
								<td align="center">{{'00015'}}</td>
								<td align="center">{{'SEKSI PEMANFAATAN TEKNOLOGI & INFORMASI'}}</td>
								<td align="center">{{$peg15}}</td>
								<td align="center"><a href="{{url('keuangan/priviewKtu',15)}}" class="btn btn-outline btn-circle btn-sm purple"><i class="fa fa-edit"></i> Priview </a></td>
							</tr>
							<tr>
								<td align="center">{{'00016'}}</td>
								<td align="center">{{'SEKSI FASILITAS KINERJA'}}</td>
								<td align="center">{{$peg16}}</td>
								<td align="center"><a href="{{url('keuangan/priviewKtu',16)}}" class="btn btn-outline btn-circle btn-sm purple"><i class="fa fa-edit"></i> Priview </a></td>
							</tr>
							<tr>
								<td align="center">{{'00017'}}</td>
								<td align="center">{{'SEKSI SUPERVISE KEPEGAWAIAN'}}</td>
								<td align="center">{{$peg17}}</td>
								<td align="center"><a href="{{url('keuangan/priviewKtu',17)}}" class="btn btn-outline btn-circle btn-sm purple"><i class="fa fa-edit"></i> Priview </a></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
@stop
</html>
