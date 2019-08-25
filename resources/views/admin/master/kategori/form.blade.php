<!-- form start -->
<form action="{{ $data->exists ? route('kategori.update', $data->kode_kategori) : route('kategori.store') }}" role="form" id="form" method="{{ $data->exists ? 'PUT' : 'POST' }}">

    <div id="alert" class="alert alert-danger alert-dismissible" role="alert" style="display: none;">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-ban"></i> Alert!</h4>
    <div id="alert_msg"> Message </div>
    </div>

    <div class="form-group">
        <label for="kode">Kode Kategori</label>
        {{-- @if ( (isset$data->exists) )
            <p class="form-control">{{ $data['kategori']->kode_kategori }}</p>
        @else
            <input type="text" class="form-control" id="kode_kategori" name="kode_kategori" placeholder="Masukkan Kode Kategori" maxlength="128">
        @endif --}}
        <input type="text" class="form-control" id="kode_kategori" name="kode_kategori" placeholder="Masukkan Kode Kategori" maxlength="128" value="{{ $data->exists ? $data->kode_kategori : '' }}" {{ $data->exists ? 'readonly disabled' : '' }} >
    </div>

    <div class="form-group">
        <label for="nama">Nama Kategori</label>
        <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" placeholder="Masukkan Nama Kategori" maxlength="50" value="{{ $data->exists ? $data->nama_kategori : '' }}" >
    </div>

    <div class="text-center">
        <div class="form-group">
            <button id="btn_submit" type="submit" class="btn btn-primary">Submit</button>
            <button type="reset" class="btn btn-danger">Reset</button>
        </div>
    </div>

</form>
