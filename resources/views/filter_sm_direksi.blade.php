@extends('layouts.app')

@section('css')
    <link href="{{ asset('assets/js/datatables.bootstrap.min.css') }}" rel="stylesheet" />
@endsection

@section('breadcrumb')
    <li>
        <i class="fa fa-hdd-o"></i>
        <a href="#">Agenda Direksi</a>
    </li>
    <li class="active">Filter Surat Masuk Direksi</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-6 col-sm-6 col-xs-6">
            <div class="well bg-palegreen bordered-right bordered-palegreen">
                <b><u>Halaman Filter Surat Masuk Direksi</u></b><br>
                <p class="text-justify">
                    Halaman ini berfungsi untuk memfilter surat masuk dari eksternal, mana yang perlu disampaikan direksi atau tidak.
                </p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-sm-12 col-xs-12">
            <div class="widget">
                <div class="widget-header bordered-bottom bordered-palegreen">
                    <span class="widget-caption">Tabel Surat Masuk Direksi Eksternal</span>
                    <div class="widget-buttons buttons-bordered">
                        <button class="btn btn-palegreen btn-sm" onclick="deleteAll()"><i class='fa fa-send'></i> Kirim Surat</button>
                    </div>
                </div>
                <div class="widget-body">
                    <form id="frmFilter">
                        {{ csrf_field() }} {{ method_field('POST') }}
                        <p class="text-center"><img src="{{ asset('assets/img/Ellipsis.gif') }}" id="imgLoader"></p>
                        <table class="table bordered-palegreen table-striped table-bordered table-hover responsive" id="tbl_sm_eks" width="100%">
                            <thead class="bordered-palegreen">
                                <tr>
                                    <th>
                                        <label>
                                            <input type="checkbox" class="inverted" name="select-all" id="select-all" value="1">
                                            <span class="text"></span>
                                        </label>
                                    </th>
                                    <th class="text-center">#</th>
                                    <th class="text-center">NO. SURAT</th>
                                    <th class="text-center">TGL SURAT</th>
                                    <th class="text-center">PENGIRIM</th>
                                    <th class="text-center">PERIHAL</th>
                                    <th class="text-center">AKSI</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL DETAIL -->
    <div class="modal fade bs-example-modal-sm" id="modalDetail" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-primary">
            <div class="modal-content">
                <div class="modal-header bordered-palegreen">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="mySmallModalLabel">Detail Surat Internal</h4>
                </div>
                <div class="modal-body">
                    <div id="detailSurat"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-palegreen" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('assets/js/jquery.datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatables.bootstrap.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('body').tooltip({selector: '[data-toggle="tooltip"]'});
            $('#imgLoader').hide();

            $('#select-all').click(function(){
                $('input[type=checkbox]').prop('checked', this.checked);
            });

            // TABLE SURAT
            oTableSurat = $('#tbl_sm_eks').dataTable({
                initComplete: function(){
                    var api = this.api();
                    $('#tbl_sm_eks_filter input').off('.DT').on('keyup.DT', function(e){
                        if(e.keyCode == 13){
                            api.search(this.value).draw();
                        }
                    });
                },
                "processing": true,
                "serverSide": true,
                "ordering": false,
                "ajax": {
                    "url": "{{ route('filter_sm_direksi.data') }}",
                    "type": "GET"
                },
                "aoColumnDefs": [{
                    "aTargets": [0,1,6],
                    "sWidth": "2%",
                    "sClass": "text-center"
                },{
                    "aTargets": [2],
                    "sWidth": "17%"
                },{
                    "aTargets": [3],
                    "sWidth": "10%",
                    "sClass": "text-center"
                },{
                    "aTargets": [4],
                    "sWidth": "20%"
                }]
            });
        });

        // FUNCTION PROSES AGENDA SENTRAL
        function detail(id){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "filter_sm_direksi/"+id+"/detail",
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

        // FUNCTION SETUJUI SURAT MASUK
        function deleteAll(){
            if($('input:checked').length < 1){
                swal({
                    title: "Gagal !",
                    text: "Silahkan pilih salah satu surat masuk.",
                    type: "error"
                });
            }else{
                swal({
                    title: "Konfirmasi !",
                    text: "Anda yakin menyetujui surat masuk ini ?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes !'
                }).then(function(){
                    $.ajax({
                        url: "{{ route('filter_sm_direksi.kirim') }}",
                        type: "POST",
                        data: $('#frmFilter').serialize(),
                        beforeSend: function(){
                            $('#imgLoader').show();
                        },
                        success: function(data){
                            oTableSurat.fnDraw();
                            $('#select-all').prop('checked', false);

                            swal({
                                title: "Berhasil !",
                                text: "Surat masuk berhasil dikirim.",
                                type: "success"
                            });
                        },
                        complete: function(){
                            $('#imgLoader').hide();
                        },
                        error: function(){
                            alert("Tidak dapat menghapus data");
                        }
                    });
                }).catch(swal.noop);
            }
        }
    </script>
@endsection