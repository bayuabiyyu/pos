
@extends('admin.layout.app')

@section('title')
    Satuan
@endsection

@push('css')

@endpush

@section('content')
   <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            MASTER
            <small>Data Satuan</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-file"></i> Master</a></li>
            <li><a href="#">Data Satuan</a></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">

              <div class="box">
                <div class="box-header">
                  <h3 class="box-title"> <button id="btn_tambah" class="btn bg-blue btn-flat"> <i class="fa fa-plus"></i> Tambah Data </button> </h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="data" class="table table-bordered table-striped table-hover">
                            <thead>
                            <tr>
                            <th>No.</th>
                            <th>Kode Satuan</th>
                            <th>Nama Satuan</th>
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
                    $('#modal #btn_submit').attr('disabled', true);
                    $('#modal #btn_reset').attr('disabled', true);
                },
                success: function(res){
                    // ALERT TOAST
                    toastr.options.positionClass = 'toast-bottom-right';
                    toastr.success(res.message);

                    $('#alert').hide();
                    if(res.success == true){
                        $('#data').DataTable().ajax.reload();
                        me.trigger('reset');
                        $('#modal').modal('hide');
                    }
                },
                error: function(xhr, err){

                    var msg = $('.alert #alert_msg').empty();
                    var errors = xhr.responseJSON.errors;
                    // Menampilkan pesan error dari json response error
                    $.each(errors, function(key, value){
                        msg.append("<li>"+ value +"</li>");
                    });

                    $('#alert').show();
                },
                complete: function(res){
                    $('#modal #btn_submit').removeAttr('disabled');
                    $('#modal #btn_reset').removeAttr('disabled');
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

                },
                success: function(res){
                    // ALERT TOAST
                    toastr.options.positionClass = 'toast-bottom-right';
                    toastr.success(res.message);
                    if(res.success == true){
                        $('#data').DataTable().ajax.reload();
                        me.trigger('reset');
                    }
                },
                error: function(xhr, err){
                    alert('error');
                },
                complete: function(res){

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
