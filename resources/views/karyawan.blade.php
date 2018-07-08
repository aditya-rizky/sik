@extends('layouts.app')

@section('css')
    <link href="{{ asset('assets/js/datatables.bootstrap.min.css') }}" rel="stylesheet" />
@endsection

@section('breadcrumb')
    <li>
        <i class="fa fa-hdd-o"></i>
        <a href="#">Master Data</a>
    </li>
    <li class="active">Data Karyawan</li>
@endsection

@section('title')
    Halaman Data Karyawan
@endsection

@section('content')
	<div class="row">
		<div class="col-lg-12 col-sm-12 col-xs-12">
			<div class="widget">
				<div class="widget-header bordered-bottom bordered-sky">
                    <span class="widget-caption">Form Karyawan</span>
                </div>
                <div class="widget-body">
                    <form class="bv-form" role="form" id="frmKaryawan" novalidate="novalidate" enctype="multipart/form-data" >
                        {{ csrf_field() }} {{ method_field('POST') }}
                        <div class="row">
                            <div class="col-lg-6 col-sm-6 col-xs-12">
                                <div class="widget flat">
                                    <div class="widget-body">
                                        <div class="form-title">
                                            Data Pribadi Karyawan
                                        </div>
                                        <div class="form-group">
                                            <label for="nama_karyawan">Nama Karyawan</label>
                                            <input type="text" class="form-control" id="nama_karyawan" name="nama_karyawan" data-bv-field="nama_karyawan" maxlength="150" onkeyup="upNama()" autofocus>
                                            <i class="form-control-feedback" data-bv-field="nama_karyawan" style="display: none;"></i>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="tanggal_lahir">Tanggal Lahir</label>
                                                    <input type="text" class="form-control tgl" id="tanggal_lahir" name="tanggal_lahir" data-bv-field="tanggal_lahir">
                                                    <i class="form-control-feedback" data-bv-field="tanggal_lahir" style="display: none;"></i>
                                                </div>  
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="tanggal_karyawan">Tanggal Pengangkatan</label>
                                                    <input type="text" class="form-control tgl" id="tanggal_karyawan" name="tanggal_karyawan" data-bv-field="tanggal_karyawan">
                                                    <i class="form-control-feedback" data-bv-field="tanggal_karyawan" style="display: none;"></i>
                                                </div>  
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="email">Alamat Email</label>
                                                    <input type="email" class="form-control" id="email" name="email" data-bv-field="email" maxlength="150">
                                                    <i class="form-control-feedback" data-bv-field="email" style="display: none;"></i>
                                                </div>  
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="nama_karyawan">Jenis Kelamin</label>
                                                    <select class="form-control" name="jenis_kelamin" id="jenis_kelamin">
                                                        <option value="1">Laki - Laki</option>
                                                        <option value="2">Perempuan</option>
                                                    </select>
                                                </div> 
                                            </div>
                                        </div>
                                        <div class="form-group divFoto">
                                            <label for="foto_karyawan">Foto Karyawan</label>
                                            <div class="input-group">
                                                <span class="input-group-btn">
                                                    <span class="btn btn-sky btn-file">
                                                        Browse <input type="file" name="foto" id="foto" accept="image/*">
                                                    </span>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-12" id="alertNotif" style="display: none;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-6 col-xs-12">
                                <div class="widget flat">
                                    <div class="widget-body">
                                        <div class="form-title">
                                            Data Pekerjaan Karyawan
                                        </div>
                                        <div class="form-group">
                                            <label for="bagian">Bagian</label>
                                            <select class="form-control" name="bagian" id="bagian">
                                                @foreach($bagian as $rowBagian)
                                                    <option value="{{ $rowBagian->id_bagian }}">{{ $rowBagian->nama_bagian }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="jabatan">Jabatan</label>
                                            <select class="form-control" name="jabatan" id="jabatan">
                                                @foreach($jbt as $rowJabatan)
                                                    <option value="{{ $rowJabatan->id_jabatan }}">{{ $rowJabatan->nama_jabatan }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                 <div class="form-group">
                                                    <label for="golongan">Golongan</label>
                                                    <select class="form-control" name="golongan" id="golongan">
                                                        @foreach($gol as $rowGolongan)
                                                            <option value="{{ $rowGolongan->id_golongan }}">{{ $rowGolongan->nama_golongan }}</option>
                                                        @endforeach
                                                    </select>
                                                </div> 
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="pendidikan">Pendidikan</label>
                                                    <select class="form-control" name="pendidikan" id="pendidikan">
                                                        @foreach($ddk as $rowPendidikan)
                                                            <option value="{{ $rowPendidikan->id_pendidikan }}">{{ $rowPendidikan->nama_pendidikan }}</option>
                                                        @endforeach
                                                    </select>
                                                </div> 
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="status_konseptor">Status Konseptor Surat</label>
                                                    <select class="form-control" name="status_konseptor" id="status_konseptor">
                                                        <option value="1">Aktif</option>
                                                        <option value="2">Tidak Aktif</option>
                                                    </select>
                                                </div> 
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="status_karyawan">Status Karyawan</label>
                                                    <select class="form-control" name="status_karyawan" id="status_karyawan">
                                                        <option value="1">Aktif</option>
                                                        <option value="2">Tidak Aktif</option>
                                                    </select>
                                                </div> 
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-sky" id="btnSimpan">Simpan</button>
                                            <button type="button" class="btn btn-yellow" id="btnBatal">Batal</button>
                                            <img src="{{ asset('assets/img/Ellipsis.gif') }}" id="imgLoader">
                                            <input type="text" name="id_karyawan" id="id_karyawan" class="form-control" style="display: none;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12 col-sm-12 col-xs-12">
			<div class="widget">
				<div class="widget-header bg-sky">
                    <span class="widget-caption">Tabel Data Karyawan</span>
                </div>
                <div class="widget-body">
                	<table class="table bordered-sky table-striped table-bordered table-hover responsive" id="tblKaryawan" width="100%">
                		<thead class="bordered-sky">
                			<tr>
	                			<th class="text-center">#</th>
	                			<th class="text-center">Nama Karyawan</th>
                                <th class="text-center">Bagian</th>
                                <th class="text-center">Jabatan</th>
	                			<th class="text-center">Aksi</th>
	                		</tr>
                		</thead>
                        <tbody></tbody>
                	</table>
                </div>
			</div>
		</div>
	</div>
    <div class="modal fade bs-example-modal-sm" id="modalFoto" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-primary">
            <div class="modal-content">
                <form class="bv-form" role="form" id="frmFoto" novalidate="novalidate" enctype="multipart/form-data">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="mySmallModalLabel">Ubah Foto Karyawan</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12 col-sm-12 col-xs-12">
                                <div class="col-lg-6 col-sm-6 col-xs-12">
                                    <div class="text-center">
                                        <div id="tampilFoto"></div>
                                    </div>      
                                </div>
                                <div class="col-lg-6 col-sm-6 col-xs-12">
                                    <div class="form-group divFoto">
                                        <label for="foto_karyawan">Pilih Foto Karyawan</label>
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <span class="btn btn-sky btn-file">
                                                    Browse <input type="file" name="ubahFoto" id="ubahFoto" accept="image/*">
                                                </span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('assets/js/jquery.datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/validation/bootstrapValidator.js') }}"></script>
    <script src="{{ asset('assets/js/datetime/bootstrap-datepicker.js') }}"></script>
    <script type="text/javascript">
        // Function mencegah submit form dari tombol enter
        function stopRKey(evt) {
            var evt = (evt) ? evt : ((event) ? event : null);
            var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null);
            if ((evt.keyCode == 13) && (node.type=="text"))  {return false;}
        }
        document.onkeypress = stopRKey;

        // Function upper input nama karyawan
        function upNama(){
            var i = document.getElementById("nama_karyawan");
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
                url: "karyawan/"+id+"/edit",
                type: "GET",
                dataType: "JSON",
                beforeSend: function(){
                    $('#imgLoader').show();
                },
                success: function(data){
                    $('#frmKaryawan').bootstrapValidator('disableSubmitButtons', false).bootstrapValidator('resetForm', true);
                    $('#nama_karyawan').val(data.nama_karyawan);
                    $('#tanggal_lahir').val(data.tanggal_lahir);
                    $('#tanggal_karyawan').val(data.tanggal_karyawan);
                    $('#email').val(data.email);
                    $('#jenis_kelamin').val(data.jenis_kelamin);
                    $('#bagian').val(data.id_bagian);
                    $('#jabatan').val(data.id_jabatan);
                    $('#golongan').val(data.id_golongan);
                    $('#pendidikan').val(data.id_pendidikan);
                    $('#status_konseptor').val(data.status_konseptor);
                    $('#status_karyawan').val(data.status_karyawan);
                    $('#id_karyawan').val(data.id_karyawan);
                    $('.divFoto').hide();
                    $('#btnBatal').show();
                    $('#nama_karyawan').focus();
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

        // Function ketika tombol ubah foto
        function editFoto(id){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "karyawan/"+id+"/editFoto",
                type: "GET",
                beforeSend: function(){
                    $('#imgLoader').show();
                },
                success: function(data){
                    $('#frmKaryawan').bootstrapValidator('disableSubmitButtons', false).bootstrapValidator('resetForm', true);
                    $('#tampilFoto').html(data);
                    $(".bs-example-modal-sm").modal('show');
                },
                complete: function(){
                    $('#imgLoader').hide();
                },
                error: function(){
                    alert("Tidak dapat menampilkan data!");
                }
            });
        }

        $(document).ready(function(){
            $('#btnBatal').hide();
            $('#imgLoader').hide();
            $('body').tooltip({selector: '[data-toggle="tooltip"]'});

            $('#btnBatal').click(function(){
                $('#frmKaryawan')[0].reset();
                $('#btnBatal').hide();
                $('#nama_karyawan').focus();
                $('.divFoto').show();
            });

            var tgl_lahir = $('#tanggal_lahir').datepicker({
                autoclose: true,
                todayHighlight: true,
                format: 'yyyy-mm-dd'
            }).on('changeDate', function(ev){
                tgl_lahir.hide();
                $('#frmKaryawan').bootstrapValidator('revalidateField', 'tanggal_lahir');
            }).data('datepicker');

            var tgl_angkat = $('#tanggal_karyawan').datepicker({
                autoclose: true,
                todayHighlight: true,
                format: 'yyyy-mm-dd'
            }).on('changeDate', function(ev){
                tgl_angkat.hide();
                $('#frmKaryawan').bootstrapValidator('revalidateField', 'tanggal_karyawan');
            }).data('datepicker');

            oTable = $('#tblKaryawan').DataTable({
                initComplete: function(){
                    var api = this.api();
                    $('#tblKaryawan_filter input').off('.DT').on('keyup.DT', function(e){
                        if(e.keyCode == 13){
                            api.search(this.value).draw();
                        }
                    });
                },
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "{{ route('karyawan.data') }}",
                    "type": "GET"
                },
                "ordering": false,
                "columnDefs": [
                    {
                        className: "text-center",
                        targets: [0,4]
                    },
                    {
                        orderable: false,
                        targets: [0,4]
                    }
                ]
            });

            $('#frmKaryawan').bootstrapValidator({
                excluded: [':hidden', ':disabled'],
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    nama_karyawan: {
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
                    tanggal_lahir: {
                        validators: {
                            notEmpty: {
                                message: 'Kolom harus diisi !'
                            },
                            date: {
                                format: 'YYYY-MM-DD',
                                message: 'Format tanggal tidak valid'
                            }
                        }
                    },
                    tanggal_karyawan: {
                        validators: {
                            notEmpty: {
                                message: 'Kolom harus diisi !'
                            },
                            date: {
                                format: 'YYYY-MM-DD',
                                message: 'Format tanggal tidak valid'
                            }
                        }
                    },
                    email: {
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
                    foto: {
                        validators: {
                            notEmpty: {
                                message: 'Silahkan pilih file foto !'
                            },
                            file: {
                                extension: 'jpg,jpeg,png',
                                type: 'image/jpeg,image/png',
                                maxSize: 1048576,
                                message: 'File foto harus format jpg dan berukuran maksimal 1 Mb.'
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
                var formdata = new FormData($("#frmKaryawan")[0]);
                var id = $('#id_karyawan').val();
                if(id == ""){
                    url = "{{ route('karyawan.simpan') }}";
                }else{
                    url = "karyawan/"+id;
                }

                $.ajax({
                    url: url,
                    type: "POST",
                    data: formdata,
                    cache: false,
                    processData: false,
                    contentType: false,
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

                        $('#frmKaryawan')[0].reset();
                        $('#nama_karyawan').focus();
                        $('.divFoto').show();
                        $('#btnBatal').hide();
                        oTable.ajax.reload();
                    },
                    complete: function(){
                        $('#imgLoader').hide();
                    }
                });
                $('#frmKaryawan').bootstrapValidator('disableSubmitButtons', false).bootstrapValidator('resetForm', true);
            });

            $('#frmFoto').bootstrapValidator({
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    ubahFoto: {
                        validators: {
                            notEmpty: {
                                message: 'Silahkan pilih file foto !'
                            },
                            file: {
                                extension: 'jpg,jpeg,png',
                                type: 'image/jpeg,image/png',
                                maxSize: 1048576,
                                message: 'File foto harus format jpg dan berukuran maksimal 1 Mb.'
                            }
                        }
                    }
                }
            }).on('success.form.bv', function(e){
                e.preventDefault();
                var formdataFoto = new FormData($("#frmFoto")[0]);
                var id = $('#id_karyawanFoto').val();

                $.ajax({
                    url: "karyawan/editFoto/"+id,
                    type: "POST",
                    data: formdataFoto,
                    cache: false,
                    processData: false,
                    contentType: false,
                    dataType: 'JSON',
                    beforeSend: function(){
                        $('#imgLoader').show();
                    },
                    success: function(data){
                        if(data.status == 4){
                            var alertStatus = ['alert-success', 'Sukses!', 'Data berhasil disimpan.'];
                        }else{
                            var alertStatus = ['alert-danger', 'Gagal!', 'Data gagal disimpan/diubah.'];
                        }

                        $('#alertNotif').html("<div class='alert "+alertStatus[0]+" alert-dismissible fade in' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button><strong>"+alertStatus[1]+"</strong> "+alertStatus[2]+"</div>");
                        $('#alertNotif').fadeTo(4000, 500).slideUp(500, function(){
                            $('#alertNotif').slideUp(500);
                        });

                        $('#frmFoto')[0].reset();
                        $('#nama_karyawan').focus();
                        $('.divFoto').show();
                        $('#btnBatal').hide();
                        $('#modalFoto').modal('hide');
                        oTable.ajax.reload();
                    },
                    complete: function(){
                        $('#imgLoader').hide();
                    }
                });
                $('#frmFoto').bootstrapValidator('disableSubmitButtons', false).bootstrapValidator('resetForm', true);
            });
        });
    </script>
@endsection