@extends('pegsub/master')
<!DOCTYPE html>
<html lang="en">
<header>
	<title>Tambah Barang Baru</title>
</header>
@section('content')
	<!-- begin breadcrumb -->
	<ol class="breadcrumb pull-right">
		<li><a href="{{url('pegsub/index')}}">Home</a></li>
		<li class="active">Tambah Barang Baru</li>
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
					<h4 class="panel-title">Input Data Barang</h4>
				</div>
				<div class="panel-body">
					<form class="form-horizontal" method="POST" action="{{url('pegsub/aksiTambahBarangBaru')}}">
						@csrf
						<div class=" col-md-6">
							<div class="form-group">
								<label class="col-md-3 control-label">Nama Barang</label>
								<div class="col-md-9">
									<input name="nama_barang" type="text" class="form-control" placeholder="Nama Barang" required/>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Jenis Barang</label>
								<div class="col-md-9">
									<select name="jenis_barang" class="form-control" required>
										<option value="" disabled selected>Jenis Barang</option>
										<option value="Alat Tulis">Alat Tulis</option>
										<option value="Tinta tulis, tinta stemple">Tinta tulis, tinta stemple</option>
										<option value="Penjepit Kertas">Penjepit Kertas</option>
										<option value="Penghapus / Korektor">Penghapus / Korektor</option>
										<option value="Penggaris">Penggaris</option>
										<option value="Cutter">Cutter</option>
										<option value="Pita, Mesin Ketik">Pita, Mesin Ketik</option>
										<option value="Ordner dan ma">Ordner dan map</option>
										<option value="Seminar kit">Seminar kit</option>
										<option value="Alat perekat">Alat perekat</option>
										<option value="Kertas cover">Kertas cover</option>
										<option value="Amplop">Amplop</option>
										<option value="Berbagai kertas dan cover">Berbagai kertas dan cover</option>
										<option value="Tinta cetak">Tinta cetak</option>
										<option value="Bahan cetak">Bahan cetak</option>
										<option value="Continuous form">Continuous form</option>
										<option value="Computer file/tempat disket">Computer file/tempat disket</option>
										<option value="Pita printer">Pita printer</option>
										<option value="Tinta/toner printer">Tinta/toner printer</option>
										<option value="Lainnya">Lainnya</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Tanggal</label>
								<div class="col-md-9">
									<input name="tanggal" type="date" class="form-control" max="{{date('Y-m-d')}}" placeholder="Tanggal" required/>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="col-md-3 control-label">Jumlah</label>
								<div class="col-md-6">
									<input name="jumlah" type="number" class="form-control" placeholder="Jumlah" min="0" required/>
								</div>
								<div class="col-md-3">
									<select name="satuan" class="form-control" required>
										<option value="" disabled selected>Satuan</option>
										<option value="Rim">Rim</option>
										<option value="Rool">Rool</option>
										<option value="Buah">Buah</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Uraian Barang</label>
								<div class="col-md-9">
									<textarea name="keterangan" class="form-control" placeholder="Merek, Ukuran, dll." rows="5" required></textarea>
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
