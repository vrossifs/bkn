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
		<button class="no-print" onclick="window.print()">cetak</button>
		<form action="{{url()->previous()}}" method="GET">
			@csrf
			<button align="right" class="no-print">kembali</button>
		</form>

		<h3 align="left"> UAPB     : BADAN KEPEGAWAIAN NEGARA </h3>
		<h3 align="left"> UAPPB-EI : BADAN KEPEGAWAIAN NEGARA </h3>
		<h3 align="left"> UAPPB-W  : - </h3>

		<h1 align="center"> LAPORAN RINCIAN BARANG PERSEDIAAN </h1>
		<h3 align="center"> UNTUK PERIODE YANG BERAKHIR TANGGAL {{date("d-m-Y", strtotime($akhir))}}</h3>


		<h4 align="left"> UAKPB       : KANTOR REGIONAL III BKN  </h4>
		<h4 align="left"> KODE UAKPB  : 088010200017237000KD </h4>

		<table border=1 width="1500px" style="border-collapse:collapse">
			<tr>
				<td rowspan="2" align="center">KODE</td>
				<td rowspan="2"  align="center">URAIAN</td>
				<td colspan="1"  align="center">NILAI
					<br>S/D {{date("d-m-Y", strtotime($awal))}}
				</td>
				<td colspan="3"  align="center">MUTASI</td>
				<td colspan="1"  align="center">NILAI
					<br>S/D {{date("d-m-Y", strtotime($akhir))}}
				</td>
				<td rowspan="2"  align="center">SATUAN</td>
			</tr>
			<tr>
				<td align="center">JUMLAH</td>
				<td align="center">TAMBAH</td>
				<td align="center">KURANG</td>
				<td align="center">JUMLAH</td>
				<td align="center">JUMLAH</td>
			</tr>
			<?php $no=1; ?>
				@foreach($barang as $row)
					<tr>
						<td align="center">{{'0000'.$no++}} </td>
						<td align="center">{{$row->namabarang}}</td>

						<?php
						if($row->tr_tgl >= $awal and $row->tr_tgl <= $akhir){
							$tambah = $row->jml_tambah;
							$kurang = $row->jml_kurang;
						}else{
							$tambah = 0 ;
							$kurang = 0 ;
						}
						$jumlah = $tambah - $kurang;
						$jumlahtot = $jumlah + $row->br_jml;?>

						<td align="center">{{$row->br_jml}}</td>       
						<td align="center">{{$tambah}}</td>
						<td align="center">{{$kurang}}</td>
						<td align="center">{{$jumlah}}</td>
						<td align="center">{{$jumlahtot}}</td>
						<td align="center">{{$row->satuan}}</td>
				@endforeach
					</tr>
			</tbody>
		</table>
		<br><br><br>
		<table border=1 width="800px" style="border-collapse:collapse">
			<tr>
				<td align="center">NO</td>
				<td align="center">UNIT KERJA</td>
				<td align="center">JUMLAH BARANG</td>
			</tr>
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

			</tr>
			<tr>
				<td align="center">{{'00002'}}</td>
				<td align="center">{{'SUB.BAG PERENCANAAN DAN KEUANGAN'}}</td>
				<td align="center">{{$keuangan}}</td>

			</tr>
			<tr>
				<td align="center">{{'00003'}}</td>
				<td align="center">{{'SUB.BAG UMUM'}}</td>
				<td align="center">{{$umum}}</td>
			</tr>
			<tr>
				<td align="center">{{'00004'}}</td>
				<td align="center">{{'SUB.BAG KEPEGAWAIAN'}}</td>
				<td align="center">{{$peg4}}</td>
			</tr>
			<tr>
				<td align="center">{{'00005'}}</td>
				<td align="center">{{'SEKSI VERIVIKASI & PELAPORAN MUTASI & STATUS KEPEGAWAIAN'}}</td>
				<td align="center">{{$peg5}}</td>

			</tr>
			<tr>
				<td align="center">{{'00006'}}</td>
				<td align="center">{{'SEKSI MUTASI INSTANSI VERIVIKASI & PROVINSI'}}</td>
				<td align="center">{{$peg6}}</td>

			</tr>
			<tr>
				<td align="center">{{'00007'}}</td>
				<td align="center">{{'SEKSI MUTASI INSTANSI KAB/KOTA'}}</td>
				<td align="center">{{$peg7}}</td>

			</tr>
			<tr>
				<td align="center">{{'00008' }}</td>
				<td align="center">{{ 'SEKSI STATUS KEPEGAWAIAN'}}</td>
				<td align="center">{{ $peg8 }}</td>

			</tr>
			<tr>
				<td align="center">{{'00009' }}</td>
				<td align="center">{{ 'SEKSI VERIVIKASI & PELAPORAN PENGANGKATAN & PENSION'}}</td>
				<td align="center">{{ $peg9 }}</td>

			</tr>
			<tr>
				<td align="center">{{'00010' }}</td>
				<td align="center">{{ 'SEKSI PENSION PEGAWAI NEGERI SIPIL INSTANSI KAB/KOTA'}}</td>
				<td align="center">{{ $peg10 }}</td>

			</tr>
			<tr>
				<td align="center">{{'00011' }}</td>
				<td align="center">{{ 'SEKSI PENGANGKATAN APARATUR SIPIL NEGARA'}}</td>
				<td align="center">{{ $peg11 }}</td>

			</tr>
			<tr>
				<td align="center">{{'00012' }}</td>
				<td align="center">{{ 'SEKSI PENGELOLAAN ARSIP KEPEGAWAIAN INSTANSI VERTICAL & PROVINSI'}}</td>
				<td align="center">{{ $peg12 }}</td>

			</tr>
			<tr>
				<td align="center">{{'00013' }}</td>
				<td align="center">{{ 'SEKSI PENGELOLAAN ARSIP KEPEGAWAIAN INSTANSI KAB/KOTA'}}</td>
				<td align="center">{{ $peg13 }}</td>

			</tr>
			<tr>
				<td align="center">{{'00014' }}</td>
				<td align="center">{{ 'SEKSI PENGELOLAAN DATA & DISEMINASI INFORMASI KEPEGAWAIAN'}}</td>
				<td align="center">{{ $peg14 }}</td>

			</tr>
			<tr>
				<td align="center">{{'00015' }}</td>
				<td align="center">{{ 'SEKSI PEMANFAATAN TEKNOLOGI & INFORMASI'}}</td>
				<td align="center">{{ $peg15 }}</td>

			</tr>
			<tr>
				<td align="center">{{'00016' }}</td>
				<td align="center">{{ 'SEKSI FASILITAS KINERJA'}}</td>
				<td align="center">{{ $peg16 }}</td>

			</tr>
			<tr>
				<td align="center">{{'00017' }}</td>
				<td align="center">{{ 'SEKSI SUPERVISE KEPEGAWAIAN'}}</td>
				<td align="center">{{ $peg17 }}</td>
			</tr>
		</table>
		<table width="3200px" >
			<br>
			<tr>
				<td></td>
				<td>Bandung, ......................</td>
			</tr>
			<tr>
				<td></td>
				<td><br></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td><br></td>
				<td></td>
			</tr>
			<tr>
				<td>(..........................)</td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td>(......................................)</td>
			</tr>

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