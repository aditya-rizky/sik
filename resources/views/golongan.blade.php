@extends('layouts.app')

@section('css')
    <link href="{{ asset('assets/js/datatables.bootstrap.min.css') }}" rel="stylesheet" />
@endsection

@section('breadcrumb')
    <li>
        <i class="fa fa-hdd-o"></i>
        <a href="#">Master Data</a>
    </li>
    <li class="active">Data Golongan</li>
@endsection

@section('title')
    Halaman Data Golongan
@endsection

@section('content')
	<div class="row">
		<div class="col-lg-6 col-sm-6 col-xs-12 col-md-6">
			<div class="widget">
				<div class="widget-header bordered-bottom bordered-purple">
                    <span class="widget-caption">Form Golongan</span>
                </div>
                <div class="widget-body">
                	<form class="bv-form" role="form" id="frmGolongan" novalidate="novalidate">
                        {{ csrf_field() }} {{ method_field('POST') }}
                        <div class="row">
                            <div class="col-lg-6 col-sm-6 col-xs-12 col-md-6">
                                <div class="form-group">
                                    <label for="nama_golongan">Nama Golongan</label>
                                    <input type="text" class="form-control" name="nama_golongan" id="nama_golongan" data-bv-field="nama_golongan" maxlength="50" onkeyup="upNama()" autofocus>
                                    <i class="form-control-feedback" data-bv-field="nama_golongan" style="display: none;"></i>
                                </div> 
                            </div>
                            <div class="col-lg-6 col-sm-6 col-xs-12 col-md-6">
                                <div class="form-group">
                                    <label for="status_golongan">Status Golongan</label>
                                    <select class="form-control" name="status_golongan" id="status_golongan">
                                        <option value="Y">AKTIF</option>
                                        <option value="N">TIDAK AKTIF</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-purple" id="btnSimpan">Simpan</button>
                            <button type="button" class="btn btn-yellow" id="btnBatal">Batal</button>
                            <img src="{{ asset('assets/img/Ellipsis.gif') }}" id="imgLoader">
                            <input type="text" name="id_golongan" id="id_golongan" class="form-control" style="display: none;">
                        </div>
                    </form>
                </div>
			</div>
		</div>
        <div class="col-lg-6 col-sm-6 col-xs-12 col-md-6">
            <div class="form-group">
                <div id="alertNotif" style="display: none;"></div>
            </div>
        </div>
	</div>
	<div class="row">
		<div class="col-lg-12 col-sm-12 col-xs-12">
			<div class="widget">
				<div class="widget-header bg-purple">
                    <span class="widget-caption">Tabel Data Golongan</span>
                </div>
                <div class="widget-body">
                	<table class="table bordered-purple table-striped table-bordered table-hover responsive" id="tblGolongan" width="100%">
                		<thead class="bordered-purple">
                			<tr>
	                			<th class="text-center">#</th>
	                			<th class="text-center">Nama Golongan</th>
	                			<th class="text-center">Aksi</th>
	                		</tr>
                		</thead>
                        <tbody></tbody>
                	</table>
                </div>
			</div>
		</div>
	</div>
@endsection

@section('script')
    <script src="{{ asset('assets/js/jquery.datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/validation/bootstrapValidator.js') }}"></script>
    <script type="text/javascript">
        // Function mencegah submit form dari tombol enter
        function stopRKey(evt) {
            var evt = (evt) ? evt : ((event) ? event : null);
            var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null);
            if ((evt.keyCode == 13) && (node.type=="text"))  {return false;}
        }
        document.onkeypress = stopRKey;

        // Function upper input nama bagian
        function upNama(){
            var i = document.getElementById("nama_golongan");
            i.value = i.value.toUpperCase();
        }

        // Function ketika tombol edit
        function editData(id){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "golongan/"+id+"/edit",
                type: "GET",
                dataType: "JSON",
                beforeSend: function(){
                    $('#imgLoader').show();
                },
                success: function(data){
                    $('#frmGolongan').bootstrapValidator('disableSubmitButtons', false).bootstrapValidator('resetForm', true);
                    $('#nama_golongan').val(data.nama_golongan);
                    $('#id_golongan').val(data.id_golongan);
                    $('#status_golongan').val(data.status_golongan);
                    $('#btnBatal').show();
                    $('#nama_golongan').focus();
                },
                complete: function(){
                    $('#imgLoader').hide();
                },
                error: function(){
                    alert("Tidak dapat menampilkan data!");
                }
            });
            return false;
        }

        $(document).ready(function(){
            $('#btnBatal').hide();
            $('#imgLoader').hide();
            $('body').tooltip({selector: '[data-toggle="tooltip"]'});

            $('#btnBatal').click(function(){
                $('#frmGolongan')[0].reset();
                $('#btnBatal').hide();
                $('#nama_golongan').focus();
            });

            oTable = $('#tblGolongan').DataTable({
                initComplete: function(){
                    var api = this.api();
                    $('#tblGolongan_filter input').off('.DT').on('keyup.DT', function(e){
                        if(e.keyCode == 13){
                            api.search(this.value).draw();
                        }
                    });
                },
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "{{ route('golongan.data') }}",
                    "type": "GET"
                },
                "ordering": false,
                "columnDefs": [
                    {
                        className: "text-center",
                        targets: [0,2],
                        width: "3%"
                    },
                    {
                        orderable: false,
                        targets: [0,2]
                    }
                ]
            });

            $('#frmGolongan').bootstrapValidator({
                excluded: [':hidden', ':disabled'],
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    nama_golongan: {
                        validators: {
                            notEmpty: {
                                message: 'Kolom harus diisi !'
                            },
                            stringLength: {
                                max: 50,
                                message: 'Maksimal 50 karakter yang diperbolehkan'
                            }
                        }
                    }
                }
            }).on('success.field.bv', function(e, data){
                var $parent = data.element.parents('.form-group');
                $parent.removeClass('has-success');
                $parent.find('.form-control-feedback[data-bv-icon-for="' + data.field + '"]').hide();
            }).on('success.form.bv', function(e){
                e.preventDefault();
                var id = $('#id_golongan').val();
                if(id == ""){
                    url = "{{ route('golongan.simpan') }}";
                    type = "POST";
                }else{
                    url = "golongan/"+id;
                    type = "PUT";
                }

                $.ajax({
                    url: url,
                    type: type,
                    data: $('#frmGolongan').serialize(),
                    dataType: 'JSON',
                    beforeSend: function(){
                        $('#imgLoader').show();
                    },
                    success: function(data){
                        if(data.status == 1){
                            var alertStatus = ['alert-success', 'Sukses!', 'Data berhasil disimpan.'];
                        }else if(data.status == 2){
                            var alertStatus = ['alert-success', 'Sukses!', 'Data berhasil diubah.'];
                        }else{
                            var alertStatus = ['alert-danger', 'Gagal!', 'Data gagal disimpan/diubah.'];
                        }

                        $('#alertNotif').html("<div class='alert "+alertStatus[0]+" alert-dismissible fade in' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button><strong>"+alertStatus[1]+"</strong> "+alertStatus[2]+"</div>");
                        $('#alertNotif').fadeTo(4000, 500).slideUp(500, function(){
                            $('#alertNotif').slideUp(500);
                        });
                        $('#nama_golongan').focus();
                        $('#btnBatal').hide();
                        oTable.ajax.reload();
                    },
                    complete: function(){
                        $('#imgLoader').hide();
                    }
                });
                $('#id_golongan').val("");
                $('#frmGolongan').bootstrapValidator('disableSubmitButtons', false).bootstrapValidator('resetForm', true);
            });
        });
    </script>
@endsection