@extends('admin.layout.app')

@section('title')
    Transaksi Penjualan
@endsection

@push('css')

@endpush

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       INVOICE
        <small>Transaksi Penjualan</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Transaksi</a></li>
        <li><a href="#">Penjualan</a></li>
        <li class="active">Transaksi Penjualan</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

    <div id="alert" class="alert alert-danger alert-dismissible" role="alert" style="display:none;">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-ban"></i> Alert!</h4>
        <div id="alert_msg"> Message </div>
    </div>

    <!-- form start -->
    <form action="{{ route('penjualan.store') }}" method="post" id="form_transaksi" name="form_transaksi" enctype="multipart/form-data">
      <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Data Transaksi</h3>
            </div>
            <!-- /.box-header -->
            <div class="form-horizontal">
                    <div class="box-body">

                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label">Kode Transaksi </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="kode_transaksi" name="kode_transaksi" placeholder="kode transaksi" value="{{ $data['kode_transaksi'] }}" readonly>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label">User</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" id="user" name="user" placeholder="User" value="{{ Auth::user()->id }}" readonly>
                        </div>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="nama_user" name="nama_user" placeholder="User" value="{{ Auth::user()->nama }}" readonly>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label">Tanggal</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="tanggal" name="tanggal" placeholder="Tanggal">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label">Pelanggan</label>
                        <div class="col-sm-5">
                            <select class="form-control" name="pelanggan" id="pelanggan">
                                @foreach ($data['pelanggan'] as $item)
                                    <option value="{{ $item->kode_pelanggan }}">{{ $item->nama_pelanggan }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label">Jenis Pembayaran</label>
                        <div class="col-sm-5">
                            <select class="form-control" name="jenis_pembayaran" id="jenis_pembayaran">
                                <option value="transfer">Transfer</option>
                                <option value="cash">Cash</option>
                            </select>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label">Keterangan</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" name="keterangan" id="keterangan" cols="" rows=""></textarea>
                        </div>
                    </div>


                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                      {{-- <p>* Harap isi data transaksi dengan benar</p> --}}
                      <div class="text-left">
                        <button type="button" class="btn btn-primary"> <span class="fa fa-refresh"></span> TRANSAKSI BARU (F5)</button>
                      </div>
                    </div>
                    <!-- /.box-footer -->
                </div>
          </div>
          <!-- /.box -->
        </div>
        <!--/.col (left) -->

        <!-- right column -->
        <div class="col-md-6">
          <!-- Horizontal Form -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Pembayaran</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <div class="form-horizontal">
              <div class="box-body">

                <div class="form-group">
                  <label for="" class="col-sm-3 control-label">Total Sub. Total</label>
                  <div class="col-sm-5">
                    <input type="number" class="form-control" id="total_sub_total" name="total_sub_total" placeholder="Total Sub. Total" value="0" readonly>
                  </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">Total. Diskon</label>
                    <div class="col-sm-5">
                        <input type="number" class="form-control" id="total_diskon" name="total_diskon" placeholder="Total Diskon" value="0" readonly>
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">PPN (%)</label>
                    <div class="col-sm-2">
                        <input type="number" class="form-control" id="pajak" name="pajak" placeholder="PPN" value="0">
                    </div>

                </div>

                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">DLL</label>
                    <div class="col-sm-5">
                        <input type="number" class="form-control" id="dll" name="dll" placeholder="DLL" value="0">
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">Total Harga</label>
                    <div class="col-sm-5">
                        <input type="number" class="form-control" id="total_harga" name="total_harga" placeholder="Total Harga" value="0" readonly>
                    </div>
                </div>


                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">Bayar</label>
                    <div class="col-sm-5">
                        <input type="number" class="form-control" id="bayar" name="bayar" placeholder="Bayar" value="0">
                    </div>
                </div>


                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">Kembali</label>
                    <div class="col-sm-5">
                        <input type="number" class="form-control" id="kembali" name="kembali" placeholder="Kembali" value="0" readonly>
                    </div>
                </div>

              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="reset" class="btn btn-danger"><span class="fa fa-eraser"></span> RESET</button>
                <button id="btn_bayar" type="submit" class="btn btn-primary pull-right"> <span class="fa fa-money"></span> BAYAR & CETAK INVOICE</button>
              </div>
              <!-- /.box-footer -->
                </div>
          </div>
          <!-- /.box -->
        </div>
        <!--/.col (right) -->
    </form>
      </div>
      <!-- /.row -->

      <div class="row">
        <div class="col-md-12 col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                <h3 class="box-title">Item</h3>
                </div>
                <div class="box-body">

                    <div class="row">
                        <div class="col-xs-2">
                        <input type="text" id="kode_barang" name="kode_barang" class="form-control" placeholder="Kode Barang">
                        </div>
                        <div class="col-xs-3">
                        <input type="text" id="nama_barang" name="nama_barang" class="form-control" placeholder="Nama Barang" readonly>
                        </div>
                        <div class="col-xs-2">
                        <input type="number" id="harga" name="harga" class="form-control" placeholder="Harga">
                        </div>
                        <div class="col-xs-1">
                        <input type="number" id="qty" name="qty" class="form-control" placeholder="Qty">
                        </div>
                        <div class="col-xs-2">
                        <input type="number" id="diskon" name="diskon" class="form-control" placeholder="Diskon">
                        </div>
                        <div class="col-xs-2">
                        <input type="number" id="sub_total" name="sub_total" class="form-control" placeholder="Sub. Total" readonly>
                        </div>
                    </div>

                </div>
                <!-- /.box-body -->
            </div>
        </div>
      </div>
      <!-- /.box -->

      <div class="row">
            <div class="col-md-12 col-xs-12">
                <div class="box box-secondary">
                        <div class="box-header with-border">
                            <h3 class="box-title">
                                <button id="btn_tambah" name="btn_tambah" type="button" class="btn btn-primary"> <span class="fa fa-plus"></span> TAMBAH </button>
                                <button id="btn_data_barang" name="btn_data_barang" type="button" class="btn btn-secondary"> <span class="fa fa-file"></span> DATA BARANG </button>
                            </h3>
                            <h3>Detail Item</h3>
                        </div>
                    <div class="box-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="tabel_barang" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Kode Barang</th>
                                            <th>Nama Barang</th>
                                            <th>Harga</th>
                                            <th>Qty</th>
                                            <th>Diskon</th>
                                            <th>Sub. Total</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                  </table>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
          </div>
          <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

{{-- MODAL --}}

<div class="modal fade" id="modal">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title text-center">Modal</h4>
            </div>
            <div class="modal-body">
              <p>One fine body&hellip;</p>
            </div>
            <div class="modal-footer">
              {{-- <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button> --}}
              {{-- <p class="text-left">Catatan : Harap memasukkan data dengan benar</p> --}}
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

{{-- END MODAL --}}

@endsection


@push('javascript')
    <!-- DataTables -->

    <script>

$(document).ready(function(){

// HEADER AJAX CSRF LARAVEL //
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
// END HEADER AJAX CSRF LARAVEL //

// INIT DATEPICKER //
$('#tanggal').datepicker({
    format: 'dd-mm-yyyy',
    todayHighlight: true,
    autoclose: true
}).datepicker("setDate",'now');
// END INIT DATEPICKER //


// TAMPILKAN LIST DATABARANG //
$('#btn_data_barang').on('click', function(e){
        e.preventDefault();

        var me          = $(this),
            url         = "{!! route('penjualan.data_barang'); !!}",
            method      = "POST",
            dataType    = "HTML";

        $.ajax({
                url: url,
                type: method,
                dataType: dataType,
                beforeSend: function(res){

                },
                success: function(res){
                    $('.modal-body').html(res);
                    var table = $('.modal-body .table').DataTable({
                        scrollX: true,
                        // serverSide: true,
                        processing: true,
                        ajax: {
                            url: "{!! route('api.barang.index') !!}",
                            type: "GET"
                        },
                        columns: [
                            {data: 'kode_barang', name: 'kode_barang'},
                            {data: 'nama_barang', name: 'nama_barang'},
                            {data: 'stok', name: 'stok'},
                            {data: 'stok_min', name: 'stok_min'},
                            {data: 'nama_satuan', name: 'nama_satuan'},
                            {data: 'nama_kategori', name: 'nama_kategori'},
                            {data: 'harga_jual', name: 'harga_jual'},
                            {data: 'keterangan', name: 'keterangan'},
                        ]
                    });
                    $('#modal').modal('show');
                },
                error: function(xhr, err){

                    var msg = $('.alert #alert_msg').empty();
                    var error = xhr.responseJSON;

                    // Menampilkan pesan error dari json response error
                    $.each(error.errors, function(key, value){
                        msg.append("<p>"+ value[0] +"</p>");
                    });
                    $('#alert').show();
                }

            })
        $('#modal').modal('show');

    });
// END TAMPILKAN LIST DATABARANG //

    // ACTION BAYAR //
    $('#form_transaksi').on('submit', function(e){
        e.preventDefault();
        var me = $(this),
            data = me.serializeArray(),
            url = me.attr('action'),
            method = me.attr('method'),
            dataType = "JSON";

        var tabel = $('#tabel_barang > tbody > tr');
        var kode_barang ,
            harga       ,
            qty         ,
            diskon      ,
            sub_total   ;

            tabel.each(function(){

                kode_barang = $(this).find('td:eq(0)').text(),
                harga =  $(this).find('td:eq(2)').text(),
                qty =  $(this).find('td:eq(3)').text(),
                diskon =  $(this).find('td:eq(4)').text(),
                sub_total   =  $(this).find('td:eq(5)').text();

                data.push( {name: "kode_barang[]", value: kode_barang} );
                data.push( {name: "harga[]", value: harga} );
                data.push( {name: "qty[]", value: qty} );
                data.push( {name: "diskon[]", value: diskon} );
                data.push( {name: "sub_total[]", value: sub_total} );

            });

        $.ajax({
            url: url,
            data: data,
            type: method,
            dataType: dataType,
            beforeSend: function(){
                $('#btn_bayar').prop('disabled', true);
            },
            success: function(res){
                alert("success");
                reset_invoice();
            },
            error: function(xhr, status, error){
                alert("error");
                var msg = $('.alert #alert_msg').empty();
                var error = xhr.responseJSON;

                // Menampilkan pesan error dari json response error
                $.each(error.errors, function(key, value){
                    msg.append("<li>"+ value[0] +"</li>");
                });
                $('#alert').show();
            },
            complete: function(){
                alert("complete");
                $('#btn_bayar').prop('disabled', false);
            }
        });


    });
    // END ACTION BAYAR //

});

// RESET FORM (TRANSAKSI BARU) //

    function reset_invoice(){
        window.location.reload();
    }

// END RESET FORM (TRANSAKSI BARU) //



// PROSES PERHITUNGAN BAYAR //

    function hitung_bayar_kembali(){
        var total_harga = $('#total_harga').val(),
            bayar = $('#bayar').val(),
            kembali = Number(bayar) - Number(total_harga) ;
        $('#kembali').val(kembali);
    }

    $('#bayar').on('keyup keypress blur change', function(e){
        hitung_bayar_kembali();
    })


    function hitung_total_sub_diskon(){
        // Loop From Table
        var tabel = $('#tabel_barang > tbody > tr');
        var total_sub_total = 0,
            total_diskon = 0;

        tabel.each(function(){
            var sub_total = $(this).find('td:eq(5)').text();
                diskon = $(this).find('td:eq(4)').text();

            total_sub_total += Number(sub_total);
            total_diskon += Number(diskon);

        });

        $('#total_sub_total').val(total_sub_total);
        $('#total_diskon').val(total_diskon);

        hitung_total_harga();

    }


    function hitung_total_harga(){

        var total_sub_total = $('#total_sub_total').val(),
            total_diskon = $('#total_diskon').val(),
            pajak = $('#pajak').val(),
            dll = $('#dll').val();

        var total_harga = Number(total_sub_total) - Number(total_diskon) + ( Number(total_sub_total) * Number(pajak) / 100 ) + Number(dll);
        $('#total_harga').val(total_harga);

    }

    $('#total_sub_total, #total_diskon, #pajak, #dll').on('keyup keypress blur change', function(e){
        hitung_total_harga();
    })

    function hitung_sub_total(){
        var qty = $('#qty').val(),
            harga = $('#harga').val(),
            diskon = $('#diskon').val();

        var sub_total = Number(qty) * Number(harga) - Number(diskon);
        $('#sub_total').val(sub_total);

    }

    $('#qty, #diskon').on('keyup keypress blur change', function(e){
        hitung_sub_total();
    })

// END PROSES PERHITUNGAN BAYAR //


// TAMBAH DATA KE TABEL TRANSAKSI //
    $('#btn_tambah').on('click', function(e){
        e.preventDefault();
        var kode_barang = $('#kode_barang').val(),
            nama_barang = $('#nama_barang').val(),
            harga = $('#harga').val(),
            qty = $('#qty').val(),
            diskon = $('#diskon').val(),
            sub_total = $('#sub_total').val();

        if(kode_barang !== "" && nama_barang !== "" && harga !== "" && qty !== "" && diskon !== "" && sub_total !== ""){

          $('#tabel_barang')
            .append("<tr>" +
                "<td>" + kode_barang + "</td>" +
                "<td>" + nama_barang + "</td>" +
                "<td>" + harga + "</td>" +
                "<td>" + qty + "</td>" +
                "<td>" + diskon + "</td>" +
                "<td>" + sub_total + "</td>" +
                "<td> <button type='button' class='btn btn-danger' id='btn_hapus' name='btn_hapus'> Hapus </button> <button type='button' class='btn btn-info' id='btn_ubah' name='btn_ubah'> Ubah </button> </td>"+
                "</tr>");

            $('#kode_barang').val("");
            $('#nama_barang').val("");
            $('#harga').val("");
            $('#qty').val("");
            $('#diskon').val("");
            $('#sub_total').val("");

            // Fill to Pembayaran
            hitung_total_sub_diskon();

        }

    });
// END TAMBAH DATA KE TABEL TRANSAKSI //

// HAPUS BARANG DARI TABEL //
    $('.table tbody').on('click', '#btn_hapus', function(){
        $(this).closest('tr').remove();
        hitung_total_sub_diskon();
    });

    $('.table tbody').on('click', '#btn_ubah', function(){
        var kode_barang = $(this).closest('tr').find('td:eq(0)').text(),
            nama_barang = $(this).closest('tr').find('td:eq(1)').text(),
            harga = $(this).closest('tr').find('td:eq(2)').text(),
            qty = $(this).closest('tr').find('td:eq(3)').text(),
            diskon = $(this).closest('tr').find('td:eq(4)').text(),
            sub_total = $(this).closest('tr').find('td:eq(5)').text();

        $('#kode_barang').val(kode_barang);
        $('#nama_barang').val(nama_barang);
        $('#harga').val(harga);
        $('#qty').val(qty);
        $('#diskon').val(diskon);
        $('#sub_total').val(sub_total);

        $(this).closest('tr').remove();
        hitung_total_sub_diskon();

    });
// HAPUS BARANG DARI TABEL //

// DATA BARANG TABEL TO FIELD QTY DLL //
    $('.modal').on('dblclick', '#data tr', function(e){
        e.preventDefault();
        var row = $(this).closest("tr");
        var kode = row.find("td:eq(0)").text();

        var me          = $(this),
            url         = "{!! route('api.barang.index') !!}" + "/" + kode,
            method      = "GET",
            dataType    = "JSON",
            data        = {kode: kode};

        $.ajax({
                url: url,
                type: method,
                data: data,
                dataType: dataType,
                beforeSend: function(res){

                },
                success: function(res){

                    $('#kode_barang').val(res.data.kode_barang);
                    $('#nama_barang').val(res.data.nama_barang);
                    $('#harga').val(res.data.harga_jual);
                    $('#diskon').val(0);
                    $('#qty').focus();

                },
                error: function(xhr, err){

                    var msg = $('.alert #alert_msg').empty();
                    var error = xhr.responseJSON;

                    // Menampilkan pesan error dari json response error
                    $.each(error.errors, function(key, value){
                        msg.append("<p>"+ value[0] +"</p>");
                    });
                    $('#alert').show();
                }

            })

        $('#modal').modal('hide');

    });
// END DATA BARANG TABEL TO FIELD QTY DLL //

    </script>

@endpush
