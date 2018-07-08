@extends('layouts.app')

@section('css')
    <link href="{{ asset('assets/js/datatables.bootstrap.min.css') }}" rel="stylesheet" />
@endsection

@section('breadcrumb')
    <li>
        <i class="fa fa-home"></i>
        <a href="#">Beranda</a>
    </li>
    <li class="active">Laporan Surat Masuk Bagian Tindasan</li>
@endsection

@section('title')
    Halaman Laporan Surat Masuk Bagian Tindasan
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12 col-sm-12 col-xs-12">
            <div class="widget">
                <div class="widget-header bordered-bottom bordered-purple">
                    <span class="widget-caption">Tabel Surat Keluar Bagian Tindasan</span>
                </div>
                <div class="widget-body">
                    <p class="text-center"><img src="{{ asset('assets/img/Ellipsis.gif') }}" id="imgLoader"></p>
                    <table class="table bordered-purple table-striped table-bordered table-hover responsive" id="tbl_surat_masuk_tindsan" width="100%">
                        <thead class="bordered-purple">
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

    <!-- MODAL DETAIL SURAT -->
    <div class="modal fade bs-example-modal-sm" id="modal_detail" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-primary">
            <div class="modal-content">
                <div class="modal-header bordered-purple">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="mySmallModalLabel">Detail Surat Masuk Bagian Tindasan</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12 col-sm-12 col-xs-12">
                            <div id="tampilSurat"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-purple" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('assets/js/jquery.datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatables.bootstrap.min.js') }}"></script>
    <script type="text/javascript">
        function detail(id){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "laporan_surat_masuk_tindasan/"+id+"/detail",
                type: "GET",
                beforeSend: function(){
                    $('#imgLoader').show();
                },
                success: function(data){
                    $('#tampilSurat').html(data);
                    $('#modal_detail').modal('show');
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

            // TABLE SURAT
            var oTableSurat = $('#tbl_surat_masuk_tindsan').dataTable({
                initComplete: function(){
                    var api = this.api();
                    $('#tbl_surat_masuk_tindsan_filter input').off('.DT').on('keyup.DT', function(e){
                        if(e.keyCode == 13){
                            api.search(this.value).draw();
                        }
                    });
                },
                "processing": true,
                "serverSide": true,
                "ordering": false,
                "ajax": {
                    "url": "{{ route('lap_surat_masuk_tindasan.data') }}",
                    "type": "GET"
                },
                "aoColumnDefs": [{
                    "aTargets": [0,5],
                    "sWidth": "1%",
                    "sClass": "text-center"
                },{
                    "aTargets": [1],
                    "sWidth": "17%",
                },{
                    "aTargets": [2],
                    "sWidth": "9%",
                    "sClass": "text-center"
                },{
                    "aTargets": [3],
                    "sWidth": "17%"
                }]
            });
        });
    </script>
@endsection