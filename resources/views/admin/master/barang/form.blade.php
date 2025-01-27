<!-- form start -->
<form action="{{ $data['barang']->exists ? route('barang.update', $data['barang']->kode_barang) : route('barang.store') }}" role="form" id="form" name="form" method="{{ $data['barang']->exists ? 'POST' : 'POST' }}" enctype="multipart/form-data">

    @if ($data['barang']->exists)
    {{-- Perlakuannya beda ketika menggunakan form data... request POST tapi ditambah _method="PUT" --}}
        @method('PUT')
    @endif

    <div id="alert" class="alert alert-danger alert-dismissible" role="alert" style="display: none;">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-ban"></i> Alert!</h4>
    <div id="alert_msg"> Message </div>
    </div>

    <div class="form-group">
        <label for="kode">Kode Barang</label>
        {{-- @if ( (isset$data['barang']->exists) )
            <p class="form-control">{{ $data['barang']['barang']->kode_barang }}</p>
        @else
            <input type="text" class="form-control" id="kode_barang" name="kode_barang" placeholder="Masukkan Kode barang" maxlength="128">
        @endif --}}
        <input type="text" class="form-control" id="kode_barang" name="kode_barang" placeholder="Masukkan Kode barang" maxlength="128" value="{{ $data['barang']->exists ? $data['barang']->kode_barang : '' }}" {{ $data['barang']->exists ? 'readonly disabled' : '' }} >
    </div>

    <div class="form-group">
        <label for="kategori">Kategori Barang</label>
        <select class="form-control" id="kode_kategori" name="kode_kategori" >
            <option value=""> --- Silahkan Pilih Kategori ---</option>
            @foreach ($data['kategori'] as $item)
                <option value="{{ $item->kode_kategori }}" {{ $data['barang']->exists && ($data['barang']->kode_kategori == $item->kode_kategori) ? 'selected' : '' }} > {{ $item->nama_kategori }} </option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="satuan">Satuan Barang</label>
        <select class="form-control" id="kode_satuan" name="kode_satuan" >
            <option value=""> --- Silahkan Pilih Satuan ---</option>
            @foreach ($data['satuan'] as $item)
                <option value="{{ $item->kode_satuan }}" {{ $data['barang']->exists && ($data['barang']->kode_satuan == $item->kode_satuan) ? 'selected' : '' }} > {{ $item->nama_satuan }} </option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="nama">Nama Barang</label>
        <input type="text" class="form-control" id="nama_barang" name="nama_barang" placeholder="Masukkan Nama barang" maxlength="50" value="{{ $data['barang']->exists ? $data['barang']->nama_barang : '' }}" >
    </div>

    <div class="form-group">
        <label for="stok">Stok</label>
        <input type="number" class="form-control" id="stok" name="stok" placeholder="Masukkan Stok" maxlength="100" value="{{ $data['barang']->exists ? $data['barang']->stok : '' }}" >
    </div>

    <div class="form-group">
        <label for="stok_min">Stok Min</label>
        <input type="number" class="form-control" id="stok_min" name="stok_min" placeholder="Masukkan Stok Min" maxlength="100" value="{{ $data['barang']->exists ? $data['barang']->stok_min : '1' }}" >
    </div>

    <div class="form-group">
        <label for="harga_beli">Harga Beli</label>
        <input type="number" class="form-control" id="harga_beli" name="harga_beli" placeholder="Masukkan Harga Beli" maxlength="10000000" value="{{ $data['barang']->exists ? $data['barang']->harga_beli : '' }}" >
    </div>

    <div class="form-group">
        <label for="harga_jual">Harga Jual</label>
        <input type="number" class="form-control" id="harga_jual" name="harga_jual" placeholder="Masukkan Harga Jual" maxlength="10000000" value="{{ $data['barang']->exists ? $data['barang']->harga_jual : '' }}" >
    </div>

    <div class="form-group">
        <label for="foto">Foto</label>
        <input type="file" class="form-control" id="foto" name="foto" >
        <img src="{{ Storage::url($data['barang']->exists ? $data['barang']->foto : '') }}" id="foto_viewer" width="150" height="150" alt="">
    </div>

    <div class="form-group">
        <label for="keterangan">Keterangan</label>
        <textarea cols="30" rows="10" class="form-control" id="keterangan" name="keterangan" placeholder="Masukkan Keterangan" maxlength="300">{{ $data['barang']->exists ? $data['barang']->keterangan : '' }}</textarea>
    </div>

    <div class="text-center">
        <div class="form-group">
            <button id="btn_submit" type="submit" class="btn btn-primary">Submit</button>
            <button type="reset" class="btn btn-danger">Reset</button>
        </div>
    </div>

</form>
