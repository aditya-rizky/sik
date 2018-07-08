@extends('layouts.app')

@section('css')
    <link href="{{ asset('assets/js/datatables.bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/js/chosen/v1.7.0/chosen.css') }}" rel="stylesheet" />
    <style type="text/css">
        .modal-body-panjang {
            height:550px;
            overflow:auto;
        }
        .modal-body-pendek {
            height:250px;
            overflow:auto;
        }
    </style>
@endsection

@section('breadcrumb')
    <li>
        <i class="fa fa-hdd-o"></i>
        <a href="#">Agenda Sentral</a>
    </li>
    <li class="active">Surat Keluar Eksternal</li>
@endsection

@section('title')
    Halaman Surat Keluar Eksternal
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12 col-sm-12 col-xs-12">
            <div class="widget">
                <div class="widget-header bordered-bottom bordered-magenta">
                    <span class="widget-caption">Form Surat Keluar Eksternal</span>
                </div>
                <div class="widget-body">
                    <form class="bv-form" role="form" id="frmSk_eksternal" novalidate="novalidate">
                        {{ csrf_field() }} {{ method_field('POST') }}
                        <div class="row">
                            <div class="col-lg-6 col-sm-6 col-xs-12">
                                <div class="widget flat">
                                    <div class="widget-body">
                                        <div class="form-title">
                                            Data Surat Keluar Eksternal
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="kode_klasifikasi">Kode Klasifikasi</label>
                                                    <div class="input-group">
                                                        <span class="input-group-btn">
                                                            <button class="btn btn-magenta" type="button" id="btnKlasifikasi" data-toggle="modal" data-target="#modalKlasifikasi"><i class="fa fa-search-plus"></i></button>
                                                        </span>
                                                        <input type="text" class="form-control" id="kode_klasifikasi" name="kode_klasifikasi" data-bv-field="kode_klasifikasi" readonly="true">
                                                    </div>
                                                    <i class="form-control-feedback" data-bv-field="kode_klasifikasi" style="display: none;"></i>
                                                </div>  
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <textarea class="form-control" rows="3" id="pokok_masalah" name="pokok_masalah" readonly="true"></textarea>
                                            <i class="form-control-feedback" data-bv-field="pokok_masalah" style="display: none;"></i>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="tanggal_surat">Tanggal Surat</label>
                                                    <input type="text" class="form-control tgl" id="tanggal_surat" name="tanggal_surat" data-bv-field="tanggal_surat">
                                                    <i class="form-control-feedback" data-bv-field="tanggal_surat" style="display: none;"></i>
                                                </div> 
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="sifat_surat">Sifat Surat</label>
                                                    <select class="form-control" name="sifat_surat" id="sifat_surat">
                                                        @foreach($sifat as $row)
                                                        <option value="{{ $row->id_sifat_surat }}">{{ $row->nama_sifat }}</option>
                                                        @endforeach
                                                    </select>
                                                </div> 
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="nama_tujuan">Tujuan</label>
                                            <textarea class="form-control" col="2" name="nama_tujuan" id="nama_tujuan" onkeyup="upNamaTujuan()"></textarea>
                                            <i class="form-control-feedback" data-bv-field="nama_tujuan" style="display: none;"></i>
                                        </div>
                                        <!-- <div class="form-group">
                                            <label for="file_surat">Upload Surat</label>
                                            <div class="input-group">
                                                <span class="input-group-btn">
                                                    <span class="btn btn-palegreen btn-file">
                                                        Browse <input type="file" name="file_surat" id="file_surat" accept="application/pdf">
                                                    </span>
                                                </span>
                                                <input type="text" class="form-control" name="namaFile" id="namaFile" readonly>
                                            </div>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-6 col-xs-12">
                                <div class="widget flat">
                                    <div class="widget-body">
                                        <div class="form-title">
                                            Data Surat Keluar Eksternal
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                <div class="form-group">
                                                    <label for="perihal">Perihal</label>
                                                    <textarea class="form-control" rows="3" id="perihal" name="perihal" onkeyup="upPerihal()" maxlength="150"></textarea>
                                                    <i class="form-control-feedback" data-bv-field="perihal" style="display: none;"></i>
                                                </div>
                                                <div class="form-group">
                                                    <label for="konseptor">Konseptor</label>
                                                    <div class="input-group">
                                                        <span class="input-group-btn">
                                                            <button class="btn btn-magenta" type="button" data-toggle="modal" data-target="#modalKonseptor"><i class="fa fa-search-plus"></i></button>
                                                        </span>
                                                        <input type="text" class="form-control" id="konseptor" name="konseptor" data-bv-field="konseptor" readonly="true">
                                                    </div>
                                                    <i class="form-control-feedback" data-bv-field="konseptor" style="display: block;"></i>
                                                </div>
                                                <div class="form-group">
                                                    <label for="tindasan">Tindasan</label>
                                                    <select class="form-control" id="tindasan" name="tindasan[]" multiple="multiple" data-placeholder="Pilih Tindasan . . .">
                                                        <option value=""></option>
                                                        @foreach($all as $row)
                                                            <option value="{{ $row->id_bagian }}">{{ $row->nama_bagian }}</option>
                                                        @endforeach
                                                    </select>
                                                    <i class="form-control-feedback" data-bv-field="nama_tujuan[]" style="display: none;"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-magenta" id="btnSimpan">Simpan</button>
                                            <button type="button" class="btn btn-yellow" id="btnBatal">Batal</button>
                                            <img src="{{ asset('assets/img/Ellipsis.gif') }}" id="imgLoader">
                                            <input type="text" name="id_sk_eksternal" id="id_sk_eksternal" class="form-control" style="display: none;">
                                            <input type="text" name="id_konseptor" class="form-control" data-bv-field="id_konseptor" style="display: none;">
                                            <input type="text" name="kd_bagian" class="form-control" data-bv-field="kd_bagian" style="display: none;" value="{{ $kdBagian }}">
                                            <input type="text" class="form-control" id="id_klas" name="id_klas" data-bv-field="id_klas" readonly="true" style="display: none;">
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-12" id="alertNotif" style="display: none;"></div>
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
                <div class="widget-header bg-magenta">
                    <span class="widget-caption">Tabel Surat Keluar Eksternal</span>
                </div>
                <div class="widget-body">
                    <table class="table bordered-magenta table-striped table-bordered table-hover responsive" id="tblSk_eksternal">
                        <thead class="bordered-magenta">
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">NO. SURAT</th>
                                <th class="text-center">TUJUAN</th>
                                <th class="text-center">PERIHAL</th>
                                <th class="text-center">AKSI</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade bs-example-modal-sm" id="modalKlasifikasi" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-magenta">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="mySmallModalLabel">Tabel Klasifikasi Surat</h4>
                </div>
                <div class="modal-body modal-body-panjang">
                    <div class="table-responsive">
                        <table class="table bordered-magenta table-striped table-bordered table-hover" id="tblKlasifikasi" width="100%">
                            <thead class="bordered-magenta">
                                <th class="text-center">No</th>
                                <th class="text-center">Aksi</th>
                                <th class="text-center">Kode</th>
                                <th class="text-center">Kamus Arsip</th>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-magenta" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade bs-example-modal-sm" id="modalKonseptor" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-magenta">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="mySmallModalLabel">Tabel Karyawan Konseptor</h4>
                </div>
                <div class="modal-body modal-body-panjang">
                    <div class="table-responsive">
                        <table class="table bordered-magenta table-striped table-bordered table-hover" id="tblKonseptor" width="100%">
                            <thead class="bordered-magenta">
                                <th class="text-center">No</th>
                                <th class="text-center">Aksi</th>
                                <th class="text-center">Nama Karyawan</th>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-magenta" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade bs-example-modal-sm" id="modalDetail" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-magenta">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="mySmallModalLabel">Detail Surat Keluar Eksternal</h4>
                </div>
                <div class="modal-body modal-body-panjang">
                    <div id="detailSurat"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-magenta" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade bs-example-modal-sm" id="modalUnggah" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-magenta">
            <div class="modal-content">
                <form class="bv-form" role="form" id="frmUnggah" novalidate="novalidate" enctype="multipart/form-data">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="mySmallModalLabel">Unggah Berkas Surat Keluar</h4>
                    </div>
                    <div class="modal-body modal-body-pendek">
                        <div id="tampilSurat"></div>
                        <!-- <div class="form-group">
                            <label for="file_surat">Upload Surat</label>
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <span class="btn btn-palegreen btn-file">
                                        Browse <input type="file" name="file_surat" id="file_surat" accept="application/pdf">
                                    </span>
                                </span>
                                <input type="text" class="form-control" name="namaFile" id="namaFile" readonly>
                            </div>
                        </div> -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-magenta" data-dismiss="modal">Tutup</button>
                        <!-- <button type="submit" class="btn btn-primary">Simpan</button> -->
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
    <script src="{{ asset('assets/js/chosen/v1.7.0/chosen.jquery.min.js') }}"></script>
    <script type="text/javascript">
        // Function mencegah submit form dari tombol enter
        function stopRKey(evt) {
            var evt = (evt) ? evt : ((event) ? event : null);
            var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null);
            if ((evt.keyCode == 13) && (node.type=="text"))  {return false;}
        }
        document.onkeypress = stopRKey;

        // Function upper input tujuan
        function upNamaTujuan(){
            var i = document.getElementById("nama_tujuan");
            i.value = i.value.toUpperCase();
        }

        // Function upper input perihal
        function upPerihal(){
            var i = document.getElementById("perihal");
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
                url: "sk_eksternal/"+id+"/edit",
                type: "GET",
                dataType: "JSON",
                beforeSend: function(){
                    $('#imgLoader').show();
                },
                success: function(data){
                    $('#frmSk_eksternal').bootstrapValidator('disableSubmitButtons', false).bootstrapValidator('resetForm', true);
                    $('[name="kode_klasifikasi"]').val(data.kode_klas);
                    $('[name="id_klas"]').val(data.id_klasifikasi);
                    $('[name="pokok_masalah"]').val(data.nama_klas);
                    $('[name="tanggal_surat"]').val(data.tanggal_surat);
                    $('[name="sifat_surat"]').val(data.sifat_surat);
                    $('[name="nama_tujuan"]').val(data.nama_tujuan);
                    $('[name="perihal"]').val(data.perihal);
                    $('[name="konseptor"]').val(data.nama_karyawan);
                    $('[name="id_sk_eksternal"]').val(data.id_sk_eksternal);
                    $('[name="id_konseptor"]').val(data.id_konseptor);
                    $('#btnKlasifikasi').hide();
                    $('#btnBatal').show();

                    var my_val = data.tindasan;
                    var str_array = my_val.split(',');
                    $('#tindasan').val(str_array).trigger("chosen:updated");
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

        // Function detail surat
        function detail_surat(id){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "sk_eksternal/"+id+"/detail",
                type: "GET",
                beforeSend: function(){
                    $('#imgLoader').show();
                },
                success: function(data){
                    $('#detailSurat').html(data);
                    $('#modalDetail').modal('show');
                },
                complete: function(){
                    $('#imgLoader').hide();
                },
                error: function(){
                    alert("Tidak dapat menampilkan data!");
                }
            });
        }

        // Function Unggah Data
        function unggah_surat(id){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "sk_eksternal/"+id+"/unggah",
                type: "GET",
                beforeSend: function(){
                    $('#imgLoader').show();
                },
                success: function(data){
                    $('#frmSk_eksternal').bootstrapValidator('disableSubmitButtons', false).bootstrapValidator('resetForm', true);
                    $('#tampilSurat').html(data);
                    $("#modalUnggah").modal('show');
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
            $('body').tooltip({selector: '[data-toggle="tooltip"]'});
            $('#btnBatal').hide();
            $('#imgLoader').hide();

            $('#btnBatal').click(function(){
                $('#frmSk_eksternal')[0].reset();
                $('#frmSk_eksternal').bootstrapValidator('disableSubmitButtons', false).bootstrapValidator('resetForm', true);
                $('#btnKlasifikasi').show();
                $('#btnBatal').hide();
                $('#tindasan').val('').trigger("chosen:updated");
            });

            $('#tindasan').chosen({
                no_results_text: "Oops, data tidak ditemukan!"
            });

            var tgl_surat = $('#tanggal_surat').datepicker({
                autoclose: true,
                todayHighlight: true,
                format: 'yyyy-mm-dd'
            }).on('changeDate', function(ev){
                tgl_surat.hide();
                $('#frmSk_eksternal').bootstrapValidator('revalidateField', 'tanggal_surat');
            }).data('datepicker');

            // TABLE SURAT
            var oTableSurat = $('#tblSk_eksternal').dataTable({
                initComplete: function(){
                    var api = this.api();
                    $('#tblSk_eksternal_filter input').off('.DT').on('keyup.DT', function(e){
                        if(e.keyCode == 13){
                            api.search(this.value).draw();
                        }
                    });
                },
                "processing": true,
                "serverSide": true,
                "ordering": false,
                "ajax": {
                    "url": "{{ route('sk_eksternal.data') }}",
                    "type": "GET"
                },
                "aoColumnDefs": [{
                    "aTargets": [0],
                    "sWidth": "2%",
                    "sClass": "text-center"
                },{
                    "aTargets": [1],
                    "sWidth": "17%"
                },{
                   "aTargets": [2],
                    "sWidth": "20%"
                },{
                   "aTargets": [4],
                    "sWidth": "10%",
                    "sClass": "text-center" 
                }]
            });

            // TABLE KLASIFIKASI
            var oTableKlasifikasi = $('#tblKlasifikasi').dataTable({
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
                "ordering": false,
                "ajax": {
                    "url": "{{ route('sk_eksternal.klasifikasi') }}",
                    "type": "GET"
                },
                "aoColumnDefs": [{
                    "aTargets": [0],
                    "sWidth": "2%",
                    "sClass": "text-center"
                },{
                    "aTargets": [1],
                    "sWidth": "5%",
                    "sClass": "text-center",
                    "mRender": function( data, type, full) {
                        return "<td><button type='button' class='btn btn-default btn-xs shiny icon-only blue tooltip-blue btnPilihKlas' data-toggle='tooltip' data-placement='top' title='Pilih Klasifikasi'><span class='fa fa-pencil'></span></button></td>";
                    }
                },{
                    "aTargets": [2],
                    "sWidth": "20%",
                },{
                    "aTargets": [3],
                }]
            });

            // TABLE KONSEPTOR
            var oTableKonseptor = $('#tblKonseptor').dataTable({
                initComplete: function(){
                    var api = this.api();
                    $('#tblKonseptor_filter input').off('.DT').on('keyup.DT', function(e){
                        if(e.keyCode == 13){
                            api.search(this.value).draw();
                        }
                    });
                },
                "processing": true,
                "serverSide": true,
                "ordering": false,
                "ajax": {
                    "url": "{{ route('sk_eksternal.konseptor') }}",
                    "type": "GET"
                },
                "aoColumnDefs": [{
                    "aTargets": [0],
                    "sWidth": "2%",
                    "sClass": "text-center"
                },{
                    "aTargets": [1],
                    "sWidth": "5%",
                    "sClass": "text-center",
                    "mRender": function( data, type, full) {
                        return "<td><button type='button' class='btn btn-default btn-xs shiny icon-only blue tooltip-blue btnPilihKonseptor' data-toggle='tooltip' data-placement='top' title='Pilih Klasifikasi'><span class='fa fa-pencil'></span></button></td>";
                    }
                },{
                    "aTargets": [2],
                    "sWidth": "20%",
                }]
            });

            // TOMBOL PILIH KLASIFIKASI
            $('#tblKlasifikasi tbody').on('click', '.btnPilihKlas', function(){
                var tr = $(this).closest('tr');
                var index = oTableKlasifikasi.fnGetPosition(tr[0]);
                var kodeKlas = oTableKlasifikasi.fnGetData(index)[2];
                var pokokKlas = oTableKlasifikasi.fnGetData(index)[3];
                var idKlas = oTableKlasifikasi.fnGetData(index)[1];

                $('[name="kode_klasifikasi"]').val(kodeKlas);
                $('[name="pokok_masalah').val(pokokKlas);
                $('[name="id_klas').val(idKlas);
                $('#frmSk_eksternal').bootstrapValidator('revalidateField', 'kode_klasifikasi');
                $('#modalKlasifikasi').modal('hide');
                return false;
            });

            // TOMBOL PILIH KONSEPTOR
            $('#tblKonseptor tbody').on('click', '.btnPilihKonseptor', function(){
                var tr = $(this).closest('tr');
                var index = oTableKonseptor.fnGetPosition(tr[0]);
                var idKaryawan = oTableKonseptor.fnGetData(index)[1];
                var namaKaryawan = oTableKonseptor.fnGetData(index)[2];

                $('[name="konseptor"]').val(namaKaryawan);
                $('[name="id_konseptor"]').val(idKaryawan);
                $('#frmSk_eksternal').bootstrapValidator('revalidateField', 'konseptor');
                $('#modalKonseptor').modal('hide');
                return false;
            });

            $('#modalKlasifikasi').on('shown.bs.modal', function(e){
                $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
            });

            $('#modalKonseptor').on('shown.bs.modal', function(e){
                $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
            });

            $('#frmSk_eksternal').bootstrapValidator({
                excluded: [':disabled',':hidden'],
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    kode_klasifikasi: {
                        validators: {
                            notEmpty: {
                                message: 'Kolom harus diisi !'
                            }
                        }
                    },
                    tanggal_surat: {
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
                    nama_tujuan: {
                        validators: {
                            notEmpty: {
                                message: 'Kolom harus diisi !'
                            }
                        }
                    },
                    perihal: {
                        validators: {
                            notEmpty: {
                                message: 'Kolom harus diisi !'
                            }
                        }
                    },
                    konseptor: {
                        validators: {
                            notEmpty: {
                                message: 'Kolom harus diisi !'
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
                var formdata = new FormData($("#frmSk_eksternal")[0]);
                var id = $('#id_sk_eksternal').val();
                if(id == ""){
                    url = "{{ route('sk_eksternal.simpan') }}";
                    type = "POST";
                }else{
                    url = "sk_eksternal/"+id;
                    type = "PUT";
                }

                $.ajax({
                    url: url,
                    type: type,
                    data: $('#frmSk_eksternal').serialize(),
                    dataType: 'JSON',
                    beforeSend: function(){
                        $('#imgLoader').show();
                    },
                    success: function(data){
                        if(data.status == 1){
                            swal({
                                title: "Nomor Surat : "+data.nomor,
                                text: "Surat masuk berhasil disimpan.",
                                type: "success",
                                width: "50%"
                            });
                        }else if(data.status == 2){
                            swal({
                                title: "Berhasil !",
                                text: "Surat keluar berhasil diubah.",
                                type: "success",
                                width: "50%"
                            });
                        }else{
                            swal('Gagal !', 'Data surat gagal disimpan.', 'error');
                        }

                        $('#btnBatal').hide();
                        $('#frmSk_eksternal')[0].reset();
                        $('#btnKlasifikasi').show();
                        $('#tindasan').val('').trigger("chosen:updated");
                        oTableSurat.fnDraw();
                    },
                    complete: function(){
                        $('#imgLoader').hide();
                    }
                });
                $('#frmSk_eksternal').bootstrapValidator('disableSubmitButtons', false).bootstrapValidator('resetForm', true);
            });
        });
    </script>
@endsection