<table class="table table-bordered table-striped">
    <thead>
        <th>Kode Pelanggan</th>
        <th>Nama Pelanggan</th>
        <th>No. Telp</th>
        <th>Alamat</th>
    </thead>
    <tbody>
        <tr>
            <td> {{ $data->kode_pelanggan }} </td>
            <td> {{ $data->nama_pelanggan }} </td>
            <td> {{ $data->no_telp }} </td>
            <td> {{ $data->alamat }} </td>
        </tr>
    </tbody>
</table>
