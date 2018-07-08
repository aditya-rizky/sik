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
    <li class="active">Disposisi Direksi</li>
@endsection

@section('title')
    Halaman Disposisi Direksi
@endsection

@section('content')
    <div class="row divForm">
        <div class="col-lg-12 col-sm-12 col-xs-12">
            <div class="widget">
                <div class="widget-header bordered-bottom bordered-maroon">
                    <span class="widget-caption">Form Agenda Disposisi Direksi</span>
                </div>
                <div class="widget-body">
                    <form class="bv-form" role="form" id="frmAgendadisposisi" novalidate="novalidate">
                        {{ csrf_field() }} {{ method_field('POST') }}
                        <div class="row">
                            <div class="col-lg-6 col-sm-6 col-xs-12">
                                <div class="row">
                                    <div class="col-sm-4 col-md-4 col-xs-12">
                                       <div class="form-group">
                                            <label for="nomor_agenda">Nomor Agenda Direksi</label>
                                            <input type="text" class="form-control" id="nomor_agenda" name="nomor_agenda" readonly="true">
                                            <i class="form-control-feedback" data-bv-field="nomor_agenda" style="display: none;"></i>
                                        </div> 
                                    </div>
                                    <div class="col-sm-8 col-md-8 col-xs-12">
                                        <div class="form-group">
                                            <label for="nomor_surat">Nomor Surat</label>
                                            <input type="text" class="form-control" id="nomor_surat" disabled="true">
                                        </div> 
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4 col-md-4 col-xs-12">
                                       <div class="form-group">
                                            <label for="nomor_agenda">Tanggal Distribusi</label>
                                            <input type="text" class="form-control" id="tanggal_distribusi" name="tanggal_distribusi">
                                            <i class="form-control-feedback" data-bv-field="tanggal_distribusi" style="display: none;"></i>
                                        </div> 
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="uraian_disposisi">Tujuan Disposisi</label>
                                    <select class="form-control" id="tujuan_disposisi" name="tujuan_disposisi[]" multiple="multiple" data-placeholder="Pilih Tujuan Disposisi . . .">
                                        <option value=""></option>
                                        @foreach($all as $row)
                                            <option value="{{ $row->id_bagian }}">{{ $row->nama_bagian }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="uraian_disposisi">Disposisi Direksi</label>
                                    <select class="form-control" id="disposisi_direksi" name="disposisi_direksi[]" multiple="multiple" data-placeholder="Pilih Disposisi . . .">
                                        <option value=""></option>
                                        @foreach($dispo as $row)
                                            <option value="{{ $row->id_disposisi_direksi }}">{{ $row->nama_disposisi }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-maroon" id="btnSimpan">Simpan</button>
                                    <button type="button" class="btn btn-yellow" id="btnBatal">Batal</button>
                                    <img src="{{ asset('assets/img/Ellipsis.gif') }}" id="imgLoaderSimpan">
                                    <input type="text" name="id_agenda_direksi" id="id_agenda_direksi" class="form-control" style="display: none;">
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="uraian_disposisi">Uraian Disposisi</label>
                                    <textarea class="form-control" rows="14" id="uraian_disposisi" name="uraian_disposisi" onkeyup="upDisposisi()"></textarea>
                                    <i class="form-control-feedback" data-bv-field="uraian_disposisi" style="display: none;"></i>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row divData">
        <div class="col-lg-12 col-sm-12 col-xs-12">
            <div class="widget">
                <div class="widget-header bordered-bottom bordered-maroon">
                    <span class="widget-caption">Tabel Disposisi Direksi</span>
                </div>
                <div class="widget-body">
                    <p class="text-center"><img src="{{ asset('assets/img/Ellipsis.gif') }}" id="imgLoader"></p>
                    <table class="table bordered-maroon table-striped table-bordered table-hover responsive" id="tblDisposisi_direksi">
                        <thead class="bordered-maroon">
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">NO. AGENDA</th>
                                <th class="text-center">TANGGAL AGENDA</th>
                                <th class="text-center">NO. SURAT</th>
                                <th class="text-center">DISPOSISI</th>
                                <th class="text-center">AKSI</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade bs-example-modal-sm" id="modalDetail" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-maroon">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="mySmallModalLabel">Detail Disposisi Direksi</h4>
                </div>
                <div class="modal-body modal-body-panjang">
                    <div id="detailDisposisi"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-maroon" data-dismiss="modal">Tutup</button>
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

        // Function upper input disposisi
        function upDisposisi(){
            var i = document.getElementById("uraian_disposisi");
            i.value = i.value.toUpperCase();
        }

        // Function detail disposisi
        function detail_disposisi(id){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "disposisi_direksi/"+id+"/detail",
                type: "GET",
                beforeSend: function(){
                    $('#imgLoader').show();
                },
                success: function(data){
                    $('#detailDisposisi').html(data);
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

        // Function agenda disposisi direksi
        function disposisi_direksi(id){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "disposisi_direksi/"+id+"/disposisi",
                type: "GET",
                dataType: "JSON",
                beforeSend: function(){
                    $('#imgLoader').show();
                },
                success: function(data){
                    $('#frmAgendadisposisi').bootstrapValidator('disableSubmitButtons', false).bootstrapValidator('resetForm', true);
                    $('#nomor_agenda').val(data.nomor_agenda);
                    $('#nomor_surat').val(data.nomor_surat);
                    $('#id_agenda_direksi').val(data.id_agenda_direksi);
                    $('#tanggal_distribusi').val(data.tanggal_bagian);
                    $('#uraian_disposisi').val(data.uraian_disposisi);
                    $('#btnBatal').show();

                    var my_val = data.tujuan_disposisi;
                    var str_array = my_val.split(',');
                    $('#tujuan_disposisi').val(str_array).trigger("chosen:updated");

                    var my_val = data.disposisi_direksi;
                    var str_array = my_val.split(',');
                    $('#disposisi_direksi').val(str_array).trigger("chosen:updated");
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
            $('#imgLoaderSimpan').hide();
            $('#btnBatal').hide();

            $('#btnBatal').click(function(){
                $('#frmAgendadisposisi')[0].reset();
                $('#btnBatal').hide();
                $('#frmAgendadisposisi').bootstrapValidator('disableSubmitButtons', false).bootstrapValidator('resetForm', true);
                $('#tujuan_disposisi').val('').trigger("chosen:updated");
                $('#disposisi_direksi').val('').trigger("chosen:updated");            
            });

            var tgl_dist = $('#tanggal_distribusi').datepicker({
                autoclose: true,
                todayHighlight: true,
                format: 'yyyy-mm-dd'
            }).on('changeDate', function(ev){
                tgl_dist.hide();
                $('#frmAgendadisposisi').bootstrapValidator('revalidateField', 'tanggal_distribusi');
            }).data('datepicker');

            $('#tujuan_disposisi').chosen({
                no_results_text: "Oops, data tidak ditemukan!"
            });

            $('#disposisi_direksi').chosen({
                no_results_text: "Oops, data tidak ditemukan!"
            });

            // TABLE DISPOSISI DIREKSI
            var oTabledisposisi = $('#tblDisposisi_direksi').dataTable({
                initComplete: function(){
                    var api = this.api();
                    $('#tblDisposisi_direksi_filter input').off('.DT').on('keyup.DT', function(e){
                        if(e.keyCode == 13){
                            api.search(this.value).draw();
                        }
                    });
                },
                "processing": true,
                "serverSide": true,
                "ordering": false,
                "ajax": {
                    "url": "{{ route('disposisi_direksi.data') }}",
                    "type": "GET"
                },
                "aoColumnDefs": [{
                    "aTargets": [0],
                    "sWidth": "2%",
                    "sClass": "text-center"
                },{
                    "aTargets": [1],
                    "sWidth": "10%",
                    "sClass": "text-right"
                },{
                    "aTargets": [2],
                    "sWidth": "15%",
                    "sClass": "text-center"
                },{
                    "aTargets": [3],
                    "sWidth": "20%"
                },{
                   "aTargets": [5],
                    "sWidth": "7%",
                    "sClass": "text-center" 
                }]
            });

            // SUBMIT FORM
            $('#frmAgendadisposisi').bootstrapValidator({
                excluded: [':hidden', ':disabled'],
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    nomor_agenda: {
                        validators: {
                            notEmpty: {
                                message: 'Kolom harus diisi !'
                            }
                        }
                    },
                    uraian_disposisi: {
                        validators: {
                            notEmpty: {
                                message: 'Kolom harus diisi !'
                            }
                        }
                    },
                    tanggal_distribusi: {
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
                e.preventDefault();
                var id = $('#id_agenda_direksi').val();

                $.ajax({
                    url: "disposisi_direksi/"+id,
                    type: "PUT",
                    data: $('#frmAgendadisposisi').serialize(),
                    dataType: 'JSON',
                    beforeSend: function(){
                        $('#imgLoaderSimpan').show();
                    },
                    success: function(data){
                        if(data.status == 1){
                            swal({
                                title: "Berhasil !",
                                text: "Disposisi Direksi berhasil disimpan/diubah.",
                                type: "success",
                                width: "50%"
                            });
                        }else{
                            swal('Gagal !', 'Data surat gagal disimpan.', 'error');
                        }

                        $('#frmAgendadisposisi')[0].reset();
                        $('#btnBatal').hide();
                        $('#tujuan_disposisi').val('').trigger("chosen:updated");
                        $('#disposisi_direksi').val('').trigger("chosen:updated");
                        oTabledisposisi.fnDraw();
                    },
                    complete: function(){
                        $('#imgLoaderSimpan').hide();
                    }
                });
                $('#frmAgendadisposisi').bootstrapValidator('disableSubmitButtons', false).bootstrapValidator('resetForm', true);
            });
        });
    </script>
@endsection