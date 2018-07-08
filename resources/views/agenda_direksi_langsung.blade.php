@extends('layouts.app')

@section('css')
    <link href="{{ asset('assets/js/datatables.bootstrap.min.css') }}" rel="stylesheet" />
@endsection

@section('breadcrumb')
    <li>
        <i class="fa fa-hdd-o"></i>
        <a href="#">Agenda Direksi</a>
    </li>
    <li>
        <a href="#">Surat Masuk Direksi</a>
    </li>
    <li class="active">Langsung</li>
@endsection

@section('title')
    Halaman Surat Masuk Direksi Langsung
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-5 col-sm-5 col-xs-12">
            <div class="widget">
                <div class="widget-header bordered-bottom bordered-darkorange">
                    <span class="widget-caption">Pencarian Surat Masuk Direksi Langsung</span>
                </div>
                <div class="widget-body">
                    <form class="bv-form" role="form" id="frmCari" novalidate="novalidate">
                        {{ csrf_field() }} {{ method_field('POST') }}
                        <div class="row">
                            <div class="col-lg-8 col-sm-8 col-xs-12">
                                <div class="form-group">
                                    <label for="status_hakakses">Direktur</label>
                                    <select class="form-control" name="direktur" id="direktur">
                                        @foreach($tujuan as $rowTujuan)
                                            <option value="{{ $rowTujuan->id_bagian }}">{{ $rowTujuan->nama_bagian }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-4 col-xs-12">
                                <div class="form-group">
                                    <label for="status_hakakses">Tahun</label>
                                    <select class="form-control" name="tahun" id="tahun">
                                        @for ($i = date("Y"); $i >= 2017; $i--)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="button" class="btn btn-darkorange" id="btnTampil">Tampilkan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-sm-12 col-xs-12">
            <div class="widget">
                <div class="widget-header bordered-bottom bordered-darkorange">
                    <span class="widget-caption">Tabel Surat Masuk Direksi Langsung</span>
                </div>
                <div class="widget-body">
                    <p class="text-center"><img src="{{ asset('assets/img/Ellipsis.gif') }}" id="imgLoader"></p>
                    <table class="table bordered-darkorange table-striped table-bordered table-hover responsive" id="tblSuratdireksi" width="100%">
                        <thead class="bordered-darkorange">
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">NO. SURAT</th>
                                <th class="text-center">TGL SURAT</th>
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
                                <div class="form-group">
                                    <label for="tanggal_agenda">KETERANGAN</label>
                                    <textarea class="form-control" rows="1" name="keterangan" id="keterangan"></textarea>
                                    <i class="form-control-feedback" data-bv-field="keterangan" style="display: none;"></i>
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
        function agenda_direksi(id){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "agenda_direksi_langsung/"+id+"/agenda",
                type: "GET",
                beforeSend: function(){
                    $('#imgLoader').show();
                },
                success: function(data){
                    $('#tampilSuratdireksi').html(data);
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
            $('#imgLoaderModal').hide();

            var tgl_agenda = $('#tanggal_agenda').datepicker({
                autoclose: true,
                todayHighlight: true,
                format: 'yyyy-mm-dd'
            }).on('changeDate', function(ev){
                tgl_agenda.hide();
                $('#frmAgendadireksi').bootstrapValidator('revalidateField', 'tanggal_agenda');
            }).data('datepicker');

            $('#btnTampil').click(function(){
                oTableSuratdireksi.fnDraw();
            });

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
                    "url": "{{ route('agenda_direksi_langsung.data') }}",
                    // "type": "GET",
                    "data": function(d){
                        d.id_direktur = $('#direktur').val();
                        d.tahun = $('#tahun').val();
                    }
                },
                "aoColumnDefs": [{
                    "aTargets": [0,5],
                    "sWidth": "2%",
                    "sClass": "text-center"
                },{
                    "aTargets": [1],
                    "sWidth": "17%",
                },{
                    "aTargets": [2],
                    "sWidth": "12%",
                    "sClass": "text-center"
                },{
                    "aTargets": [3],
                    "sWidth": "20%"
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
                    }
                }
            }).on('success.field.bv', function(e, data){
                var $parent = data.element.parents('.form-group');
                $parent.removeClass('has-success');
                $parent.find('.form-control-feedback[data-bv-icon-for="' + data.field + '"]').hide();
            }).on('success.form.bv', function(e){
                $.ajax({
                    url: "{{ route('agenda_direksi_langsung.simpan') }}",
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
                        }else{
                            swal('Gagal !', 'Data surat gagal diagenda.', 'error');
                        }
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