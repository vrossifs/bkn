@extends('keuangan/master')
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Approval Pembelian barang</title>
</head>
@section('content')
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li><a href="{{url('keuangan/index')}}">Home</a></li>
        <li class="active">Approval Pembelian barang</li>
    </ol>
    <!-- end breadcrumb -->
    <h1 class="page-header m-b-10">Approval Pembelian barang</h1><hr />
    <!-- begin row -->
    <div class="row">
        <!-- begin col-12 -->
        <a href="{{url('keuangan/riwayatApprove')}}"><button type="submit" class="btn btn-primary">Lihat Riwayat Approval</button></a><br><br>
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
                <form action="{{url('keuangan/approve')}}" method="POST">
                    @csrf
                    <table id="data-table" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 5%"><input type="checkbox" class="checkAll" name="checkAll" /></th>
                                <th>Nama Barang</th>
                                <th>Jenis Barang</th>
                                <th style="width: 17%">Jumlah Permintaan</th>
                                <th>Tanggal</th>
                                <th>Bagian</th>
                                <th style="width: 17%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($barang as $row)
                                <tr>
                                    <td><input type="checkbox" name="check|{{$row->kdtransaksi}}" value="checked" /></td>
                                    <td>{{$row->namabarang}}</td>
                                    <td>{{$row->jenis}}</td>
                                    <td>{{$row->tambah." ".$row->satuan}}</td>
                                    <td>{{date("d M Y", strtotime($row->tgl_transaksi))}}</td>
                                    <td>{{$row->nama_unit}}</td>
                                    <td><a href="{{url('keuangan/approveSingle', $row->kdtransaksi)}}" class="btn-success btn-sm"><i class="fa fa-check"></i> Terima</a> | <a href="{{url('keuangan/declineSingle', $row->kdtransaksi)}}" class="btn-danger btn-sm"><i class="fa fa-times"></i> Tolak</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <button type="submit" class="btn btn-sm btn-success" name="acc_all"><i class="fa fa-check"></i> Terima yang terceklis</button>
                    <button type="submit" class="btn btn-sm btn-warning" name="dec_all"><i class="fa fa-times"></i> Tolak yang terceklis</button>
                </form>
            </div>
        </div>
    </div>
@stop
</html>
