<html>
<head>
	<style>
		@media print{
			.no-print, .no-print *{
				display: none !important;
			}
		}
	</style>
</head>
<?php 
$data = "";
foreach($barang as $key){
	$data = $key->namabarang;
} ?>
<?php if($data != null){ ?>
	<body onload="window.print()">
		<button align="left" class="no-print" onclick="window.print()">Cetak</button>
		<form action="{{url()->previous()}}" method="GET">
			@csrf
			<button align="right" class="no-print">Kembali</button>
		</form>

		<h1 align="center"> KANTOR REGIONAL III </h1>
		<h3 align="center"> BADAN KEPEGAWAIAN </h3>
		<br>

		<table border=1 width="1500px" style="border-collapse:collapse">
			<tr>
				<td align="center">NO</td>
				<td align="center">NAMA BARANG</td>
				<td align="center">MASUK</td>
				<td align="center">KELUAR</td>
				<td align="center">JUMLAH</td>
			</tr>
			<?php
				$no=1;
				foreach($barang as $row){
					$month = date("M",strtotime($row->tr_tgl)); ?>
					<tr>
						<td align="center">{{'0000'.$no++}}  </td>
						<td align="center">{{$row->namabarang}}</td>
						<?php if($month=$bulan){
							$tambah = $row->jml_tambah;
							$kurang = $row->jml_kurang;
						} else{
							$tambah = 0;
							$kurang = 0;
						}

						$jumlah = $tambah - $kurang;
						$jumlahtot = $jumlah + $row->br_jml; ?>

						<td align="center">{{$tambah}}</td>
						<td align="center">{{$kurang}}</td>
						<td align="center">{{$jumlah}}</td>
						<?php
				} ?>
					</tr>
		</table>
		<br>
		<table width="3350px" >
			<td></td>
			<td>Bandung .......................</td>
			<br></br>

			<tr></tr>
			<tr>
				<td>(.........................)</td>
				<td></td>
			</tr><tr>
				<td></td>
				<td>(..............................)</td>
				<br></br>

		</table>
	</body>
<?php } else { ?>
	<body>
		<form action="{{url()->previous()}}" method="GET">
			@csrf
			<button align="right" class="no-print">kembali</button>
		</form>
		<h1 style="text-align: center;">Tidak ada data</h1>
	</body>
<?php } ?>
</html>
