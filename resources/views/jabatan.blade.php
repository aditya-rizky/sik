@extends('layouts.app')

@section('css')
    <link href="{{ asset('assets/js/datatables.bootstrap.min.css') }}" rel="stylesheet" />
@endsection

@section('breadcrumb')
    <li>
        <i class="fa fa-hdd-o"></i>
        <a href="#">Master Data</a>
    </li>
    <li class="active">Data Jabatan</li>
@endsection

@section('title')
    Halaman Data Jabatan
@endsection

@section('content')
	<div class="row">
		<div class="col-lg-6 col-sm-6 col-xs-12 col-md-6">
			<div class="widget">
				<div class="widget-header bordered-bottom bordered-azure">
                    <span class="widget-caption">Form Jabatan</span>
                </div>
                <div class="widget-body">
                	<form class="bv-form" role="form" id="frmJabatan" novalidate="novalidate">
                        {{ csrf_field() }} {{ method_field('POST') }}
                        <div class="form-group">
                            <label for="nama_jabatan">Nama Jabatan</label>
                            <input type="text" class="form-control" name="nama_jabatan" id="nama_jabatan" maxlength="100" onkeyup="upNama()" autofocus>
                            <i class="form-control-feedback" style="display: none;"></i>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-sm-4 col-xs-12 col-md-4">
                                <div class="form-group">
                                    <label for="status_jabatan">Status Jabatan</label>
                                    <select class="form-control" name="status_jabatan" id="status_jabatan">
                                        <option value="Y">AKTIF</option>
                                        <option value="N">TIDAK AKTIF</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-azure" id="btnSimpan">Simpan</button>
                            <button type="button" class="btn btn-yellow" id="btnBatal">Batal</button>
                            <img src="{{ asset('assets/img/Ellipsis.gif') }}" id="imgLoader">
                            <input type="text" name="id_jabatan" id="id_jabatan" class="form-control" style="display: none;">
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
                <div class="widget-header bg-azure">
                    <span class="widget-caption">Tabel Data Jabatan</span>
                </div>
                <div class="widget-body">
                    <table class="table bordered-azure table-striped table-bordered table-hover responsive" id="tblJabatan" width="100%">
                        <thead class="bordered-azure">
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Nama Jabatan</th>
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

        // Function upper input nama jabatan
        function upNama(){
            var i = document.getElementById("nama_jabatan");
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
                url: "jabatan/"+id+"/edit",
                type: "GET",
                dataType: "JSON",
                beforeSend: function(){
                    $('#imgLoader').show();
                },
                success: function(data){
                    $('#frmJabatan').bootstrapValidator('disableSubmitButtons', false).bootstrapValidator('resetForm', true);
                    $('#nama_jabatan').val(data.nama_jabatan);
                    $('#status_jabatan').val(data.status_jabatan);
                    $('#id_jabatan').val(data.id_jabatan);
                    $('#btnBatal').show();
                    $('#nama_jabatan').focus();
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
                $('#frmJabatan')[0].reset();
                $('#btnBatal').hide();
                $('#nama_jabatan').focus();
            });

            oTable = $('#tblJabatan').DataTable({
                initComplete: function(){
                    var api = this.api();
                    $('#tblJabatan_filter input').off('.DT').on('keyup.DT', function(e){
                        if(e.keyCode == 13){
                            api.search(this.value).draw();
                        }
                    });
                },
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "{{ route('jabatan.data') }}",
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

            $('#frmJabatan').bootstrapValidator({
                excluded: [':hidden', ':disabled'],
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    nama_jabatan: {
                        validators: {
                            notEmpty: {
                                message: 'Kolom harus diisi !'
                            },
                            stringLength: {
                                max: 100,
                                message: 'Maksimal 100 karakter yang diperbolehkan'
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
                var id = $('#id_jabatan').val();
                if(id == ""){
                    url = "{{ route('jabatan.simpan') }}";
                    type = "POST";
                }else{
                    url = "jabatan/"+id;
                    type = "PUT";
                }

                $.ajax({
                    url: url,
                    type: type,
                    data: $('#frmJabatan').serialize(),
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

                        $('#frmJabatan')[0].reset();
                        $('#nama_jabatan').focus();
                        $('#btnBatal').hide();
                        oTable.ajax.reload();
                    },
                    complete: function(){
                        $('#imgLoader').hide();
                    }
                });
                $('#id_jabatan').val("");
                $('#frmJabatan').bootstrapValidator('disableSubmitButtons', false).bootstrapValidator('resetForm', true);
            });
        });
    </script>
@endsection