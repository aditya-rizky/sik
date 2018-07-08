@extends('layouts.app')

@section('css')
    <link href="{{ asset('assets/js/datatables.bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/js/chosen/v1.7.0/chosen.css') }}" rel="stylesheet" />
@endsection

@section('breadcrumb')
    <li>
        <i class="fa fa-hdd-o"></i>
        <a href="#">Agenda Sentral</a>
    </li>
    <li class="active">Surat Keluar Karyawan</li>
@endsection

@section('title')
    Halaman Input Surat Keluar Karyawan
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12 col-sm-12 col-lg-12 col-xs-12">
            <div class="widget">
                <div class="widget-header bordered-bottom bordered-sky">
                    <span class="widget-caption">Form Surat Keluar Karyawan</span>
                </div>
                <div class="widget-body">
                    <form class="bv-form" role="form" id="frm_karyawan" novalidate="novalidate">
                        {{ csrf_field() }} {{ method_field('POST') }}
                        <div class="row">
                            <div class="col-lg-6 col-sm-6 col-xs-12">
                                <div class="widget flat">
                                    <div class="widget-body">
                                        <!-- <div class="form-title">
                                            Data Surat Keluar Internal
                                        </div> -->
                                        <div class="row">
                                            <div class="col-lg-4 col-sm-4 col-xs-12">
                                                <div class="form-group">
                                                    <label for="kode_klasifikasi">Kode Klasifikasi</label>
                                                    <div class="input-group">
                                                        <span class="input-group-btn">
                                                            <button class="btn btn-sky" type="button" id="btnKlasifikasi" data-toggle="modal" data-target="#modalKlasifikasi"><i class="fa fa-search-plus"></i></button>
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
                                            <div class="col-md-6 divSifat">
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
                                            <label for="nama_tujuan">Tujuan / Nama Karyawan</label>
                                            <select class="form-control" id="nama_tujuan" name="nama_tujuan[]" multiple="multiple" data-placeholder="Pilih Karyawan . . .">
                                                <option value=""></option>
                                                @foreach($kry as $row)
                                                    <option value="{{ $row->id_karyawan }}">{{ $row->nama_karyawan }}</option>
                                                @endforeach
                                            </select>
                                            <i class="form-control-feedback" data-bv-field="nama_tujuan[]" style="display: none;"></i>
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
                                        <!-- <div class="form-title">
                                            Data Surat Keluar Internal
                                        </div> -->
                                        <div class="form-group">
                                            <label for="perihal">Perihal</label>
                                            <textarea class="form-control" rows="3" id="perihal" name="perihal" onkeyup="upPerihal()" maxlength="150"></textarea>
                                            <i class="form-control-feedback" data-bv-field="perihal" style="display: none;"></i>
                                        </div>
                                        <div class="form-group">
                                            <label for="konseptor">Konseptor</label>
                                            <div class="input-group">
                                                <span class="input-group-btn">
                                                    <button class="btn btn-sky" type="button" data-toggle="modal" data-target="#modalKonseptor"><i class="fa fa-search-plus"></i></button>
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
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-sky" id="btnSimpan">Simpan</button>
                                            <button type="button" class="btn btn-yellow" id="btnBatal" onclick="location.href='{{ route('surat_keluar_karyawan') }}'">Batal</button>
                                            <img src="{{ asset('assets/img/Ellipsis.gif') }}" id="imgLoader">
                                            <input type="text" name="id_suratkeluar" id="id_suratkeluar" class="form-control" style="display: none;">
                                            <input type="text" name="id_tujuan" class="form-control" style="display: none;">
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

    <div class="modal fade bs-example-modal-sm" id="modalKlasifikasi" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="mySmallModalLabel">Tabel Klasifikasi Surat</h4>
                </div>
                <div class="modal-body modal-body-panjang">
                    <div class="table-responsive">
                        <table class="table bordered-sky table-striped table-bordered table-hover" id="tblKlasifikasi" width="100%">
                            <thead class="bordered-sky">
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
                    <button type="button" class="btn btn-sky" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade bs-example-modal-sm" id="modalKonseptor" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="mySmallModalLabel">Tabel Karyawan Konseptor</h4>
                </div>
                <div class="modal-body modal-body-panjang">
                    <div class="table-responsive">
                        <table class="table bordered-sky table-striped table-bordered table-hover" id="tblKonseptor" width="100%">
                            <thead class="bordered-sky">
                                <th class="text-center">No</th>
                                <th class="text-center">Aksi</th>
                                <th class="text-center">Nama Karyawan</th>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sky" data-dismiss="modal">Tutup</button>
                </div>
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

        // Function upper input perihal
        function upPerihal(){
            var i = document.getElementById("perihal");
            i.value = i.value.toUpperCase();
        }

        $(document).ready(function(){
            $('body').tooltip({selector: '[data-toggle="tooltip"]'});
            $('#imgLoader').hide();

            $('#tindasan').chosen({
                no_results_text: "Oops, data tidak ditemukan!"
            });

            var tgl_surat = $('#tanggal_surat').datepicker({
                autoclose: true,
                todayHighlight: true,
                format: 'yyyy-mm-dd'
            }).on('changeDate', function(ev){
                tgl_surat.hide();
                $('#frm_internal').bootstrapValidator('revalidateField', 'tanggal_surat');
            }).data('datepicker');

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
                    "url": "{{ route('surat_keluar_karyawan.klasifikasi') }}",
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
                    "url": "{{ route('surat_keluar_karyawan.konseptor') }}",
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
                $('form#frm_internal').bootstrapValidator('revalidateField', 'kode_klasifikasi');
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
                $('#frm_internal').bootstrapValidator('revalidateField', 'konseptor');
                $('#modalKonseptor').modal('hide');
                return false;
            });

            $('#modalKlasifikasi').on('shown.bs.modal', function(e){
                $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
            });

            $('#modalKonseptor').on('shown.bs.modal', function(e){
                $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
            });

            $('#frm_karyawan').find('[name="nama_tujuan[]"]').chosen().change(function(e){
                $('#frm_karyawan').bootstrapValidator('revalidateField', 'nama_tujuan[]');
            }).end().bootstrapValidator({
                excluded: ':disabled',
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    'nama_tujuan[]': {
                        validators: {
                            callback: {
                                message: 'Pilih minimal 1 tujuan',
                                callback: function(value, validator) {
                                    var options = validator.getFieldElements('nama_tujuan[]').val();
                                    return (options != null && options.length >= 1);
                                }
                            },
                            notEmpty: {
                                message: 'Kolom harus diisi !'
                            }
                        }
                    },
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

                $.ajax({
                    url: "{{ route('surat_keluar_karyawan.simpan') }}",
                    type: "POST",
                    data: $('#frm_karyawan').serialize(),
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

                        $('#frm_karyawan')[0].reset();
                        $('#btnKlasifikasi').show();
                        $('#nama_tujuan').val('').trigger("chosen:updated");
                        $('#tindasan').val('').trigger("chosen:updated");
                    },
                    complete: function(){
                        $('#imgLoader').hide();
                    }
                });
                $('#frm_karyawan').bootstrapValidator('disableSubmitButtons', false).bootstrapValidator('resetForm', true);
            });
        });
    </script>
@endsection