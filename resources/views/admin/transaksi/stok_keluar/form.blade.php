@extends('admin.layout.app')

@section('title')
    Transaksi Stok keluar
@endsection

@push('css')

@endpush

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       STOK
        <small>Transaksi Stok Keluar</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Transaksi</a></li>
        <li><a href="#">Stok Keluar</a></li>
        <li class="active">Transaksi Stok Keluar</li>
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
    <form action="{{ $data['stok_keluar']->exists ? route('stokkeluar.update', $data['stok_keluar']->id) : route('stokkeluar.store') }}" role="form" id="form_stokkeluar" method="{{ $data['stok_keluar']->exists ? 'PUT' : 'POST' }}">
        <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Transaksi Stok keluar</h3>
            </div>
            <!-- /.box-header -->
            <div class="form-horizontal">
                    <div class="box-body">

                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label">Kode Barang </label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="kode_barang" name="kode_barang" placeholder="Kode Barang" value="{{ $data['stok_keluar']->exists ? $data['stok_keluar']->kode_barang : '' }}" readonly>
                        </div>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="nama_barang" name="nama_barang" placeholder="Nama Barang" value="{{ $data['stok_keluar']->exists ? $data['stok_keluar']->nama_barang : '' }}" readonly>
                        </div>
                        @if (!$data['stok_keluar']->exists)
                            <div class="col-sm-1">
                                <button class="btn btn-primary" id="btn_search"><i class="fa fa-search"></i> Search</button>
                            </div>
                        @endif

                    </div>

                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label">Qty </label>
                        <div class="col-sm-2">
                            <input type="number" class="form-control" id="qty" name="qty" placeholder="Qty" value="{{ $data['stok_keluar']->exists ? $data['stok_keluar']->qty : '' }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label">Keterangan</label>
                        <div class="col-sm-4">
                            <textarea class="form-control" name="keterangan" id="keterangan" cols="" rows="">{{ $data['stok_keluar']->exists ? $data['stok_keluar']->keterangan : '' }}</textarea>
                        </div>
                    </div>

                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                      {{-- <p>* Harap isi data transaksi dengan benar</p> --}}
                      <div class="text-left">
                        <button id="btn_submit" type="submit" class="btn btn-primary"> <span class="fa fa-plus"></span> Simpan</button>
                        <button id="btn_reset" type="reset" class="btn btn-danger"> <span class="fa fa-refresh"></span> Reset</button>
                      </div>
                    </div>
                    <!-- /.box-footer -->
                </div>
          </div>
          <!-- /.box -->
        </div>
        </form>
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
              <h4 class="modal-title text-center">Data Barang</h4>
            </div>
            <div class="modal-body">
              <p>One fine body&hellip;</p>
            </div>
            <div class="modal-footer">
              <p class="text-left">Catatan : Double Click Pada Baris Barang Yang Akan Dipilih</p>
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

    // HEADER AJAX CSRF LARAVEL //
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    // END HEADER AJAX CSRF LARAVEL //


    // SUBMIT FORM //
    $('#form_stokkeluar').on('submit', function(e){
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
                        me.trigger('reset');
                        if(method == "PUT"){
                            window.location.href = "{{ route('stokkeluar.index') }}";
                        }
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
    // END SUBMIT FORM //


  // TAMPILKAN LIST DATABARANG //
    $('#btn_search').on('click', function(e){
        e.preventDefault();
        var me          = $(this),
            url         = "{!! route('stokkeluar.data_barang'); !!}",
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

        });
        $('#modal').modal('show');
    });
    // END TAMPILKAN LIST DATABARANG //

    // GET VALUE FROM DATATABLE BARANG
    $('#modal .modal-body').on( 'dblclick', '#data', function () {
        var data = $(this).find("tbody tr td"),
            kode = data.eq(0).text(),
            nama = data.eq(1).text();

        $('#kode_barang').val(kode);
        $('#nama_barang').val(nama);
        $('#modal').modal('hide');
        $('#qty').focus();
    });
    // END GET VALUE FROM DATATABLE BARANG

});
</script>

@endpush
