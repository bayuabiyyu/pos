<!-- form start -->
<form action="{{ $data->exists ? route('satuan.update', $data->kode_satuan) : route('satuan.store') }}" role="form" id="form" method="{{ $data->exists ? 'PUT' : 'POST' }}">

    <div id="alert" class="alert alert-danger alert-dismissible" role="alert" style="display: none;">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-ban"></i> Alert!</h4>
    <div id="alert_msg"> Message </div>
    </div>

    <div class="form-group">
        <label for="kode">Kode Satuan</label>
        {{-- @if ( (isset$data->exists) )
            <p class="form-control">{{ $data['satuan']->kode_satuan }}</p>
        @else
            <input type="text" class="form-control" id="kode_satuan" name="kode_satuan" placeholder="Masukkan Kode satuan" maxlength="128">
        @endif --}}
        <input type="text" class="form-control" id="kode_satuan" name="kode_satuan" placeholder="Masukkan Kode Satuan" maxlength="5" value="{{ $data->exists ? $data->kode_satuan : '' }}" {{ $data->exists ? 'readonly disabled' : '' }} >
    </div>

    <div class="form-group">
        <label for="nama">Nama Satuan</label>
        <input type="text" class="form-control" id="nama_satuan" name="nama_satuan" placeholder="Masukkan Nama Satuan" maxlength="10" value="{{ $data->exists ? $data->nama_satuan : '' }}" >
    </div>

    <div class="text-center">
        <div class="form-group">
            <button id="btn_submit" type="submit" class="btn btn-primary">Submit</button>
            <button type="reset" class="btn btn-danger">Reset</button>
        </div>
    </div>

</form>
