@extends('layouts.app')

@section('css')
    <link href="{{ asset('assets/js/datatables.bootstrap.min.css') }}" rel="stylesheet" />
    <!-- <style type="text/css">
        .modal-body-panjang {
            height:500px;
            overflow:auto;
        }
    </style> -->
@endsection

@section('breadcrumb')
    <li>
        <i class="fa fa-hdd-o"></i>
        <a href="#">Agenda Direksi</a>
    </li>
    <li class="active">Surat Keluar Direksi</li>
@endsection

@section('title')
    Halaman Surat Keluar Direksi
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12 col-sm-12 col-xs-12">
            <div class="widget">
                <div class="widget-header bordered-bottom bordered-darkorange">
                    <span class="widget-caption">Tabel Surat Keluar Direksi</span>
                </div>
                <div class="widget-body">
                    <p class="text-center"><img src="{{ asset('assets/img/Ellipsis.gif') }}" id="imgLoader"></p>
                    <table class="table bordered-darkorange table-striped table-bordered table-hover responsive" id="tblSuratdireksi" width="100%">
                        <thead class="bordered-darkorange">
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">NO. SURAT</th>
                                <th class="text-center">PERIHAL</th>
                                <th class="text-center">TANGGAL SURAT</th>
                                <th class="text-center">AKSI</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL AGENDA DIREKSI -->
    <div class="modal fade bs-example-modal-sm" id="modalAgendadireksi" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-primary">
            <div class="modal-content">
                <form class="bv-form" role="form" id="frmAgendadireksi" novalidate="novalidate">
                    <div class="modal-header bordered-darkorange">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="mySmallModalLabel">Form Agenda Direksi</h4>
                    </div>
                    <div class="modal-body modal-body-panjang">
                        <div class="row">
                            <div class="col-lg-10 col-sm-10 col-xs-10">
                                <div class="form-group">
                                    <label for="tanggal_agenda">KETERANGAN</label>
                                    <textarea class="form-control" rows="1" name="keterangan" id="keterangan"></textarea>
                                    <i class="form-control-feedback" data-bv-field="keterangan" style="display: none;"></i>
                                </div> 
                            </div>
                            <div class="col-md-2 col-sm-2 col-lg-2 col-xs-12">
                                <label for="agenda_sk_direksi">AGENDA</label>
                                <label>
                                    <input class="checkbox-slider slider-icon colored-darkorange" type="checkbox" id="tampilAgenda" name="tampilAgenda" value="tes">
                                    <span class="text"></span>
                                </label>
                            </div>
                        </div>
                        <div class="row divAgenda">
                            <div class="col-lg-4 col-sm-4 col-xs-12">
                                <div class="form-group">
                                    <label for="id_tujuan">TUJUAN</label>
                                    <select class="form-control" name="id_tujuan" id="id_tujuan">
                                        @foreach($tujuan as $rowTujuan)
                                            <option value="{{ $rowTujuan->id_bagian }}">{{ $rowTujuan->nama_bagian }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-4 col-xs-12">
                                <div class="form-group">
                                    <label for="id_jenis_surat">MASUK SEBAGAI</label>
                                    <select class="form-control" name="id_jenis_surat" id="id_jenis_surat">
                                        @foreach($jenis as $rowSifat)
                                            <option value="{{ $rowSifat->id_jenis_surat }}">{{ $rowSifat->nama_jenis }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-4 col-xs-12">
                                <div class="form-group">
                                    <label for="tanggal_agenda">TANGGAL AGENDA</label>
                                    <input type="text" class="form-control tgl" id="tanggal_agenda" name="tanggal_agenda" data-bv-field="tanggal_agenda">
                                    <i class="form-control-feedback" data-bv-field="tanggal_agenda" style="display: none;"></i>
                                </div> 
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-sm-12 col-xs-12">
                                <div class="text-center">
                                    <div id="tampilSuratdireksi"></div>
                                    <img src="{{ asset('assets/img/Ellipsis.gif') }}" id="imgLoaderModal">
                                </div> 
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-darkorange" data-dismiss="modal">Tutup</button>
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
        // FUNCTION SURAT MASUK DIREKSI / AGENDA DIREKSI
        function agenda_sk_direksi(id){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "agenda_sk_direksi/"+id+"/agenda",
                type: "GET",
                beforeSend: function(){
                    $('#imgLoader').show();
                },
                success: function(data){
                    $('#tampilSuratdireksi').html(data);
                    $('#imgLoaderModal').hide();
                    $('#modalAgendadireksi').modal('show');
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
            $('#imgLoader').hide();
            $('#imgLoaderEksternal').hide();
            $('.divAgenda').hide();

            $('#tampilAgenda').change(function(){
                $('.divAgenda').fadeToggle();
            });

            var tgl_agenda = $('#tanggal_agenda').datepicker({
                autoclose: true,
                todayHighlight: true,
                format: 'yyyy-mm-dd'
            }).on('changeDate', function(ev){
                tgl_agenda.hide();
                $('#frmAgendadireksi').bootstrapValidator('revalidateField', 'tanggal_agenda');
            }).data('datepicker');

            // TABLE SURAT MASUK EKSTERNAL DIREKSI
            var oTableSuratdireksi = $('#tblSuratdireksi').dataTable({
                initComplete: function(){
                    var api = this.api();
                    $('#tblSuratdireksi_filter input').off('.DT').on('keyup.DT', function(e){
                        if(e.keyCode == 13){
                            api.search(this.value).draw();
                        }
                    });
                },
                "processing": true,
                "serverSide": true,
                "ordering": false,
                "pageLength": 20,
                "lengthMenu": [5, 10, 15, 20],
                "ajax": {
                    "url": "{{ route('agenda_sk_direksi.data') }}",
                    "type": "GET"
                },
                "aoColumnDefs": [{
                    "aTargets": [0,4],
                    "sWidth": "2%",
                    "sClass": "text-center"
                },{
                    "aTargets": [1],
                    "sWidth": "20%"
                },{
                    "aTargets": [3],
                    "sWidth": "13%",
                    "sClass": "text-center"
                }]
            });

            $('#frmAgendadireksi').bootstrapValidator({
                excluded: [':hidden', ':disabled'],
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    tanggal_agenda: {
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
                    keterangan: {
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
                $.ajax({
                    url: "{{ route('agenda_sk_direksi.simpan') }}",
                    type: "POST",
                    data: $('#frmAgendadireksi').serialize(),
                    dataType: 'JSON',
                    beforeSend: function(){
                        $('#imgLoaderModal').show();
                    },
                    success: function(data){
                        if(data.status == 1){
                            swal({
                                title: "Nomor Agenda Direksi : "+data.nomor,
                                text: "Surat masuk berhasil diagenda direksi.",
                                type: "success"
                            });
                        }else if(data.status == 2){
                            swal({
                                title: data.nomor,
                                text: "Surat sudah diagenda.",
                                type: "error"
                            });
                        }else if(data.status == 3){
                            swal({
                                title: data.nomor,
                                text: "Surat masuk berhasil disimpan.",
                                type: "success"
                            });
                        }else{
                            swal('Gagal !', 'Data surat gagal diagenda.', 'error');
                        }

                        oTableSuratdireksi.fnDraw();
                    },
                    complete: function(){
                        $('#imgLoaderModal').hide();
                    }
                });
                $('#modalAgendadireksi').modal('hide');
                $('#frmAgendadireksi').bootstrapValidator('disableSubmitButtons', false).bootstrapValidator('resetForm', true);
            });
        });
    </script>
@endsection