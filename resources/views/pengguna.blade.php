@extends('layouts.app')

@section('css')
    <link href="{{ asset('assets/js/datatables.bootstrap.min.css') }}" rel="stylesheet" />
@endsection

@section('breadcrumb')
    <li>
        <i class="fa fa-hdd-o"></i>
        <a href="#">Master Data</a>
    </li>
    <li class="active">Data Pengguna</li>
@endsection

@section('title')
    Halaman Data Pengguna
@endsection

@section('content')
	<div class="row">
		<div class="col-lg-8 col-sm-8 col-xs-12">
			<div class="widget">
				<div class="widget-header bordered-bottom bordered-magenta">
                    <span class="widget-caption">Form Pengguna</span>
                </div>
                <div class="widget-body">
                	<div id="horizontal-form">
                		<form class="form-horizontal bv-form" role="form" id="frmPengguna" novalidate="novalidate">
                            {{ csrf_field() }} {{ method_field('POST') }}
                            <div class="form-group">
                                <label for="karyawan" class="col-sm-2 control-label no-padding-right">Nama Karyawan</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="karyawan" id="karyawan">
                                        @foreach($karyawan as $rowKaryawan)
                                            <option value="{{ $rowKaryawan->id_karyawan }}">{{ $rowKaryawan->nama_karyawan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group role">
                                <label for="role" class="col-sm-2 control-label no-padding-right">Hak Akses</label>
                                <div class="col-sm-3">
                                    <select class="form-control" name="role" id="role">
                                        @foreach($role as $rowRole)
                                            <option value="{{ $rowRole->id_hakakses }}">{{ $rowRole->nama_hakakses }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-magenta" id="btnSimpan">Simpan</button>
                                    <button type="button" class="btn btn-yellow" id="btnBatal">Batal</button>
                                    <img src="{{ asset('assets/img/Ellipsis.gif') }}" id="imgLoader">
                                    <input type="text" name="id_pengguna" id="id_pengguna" class="form-control" style="display: none;">
                                    <input type="text" name="pwd_pengguna" id="pwd_pengguna" class="form-control" style="display: none;">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12" id="alertNotif" style="display: none;"></div>
                            </div>
                		</form>
                	</div>
                </div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12 col-sm-12 col-xs-12">
			<div class="widget">
				<div class="widget-header bg-magenta">
                    <span class="widget-caption">Tabel Data Pengguna</span>
                </div>
                <div class="widget-body">
                	<table class="table bordered-magenta table-striped table-bordered table-hover responsive" id="tblPengguna" width="100%">
                		<thead class="bordered-magenta">
                			<tr>
	                			<th class="text-center">#</th>
	                			<th class="text-center">Nama Karyawan</th>
	                			<th class="text-center">Email</th>
                                <th class="text-center">Bagian</th>
                                <th class="text-center">Hak Akses</th>
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

        // Function ketika tombol edit
        function editData(id){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "pengguna/"+id+"/edit",
                type: "GET",
                dataType: "JSON",
                beforeSend: function(){
                    $('#imgLoader').show();
                },
                success: function(data){
                    $('#frmPengguna').bootstrapValidator('disableSubmitButtons', false).bootstrapValidator('resetForm', true);
                    $('#karyawan').val(data.id_karyawan);
                    $('#role').val(data.id_role);
                    $('#id_pengguna').val(data.id);
                    $('.role').show();
                    $('#karyawan').attr('disabled', true);
                    $('#btnBatal').show();
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

        // Function reset password
        function editPassword(id)
        {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            swal({
                title: "Konfirmasi !",
                text: "Anda yakin akan me-reset password pengguna ini ?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes !'
            }).then(function(){
                $.ajax({
                    url: "pengguna/editPassword/"+id,
                    type: "PUT",
                    dataType: 'json',
                    beforeSend: function(){
                        $('#imgLoader').show();
                    },
                    success:function(response){
                        if(response.status == 3){
                            var alertStatus = ['alert-success', 'Sukses!', 'Password berhasil direset.'];
                        }else{
                            var alertStatus = ['alert-danger', 'Gagal!', 'Password gagal direset.'];
                        }

                        $('#alertNotif').html("<div class='alert "+alertStatus[0]+" alert-dismissible fade in' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button><strong>"+alertStatus[1]+"</strong> "+alertStatus[2]+"</div>");
                        $('#alertNotif').fadeTo(4000, 500).slideUp(500, function(){
                            $('#alertNotif').slideUp(500);
                        });
                    },
                    complete: function(){
                        $('#imgLoader').hide();
                    }
                });
            }).catch(swal.noop);
        }

        // Function ketika tombol hapus
        function deleteData(id){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            swal({
                title: "Konfirmasi !",
                text: "Anda yakin menghapus data pengguna ini ?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes !'
            }).then(function(){
                $.ajax({
                    url: "pengguna/"+id,
                    type: "DELETE",
                    dataType: 'json',
                    beforeSend: function(){
                        $('#imgLoader').show();
                    },
                    success:function(response){
                        if(response.status == 3){
                            var alertStatus = ['alert-success', 'Sukses!', 'Data berhasil dihapus.'];
                        }else{
                            var alertStatus = ['alert-danger', 'Gagal!', 'Data gagal dihapus.'];
                        }

                        $('#alertNotif').html("<div class='alert "+alertStatus[0]+" alert-dismissible fade in' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button><strong>"+alertStatus[1]+"</strong> "+alertStatus[2]+"</div>");
                        $('#alertNotif').fadeTo(4000, 500).slideUp(500, function(){
                            $('#alertNotif').slideUp(500);
                        });
                        $('#karyawan').focus();
                        $('#btnBatal').hide();
                        oTable.ajax.reload();
                    },
                    complete: function(){
                        $('#imgLoader').hide();
                    }
                });
            }).catch(swal.noop);
        }

        $(document).ready(function(){
            $('#btnBatal').hide();
            $('#imgLoader').hide();
            $('body').tooltip({selector: '[data-toggle="tooltip"]'});

            $('#btnBatal').click(function(){
                $('#frmPengguna')[0].reset();
                $('#btnBatal').hide();
                $('.role').show();
                $('#karyawan').attr('disabled', false);
                $('#karyawan').focus();
            });

            oTable = $('#tblPengguna').DataTable({
                initComplete: function(){
                    var api = this.api();
                    $('#tblPengguna_filter input').off('.DT').on('keyup.DT', function(e){
                        if(e.keyCode == 13){
                            api.search(this.value).draw();
                        }
                    });
                },
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "{{ route('pengguna.data') }}",
                    "type": "GET"
                },
                "ordering": false,
                "columnDefs": [
                    {
                        className: "text-center",
                        targets: [0,5,4]
                    },
                    {
                        orderable: false,
                        targets: [0,4]
                    }
                ]
            });

            $('#frmPengguna').on('submit', function(e){
                e.preventDefault();
                var id = $('#id_pengguna').val();
                var pwd = $('#pwd_pengguna').val();
                if(id == ""){
                    url = "{{ route('pengguna.simpan') }}";
                    type = "POST";
                }else{
                    if(pwd == ""){
                        url = "pengguna/"+id;
                        type = "PUT";
                    }else{
                        url = "pengguna/editPassword/"+id;
                        type = "PUT";
                    }
                }

                $.ajax({
                    url: url,
                    type: type,
                    data: $('#frmPengguna').serialize(),
                    dataType: 'JSON',
                    beforeSend: function(){
                        $('#imgLoader').show();
                    },
                    success: function(data){
                        if(data.status == 1){
                            var alertStatus = ['alert-success', 'Sukses!', 'Data berhasil disimpan.'];
                        }else if(data.status == 2){
                            var alertStatus = ['alert-success', 'Sukses!', 'Data berhasil diubah.'];
                        }else if(data.status == 3){
                            var alertStatus = ['alert-danger', 'Gagal!', 'Pengguna sudah terdaftar.'];
                        }else{
                            var alertStatus = ['alert-danger', 'Gagal!', 'Data gagal disimpan/diubah.'];
                        }

                        $('#alertNotif').html("<div class='alert "+alertStatus[0]+" alert-dismissible fade in' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button><strong>"+alertStatus[1]+"</strong> "+alertStatus[2]+"</div>");
                        $('#alertNotif').fadeTo(4000, 500).slideUp(500, function(){
                            $('#alertNotif').slideUp(500);
                        });
                        $('#karyawan').focus();
                        $('#btnBatal').hide();
                        $('#karyawan').attr('disabled', false);
                        oTable.ajax.reload();
                    },
                    complete: function(){
                        $('#imgLoader').hide();
                    }
                });
            });

            // $('#frmPengguna').bootstrapValidator({
            //     excluded: [':hidden', ':disabled'],
            //     feedbackIcons: {
            //         valid: 'glyphicon glyphicon-ok',
            //         invalid: 'glyphicon glyphicon-remove',
            //         validating: 'glyphicon glyphicon-refresh'
            //     },
            //     fields: {
            //         password: {
            //             validators: {
            //                 notEmpty: {
            //                     message: 'Kolom harus diisi !'
            //                 },
            //                 identical: {
            //                     field: 'password_verify',
            //                     message: 'Password harus sama !'
            //                 }
            //             }
            //         },
            //         password_verify: {
            //             validators: {
            //                 notEmpty: {
            //                     message: 'Kolom harus diisi !'
            //                 },
            //                 identical: {
            //                     field: 'password',
            //                     message: 'Password harus sama !'
            //                 }
            //             }
            //         }
            //     }
            // }).on('success.field.bv', function(e, data){
            //     var $parent = data.element.parents('.form-group');
            //     $parent.removeClass('has-success');
            //     $parent.find('.form-control-feedback[data-bv-icon-for="' + data.field + '"]').hide();
            // }).on('success.form.bv', function(e){
            //     e.preventDefault();
            //     var id = $('#id_pengguna').val();
            //     var pwd = $('#pwd_pengguna').val();
            //     if(id == ""){
            //         url = "{{ route('pengguna.simpan') }}";
            //         type = "POST";
            //     }else{
            //         if(pwd == ""){
            //             url = "pengguna/"+id;
            //             type = "PUT";
            //         }else{
            //             url = "pengguna/editPassword/"+id;
            //             type = "PUT";
            //         }
            //     }

            //     $.ajax({
            //         url: url,
            //         type: type,
            //         data: $('#frmPengguna').serialize(),
            //         dataType: 'JSON',
            //         beforeSend: function(){
            //             $('#imgLoader').show();
            //         },
            //         success: function(data){
            //             if(data.status == 1){
            //                 var alertStatus = ['alert-success', 'Sukses!', 'Data berhasil disimpan.'];
            //             }else if(data.status == 2){
            //                 var alertStatus = ['alert-success', 'Sukses!', 'Data berhasil diubah.'];
            //             }else if(data.status == 3){
            //                 var alertStatus = ['alert-danger', 'Gagal!', 'Pengguna sudah terdaftar.'];
            //             }else{
            //                 var alertStatus = ['alert-danger', 'Gagal!', 'Data gagal disimpan/diubah.'];
            //             }

            //             $('#alertNotif').html("<div class='alert "+alertStatus[0]+" alert-dismissible fade in' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button><strong>"+alertStatus[1]+"</strong> "+alertStatus[2]+"</div>");
            //             $('#alertNotif').fadeTo(4000, 500).slideUp(500, function(){
            //                 $('#alertNotif').slideUp(500);
            //             });
            //             $('#karyawan').focus();
            //             $('#btnBatal').hide();
            //             $('.pwd').show();
            //             $('#karyawan').attr('disabled', false);
            //             oTable.ajax.reload();
            //         },
            //         complete: function(){
            //             $('#imgLoader').hide();
            //         }
            //     });
            //     $('#id_pengguna').val("");
            //     $('#pwd_pengguna').val("");
            //     $('#frmPengguna').bootstrapValidator('disableSubmitButtons', false).bootstrapValidator('resetForm', true);
            // });
        });
    </script>
@endsection