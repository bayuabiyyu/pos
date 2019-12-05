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
                        <label for="" class="col-sm-3 control-label">Pembayaran</label>
                        <div class="col-sm-5">
                            <select class="form-control" name="jenis_pembayaran" id="jenis_pembayaran">
                                <option value="cash">Cash</option>
                                <option value="transfer">Transfer</option>
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
                      <p>* Harap isi data transaksi dengan benar</p>
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
                  <label for="" class="col-sm-3 control-label">Sub. Total</label>
                  <div class="col-sm-5">
                    <input type="number" class="form-control" id="sub_total" name="sub_total" placeholder="Total" value="0" readonly>
                  </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">Pajak (%)</label>
                    <div class="col-sm-2">
                        <input type="number" class="form-control" id="pajak" name="pajak" placeholder="PPN" value="0">
                    </div>
                    <label for="" class="col-sm-1 control-label">Rp.</label>
                    <div class="col-sm-4">
                        <input type="number" class="form-control" id="pajak_rp" name="pajak_rp" placeholder="PPN RP" value="0" readonly>
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">DLL</label>
                    <div class="col-sm-5">
                        <input type="number" class="form-control" id="dll" name="dll" placeholder="DLL" value="0">
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">Grand Total</label>
                    <div class="col-sm-5">
                        <input type="number" class="form-control" id="grand_total" name="grand_total" placeholder="Total Harga" value="0" readonly>
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
                 <button id="btn_reset" type="button" class="btn btn-success pull-left"> <span class="fa fa-refresh"></span> Transaksi Baru (F5)</button>
                 <button id="btn_bayar" type="submit" class="btn btn-primary pull-right"> <span class="fa fa-money"></span> Bayar & Cetak</button>
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
                            <input type="number" id="harga_barang" name="harga_barang" class="form-control" placeholder="Harga">
                        </div>
                        <div class="col-xs-1">
                            <input type="number" id="qty_barang" name="qty_barang" class="form-control" placeholder="Qty">
                        </div>
                        <div class="col-xs-2">
                            <input type="number" id="sub_total_barang" name="sub_total_barang" class="form-control" placeholder="Sub. Total" readonly>
                        </div>
                        <div class="col-xs-2">
                            <button id="btn_tambah" name="btn_tambah" type="button" class="btn btn-primary"> <span class="fa fa-plus"></span> Tambah </button>
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
                                <button id="btn_data_barang" name="btn_data_barang" type="button" class="btn btn-secondary"> <span class="fa fa-file"></span> Data Barang </button>
                            </h3>
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
              <h4 class="modal-title text-center">Data Barang</h4>
            </div>
            <div class="modal-body">
              <p>One fine body&hellip;</p>
            </div>
            <div class="modal-footer">
              <p class="text-left">Catatan : Double click pada barang yang akan dipilih</p>
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
//Timepicker
$('#waktu').timepicker({
    maxHours: 24,
})
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
                            url: "{!! route('barang.getall') !!}",
                            type: "POST"
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
            sub_total   ;

            tabel.each(function(){

                kode_barang = $(this).find('td:eq(0)').text(),
                harga =  $(this).find('td:eq(2)').text(),
                qty =  $(this).find('td:eq(3)').text(),
                sub_total   =  $(this).find('td:eq(4)').text();

                data.push( {name: "kode_barang[]", value: kode_barang} );
                data.push( {name: "harga[]", value: harga} );
                data.push( {name: "qty[]", value: qty} );
                data.push( {name: "sub_total_barang[]", value: sub_total} );

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
                alert(res.message);
                // reset_invoice();
            },
            error: function(xhr, status, error){
                var msg = $('.alert #alert_msg').empty();
                var error = xhr.responseJSON;

                // Menampilkan pesan error dari json response error
                $.each(error.errors, function(key, value){
                    msg.append("<li>"+ value +"</li>");
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
    $('#btn_reset').on('click', function(e){
        e.preventDefault();
        reset_invoice();
    });
    function reset_invoice(){
        if(confirm("Apakah anda ingin transaksi baru?")){
            $('#form_transaksi').trigger('reset');
            $('#kode_barang, #nama_barang, #harga_barang, #qty_barang, #sub_total_barang').val(null);
            $('#tabel_barang tbody').empty();
        }
    }
// END RESET FORM (TRANSAKSI BARU) //



// PROSES PERHITUNGAN BAYAR //

    function hitung_bayar_kembali(){
        var grand_total = $('#grand_total').val(),
            bayar = $('#bayar').val(),
            kembali = Number(bayar) - Number(grand_total) ;
        $('#kembali').val(kembali);
    }

    $('#bayar').on('keyup keypress blur change', function(e){
        hitung_bayar_kembali();
    })


    function hitung_sub_total(){
        // Loop From Table
        var tabel = $('#tabel_barang > tbody > tr'),
            total = 0;

        tabel.each(function(){
            var sub_total = $(this).find('td:eq(4)').text();
            total += Number(sub_total);
        });

        $('#sub_total').val(total);
    }

    function hitung_pajak_rp(){
        var total = $('#sub_total').val()
            pajak = $('#pajak').val(),
            pajak_rp = Number(total) * Number(pajak) / 100;
        $('#pajak_rp').val(pajak_rp);
    }

    function hitung_grand_total(){
        var total = $('#sub_total').val(),
            pajak = $('#pajak').val(),
            dll = $('#dll').val();
        var grand_total = Number(total) + ( Number(total) * Number(pajak) / 100 ) + Number(dll);
        $('#grand_total').val(grand_total);
    }

    $('#pajak, #dll').on('keyup keypress blur change', function(e){
        hitung_pajak_rp();
        hitung_grand_total();
    })

    function hitung_sub_total_barang(){
        var qty = $('#qty_barang').val(),
            harga = $('#harga_barang').val();

        var sub_total = Number(qty) * Number(harga);
        if(sub_total < 0){
            $('#sub_total_barang').val('0');
        }else{
            $('#sub_total_barang').val(sub_total);
        }
    }

    $('#qty_barang').on('keyup keypress blur change', function(e){
        hitung_sub_total_barang();
    })

// END PROSES PERHITUNGAN BAYAR //


// TAMBAH DATA KE TABEL TRANSAKSI //
    $('#btn_tambah').on('click', function(e){
        e.preventDefault();
        var kode_barang = $('#kode_barang').val(),
            nama_barang = $('#nama_barang').val(),
            harga = $('#harga_barang').val(),
            qty = $('#qty_barang').val(),
            sub_total = $('#sub_total_barang').val();

        if(kode_barang !== "" && nama_barang !== "" && harga !== "" && qty !== "" && sub_total !== ""){

          $('#tabel_barang')
            .append("<tr>" +
                "<td>" + kode_barang + "</td>" +
                "<td>" + nama_barang + "</td>" +
                "<td>" + harga + "</td>" +
                "<td>" + qty + "</td>" +
                "<td>" + sub_total + "</td>" +
                "<td> <button type='button' class='btn btn-danger' id='btn_hapus' name='btn_hapus'> Hapus </button> <button type='button' class='btn btn-info' id='btn_ubah' name='btn_ubah'> Ubah </button> </td>"+
                "</tr>");

            $('#kode_barang').val(null);
            $('#nama_barang').val(null);
            $('#harga_barang').val(null);
            $('#qty_barang').val(null);
            $('#sub_total_barang').val(null);
            // Fill to Pembayaran
            hitung_sub_total();
            hitung_grand_total();
        }

    });
// END TAMBAH DATA KE TABEL TRANSAKSI //

// HAPUS BARANG DARI TABEL //
    $('.table tbody').on('click', '#btn_hapus', function(){
        $(this).closest('tr').remove();
        hitung_sub_total();
    });
// HAPUS BARANG DARI TABEL //

// UBAH BARANG DARI TABEL //
    $('.table tbody').on('click', '#btn_ubah', function(){
        var kode_barang = $(this).closest('tr').find('td:eq(0)').text(),
            nama_barang = $(this).closest('tr').find('td:eq(1)').text(),
            harga = $(this).closest('tr').find('td:eq(2)').text(),
            qty = $(this).closest('tr').find('td:eq(3)').text(),
            sub_total = $(this).closest('tr').find('td:eq(4)').text();

        $('#kode_barang').val(kode_barang);
        $('#nama_barang').val(nama_barang);
        $('#harga_barang').val(harga);
        $('#qty_barang').val(qty);
        $('#sub_total_barang').val(sub_total);

        $(this).closest('tr').remove();
        hitung_sub_total();

    });
// UBAH BARANG DARI TABEL //

// GET BARANG VALUE FROM TABLE //
    $('.modal').on('dblclick', '#data tr', function(e){
        e.preventDefault();
        var row = $(this).closest("tr"),
            kode = row.find("td:eq(0)").text(),
            nama = row.find("td:eq(1)").text(),
            stok = row.find("td:eq(2)").text(),
            harga = row.find("td:eq(6)").text();

        if(stok <= 0 ){
            alert("Stok barang 0, harap perbarui data stok");
        }else{
            $('#kode_barang').val(kode);
            $('#nama_barang').val(nama);
            $('#harga_barang').val(harga);
            $('#qty_barang').focus();
            $('#modal').modal('hide');
        }

    });
// END GET BARANG VALUE FROM TABLE //

    </script>

@endpush
