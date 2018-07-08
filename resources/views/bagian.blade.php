@extends('layouts.app')

@section('css')
    <link href="{{ asset('assets/js/datatables.bootstrap.min.css') }}" rel="stylesheet" />
@endsection

@section('breadcrumb')
    <li>
        <i class="fa fa-hdd-o"></i>
        <a href="#">Master Data</a>
    </li>
    <li class="active">Data Bagian</li>
@endsection

@section('title')
    Halaman Data Bagian
@endsection

@section('content')
	<div class="row">
		<div class="col-lg-6 col-sm-6 col-xs-12 col-md-6">
			<div class="widget">
				<div class="widget-header bordered-bottom bordered-palegreen">
                    <span class="widget-caption">Form Bagian</span>
                </div>
                <div class="widget-body">
            		<form class="bv-form" role="form" id="frmBagian" novalidate="novalidate">
                        {{ csrf_field() }} {{ method_field('POST') }}
            			<div class="form-group">
                            <label for="nama_bagian">Nama Bagian</label>
                            <input type="text" class="form-control" name="nama_bagian" id="nama_bagian" data-bv-field="nama_bagian" maxlength="150" onkeyup="upNama()" autofocus>
                            <i class="form-control-feedback" data-bv-field="nama_bagian" style="display: none;"></i>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-lg-6 col-xs-12">
                                <div class="form-group">
                                    <label for="kode_bagian"">Kode Bagian</label>
                                    <input type="text" class="form-control" name="kode_bagian" id="kode_bagian" data-bv-field="kode_bagian" maxlength="10" onkeyup="upKode()">
                                    <i class="form-control-feedback" data-bv-field="kode_bagian" style="display: none;"></i>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-lg-6 col-xs-12">
                                <div class="form-group">
                                    <label for="grup_bagian">Grup Bagian</label>
                                    <select class="form-control" name="grup_bagian" id="grup_bagian">
                                        <option value="0">DIREKSI</option>
                                        <option value="1">BAGIAN KANTOR DIREKSI</option>
                                        <option value="2">UNIT KERJA</option>
                                        <option value="3">AGROWISATA</option>
                                        <option value="4">LAIN - LAIN</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-lg-6 col-xs-12">
                                <div class="form-group">
                                    <label for="kode_bagian">Status Tindasan Surat</label>
                                    <select class="form-control" name="tindasan" id="tindasan">
                                        <option value="1">AKTIF</option>
                                        <option value="0">TIDAK AKTIF</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-lg-6 col-xs-12">
                                <div class="form-group">
                                    <label for="status_bagian">Status Bagian</label>
                                    <select class="form-control" name="status_bagian" id="status_bagian">
                                        <option value="Y">AKTIF</option>
                                        <option value="N">TIDAK AKTIF</option>
                                    </select>
                                </div>
                            </div>
                        </div>                                
                        <div class="form-group">
                            <button type="submit" class="btn btn-palegreen" id="btnSimpan">Simpan</button>
                            <button type="button" class="btn btn-yellow" id="btnBatal">Batal</button>
                            <img src="{{ asset('assets/img/Ellipsis.gif') }}" id="imgLoader">
                            <input type="text" name="id_bagian" id="id_bagian" class="form-control" style="display: none;">
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
				<div class="widget-header bg-palegreen">
                    <span class="widget-caption">Tabel Data Bagian</span>
                </div>
                <div class="widget-body">
                	<table class="table bordered-palegreen table-striped table-bordered table-hover responsive" id="tblBagian" width="100%">
                		<thead class="bordered-palegreen">
                			<tr>
	                			<th class="text-center">#</th>
	                			<th class="text-center">Nama Bagian</th>
	                			<th class="text-center">Kode Bagian</th>
                                <th class="text-center">Grup</th>
                                <th class="text-center">Status Tindasan</th>
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
            var i = document.getElementById("nama_bagian");
            i.value = i.value.toUpperCase();
        }

        // Function upper input kode bagian
        function upKode(){
            var i = document.getElementById("kode_bagian");
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
                url: "bagian/"+id+"/edit",
                type: "GET",
                dataType: "JSON",
                beforeSend: function(){
                    $('#imgLoader').show();
                },
                success: function(data){
                    $('#frmBagian').bootstrapValidator('disableSubmitButtons', false).bootstrapValidator('resetForm', true);
                    $('#nama_bagian').val(data.nama_bagian);
                    $('#kode_bagian').val(data.kode_bagian);
                    $('#id_bagian').val(data.id_bagian);
                    $('#tindasan').val(data.tindasan);
                    $('#grup_bagian').val(data.grup_bagian);
                    $('#status_bagian').val(data.status_bagian);
                    $('#btnBatal').show();
                    $('#nama_bagian').focus();
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
                $('#frmBagian')[0].reset();
                $('#btnBatal').hide();
                $('#nama_bagian').focus();
            });

            oTable = $('#tblBagian').DataTable({
                initComplete: function(){
                    var api = this.api();
                    $('#tblBagian_filter input').off('.DT').on('keyup.DT', function(e){
                        if(e.keyCode == 13){
                            api.search(this.value).draw();
                        }
                    });
                },
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "{{ route('bagian.data') }}",
                    "type": "GET"
                },
                "ordering": false,
                "columnDefs": [
                    {
                        width: "1%",
                        className: "text-center",
                        targets: [0]
                    },{
                        width: "10%",
                        className: "text-center",
                        targets: [2]
                    },{
                        width: "17%",
                        className: "text-center",
                        targets: [3]
                    },{
                        width: "15%",
                        className: "text-center",
                        targets: [4]
                    },{
                        width: "1%",
                        className: "text-center",
                        targets: [5]
                    }
                ]
            });

            $('#frmBagian').bootstrapValidator({
                excluded: [':hidden', ':disabled'],
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    nama_bagian: {
                        validators: {
                            notEmpty: {
                                message: 'Kolom harus diisi !'
                            },
                            stringLength: {
                                max: 150,
                                message: 'Maksimal 150 karakter yang diperbolehkan'
                            }
                        }
                    },
                    kode_bagian: {
                        validators: {
                            notEmpty: {
                                message: 'Kolom harus diisi !'
                            },
                            stringLength: {
                                max: 10,
                                message: 'Maksimal 10 karakter yang diperbolehkan'
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
                var id = $('#id_bagian').val();
                if(id == ""){
                    url = "{{ route('bagian.simpan') }}";
                    type = "POST";
                }else{
                    url = "bagian/"+id;
                    type = "PUT";
                }

                $.ajax({
                    url: url,
                    type: type,
                    data: $('#frmBagian').serialize(),
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

                        $('#frmBagian')[0].reset();
                        $('#nama_bagian').focus();
                        $('#btnBatal').hide();
                        oTable.ajax.reload();
                    },
                    complete: function(){
                        $('#imgLoader').hide();
                    }
                });
                $('#id_bagian').val("");
                $('#frmBagian').bootstrapValidator('disableSubmitButtons', false).bootstrapValidator('resetForm', true);
            });
        });
    </script>
@endsection