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

<body>
	<button align="left" class="no-print" onclick="window.print()">cetak</button>
	<form action="<?php echo base_url('index.php/c_keuanganTU/lihatlaporanbulan ');?>" method="post">
		<button align="right" class="no-print">kembali</button>
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
		if($barang != null){
			$no=1;
			foreach($barang as $row){
				$month = date("M",strtotime($row->tr_tgl)); ?>
				<tr>
					<td align="center"><?php echo '0000'.$no ?> </td>
					<td align="center"><?php echo $row->namabarang; ?></td>
					<?php
					if($month=$bulan){
						$tambah = $row->jml_tambah;
						$kurang = $row->jml_kurang;
					} else{
						$tambah = 0;
						$kurang = 0;
					}
					$jumlah = $tambah - $kurang;
					$jumlahtot = $jumlah + $row->br_jml; ?>

					<td align="center"><?php echo $tambah; ?></td>
					<td align="center"><?php echo $kurang; ?></td>
					<td align="center"><?php echo $jumlah; ?></td>
					<?php $no++;
			}
		} else { ?>
			<script type='text/javascript'>
				window.alert("Tidak ada data");
				history.back(self);
			</script>

		<?php } ?>

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


	</html>
