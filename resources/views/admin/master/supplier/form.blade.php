<!-- form start -->
<form action="{{ $data->exists ? route('supplier.update', $data->kode_supplier) : route('supplier.store') }}" role="form" id="form" method="{{ $data->exists ? 'PUT' : 'POST' }}">

    <div id="alert" class="alert alert-danger alert-dismissible" role="alert" style="display: none;">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-ban"></i> Alert!</h4>
    <div id="alert_msg"> Message </div>
    </div>

    <div class="form-group">
        <label for="kode">Kode Supplier</label>
        {{-- @if ( (isset$data->exists) )
            <p class="form-control">{{ $data['supplier']->kode_supplier }}</p>
        @else
            <input type="text" class="form-control" id="kode_supplier" name="kode_supplier" placeholder="Masukkan Kode supplier" maxlength="128">
        @endif --}}
        <input type="text" class="form-control" id="kode_supplier" name="kode_supplier" placeholder="Masukkan Kode supplier" maxlength="128" value="{{ $data->exists ? $data->kode_supplier : '' }}" {{ $data->exists ? 'readonly disabled' : '' }} >
    </div>

    <div class="form-group">
        <label for="nama">Nama supplier</label>
        <input type="text" class="form-control" id="nama_supplier" name="nama_supplier" placeholder="Masukkan Nama supplier" maxlength="50" value="{{ $data->exists ? $data->nama_supplier : '' }}" >
    </div>

    <div class="form-group">
        <label for="no_telp">No. Telp</label>
        <input type="text" class="form-control" id="no_telp" name="no_telp" placeholder="Masukkan No. Telp" maxlength="20" value="{{ $data->exists ? $data->no_telp : '' }}" >
    </div>

    <div class="form-group">
        <label for="alamat">Alamat</label>
        <textarea name="alamat" id="alamat" cols="" rows="" class="form-control" placeholder="Masukkan Alamat" maxlength="300">{{ $data->exists ? $data->alamat : '' }}</textarea>
    </div>

    <div class="text-center">
        <div class="form-group">
            <button id="btn_submit" type="submit" class="btn btn-primary">Submit</button>
            <button type="reset" class="btn btn-danger">Reset</button>
        </div>
    </div>

</form>
