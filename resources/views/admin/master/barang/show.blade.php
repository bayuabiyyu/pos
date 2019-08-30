<table class="table table-bordered table-striped">
    <thead>
        <th>Kode Barang</th>
        <th>Nama Barang</th>
        <th>Stok</th>
        <th>Stok Min</th>
        <th>Satuan</th>
        <th>Kategori</th>
        <th>Foto</th>
        <th>Keterangan</th>
    </thead>
    <tbody>
        <tr>
            <td> {{ $data->kode_barang }} </td>
            <td> {{ $data->nama_barang }} </td>
            <td> {{ $data->stok }} </td>
            <td> {{ $data->stok_min }} </td>
            <td> {{ $data->nama_satuan }} </td>
            <td> {{ $data->nama_kategori }} </td>
            <td> {!! Storage::exists($data->foto) ? '<img src="'. Storage::url($data->foto) .'" height="42" width="42">' : '<span class="badge badge-info"> Foto tidak ditemukan </span>' !!} </td>
            <td> {{ $data->keterangan }} </td>
        </tr>
    </tbody>
</table>
