@extends('assets')
<!DOCTYPE html>
<html>
<header>
	@section('css')
	@stop
</header>
<body>
	<!-- begin #header -->
	<div id="header" class="header navbar navbar-default navbar-fixed-top">
		<!-- begin container-fluid -->
		<div class="container-fluid">
			<!-- begin mobile sidebar expand / collapse button -->
			<div class="navbar-header">
				<a href="{{url('pegsub/index')}}" class="navbar-brand"><img src="{{ asset('/img/login-bg/logo.png') }}" style="width: 50%"></a>
			</div>
			<!-- end mobile sidebar expand / collapse button -->

			<!-- begin header navigation right -->
			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown navbar-user">
					<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
						<span class="hidden-xs"></span>{{Session::get('nama')}}<b class="caret"></b>
					</a>
					<ul class="dropdown-menu animated fadeInLeft">
						<li><a href="#" data-toggle="modal">Ubah Password</a></li>
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
				<li><a href="{{url('pegsub/index')}}"><i class="fa fa-laptop"></i> <span>Dashboard</span></a></li>
				<li><a href="{{url('pegsub/lihatBarang')}}"><i class="fa fa-eye"></i> <span>Lihat Barang</span></a></li>
				<li><a href="{{url('pegsub/approvalAmbil')}}"><i class="fa fa-check"></i> <span>Approval Ambil Barang</span></a></li>
				<li class="has-sub">
					<a href="javascript:;">
						<b class="caret pull-right"></b>
						<i class="fa fa-pencil"></i>
						<span>Tambah Barang</span>
					</a>
					<ul class="sub-menu">
						<li><a href="{{url('pegsub/tambahBarangBaru')}}">Tambah Barang Baru</a></li>
						<li><a href="{{url('pegsub/tambahBarangLama')}}">Tambah Barang Lama</a></li>
						<li><a href="{{url('pegsub/tambahBarangPembelian')}}">Tambah Barang Pembelian</a></li>
					</ul>
				</li>
				<li class="has-sub">
					<a href="javascript:;">
						<b class="caret pull-right"></b>
						<i class="fa fa-print"></i>
						<span>Cetak Laporan</span>
					</a>
					<ul class="sub-menu">
						<li><a href="{{url('pegsub/dialogLaporanTahun')}}" data-toggle="modal" data-target="#myModal">Laporan Tahunan</a></li>
						<li><a href="{{url('pegsub/dialogLaporanBulan')}}" data-toggle="modal" data-target="#myModal">Laporan Bulanan</a></li>
					</ul>
				</li>
				<li><a href="{{url('pegsub/manajemenAdmin')}}"><i class="fa fa-gear"></i> <span>Manajemen Admin</span></a></li>
				<li><a href="{{url('pegsub/riwayatTambahBarang')}}"><i class="fa fa-history"></i> <span>Riwayat Tambah Barang</span></a></li> 
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
</body>
<footer>
	@section('javascript')
	@stop
</footer>
</html>