@extends('layouts.app')

@section('css')
    <link href="{{ asset('assets/js/datatables.bootstrap.min.css') }}" rel="stylesheet" />
@endsection

@section('breadcrumb')
    <li>
        <i class="fa fa-hdd-o"></i>
        <a href="#">Master Data</a>
    </li>
    <li class="active">Data Retensi Deksripsi</li>
@endsection

@section('title')
    Halaman Data Retensi Deskripsi Klasifikasi
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-5 col-sm-5 col-md-5 col-xs-12">
            <div class="widget">
                <div class="widget-header bordered-bottom bordered-danger">
                    <span class="widget-caption">Form Retensi Deskripsi Klasifikasi</span>
                </div>
                <div class="widget-body">
                    <form class="bv-form" role="form" id="frmRetensi" novalidate="novalidate">
                        {{ csrf_field() }} {{ method_field('POST') }}
                        <div class="row">
                            <div class="col-lg-8 col-sm-8 col-md-8 col-xs-12">
                                <div class="form-group">
                                    <label for="nama_ket">Nama Retensi Deskripsi</label>
                                    <input type="text" class="form-control" name="nama_ket" id="nama_ket" data-bv-field="nama_ket" maxlength="150" onkeyup="upNama()" autofocus>
                                    <i class="form-control-feedback" data-bv-field="nama_ket" style="display: none;"></i>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                                <div class="form-group">
                                    <label for="status_ket">Status Aktif</label>
                                    <select class="form-control" name="status_ket" id="status_ket">
                                        <option value="Y">Aktif</option>
                                        <option value="N">Tidak Aktif</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-danger" id="btnSimpan">Simpan</button>
                            <button type="button" class="btn btn-yellow" id="btnBatal">Batal</button>
                            <img src="{{ asset('assets/img/Ellipsis.gif') }}" id="imgLoader">
                            <input type="text" name="id_retensi_ket" id="id_retensi_ket" class="form-control" style="display: none;">
                        </div>
                        <div class="form-group">
                            <div id="alertNotif" style="display: none;"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-7 col-sm-7 col-xs-12">
            <div class="widget">
                <div class="widget-header bg-danger">
                    <span class="widget-caption">Tabel Data Retensi Deskripsi Klasifikasi</span>
                </div>
                <div class="widget-body">
                    <table class="table bordered-danger table-striped table-bordered table-hover responsive" id="tblRetensi" width="100%">
                        <thead class="bordered-danger">
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Nama Deskripsi Retensi</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('assets/js/jquery.datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/validation/bootstrapValidator.js') }}"></script>
    <script type="text/javascript">
        // Function mencegah submit form dari tombol enter
        function stopRKey(evt) {
            var evt = (evt) ? evt : ((event) ? event : null);
            var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null);
            if ((evt.keyCode == 13) && (node.type=="text"))  {return false;}
        }
        document.onkeypress = stopRKey;

        // Function upper input nama bagian
        function upNama(){
            var i = document.getElementById("nama_ket");
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
                url: "retensi_deskripsi/"+id+"/edit",
                type: "GET",
                dataType: "JSON",
                beforeSend: function(){
                    $('#imgLoader').show();
                },
                success: function(data){
                    $('#frmRetensi').bootstrapValidator('disableSubmitButtons', false).bootstrapValidator('resetForm', true);
                    $('#nama_ket').val(data.nama_ket);
                    $('#status_ket').val(data.status_ket);
                    $('#id_retensi_ket').val(data.id_retensi_ket)
                    $('#btnBatal').show();
                    $('#nama_ket').focus();
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

        $(document).ready(function(){
            $('#btnBatal').hide();
            $('#imgLoader').hide();
            $('body').tooltip({selector: '[data-toggle="tooltip"]'});

            $('#btnBatal').click(function(){
                $('#frmRetensi')[0].reset();
                $('#btnBatal').hide();
                $('#nama_ket').focus();
            });

            oTable = $('#tblRetensi').DataTable({
                initComplete: function(){
                    var api = this.api();
                    $('#tblRetensi_filter input').off('.DT').on('keyup.DT', function(e){
                        if(e.keyCode == 13){
                            api.search(this.value).draw();
                        }
                    });
                },
                "processing": true,
                "serverSide": true,
                "ordering": false,
                "ajax": {
                    "url": "{{ route('retensi_deskripsi.data') }}",
                    "type": "GET"
                },
                "ordering": false,
                "columnDefs": [
                    {
                        className: "text-center",
                        targets: [0,2],
                        width: "3%"
                    },
                    {
                        orderable: false,
                        targets: [0,2]
                    }
                ]
            });

            $('#frmRetensi').bootstrapValidator({
                excluded: [':hidden', ':disabled'],
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    nama_ket: {
                        validators: {
                            notEmpty: {
                                message: 'Kolom harus diisi !'
                            },
                            stringLength: {
                                max: 150,
                                message: 'Maksimal 150 karakter yang diperbolehkan'
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
                var id = $('#id_retensi_ket').val();
                if(id == ""){
                    url = "{{ route('retensi_deskripsi.simpan') }}";
                    type = "POST";
                }else{
                    url = "retensi_deskripsi/"+id;
                    type = "PUT";
                }

                $.ajax({
                    url: url,
                    type: type,
                    data: $('#frmRetensi').serialize(),
                    dataType: 'JSON',
                    beforeSend: function(){
                        $('#imgLoader').show();
                    },
                    success: function(data){
                        if(data.status == 1){
                            var alertStatus = ['alert-success', 'Sukses!', 'Data berhasil disimpan.'];
                        }else if(data.status == 2){
                            var alertStatus = ['alert-success', 'Sukses!', 'Data berhasil diubah.'];
                        }else{
                            var alertStatus = ['alert-danger', 'Gagal!', 'Data gagal disimpan/diubah.'];
                        }

                        $('#alertNotif').html("<div class='alert "+alertStatus[0]+" alert-dismissible fade in' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button><strong>"+alertStatus[1]+"</strong> "+alertStatus[2]+"</div>");
                        $('#alertNotif').fadeTo(4000, 500).slideUp(500, function(){
                            $('#alertNotif').slideUp(500);
                        });
                        $('#nama_ket').focus();
                        $('#btnBatal').hide();
                        oTable.ajax.reload();
                    },
                    complete: function(){
                        $('#imgLoader').hide();
                    }
                });
                $('#id_retensi_ket').val("");
                $('#frmRetensi').bootstrapValidator('disableSubmitButtons', false).bootstrapValidator('resetForm', true);
            });
        });
    </script>
@endsection