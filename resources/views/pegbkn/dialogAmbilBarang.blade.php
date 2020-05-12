<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h4 class="modal-title">Input Data Pengambilan Barang</h4>
</div>
<form action="{{action('PegBknController@aksiAmbilBarang')}}" method="POST" class="form-horizontal" >
    @csrf
    <div class="modal-body">
        @foreach($barang as $row)
        <input type='hidden' name='kdbarang' value="{{$row->kdbarang}}" />
        <div class="form-group">
            <label class="col-md-3 control-label">Nama Barang</label>
            <div class="col-md-8">
                <input type="text" class="form-control" name="namabarang" value="{{$row->namabarang}}" readonly />
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label">Jenis</label>
            <div class="col-md-8">
                <input type="text" class="form-control" name="jenis" value="{{$row->jenis}}"  readonly/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label">Jumlah Barang</label>
            <div class="col-md-8">
                <div class="input-group">
                    <input type="number" name="jumlah" min=1 class="form-control"  required/>
                    <span class="input-group-addon">{{$row->satuan}}</span>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="modal-footer">
        <button type="reset" class="btn btn-sm btn-danger">Reset</button>
        <button type="submit" class="btn btn-sm btn-success" name="submit">Submit</button>
    </div>
</form>