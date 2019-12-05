@extends('admin.layout.app')

@section('title')
    Data Penjualan
@endsection

@push('css')

@endpush

@section('content')
<style>
    th, td {
        white-space: nowrap;
    }
</style>
    <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
            <h1>
                PENJUALAN
                <small>Data Penjualan</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-file"></i> Penjualan</a></li>
                <li><a href="#">Data Penjualan</a></li>
            </ol>
            </section>

            <!-- Main content -->
            <section class="content">
            <div class="row">
                <div class="col-xs-12">

                <div class="box">
                    <div class="box-header">
                    <h3 class="box-title"> <button id="btn_refresh" class="btn bg-blue btn-flat"> <i class="fa fa-refresh"></i> Refresh Data </button> </h3>

                    <!-- Date range -->
                    <div class="row">
                            <div class="col-md-5 pull-right">
                                <label>Mulai s/d Sampai</label>

                                <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control pull-right" id="range_tanggal">
                                </div>
                                <!-- /.input group -->
                            </div>
                        </div>
                        <!-- /.End date range -->

                </div>
                    <!-- /.box-header -->
                    <div class="box-body">

                        <div class="table-responsive">
                            <table id="data" class="table table-bordered table-striped table-hover">
                                <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Kode Transaksi</th>
                                    <th>Tgl Transaksi</th>
                                    <th>Karyawan</th>
                                    <th>Pelanggan</th>
                                    <th>Grand Total</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
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

    <script>

$(document).ready(function(){

//HEADER AJAX CSRF LARAVEL
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


    // DATE RANGE PICKER
    $('#range_tanggal').daterangepicker({
    locale: {
        format: 'DD/MM/YYYY'
    }
    }).on('apply.daterangepicker', function (e, picker) {
        $('#data').DataTable().ajax.reload();
    })
    // END DATE RANGE PICKER


    var table = $('#data').DataTable({
        processing: true,
        serverSide: true,
        order: [],
        ajax: {
            url: "{{ route('penjualan.datatables') }}",
            type: "POST",
            data: function(d) {
                // NEW PARAMETER IF RELOAD / KHUSUS DATATABLE
                d.mulai = $('#range_tanggal').data('daterangepicker').startDate.format('DD-MM-YYYY');
                d.sampai = $('#range_tanggal').data('daterangepicker').endDate.format('DD-MM-YYYY');
            },
        },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'kode_transaksi', name: 'kode_transaksi'},
            {data: 'tgl_transaksi', name: 'tgl_transaksi'},
            {data: 'nama', name: 'nama'},
            {data: 'nama_pelanggan', name: 'nama_pelanggan'},
            {data: 'grand_total', name: 'grand_total'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

})

    $('#btn_refresh').on('click', function(e){
        e.preventDefault();
        $('#data').DataTable().ajax.reload();
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
