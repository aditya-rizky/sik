@extends('layouts.app')

@section('css')
    <link href="{{ asset('assets/js/datatables.bootstrap.min.css') }}" rel="stylesheet" />
@endsection

@section('breadcrumb')
    <li>
        <i class="fa fa-home"></i>
        <a href="#">Beranda</a>
    </li>
    <li class="active">Laporan Agenda Sentral Eksternal - Kantor Direksi</li>
@endsection

@section('title')
    Halaman Laporan Agenda Sentral Eksternal - Kantor Direksi
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-5 col-sm-5 col-xs-12">
            <div class="widget">
                <div class="widget-header bordered-bottom bordered-blueberry">
                    <span class="widget-caption">Pencarian Agenda Sentral Eksternal</span>
                </div>
                <div class="widget-body">
                    <form class="bv-form" role="form" id="frmCari" novalidate="novalidate">
                        {{ csrf_field() }} {{ method_field('POST') }}
                        <div class="row">
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
                            <div class="col-lg-8 col-sm-8 col-xs-12">
                                <div class="form-group">
                                    <label for="status_hakakses">Nama Pengirim</label>
                                    <input type="text" class="form-control" name="nama_pengirim" id="nama_pengirim" onkeyup="upNama()">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="button" class="btn btn-blueberry" id="btnTampil">Tampilkan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-sm-12 col-xs-12">
            <div class="widget">
                <div class="widget-header bordered-bottom bordered-blueberry">
                    <span class="widget-caption">Tabel Agenda Sentral Eksternal - Kantor Direksi</span>
                </div>
                <div class="widget-body">
                    <p class="text-center"><img src="{{ asset('assets/img/Ellipsis.gif') }}" id="imgLoader"></p>
                    <table class="table bordered-blueberry table-striped table-bordered table-hover responsive" id="tbl_agenda_sentral_eks" width="100%">
                        <thead class="bordered-blueberry">
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
                <div class="modal-header bordered-blueberry">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="mySmallModalLabel">Detail Agenda Sentral Eksternal</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12 col-sm-12 col-xs-12">
                            <div id="tampilSurat"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-blueberry" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('assets/js/jquery.datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatables.bootstrap.min.js') }}"></script>
    <script type="text/javascript">
        // FUNCTION SURAT MASUK DIREKSI / AGENDA DIREKSI
        function detail(id){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "laporan_agenda_sentral_eks/"+id+"/detail",
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

        // Function upper input perihal
        function upNama(){
            var i = document.getElementById("nama_pengirim");
            i.value = i.value.toUpperCase();
        }

        // Function mencegah submit form dari tombol enter
        function stopRKey(evt) {
            var evt = (evt) ? evt : ((event) ? event : null);
            var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null);
            if ((evt.keyCode == 13) && (node.type=="text"))  {return false;}
        }
        document.onkeypress = stopRKey;

        $(document).ready(function(){
            $('body').tooltip({selector: '[data-toggle="tooltip"]'});
            $('#imgLoader').hide();

            $('#btnTampil').click(function(){
                oTableSurat.fnDraw();
            });

            // TABLE SURAT MASUK EKSTERNAL DIREKSI
            var oTableSurat = $('#tbl_agenda_sentral_eks').dataTable({
                initComplete: function(){
                    var api = this.api();
                    $('#tbl_agenda_sentral_eks_filter input').off('.DT').on('keyup.DT', function(e){
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
                    "url": "{{ route('lap_agenda_sentral_eks.data') }}",
                    // "type": "GET"
                    "data": function(d){
                        d.tahun = $('#tahun').val();
                        d.nama_pengirim = $('#nama_pengirim').val();
                    }
                },
                "aoColumnDefs": [{
                    "aTargets": [0,5],
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
                }]
            });
        });
    </script>
@endsection