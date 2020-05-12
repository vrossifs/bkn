<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h4 class="modal-title">Pilih Periode Tahun</h4>
</div>
<form action="{{url('laporan/printLaporanTahun')}}" method="POST" class="form-horizontal" >
    @csrf
    <div class="modal-body">
        <div class="form-group">
        	<label class="col-md-3 control-label">Tanggal awal</label>
        	<div class="col-md-8">
        		<input type="date" class="form-control" placeholder="Tanggal Awal" id="awal" name="awal" required />
        	</div>
        </div>
        <div class="form-group">
        	<label class="col-md-3 control-label">Tanggal akhir</label>
        	<div class="col-md-8">
        		<input type="date" class="form-control" placeholder="Tanggal Akhir" id="akhir" name="akhir" required/>
        	</div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="reset" class="btn btn-sm btn-danger">Reset</button>
        <button type="submit" class="btn btn-sm btn-success" name="submit">Submit</button>
    </div>
</form>