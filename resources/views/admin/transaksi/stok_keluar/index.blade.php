
@extends('admin.layout.app')

@section('title')
    Stok Keluar
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
            <small>Data Stok Keluar</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-file"></i> Master</a></li>
            <li><a href="#">Data Stok Keluar</a></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">

              <div class="box">
                <div class="box-header">
                    {{-- alert --}}
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="data" class="table table-bordered table-striped table-hover" style="width:100%">
                            <thead>
                            <tr>
                            <th>No.</th>
                            <th>Tanggal</th>
                            <th>Barang</th>
                            <th>Qty</th>
                            <th>Keterangan</th>
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

    var table = $('#data').DataTable({
        processing: true,
        serverSide: true,
        order: [],
        ajax: {
            url: "{{ route('stokkeluar.datatables') }}",
            type: "POST"
        },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'tanggal', name: 'tanggal'},
            {data: 'nama_barang', name: 'nama_barang'},
            {data: 'qty', name: 'qty'},
            {data: 'keterangan', name: 'keterangan'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });


})

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

    </script>

@endpush
