<div class="modal-header">
    <h4 class="modal-title">Detail Barang</h4>
</div>
<form class="form-horizontal">
	<div class="modal-body">
		<table id="data-table" class="table table-bordered">
			<tbody>
				@foreach($barang as $row)
					<tr>
						<td style="width: 40%;">Kode Barang</td>
						<td style="font-weight: bold;">{{$row->kdbarang}}</td>
					</tr>
					<tr>
						<td style="width: 40%;">Nama Barang</td>
						<td style="font-weight: bold;">{{$row->namabarang}}</td>
					</tr>
					<tr>
						<td style="width: 40%;">Jenis</td>
						<td style="font-weight: bold;">{{$row->jenis}}</td>
					</tr>
					<tr>
						<td style="width: 40%;">Jumlah Barang</td>
						<td style="font-weight: bold;">{{$row->jumlah." ".$row->satuan}}</td>
					</tr>
					<tr>
						<td style="width: 40%;">Uraian Barang</td>
						<td style="font-weight: bold;">{{$row->keterangan}}</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-sm btn-success" data-dismiss="modal" aria-hidden="true">Close</button>
	</div>
</form>