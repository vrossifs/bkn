@extends('keuangan/master')
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Dashboard</title>
</head>
@section('content')
	<!-- begin breadcrumb -->
	<ol class="breadcrumb pull-right">
		<li class="active">Home</li>
	</ol>
	<!-- end breadcrumb -->
	<h1 class="page-header m-b-10">Dashboard</h1><hr />
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
		]);
		?>
	</div>
	@endif
	<!-- begin row -->
	<div class="row">
		<div class="panel panel-inverse">

		</div>
		<!-- end panel -->
	</div>
@endsection
</html>
