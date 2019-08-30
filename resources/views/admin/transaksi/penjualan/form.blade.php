
@extends('admin.layout.app')

@section('title')
    Create Penjualan
@endsection

@push('css')

@endpush

@section('content')
   <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Create Penjualan
            <small>#007612</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Transaksi</a></li>
            <li><a href="#">Penjualan</a></li>
            <li class="active">Create Penjualan</li>
          </ol>
        </section>

        <div class="pad margin no-print">
          <div class="callout callout-info" style="margin-bottom: 0!important;">
            <h4><i class="fa fa-info"></i> Note:</h4>
            This page has been enhanced for printing. Click the print button at the bottom of the invoice to test.
          </div>
        </div>

        <!-- Main content -->
        <section class="invoice">
          <!-- title row -->
          <div class="row">
            <div class="col-xs-12">
              <h2 class="page-header">
                <i class="fa fa-globe"></i> AdminLTE, Inc.
                <small class="pull-right">Date: 2/10/2014</small>
              </h2>
            </div>
            <!-- /.col -->
          </div>
          <!-- info row -->
          <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
              <input type="text" placeholder="Kode Barang">
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
              To
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
              <b>Invoice #007612</b><br>
              <br>
              <b>Order ID:</b> 4F3S8J<br>
              <b>Payment Due:</b> 2/22/2014<br>
              <b>Account:</b> 968-34567
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
                  <th>Qty</th>
                  <th>Product</th>
                  <th>Serial #</th>
                  <th>Description</th>
                  <th>Subtotal</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                  <td>1</td>
                  <td>Call of Duty</td>
                  <td>455-981-221</td>
                  <td>El snort testosterone trophy driving gloves handsome</td>
                  <td>$64.50</td>
                </tr>
                <tr>
                  <td>1</td>
                  <td>Need for Speed IV</td>
                  <td>247-925-726</td>
                  <td>Wes Anderson umami biodiesel</td>
                  <td>$50.00</td>
                </tr>
                <tr>
                  <td>1</td>
                  <td>Monsters DVD</td>
                  <td>735-845-642</td>
                  <td>Terry Richardson helvetica tousled street art master</td>
                  <td>$10.70</td>
                </tr>
                <tr>
                  <td>1</td>
                  <td>Grown Ups Blue Ray</td>
                  <td>422-568-642</td>
                  <td>Tousled lomo letterpress</td>
                  <td>$25.99</td>
                </tr>
                </tbody>
              </table>
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->

          <div class="row">
            <!-- accepted payments column -->
            <div class="col-xs-6">
              <p class="lead">Catatan Penjualan :</p>
                <textarea name="" id="" cols="60" rows="10" placeholder="Jika tidak ada harap dikosongkan"></textarea>
            </div>
            <!-- /.col -->
            <div class="col-xs-6">
              <p class="lead">Pembayaran</p>

              <div class="table-responsive">
                <table class="table">
                  <tr>
                    <th style="width:50%">Subtotal:</th>
                    <td>$250.30</td>
                  </tr>
                  <tr>
                    <th>Tax (9.3%)</th>
                    <td>$10.34</td>
                  </tr>
                  <tr>
                    <th>Shipping:</th>
                    <td>$5.80</td>
                  </tr>
                  <tr>
                    <th>Total:</th>
                    <td>$265.24</td>
                  </tr>
                </table>
              </div>
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->

          <!-- this row will not appear when printing -->
          <div class="row no-print">
            <div class="col-xs-12">
              <button type="button" class="btn btn-primary pull-right"><i class="fa fa-credit-card"></i> Bayar
              </button>
              <button type="button" class="btn btn-danger pull-right" style="margin-right: 5px;">
                <i class="fa fa-download"></i> Reset
              </button>
            </div>
          </div>
        </section>
        <!-- /.content -->
        <div class="clearfix"></div>
      </div>
      <!-- /.content-wrapper -->

{{-- MODAL --}}

<div class="modal fade" id="modal">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title text-center">Modal Form</h4>
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
    <script src="{{ asset('assets/admin') }}/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('assets/admin') }}/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

    <script>

$(document).ready(function(){

//HEADER AJAX CSRF LARAVEL
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

    var table = $('#data').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('satuan.datatables') }}",
            type: "POST"
        },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'kode_satuan', name: 'kode_satuan'},
            {data: 'nama_satuan', name: 'nama_satuan'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });



})


    $('#btn_tambah').on('click', function(e){
        e.preventDefault();
        $('#modal .modal-title').html('TAMBAH DATA');
        var url = "{{ route('satuan.create') }}",
            method = "GET",
            dataType = "HTML";

        $.ajax({
            url: url,
            type: method,
            dataType: dataType,
            success: function(res){
                $('.modal-body').html(res);
                $('#modal').modal('show');
            }
        });

    });


    $('#modal').on('submit', 'form', function(e){
        e.preventDefault();
        var me          = $(this),
            url         = me.attr('action'),
            method      = me.attr('method'),
            dataType    = "JSON",
            data        = me.serialize();

        var result = confirm("Apakah anda yakin ingin submit data tersebut?");

        if(result){

            $.ajax({
                url: url,
                type: method,
                dataType: dataType,
                data: data,
                beforeSend: function(res){

                },
                success: function(res){
                    alert(res.msg);
                    $('#alert').hide();
                    if(res.status == true){
                        $('#data').DataTable().ajax.reload();
                        me.trigger('reset');
                        $('#modal').modal('hide');
                    }
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

        }

    });


    $('#data').on('click', '#btn_edit', function(e){
        e.preventDefault();
        $('#modal .modal-title').html('EDIT DATA');
        var me = $(this),
            url = me.attr('href'),
            method = "GET",
            dataType = "HTML";

        $.ajax({
            url: url,
            type: method,
            dataType: dataType,
            success: function(res){
                $('.modal-body').html(res);
                $('#modal').modal('show');
            }
        });

    });

    $('#data').on('click', '#btn_delete', function(e){
        e.preventDefault();
        var me = $(this),
            url = me.attr('href'),
            method = "DELETE",
            dataType = "JSON";

        var result = confirm("Apakah anda yakin ingin menghapus data tersebut?");

        if(result){

            $.ajax({
                url: url,
                type: method,
                dataType: dataType,
                beforeSend: function(res){
                    alert('beforesend');
                },
                success: function(res){
                    alert(res.msg);
                    if(res.status == true){
                        $('#data').DataTable().ajax.reload();
                        me.trigger('reset');
                    }
                },
                error: function(xhr, err){
                    alert('error');
                }

            });
        }
    });


    $('#data').on('click', '#btn_show', function(e){
        e.preventDefault();
        $('#modal .modal-title').html('SHOW DATA');
        var me = $(this),
            url = me.attr('href'),
            method = "GET",
            dataType = "HTML";

        $.ajax({
            url: url,
            type: method,
            dataType: dataType,
            success: function(res){
                $('.modal-body').html(res);
                $('#modal').modal('show');
            }
        });

    });

    </script>

@endpush
