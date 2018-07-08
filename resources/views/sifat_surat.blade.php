@extends('layouts.app')

@section('css')
    <link href="{{ asset('assets/js/datatables.bootstrap.min.css') }}" rel="stylesheet" />
@endsection

@section('breadcrumb')
    <li>
        <i class="fa fa-hdd-o"></i>
        <a href="#">Master Data</a>
    </li>
    <li class="active">Data Sifat Surat</li>
@endsection

@section('title')
    Halaman Data Sifat Surat
@endsection

@section('content')
	<div class="row">
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="widget">
				<div class="widget-header bordered-bottom bordered-palegreen">
                    <span class="widget-caption">Form Sifat Surat</span>
                </div>
                <div class="widget-body">
                	<form class="bv-form" role="form" id="frmSifatsurat" novalidate="novalidate">
                        {{ csrf_field() }} {{ method_field('POST') }}
                        <div class="row">
                            <div class="col-lg-5 col-sm-5 col-md-5 col-xs-12">
                                <div class="form-group">
                                    <label for="nama_sifat">Nama Sifat</label>
                                    <input type="text" class="form-control" name="nama_sifat" id="nama_sifat" data-bv-field="nama_sifat" maxlength="20" onkeyup="upNama()" autofocus>
                                    <i class="form-control-feedback" data-bv-field="nama_sifat" style="display: none;"></i>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
                                <div class="form-group">
                                    <label for="kode_sifat">Kode Sifat</label>
                                    <input type="text" class="form-control" name="kode_sifat" id="kode_sifat" data-bv-field="kode_sifat" maxlength="5" onkeyup="upKode()">
                                    <i class="form-control-feedback" data-bv-field="kode_sifat" style="display: none;"></i>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                                <div class="form-group">
                                    <label for="status_sifat">Status Sifat</label>
                                    <select class="form-control" name="status_sifat" id="status_sifat">
                                        <option value="Y">AKTIF</option>
                                        <option value="N">TIDAK AKTIF</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea class="form-control" rows="3" id="deskripsi" name="deskripsi" onkeyup="upDeskripsi()" maxlength="150"></textarea>
                            <i class="form-control-feedback" data-bv-field="deskripsi" style="display: none;"></i>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-palegreen" id="btnSimpan">Simpan</button>
                            <button type="button" class="btn btn-yellow" id="btnBatal">Batal</button>
                            <img src="{{ asset('assets/img/Ellipsis.gif') }}" id="imgLoader">
                            <input type="text" name="id_sifat" id="id_sifat" class="form-control" style="display: none;">
                        </div>
                    </form>
                </div>
			</div>
		</div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <div id="alertNotif" style="display: none;"></div>
            </div>
        </div>
	</div>
	<div class="row">
		<div class="col-lg-12 col-sm-12 col-xs-12">
			<div class="widget">
				<div class="widget-header bg-palegreen">
                    <span class="widget-caption">Tabel Data Sifat Surat</span>
                </div>
                <div class="widget-body">
                	<table class="table bordered-palegreen table-striped table-bordered table-hover responsive" id="tblSifat" width="100%">
                		<thead class="bordered-palegreen">
                			<tr>
	                			<th class="text-center">#</th>
	                			<th class="text-center">Nama Jenis Surat</th>
	                			<th class="text-center">Deskripsi</th>
	                			<th class="text-center">Kode</th>
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

        // Function upper input nama jenis
        function upNama(){
            var i = document.getElementById("nama_sifat");
            i.value = i.value.toUpperCase();
        }

        // Function upper input kode jenis
        function upKode(){
            var i = document.getElementById("kode_sifat");
            i.value = i.value.toUpperCase();
        }

        // Function upper input deskripsi
        function upDeskripsi(){
            var i = document.getElementById("deskripsi");
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
                url: "sifat_surat/"+id+"/edit",
                type: "GET",
                dataType: "JSON",
                beforeSend: function(){
                    $('#imgLoader').show();
                },
                success: function(data){
                    $('#frmSifatsurat').bootstrapValidator('disableSubmitButtons', false).bootstrapValidator('resetForm', true);
                    $('[name="nama_sifat"]').val(data.nama_sifat);
                    $('[name="kode_sifat"]').val(data.kode_sifat);
                    $('[name="deskripsi"]').val(data.deskripsi);
                    $('[name="status_sifat"]').val(data.status_sifat);
                    $('[name="id_sifat"]').val(data.id_sifat_surat);
                    $('#btnBatal').show();
                    $('[name="nama_sifat"]').focus();
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
                $('#frmSifatsurat')[0].reset();
                $('#btnBatal').hide();
                $('#nama_sifat').focus();
            });

            oTable = $('#tblSifat').DataTable({
                initComplete: function(){
                    var api = this.api();
                    $('#tblSifat_filter input').off('.DT').on('keyup.DT', function(e){
                        if(e.keyCode == 13){
                            api.search(this.value).draw();
                        }
                    });
                },
                "processing": true,
                "serverSide": true,
                "ordering": false,
                "ajax": {
                    "url": "{{ route('sifat_surat.data') }}",
                    "type": "GET"
                },
                "columnDefs": [
                    {
                        className: "text-center",
                        targets: [0,3,4]
                    },
                    {
                        orderable: false,
                        targets: [0,4]
                    }
                ]
            });

            $('#frmSifatsurat').bootstrapValidator({
                excluded: [':hidden', ':disabled'],
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    nama_sifat: {
                        validators: {
                            notEmpty: {
                                message: 'Kolom harus diisi !'
                            },
                            stringLength: {
		                        max: 20,
		                        message: 'Maksimal 20 karakter yang diperbolehkan'
		                    }
                        }
                    },
                    kode_sifat: {
                    	validators: {
                            notEmpty: {
                                message: 'Kolom harus diisi !'
                            },
                            stringLength: {
		                        max: 5,
		                        message: 'Maksimal 5 karakter yang diperbolehkan'
		                    }
                        }
                    },
                    deskripsi: {
                    	validators: {
                            notEmpty: {
                                message: 'Kolom harus diisi !'
                            },
                            stringLength: {
		                        max: 150,
		                        message: 'Maksimal 150 karakter yang diperbolehkan'
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
                var id = $('#id_sifat').val();
                if(id == ""){
                    url = "{{ route('sifat_surat.simpan') }}";
                    type = "POST";
                }else{
                    url = "sifat_surat/"+id;
                    type = "PUT";
                }

                $.ajax({
                    url: url,
                    type: type,
                    data: $('#frmSifatsurat').serialize(),
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

                        $('#frmSifatsurat')[0].reset();
                        $('#nama_sifat').focus();
                        $('#btnBatal').hide();
                        oTable.ajax.reload();
                    },
                    complete: function(){
                        $('#imgLoader').hide();
                    }
                });
                $('#frmSifatsurat').bootstrapValidator('disableSubmitButtons', false).bootstrapValidator('resetForm', true);
            });
        });
    </script>
@endsection