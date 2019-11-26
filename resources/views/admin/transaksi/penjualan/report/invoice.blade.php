@extends('admin.layout_report.app')

@section('reportName')
    Invoice
@endsection

@section('content')

    <div class="container">

            <section class="invoice">
                    <!-- title row -->
                    <div class="row">
                      <div class="col-xs-12">
                        <h2 class="page-header">
                          <i class="fa fa-money"></i> INVOICE TRANSAKSI PENJUALAN
                          <small class="pull-right">Tanggal : {{ date('d-m-Y', strtotime($data['header']->tgl_transaksi)) }}</small>
                        </h2>
                      </div>
                      <!-- /.col -->
                    </div>
                    <!-- info row -->
                    <div class="row invoice-info">
                      <div class="col-sm-4 invoice-col">
                        Petugas :
                        <address>
                          <strong>{{ $data['header']->nama }}</strong><br>
                          {{ 'Alamatnya toko' }} <br>
                          No. Telp : {{ 'Telephon toko' }}<br>
                        </address>
                      </div>
                      <!-- /.col -->
                      <div class="col-sm-4 invoice-col">
                        Pelanggan :
                        <address>
                            <strong>{{ $data['header']->nama_pelanggan }}</strong><br>
                            {{ $data['header']->alamat }} <br>
                            No. Telp : {{ $data['header']->no_telp }}<br>
                        </address>
                      </div>
                      <!-- /.col -->
                      <div class="col-sm-4 invoice-col">
                        <b>{{ $data['header']->kode_transaksi }}</b>
                      </div>
                      <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <!-- Table row -->
                    <div class="row">
                      <div class="col-xs-12 table-responsive">
                        <table class="table table-striped">
                          <thead>
                          <tr>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Harga</th>
                            <th>Qty</th>
                            <th>Diskon</th>
                            <th>Sub. Total</th>
                          </tr>
                          </thead>
                          <tbody>
                              @foreach ($data['detail'] as $item)
                                <tr>
                                    <td>{{ $item->kode_barang }}</td>
                                    <td>{{ $item->nama_barang }}</td>
                                    <td>{{ $item->harga }}</td>
                                    <td>{{ $item->qty }}</td>
                                    <td>{{ $item->diskon }}</td>
                                    <td>{{ $item->sub_total }}</td>
                                </tr>
                              @endforeach
                          </tbody>
                        </table>
                      </div>
                      <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <div class="row">
                      <!-- accepted payments column -->
                      <div class="col-xs-6">
                        <p class="lead">Catatan / Keterangan : </p>
                        <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                            {{ $data['header']->keterangan }}
                        </p>
                      </div>
                      <!-- /.col -->
                      <div class="col-xs-6">

                        <div class="table-responsive">
                          <table class="table">
                            <tbody>
                                <tr>
                                    <th style="width:50%">Sub. Total:</th>
                                    <td>{{ $data['header']->total_sub_total }}</td>
                                </tr>
                                <tr>
                                    <th style="width:50%">Total Diskon:</th>
                                    <td>{{ $data['header']->total_diskon }}</td>
                                </tr>
                                <tr>
                                    <th style="width:50%">PPN (%):</th>
                                    <td>{{ $data['header']->pajak }}</td>
                                </tr>
                                <tr>
                                    <th style="width:50%">DLL</th>
                                    <td>{{ $data['header']->dll }}</td>
                                </tr>
                                 <tr>
                                    <th style="width:50%">Total</th>
                                    <td>{{ $data['header']->total_harga }}</td>
                                </tr>
                          </tbody></table>
                        </div>
                      </div>
                      <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <!-- this row will not appear when printing -->
                    <div class="row no-print">
                      <div class="col-xs-12">
                       <p>di cetak tanggal sekian</p>
                      </div>
                    </div>
                  </section>


    </div>

@endsection
