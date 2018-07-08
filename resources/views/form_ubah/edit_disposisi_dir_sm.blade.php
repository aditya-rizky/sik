@extends('layouts.app')

@section('css')
    <link href="{{ asset('assets/js/datatables.bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/js/chosen/v1.7.0/chosen.css') }}" rel="stylesheet" />
@endsection

@section('breadcrumb')
    <li>
        <i class="fa fa-hdd-o"></i>
        <a href="#">Agenda Direksi</a>
    </li>
    <li>
        <a href="#">Disposisi Direksi</a>
    </li>
    <li class="active">Surat Masuk Langsung</li>
@endsection

@section('title')
    Halaman Disposisi Direksi - Surat Masuk Langsung
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12 col-sm-12 col-xs-12">
            <div class="widget">
                <div class="widget-header bordered-bottom bordered-darkorange">
                    <span class="widget-caption">Form Disposisi Direksi - Surat Langsung</span>
                </div>
                <div class="widget-body">
                    <form class="bv-form" role="form" id="frmAgendadisposisi" method="POST" action="{{ $url }}" novalidate="novalidate">
                        {{ csrf_field() }} {{ method_field('POST') }}
                        <div class="row">
                            <div class="col-lg-6 col-sm-6 col-xs-12">
                                <div class="row">
                                    <div class="col-sm-8 col-md-8 col-xs-12">
                                       <div class="form-group">
                                            <label for="nomor_surat">Nomor Surat</label>
                                            <input type="text" class="form-control" id="nomor_surat" name="nomor_surat" readonly="true" value="{{ $detail->nomor_surat }}">
                                            <i class="form-control-feedback" data-bv-field="nomor_agenda" style="display: none;"></i>
                                        </div> 
                                    </div>
                                    <div class="col-sm-4 col-md-4 col-xs-12">
                                        <div class="form-group">
                                            <label for="tanggal_surat">Tanggal Agenda</label>
                                            <input type="text" class="form-control" id="tanggal_surat" disabled="true" value="{{ date('d M Y', strtotime($surat->tanggal_agenda)) }}">
                                        </div> 
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-8 col-md-8 col-xs-12">
                                        <div class="form-group">
                                            <label for="uraian_disposisi">Perihal Surat</label>
                                            <textarea class="form-control" rows="2" id="perihal" name="perihal" readonly="true">{{ $detail->perihal }}</textarea>
                                            <i class="form-control-feedback" data-bv-field="perihal" style="display: none;"></i>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-md-4 col-xs-12">
                                        <div class="form-group">
                                            <label for="nomor_agenda">Nomor Agenda</label>
                                            <input type="text" class="form-control" id="nomor_agenda" name="nomor_agenda" readonly="true" value="{{ $surat->nomor_agenda }}">
                                            <i class="form-control-feedback" data-bv-field="perihal" style="display: none;"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-8 col-md-8 col-xs-12">
                                        <div class="form-group">
                                            <label for="uraian_disposisi">Uraian Disposisi</label>
                                            <textarea class="form-control" rows="8" id="uraian_disposisi" name="uraian_disposisi" onkeyup="upUraian()">{{ $surat->uraian_dispo }}</textarea>
                                            <i class="form-control-feedback" data-bv-field="uraian_disposisi" style="display: none;"></i>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-md-4 col-xs-12">
                                        <div class="form-group">
                                            <label for="tanggal_bagian">Tanggal bagian</label>
                                            <input type="text" class="form-control" id="tanggal_bagian" name="tanggal_bagian" value="{{ $surat->tanggal_bagian }}">
                                            <i class="form-control-feedback" data-bv-field="tanggal_bagian" style="display: none;"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-darkorange" id="btnSimpan">Simpan</button>
                                    <button type="button" class="btn btn-yellow" id="btnBatal" onclick="location.href='{{ route('disposisi_direksi_sm') }}'">Batal</button>
                                    <img src="{{ asset('assets/img/Ellipsis.gif') }}" id="imgLoaderSimpan">
                                    <input type="text" name="id_agenda" id="id_agenda" class="form-control" style="display: none;" value="{{ $surat->id_agenda }}">
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-6 col-xs-12">
                                <div class="row">
                                    <div class="col-lg-6 col-sm-6 col-xs-12">
                                        @foreach($dir as $row)
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" class="colored-danger" name="tujuan_disposisi[]" value="{{ $row->id_bagian }}" {{ (in_array($row->id_bagian, $selected_tujuan)) ? 'checked' : '' }}>
                                                <span class="text">{{ $row->nama_bagian }}</span>
                                            </label>
                                        </div>
                                        @endforeach
                                        <br>
                                        @foreach($bag as $row)
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" class="colored-danger" name="tujuan_disposisi[]" value="{{ $row->id_bagian }}" {{ (in_array($row->id_bagian, $selected_tujuan)) ? 'checked' : '' }}>
                                                <span class="text">{{ $row->nama_bagian }}</span>
                                            </label>
                                        </div>
                                        @endforeach
                                    </div>
                                    <div class="col-lg-6 col-sm-6 col-xs-12">
                                        @foreach($dispo as $row)
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" class="colored-danger" name="disposisi_direksi[]" value="{{ $row->id_disposisi_direksi }}" {{ (in_array($row->id_disposisi_direksi, $selected_disposisi)) ? 'checked' : '' }}>
                                                <span class="text">{{ $row->nama_disposisi }}</span>
                                            </label>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
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
        // FUNCTION UPPER URAIAN DISPOSISI
        function upUraian(){
            var i = document.getElementById("uraian_disposisi");
            i.value = i.value.toUpperCase();
        }

        $(document).ready(function(){
            $('body').tooltip({selector: '[data-toggle="tooltip"]'});
            $('#imgLoaderSimpan').hide();

            var tgl_agenda = $('#tanggal_bagian').datepicker({
                autoclose: true,
                todayHighlight: true,
                format: 'yyyy-mm-dd'
            }).on('changeDate', function(ev){
                tgl_agenda.hide();
                $('#frmAgendadisposisi').bootstrapValidator('revalidateField', 'tanggal_bagian');
            }).data('datepicker');

            $('#frmAgendadisposisi').bootstrapValidator({
                excluded: ':disabled',
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    uraian_disposisi: {
                        validators: {
                            notEmpty: {
                                message: 'Kolom harus diisi !'
                            }
                        }
                    },
                    tanggal_bagian: {
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
            });
        });
    </script>
@endsection