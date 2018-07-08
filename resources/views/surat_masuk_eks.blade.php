@extends('layouts.app')

@section('css')
    <link href="{{ asset('assets/js/datatables.bootstrap.min.css') }}" rel="stylesheet" />
@endsection

@section('breadcrumb')
    <li>
        <i class="fa fa-hdd-o"></i>
        <a href="#">Agenda Sentral</a>
    </li>
    <li class="active">Surat Masuk Eksternal</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-6 col-sm-6 col-xs-6">
            <div class="well bg-purple bordered-right bordered-purple">
                <b><u>Halaman surat masuk eksternal</u></b><br>
                <p class="text-justify">
                    Halaman ini berisi daftar surat masuk perusahaan dari eksternal. Bagian sentral/sekretariat dapat melakukan <i>input</i> atau <i>edit</i> surat masuk perusahaan yang berasal dari eksternal (di luar lingkup perusahaan).
                </p>
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-xs-6">
            @if (Session::has('status'))
                {!! Session::get('status') !!}
            @endif
        </div>
    </div>
	<div class="row">
        <div class="col-lg-12 col-sm-12 col-xs-12">
            <div class="widget">
                <div class="widget-header bordered-bottom bordered-purple">
                    <span class="widget-caption">Tabel Surat Masuk Eksternal</span>
                    <div class="widget-buttons buttons-bordered">
                        <button class="btn btn-purple btn-sm" onclick="location.href='{{ route('surat_masuk_eksternal.tambah') }}'"><i class='fa fa-plus'></i> Tambah Data</button>
                    </div>
                </div>
                <div class="widget-body">
                    <p class="text-center"><img src="{{ asset('assets/img/Ellipsis.gif') }}" id="imgLoader"></p>
                    <table class="table bordered-purple table-striped table-bordered table-hover responsive" id="tbl_sm_eks" width="100%">
                        <thead class="bordered-purple">
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">NO. STRL</th>
                                <th class="text-center">TGL STRL</th>
                                <th class="text-center">NO. SURAT</th>
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
                    <h4 class="modal-title" id="mySmallModalLabel">Detail Surat Masuk Eksternal</h4>
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
                url: "surat_masuk_eksternal/"+id+"/detail",
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
            var oTableSurat = $('#tbl_sm_eks').dataTable({
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
                    "url": "{{ route('surat_masuk_eksternal.list') }}",
                    "type": "GET"
                },
                "aoColumnDefs": [{
                    "aTargets": [0],
                    "sWidth": "2%",
                    "sClass": "text-center"
                },{
                    "aTargets": [1],
                    "sWidth": "8%",
                    "sClass": "text-right"
                },{
                    "aTargets": [2],
                    "sWidth": "13%",
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
    	});	
    </script>
@endsection