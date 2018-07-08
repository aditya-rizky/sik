@extends('layouts.app')

@section('css')
    <link href="{{ asset('assets/js/datatables.bootstrap.min.css') }}" rel="stylesheet" />
@endsection

@section('breadcrumb')
    <li>
        <i class="fa fa-hdd-o"></i>
        <a href="#">Master Data</a>
    </li>
    <li class="active">Data Pendidikan</li>
@endsection

@section('title')
    Halaman Data Pendidikan
@endsection

@section('content')
	<div class="row">
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="widget">
				<div class="widget-header bordered-bottom bordered-blue">
                    <span class="widget-caption">Form Pendidikan</span>
                </div>
                <div class="widget-body">
                	<form class="bv-form" role="form" id="frmPendidikan" novalidate="novalidate">
                        {{ csrf_field() }} {{ method_field('POST') }}
                        <div class="row">
                            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-1">
                                <div class="form-group">
                                    <label for="nama_pendidikan">Pendidikan</label>
                                    <input type="text" class="form-control" name="nama_pendidikan" id="nama_pendidikan" data-bv-field="nama_pendidikan" maxlength="50" onkeyup="upNama()" autofocus>
                                    <i class="form-control-feedback" data-bv-field="nama_pendidikan" style="display: none;"></i>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-1">
                                <div class="form-group">
                                    <label for="status_pendidikan">Status Pendidikan</label>
                                    <select class="form-control" name="status_pendidikan" id="status_pendidikan">
                                        <option value="Y">AKTIF</option>
                                        <option value="N">TIDAK AKTIF</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-blue" id="btnSimpan">Simpan</button>
                            <button type="button" class="btn btn-yellow" id="btnBatal">Batal</button>
                            <img src="{{ asset('assets/img/Ellipsis.gif') }}" id="imgLoader">
                            <input type="text" name="id_pendidikan" id="id_pendidikan" class="form-control" style="display: none;">
                        </div>
                    </form>
                </div>
			</div>
		</div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <div class="col-md-12" id="alertNotif" style="display: none;"></div>
            </div>
        </div>
	</div>
	<div class="row">
		<div class="col-lg-12 col-sm-12 col-xs-12">
			<div class="widget">
				<div class="widget-header bg-blue">
                    <span class="widget-caption">Tabel Data Pendidikan</span>
                </div>
                <div class="widget-body">
                	<table class="table bordered-blue table-striped table-bordered table-hover responsive" id="tblPendidikan" width="100%">
                		<thead class="bordered-blue">
                			<tr>
	                			<th class="text-center">#</th>
	                			<th class="text-center">Pendidikan</th>
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
            var i = document.getElementById("nama_pendidikan");
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
                url: "pendidikan/"+id+"/edit",
                type: "GET",
                dataType: "JSON",
                beforeSend: function(){
                    $('#imgLoader').show();
                },
                success: function(data){
                    $('#frmPendidikan').bootstrapValidator('disableSubmitButtons', false).bootstrapValidator('resetForm', true);
                    $('#nama_pendidikan').val(data.nama_pendidikan);
                    $('#id_pendidikan').val(data.id_pendidikan);
                    $('#status_pendidikan').val(data.status_pendidikan);
                    $('#btnBatal').show();
                    $('#nama_pendidikan').focus();
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
                $('#frmPendidikan')[0].reset();
                $('#btnBatal').hide();
                $('#nama_pendidikan').focus();
            });

            oTable = $('#tblPendidikan').DataTable({
                initComplete: function(){
                    var api = this.api();
                    $('#tblPendidikan_filter input').off('.DT').on('keyup.DT', function(e){
                        if(e.keyCode == 13){
                            api.search(this.value).draw();
                        }
                    });
                },
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "{{ route('pendidikan.data') }}",
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

            $('#frmPendidikan').bootstrapValidator({
                excluded: [':hidden', ':disabled'],
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    nama_pendidikan: {
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
                var id = $('#id_pendidikan').val();
                if(id == ""){
                    url = "{{ route('pendidikan.simpan') }}";
                    type = "POST";
                }else{
                    url = "pendidikan/"+id;
                    type = "PUT";
                }

                $.ajax({
                    url: url,
                    type: type,
                    data: $('#frmPendidikan').serialize(),
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

                        $('#frmPendidikan')[0].reset();
                        $('#nama_pendidikan').focus();
                        $('#btnBatal').hide();
                        oTable.ajax.reload();
                    },
                    complete: function(){
                        $('#imgLoader').hide();
                    }
                });
                $('#frmPendidikan').bootstrapValidator('disableSubmitButtons', false).bootstrapValidator('resetForm', true);
            });
        });
    </script>
@endsection