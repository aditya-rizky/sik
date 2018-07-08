@extends('layouts.app')

@section('breadcrumb')
    <li>
        <i class="fa fa-home"></i>
        <a href="#">Beranda</a>
    </li>
    <li class="active">Ganti Password</li>
@endsection

@section('title')
    Halaman Ganti Password
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-6 col-sm-6 col-xs-12 col-md-6">
            <div class="widget">
                <div class="widget-header bordered-bottom bordered-palegreen">
                    <span class="widget-caption">Form Ganti Password</span>
                </div>
                <div class="widget-body">
                    <form class="bv-form" role="form" id="frmPwd" method="POST" action="{{ $url }}" novalidate="novalidate">
                        {{ csrf_field() }} {{ method_field('POST') }}
                        <div class="form-group">
                            <label for="new_pwd_1">Password Baru</label>
                            <input type="password" class="form-control" name="new_pwd_1" id="new_pwd_1" data-bv-field="new_pwd_1">
                            <i class="form-control-feedback" data-bv-field="new_pwd_1" style="display: none;"></i>
                        </div>
                        <div class="form-group">
                            <label for="new_pwd_2">Cocokan Password Baru</label>
                            <input type="password" class="form-control" name="new_pwd_2" id="new_pwd_2" data-bv-field="new_pwd_2">
                            <i class="form-control-feedback" data-bv-field="new_pwd_1" style="display: none;"></i>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-palegreen" id="btnSimpan">Ubah</button>
                            <img src="{{ asset('assets/img/Ellipsis.gif') }}" id="imgLoader">
                            <input type="text" name="id" id="id" class="form-control" value="{{ $id }}" style="display: none;">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('assets/js/validation/bootstrapValidator.js') }}"></script>
    <script type="text/javascript">
        // Function mencegah submit form dari tombol enter
        function stopRKey(evt) {
            var evt = (evt) ? evt : ((event) ? event : null);
            var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null);
            if ((evt.keyCode == 13) && (node.type=="text"))  {return false;}
        }
        document.onkeypress = stopRKey;

        $(document).ready(function(){
            $('#imgLoader').hide();

            $('#frmPwd').bootstrapValidator({
                excluded: [':hidden', ':disabled'],
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    old_pwd: {
                        validators: {
                            notEmpty: {
                                message: 'Kolom harus diisi !'
                            }
                        }
                    },
                    new_pwd_1: {
                        validators: {
                            notEmpty: {
                                message: 'Kolom harus diisi !'
                            },
                            identical: {
                                field: 'new_pwd_2',
                                message: 'Password harus sama !'
                            }
                        }
                    },
                    new_pwd_2: {
                        validators: {
                            notEmpty: {
                                message: 'Kolom harus diisi !'
                            },
                            identical: {
                                field: 'new_pwd_1',
                                message: 'Password harus sama !'
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