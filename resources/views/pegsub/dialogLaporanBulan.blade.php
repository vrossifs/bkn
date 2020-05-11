<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h4 class="modal-title">Pilih Bulan</h4>
</div>
<form action="#" method="POST" class="form-horizontal" >
    <div class="modal-body">
        <div class="form-group">
        	<label class="col-md-3 control-label">Pilih Bulan</label>
        	<div class="col-md-8">
        		<select class="form-control" name="bulan" id="bulan" required>
        			<option value="" disabled selected>Pilih Bulan</option>
        			<option value="1">Januari</option>
        			<option value="2">Februari</option>
        			<option value="3">Maret</option>
        			<option value="4">April</option>
        			<option value="5">Mei</option>
        			<option value="6">Juni</option>
        			<option value="7">Juli</option>
        			<option value="8">Agustus</option>
        			<option value="9">September</option>
        			<option value="10">Oktober</option>
        			<option value="11">November</option>
        			<option value="12">Desember</option>
        		</select>
        	</div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="reset" class="btn btn-sm btn-danger">Reset</button>
        <button type="submit" class="btn btn-sm btn-success" name="submit">Submit</button>
    </div>
</form>