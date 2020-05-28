@extends('assets')
<!DOCTYPE html>
<html>
<header>
	@section('css')
	@stop
</header>
<body>

	@if (session('status_login') != 'login') {
		<script type="text/javascript">
			confirm('Anda harus login terlebih dahulu');
			window.location = "{{url('')}}";
		</script>
	@elseif (session('kode_role') == "1")
		<script type="text/javascript">
			window.location = "{{url('pegbkn/index')}}";
		</script>
	@elseif (session('kode_role') == "3")
		<script type="text/javascript">
			window.location = "{{url('pegsub/index')}}";
		</script>
	@elseif (session('kode_role') == "2")
		<script type="text/javascript">
			window.location = "{{url('keuangan/index')}}";
		</script>
	@endif

	<?php 

	$notifikasi = DB::table('notifikasi')
		->select('*', DB::raw('notifikasi.tanggal AS tgl_notifikasi'))
		->join('unit_kerja', 'notifikasi.pengirim', '=', 'unit_kerja.kode_unit')
		->join('transaksi', 'notifikasi.penerima', '=', 'transaksi.kdtransaksi')
		->where('transaksi.kode_unit', session('kode_unit'))
		->where('notifikasi.status', 6)
		->groupBy('kdnotifikasi')
		->orderBy('notifikasi.tanggal')
		->limit(4)->get();

	?>

	<!-- begin #header -->
	<div id="header" class="header navbar navbar-default navbar-fixed-top">
		<!-- begin container-fluid -->
		<div class="container-fluid">
			<!-- begin mobile sidebar expand / collapse button -->
			<div class="navbar-header">
				<a href="{{url('pegbkn/index')}}" class="navbar-brand"><img src="{{ asset('/img/login-bg/logo.png') }}" style="width: 50%"></a>
			</div>
			<!-- end mobile sidebar expand / collapse button -->

			<!-- begin header navigation right -->
			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
					<a href="javascript:;" data-toggle="dropdown" class="dropdown-toggle f-s-14">
						<i class="fa fa-bell-o"></i>
						<span class="label">{{sizeof($notifikasi)}}</span>
					</a>
					<ul class="dropdown-menu media-list pull-right animated fadeInDown">
						<li class="dropdown-header">Notifikasi</li>
						<?php 
						foreach ($notifikasi as $key) { ?>
							<li class="media">
								<a href="{{url('pegbkn/notifikasi',$key->kdnotifikasi)}}">
									<div class="media-body">
										<h6 class="media-heading">{{$key->header}}</h6>
										<p><?php echo $key->pesan;?></p>
										<div class="text-muted f-s-11">{{$key->nama_unit}}</div>
										<div class="text-muted f-s-11">{{date("H:i, d-m-Y", strtotime($key->tgl_notifikasi))}}</div>
									</div>
								</a>
							</li>
						<?php } ?>
						<li class="dropdown-footer text-center">
                            <a href="{{url('pegbkn/notifikasi', 'all')}}">View more</a>
                        </li>
					</ul>
				</li>
				
				<li class="dropdown navbar-user">
					<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
						<span class="hidden-xs"></span>{{Session::get('nama')}}<b class="caret"></b>
					</a>
					<ul class="dropdown-menu animated fadeInLeft">
						<li><a href="#modal-dialog-ubahpassword" data-toggle="modal">Ubah Password</a></li>
						<li class="divider"></li>
						<li><a href="{{action('LoginController@logout')}}">Log Out</a></li>
					</ul>
				</li>
			</ul>
			<!-- end header navigation right -->
		</div>
		<!-- end container-fluid -->
	</div>
	<!-- end #header -->

	<!-- begin #sidebar -->
	<div id="sidebar" class="sidebar">
		<!-- begin sidebar scrollbar -->
		<div data-scrollbar="true" data-height="100%">
			<!-- begin sidebar user -->
			<ul class="nav">
				<li class="nav-profile">
					<div class="info">
						{{Session::get('nama')}}
						<small>{{Session::get('unit_kerja')}}</small>
					</div>
				</li>
			</ul>
			<!-- end sidebar user -->
			<!-- begin sidebar nav -->
			<ul class="nav">
				<li><a href="{{url('pegbkn/index')}}"><i class="fa fa-laptop"></i> <span>Dashboard</span></a></li>
				<li><a href="{{url('pegbkn/lihatBarang')}}"><i class="fa fa-eye"></i> <span>Lihat Barang</span></a></li>
				<li><a href="{{url('pegbkn/beliBarang')}}"><i class="fa fa-pencil"></i> <span>Input Beli Barang</span></a></li>
				<li><a href="{{url('pegbkn/ambilBarang')}}"><i class="fa fa-pencil"></i> <span>Input Ambil Barang</span></a></li>
			</ul>
			<!-- end sidebar nav -->
		</div>
		<!-- end sidebar scrollbar -->
	</div>
	<div class="sidebar-bg"></div>
	<!-- end #sidebar -->

	<!-- begin #page-container -->
	<div id="page-container" class="page-container fade page-sidebar-fixed page-header-fixed">

		<!-- begin #content -->
		<div id="content" class="content">
			@yield('content')
		</div>
		<!-- begin scroll to top btn -->
		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
		<!-- end scroll to top btn -->
	</div>

	<!-- modal -->
	<div class="modal fade" id="myModal" role="dialog">
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header"></div>
				<div class="modal-body"></div>
				<div class="modal-footer"></div>
			</div>
		</div>
	</div>
	<!-- end modal -->

	<!-- #modal-dialog -->
	<div class="modal fade" id="modal-dialog-ubahpassword">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h4 class="modal-title">Ubah Password</h4>
				</div>
				<form class="form-horizontal" method="POST" action="{{action('LoginController@ubahPassword')}}">
					@csrf
					<div class="modal-body">
						<div class="form-group">
							<label class="col-md-3 control-label">Nomor Induk Penduduk (NIP)</label>
							<div class="col-md-8">
								<input type="text" class="form-control" value="{{session('nip')}}" name="nip" readonly/>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label">Password Lama</label>
							<div class="col-md-8">
								<input type="password" class="form-control" placeholder="Password Lama" name="lama" data-toggle="password" data-placement="after"/>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label">Password Baru</label>
							<div class="col-md-8">
								<input type="password" class="form-control" placeholder="Password Baru" name="baru" data-toggle="password" data-placement="after"/>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Close</a>
						<button type="submit" class="btn btn-sm btn-success" name="submit">Submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
<footer>
	@section('javascript')
	@stop
</footer>
</html>