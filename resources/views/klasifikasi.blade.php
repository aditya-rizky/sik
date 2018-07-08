@extends('layouts.app')

@section('css')
    <link href="{{ asset('assets/js/datatables.bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/js/chosen/v1.7.0/chosen.min.css') }}" rel="stylesheet" />
@endsection

@section('breadcrumb')
    <li>
        <i class="fa fa-hdd-o"></i>
        <a href="#">Master Data</a>
    </li>
    <li>
        <a href="#">Data Klasifikasi</a>
    </li>
    <li class="active">Parent Klasifikasi</li>
@endsection

@section('title')
    Halaman Data Parent Klasifikasi
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-8 col-sm-8 col-lg-8 col-xs-12">
            <div class="widget">
                <div class="widget-header bordered-bottom bordered-blue">
                    <span class="widget-caption">Form Tambah Klasifikasi</span>
                </div>

                <div class="widget-body">
                    <div class="widget-main">
                        <div class="tabbable">
                            <ul class="nav nav-tabs" id="myTab9">
                                <li class="active tab-blue">
                                    <a data-toggle="tab" href="#parent">Top Klasifikasi</a>
                                </li>
                                <li class="tab-red">
                                    <a data-toggle="tab" href="#middle">Middle Klasifikasi</a>
                                </li>
                                <li class="tab-palegreen">
                                    <a data-toggle="tab" href="#bottom">Bottom Klasifikasi</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div id="parent" class="tab-pane in active">
                                    <form class="bv-form" role="form" id="frmTopKlas" novalidate="novalidate">
                                        <div class="form-group">
                                            <label for="nama_top_klas">Nama Top Klasifikasi</label>
                                            <input type="text" class="form-control" name="nama_top_klas" id="nama_top_klas" data-bv-field="nama_top_klas" maxlength="150" onkeyup="upNama()">
                                            <i class="form-control-feedback" data-bv-field="nama_top_klas" style="display: none;"></i>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3 col-sm-3 col-lg-3 col-xs-12">
                                                <div class="form-group">
                                                    <label for="kode_top_klas">Kode Klasifikasi</label>
                                                    <input type="text" class="form-control" name="kode_top_klas" id="kode_top_klas" data-bv-field="kode_top_klas" onkeyup="upKode()" maxlength="3">
                                                    <i class="form-control-feedback" data-bv-field="kode_top_klas" style="display: none;"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-9 col-sm-9 col-lg-9 col-xs-12">
                                                <div class="form-group">
                                                    <label for="status_top_klas">Status Klasifikasi</label>
                                                    <select class="form-control" name="status_top_klas" id="status_top_klas">
                                                        <option value="Y">AKTIF</option>
                                                        <option value="N">TIDAK AKTIF</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-blue" id="btnSimpanTop">Simpan</button>
                                            <button type="button" class="btn btn-warning" id="btnBatalTop">Batal</button>
                                            <img src="{{ asset('assets/img/Ellipsis.gif') }}" id="imgLoaderTop">
                                            <input type="text" name="id_top" id="id_top" class="form-control" style="display: none;">
                                        </div>
                                    </form>
                                </div>
                                <div id="middle" class="tab-pane">
                                    <form class="bv-form" role="form" id="frmMiddleKlas" novalidate="novalidate">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-6 col-lg-6 col-xs-12">
                                                <div class="form-group">
                                                    <label for="kode_middle_klas"">Kode Top Klasifikasi</label>
                                                    <select class="form-control" name="kode_middle_klas" id="kode_middle_klas"></select>
                                                    <i class="form-control-feedback" data-bv-field="kode_middle_klas" style="display: none;"></i>
                                                </div>  
                                            </div>
                                            <div class="col-md-4 col-sm-4 col-lg-4 col-xs-12">
                                                 <div class="form-group">
                                                    <label for="status_mid_klas">Status Klasifikasi</label>
                                                    <select class="form-control" name="status_mid_klas" id="status_mid_klas">
                                                        <option value="Y">AKTIF</option>
                                                        <option value="N">TIDAK AKTIF</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-2 col-sm-2 col-lg-2 col-xs-12">
                                                <label for="status_mid_klas">Detail</label>
                                                <label>
                                                    <input class="checkbox-slider slider-icon colored-success" type="checkbox" id="tampilDetail" name="tampilDetail" value="tes">
                                                    <span class="text"></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row divDetail">
                                            <div class="col-md-4 col-sm-4 col-lg-4 col-xs-12">
                                                <div class="form-group">
                                                    <label for="retensi_aktif"">Durasi Retensi Aktif</label>
                                                    <select class="form-control" name="retensi_aktif" id="retensi_aktif">
                                                        @foreach($aktif as $rowAktif)
                                                            <option value="{{ $rowAktif->id_retensi_aktif }}">{{ $rowAktif->nama_retensi }}</option>
                                                        @endforeach
                                                    </select>
                                                    <i class="form-control-feedback" data-bv-field="retensi_aktif" style="display: none;"></i>
                                                </div>  
                                            </div>
                                            <div class="col-md-4 col-sm-4 col-lg-4 col-xs-12">
                                                 <div class="form-group">
                                                    <label for="retensi_inaktif">Durasi Retensi Inaktif</label>
                                                    <select class="form-control" name="retensi_inaktif" id="retensi_inaktif">
                                                        @foreach($inaktif as $rowInaktif)
                                                            <option value="{{ $rowInaktif->id_retensi_inaktif }}">{{ $rowInaktif->nama_retensi }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-4 col-lg-4 col-xs-12">
                                                 <div class="form-group">
                                                    <label for="retensi_deskripsi">Perlakuan setelah inaktif</label>
                                                    <select class="form-control" name="retensi_deskripsi" id="retensi_deskripsi">
                                                        @foreach($desk as $rowDesk)
                                                            <option value="{{ $rowDesk->id_retensi_ket }}">{{ $rowDesk->nama_ket }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="nama_middle_klas"">Uraian Middle Klasifikasi</label>
                                            <textarea class="form-control" id="nama_middle_klas" name="nama_middle_klas"></textarea>
                                            <i class="form-control-feedback" data-bv-field="nama_middle_klas" style="display: none;"></i>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-blue" id="btnSimpanMiddle">Simpan</button>
                                            <button type="button" class="btn btn-warning" id="btnBatalMiddle">Batal</button>
                                            <img src="{{ asset('assets/img/Ellipsis.gif') }}" id="imgLoaderMiddle">
                                            <input type="text" name="id_middle_klas" id="id_middle_klas" class="form-control" style="display: none;">
                                        </div>
                                    </form>
                                </div>
                                <div id="bottom" class="tab-pane">
                                    <form class="bv-form" role="form" id="frmBottomKlas" novalidate="novalidate">
                                        <div class="row">
                                            <div class="col-md-8 col-sm-8 col-lg-8 col-xs-12">
                                                <div class="form-group">
                                                    <label for="kode_bottom_klas"">Kode Middle Klasifikasi</label>
                                                    <select class="form-control" name="kode_bottom_klas" id="kode_bottom_klas"></select>
                                                    <i class="form-control-feedback" data-bv-field="kode_bottom_klas" style="display: none;"></i>
                                                </div>  
                                            </div>
                                            <div class="col-md-4 col-sm-4 col-lg-4 col-xs-12">
                                                 <div class="form-group">
                                                    <label for="status_bottom_klas">Status Klasifikasi</label>
                                                    <select class="form-control" name="status_bottom_klas" id="status_bottom_klas">
                                                        <option value="Y">AKTIF</option>
                                                        <option value="N">TIDAK AKTIF</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4 col-sm-4 col-lg-4 col-xs-12">
                                                <div class="form-group">
                                                    <label for="retensi_aktif"">Durasi Retensi Aktif</label>
                                                    <select class="form-control" name="retensi_aktif" id="retensi_aktif">
                                                        @foreach($aktif as $rowAktif)
                                                            <option value="{{ $rowAktif->id_retensi_aktif }}">{{ $rowAktif->nama_retensi }}</option>
                                                        @endforeach
                                                    </select>
                                                    <i class="form-control-feedback" data-bv-field="retensi_aktif" style="display: none;"></i>
                                                </div>  
                                            </div>
                                            <div class="col-md-4 col-sm-4 col-lg-4 col-xs-12">
                                                 <div class="form-group">
                                                    <label for="retensi_inaktif">Durasi Retensi Inaktif</label>
                                                    <select class="form-control" name="retensi_inaktif" id="retensi_inaktif">
                                                        @foreach($inaktif as $rowInaktif)
                                                            <option value="{{ $rowInaktif->id_retensi_inaktif }}">{{ $rowInaktif->nama_retensi }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-4 col-lg-4 col-xs-12">
                                                 <div class="form-group">
                                                    <label for="retensi_deskripsi">Perlakuan setelah inaktif</label>
                                                    <select class="form-control" name="retensi_deskripsi" id="retensi_deskripsi">
                                                        @foreach($desk as $rowDesk)
                                                            <option value="{{ $rowDesk->id_retensi_ket }}">{{ $rowDesk->nama_ket }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="nama_bottom_klas"">Uraian Bottom Klasifikasi</label>
                                            <textarea class="form-control" id="nama_bottom_klas" name="nama_bottom_klas"></textarea>
                                            <i class="form-control-feedback" data-bv-field="nama_bottom_klas" style="display: none;"></i>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-blue" id="btnSimpanBottom">Simpan</button>
                                            <button type="button" class="btn btn-warning" id="btnBatalBottom">Batal</button>
                                            <img src="{{ asset('assets/img/Ellipsis.gif') }}" id="imgLoaderBottom">
                                            <input type="text" name="id_bottom_klas" id="id_bottom_klas" class="form-control" style="display: none;">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-4 col-xs-12 col-md-4">
            <div class="form-group">
                <div id="alertNotif" style="display: none;"></div>
            </div>
        </div>
    </div>

	<div class="row">
		<div class="col-lg-12 col-sm-12 col-xs-12">
			<div class="widget">
				<div class="widget-header bg-blue">
                    <span class="widget-caption">Tabel Data Parent Klasifikasi</span>
                </div>
                <div class="widget-body">
                	<table class="table bordered-blue table-striped table-bordered table-hover responsive" id="tblKlasifikasi" width="100%">
                		<thead class="bordered-blue">
                			<tr>
	                			<th class="text-center">#</th>
	                			<th class="text-center">Kode Klasifikasi</th>
                                <th class="text-center">Uraian Klasifikasi</th>
                                <th class="text-center">Status</th>
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
    <script src="{{ asset('assets/js/summernote/summernote.js') }}"></script>
    <script src="{{ asset('assets/js/chosen/v1.7.0/chosen.jquery.min.js') }}"></script>
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
            var i = document.getElementById("nama_top_klas");
            i.value = i.value.toUpperCase();
        }

        // Function upper input nama bagian
        function upKode(){
            var i = document.getElementById("kode_top_klas");
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
                url: "klasifikasi/"+id+"/edit",
                type: "GET",
                dataType: "JSON",
                beforeSend: function(){
                    $('#imgLoader').show();
                },
                success: function(data){
                    $('#frmParent').bootstrapValidator('disableSubmitButtons', false).bootstrapValidator('resetForm', true);
                    $('#nama_parent').val(data.deskripsi_parent);
                    $('#kode_parent').val(data.kode_parent);
                    $('#id_parent').val(data.id_parent);
                    $('#kode_parent').attr('disabled', true);
                    $('#btnBatal').show();
                    $('#nama_parent').focus();
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

        // Function ajax combo middle
        function listTop(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{ route('klasifikasi.listTop') }}",
                type: "GET",
                dataType: "JSON",
                beforeSend: function(){
                    $('#imgLoader').show();
                },
                success: function(data){
                    $('#kode_middle_klas').empty();
                    $.each(data, function(key, value){
                        $('#kode_middle_klas').append('<option value="'+ value.id_parent +'">'+value.kode_parent+' - '+value.deskripsi_parent+'</option>');
                    });
                },
                complete: function(){
                    $('#imgLoader').hide();
                },
                error: function(){
                    alert("Data Top Klasifikasi belum ada!");
                }
            });
            return false;
        }

        // Function ajax combo bottom
        function listMiddle(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{ route('klasifikasi.listMiddle') }}",
                type: "GET",
                dataType: "JSON",
                beforeSend: function(){
                    $('#imgLoader').show();
                },
                success: function(data){
                    $('#kode_bottom_klas').empty();
                    $.each(data, function(key, value){
                        $('#kode_bottom_klas').append('<option value="'+ value.id_klas +'">'+value.kode_klas+'</option>');
                    });
                },
                complete: function(){
                    $('#imgLoader').hide();
                },
                error: function(){
                    alert("Data Middle Klasifikasi belum ada!");
                }
            });
            return false;
        }

        $(document).ready(function(){
            $('#btnBatalTop').hide();
            $('#btnBatalMiddle').hide();
            $('#btnBatalBottom').hide();
            $('#imgLoaderTop').hide();
            $('#imgLoaderMiddle').hide();
            $('#imgLoaderBottom').hide();
            $('body').tooltip({selector: '[data-toggle="tooltip"]'});
            $('.divDetail').hide();
            listTop();
            listMiddle();

            $('#btnBatal').click(function(){
                $('#frmParent')[0].reset();
                $('#btnBatal').hide();
                $('#nama_parent').focus();
            });

            $('#nama_middle_klas').summernote({
                height: 150,
                minHeight: null,
                maxHeight: null,
                toolbar: [
                    ['para', ['ul', 'ol']]
                ]
            });

            $('#nama_bottom_klas').summernote({
                height: 150,
                minHeight: null,
                maxHeight: null,
                toolbar: [
                    ['para', ['ol']]
                ]
            });

            oTable = $('#tblKlasifikasi').DataTable({
                initComplete: function(){
                    var api = this.api();
                    $('#tblKlasifikasi_filter input').off('.DT').on('keyup.DT', function(e){
                        if(e.keyCode == 13){
                            api.search(this.value).draw();
                        }
                    });
                },
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "{{ route('klasifikasi.data') }}",
                    "type": "GET"
                },
                "ordering": false,
                "pageLength": 50,
                "columnDefs": [
                    {
                        width: "1%",
                        className: "text-center",
                        targets: [0]
                    },{
                        width: "15%",
                        targets: [1]
                    },{
                        width: "1%",
                        className: "text-center",
                        targets: [3,4]
                    }
                ]
            });

            $('#tampilDetail').change(function(){
                $('.divDetail').fadeToggle();
            });

            $('#frmTopKlas').bootstrapValidator({
                excluded: [':hidden', ':disabled'],
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    nama_top_klas: {
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
                    kode_top_klas: {
                        validators: {
                            notEmpty: {
                                message: 'Kolom harus diisi !'
                            },
                            stringLength: {
                                max: 3,
                                message: 'Maksimal 3 karakter yang diperbolehkan'
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
                var id = $('#id_top').val();
                if(id == ""){
                    url = "{{ route('klasifikasi.simpan_top') }}";
                    type = "POST";
                }

                $.ajax({
                    url: url,
                    type: type,
                    data: $('#frmTopKlas').serialize(),
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

                        $('#frmTopKlas')[0].reset();
                        $('#nama_top_klas').focus();
                        $('#btnBatal').hide();
                        oTable.ajax.reload();
                    },
                    complete: function(){
                        $('#imgLoader').hide();
                        listTop();
                    }
                });
                $('#frmTopKlas').bootstrapValidator('disableSubmitButtons', false).bootstrapValidator('resetForm', true);
            });

            $('#frmMiddleKlas').submit(function(e){  
                e.preventDefault();       
                var a = $('#nama_middle_klas').val();

                if (a == "" || a == "<p><br></p>" || a == "<br>") {
                    swal('Gagal !', 'Data Uraian Middle Klasifikasi harus diisi.', 'error');
                }else{
                    $.ajax({
                        url: "{{ route('klasifikasi.simpan_mid') }}",
                        type: "POST",
                        data: $('#frmMiddleKlas').serialize(),
                        dataType: 'JSON',
                        beforeSend: function(){
                            $('#imgLoader').show();
                        },
                        success: function(data){
                            if(data.status == 1){
                                var alertStatus = ['alert-success', 'Sukses!', 'Data berhasil disimpan dengan nomor : <strong>'+data.urut+'</strong>'];
                            }else if(data.status == 2){
                                var alertStatus = ['alert-success', 'Sukses!', 'Data berhasil diubah.'];
                            }else{
                                var alertStatus = ['alert-danger', 'Gagal!', 'Data gagal disimpan/diubah.'];
                            }

                            $('#alertNotif').html("<div class='alert "+alertStatus[0]+" alert-dismissible fade in' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button><strong>"+alertStatus[1]+"</strong> "+alertStatus[2]+"</div>");
                            $('#alertNotif').fadeTo(8000, 500).slideUp(500, function(){
                                $('#alertNotif').slideUp(500);
                            });

                            $('#btnBatal').hide();
                            $('#nama_middle_klas').code('');
                            listMiddle();
                            oTable.ajax.reload();
                        },
                        complete: function(){
                            $('#imgLoader').hide();
                        }
                    });
                }              
            });

            $('#frmBottomKlas').submit(function(e){
                e.preventDefault();       
                var a = $('#nama_bottom_klas').val();

                if (a == "" || a == "<p><br></p>" || a == "<br>") {
                    swal('Gagal !', 'Data Uraian Bottom Klasifikasi harus diisi.', 'error');
                }else{
                    $.ajax({
                        url: "{{ route('klasifikasi.simpan_bot') }}",
                        type: "POST",
                        data: $('#frmBottomKlas').serialize(),
                        dataType: 'JSON',
                        beforeSend: function(){
                            $('#imgLoader').show();
                        },
                        success: function(data){
                            if(data.status == 1){
                                var alertStatus = ['alert-success', 'Sukses!', 'Data berhasil disimpan dengan nomor : <strong>'+data.urut+'</strong>'];
                            }else if(data.status == 2){
                                var alertStatus = ['alert-success', 'Sukses!', 'Data berhasil diubah.'];
                            }else{
                                var alertStatus = ['alert-danger', 'Gagal!', 'Data gagal disimpan/diubah.'];
                            }

                            $('#alertNotif').html("<div class='alert "+alertStatus[0]+" alert-dismissible fade in' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button><strong>"+alertStatus[1]+"</strong> "+alertStatus[2]+"</div>");
                            $('#alertNotif').fadeTo(8000, 500).slideUp(500, function(){
                                $('#alertNotif').slideUp(500);
                            });

                            $('#nama_bottom_klas').code('');
                            oTable.ajax.reload();
                        },
                        complete: function(){
                            $('#imgLoader').hide();
                        }
                    });
                } 
            });
        });
    </script>
@endsection