@extends('layouts.app')

@section('breadcrumb')
    <li class="active"><i class="fa fa-home"></i> Beranda</li>
@endsection

@section('title')
    Halaman Beranda
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="databox bg-white radius-bordered">
                        <div class="databox-left bg-themesecondary">
                            <div class="databox-piechart">
                                <div data-toggle="easypiechart" class="easyPieChart" data-barcolor="#fff" data-linecap="butt" data-percent="50" data-animate="500" data-linewidth="3" data-size="47" data-trackcolor="rgba(255,255,255,0.1)"><span class="white font-90">50%</span></div>
                            </div>
                        </div>
                        <div class="databox-right">
                            <span class="databox-number themesecondary">28</span>
                            <div class="databox-text darkgray">SURAT MASUK INTERNAL</div>
                            <div class="databox-stat themesecondary radius-bordered">
                                <i class="stat-icon icon-lg fa fa-tasks"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="databox bg-white radius-bordered">
                        <div class="databox-left bg-themethirdcolor">
                            <div class="databox-piechart">
                                <div data-toggle="easypiechart" class="easyPieChart" data-barcolor="#fff" data-linecap="butt" data-percent="15" data-animate="500" data-linewidth="3" data-size="47" data-trackcolor="rgba(255,255,255,0.2)"><span class="white font-90">15%</span></div>
                            </div>
                        </div>
                        <div class="databox-right">
                            <span class="databox-number themethirdcolor">5</span>
                            <div class="databox-text darkgray">SURAT MASUK EKSTERNAL</div>
                            <div class="databox-stat themethirdcolor radius-bordered">
                                <i class="stat-icon  icon-lg fa fa-envelope-o"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="databox bg-white radius-bordered">
                        <div class="databox-left bg-themeprimary">
                            <div class="databox-piechart">
                                <div id="users-pie" data-toggle="easypiechart" class="easyPieChart" data-barcolor="#fff" data-linecap="butt" data-percent="76" data-animate="500" data-linewidth="3" data-size="47" data-trackcolor="rgba(255,255,255,0.1)"><span class="white font-90">76%</span></div>
                            </div>
                        </div>
                        <div class="databox-right">
                            <span class="databox-number themeprimary">92</span>
                            <div class="databox-text darkgray">SURAT KELUAR</div>
                            <div class="databox-state bg-themeprimary">
                                <i class="fa fa-check"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="databox bg-white radius-bordered">
                        <div class="databox-left bg-blueberry">
                            <div class="databox-piechart">
                                <div id="users-pie" data-toggle="easypiechart" class="easyPieChart" data-barcolor="#fff" data-linecap="butt" data-percent="76" data-animate="500" data-linewidth="3" data-size="47" data-trackcolor="rgba(255,255,255,0.1)"><span class="white font-90">76%</span></div>
                            </div>
                        </div>
                        <div class="databox-right">
                            <span class="databox-number blueberry">92</span>
                            <div class="databox-text darkgray">SOFTCOPY SURAT KELUAR</div>
                            <div class="databox-state bg-blueberry">
                                <i class="fa fa-check"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <div class="orders-container">
                <div class="orders-header">
                    <h6>Laporan Persuratan</h6>
                </div>
                <ul class="orders-list">
                    <li class="order-item">
                        <div class="row">
                            <div class="col-lg-11 col-md-11 col-sm-11 col-xs-11 item-left">
                                <div class="item-booker">Surat Masuk Langsung</div>
                                <div class="item-time">
                                    <span>Surat masuk langsung ke bagian/unitkerja.</span>
                                </div>
                            </div>
                        </div>
                        <a class="item-more" href="{{ route('lap_surat_masuk_langsung') }}">
                             <i class="fa fa-camera-retro"></i> 
                        </a>
                    </li>
                    <li class="order-item top">
                        <div class="row">
                            <div class="col-lg-11 col-md-11 col-sm-11 col-xs-11 item-left">
                                <div class="item-booker">Surat Masuk Disposisi Direksi</div>
                                <div class="item-time">
                                    <span>Surat masuk ke bagian dari disposisi direksi.</span>
                                </div>
                            </div>
                        </div>
                        <a class="item-more" href="{{ route('lap_surat_masuk_disposisi') }}">
                            <i></i>
                        </a>
                    </li>
                    <li class="order-item">
                        <div class="row">
                            <div class="col-lg-11 col-md-11 col-sm-11 col-xs-11 item-left">
                                <div class="item-booker">Surat Masuk Tindasan</div>
                                <div class="item-time">
                                    <span>Surat masuk ke bagian dari tindasan surat keluar.</span>
                                </div>
                            </div>
                        </div>
                        <a class="item-more" href="{{ route('lap_surat_masuk_tindasan') }}">
                            <i></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <div class="orders-container">
                <div class="orders-header">
                    <h6>Laporan Agenda Sentral Kantor Direksi</h6>
                </div>
                <ul class="orders-list">
                    <li class="order-item">
                        <div class="row">
                            <div class="col-lg-11 col-md-11 col-sm-11 col-xs-11 item-left">
                                <div class="item-booker">Agenda Surat Masuk Internal - Sentral</div>
                                <div class="item-time">
                                    <span>Agenda sentral internal kantor direksi.</span>
                                </div>
                            </div>
                        </div>
                        <a class="item-more" href="{{ route('lap_agenda_sentral_int') }}">
                             <i class="fa fa-camera-retro"></i> 
                        </a>
                    </li>
                    <li class="order-item top">
                        <div class="row">
                            <div class="col-lg-11 col-md-11 col-sm-11 col-xs-11 item-left">
                                <div class="item-booker">Agenda Surat Masuk Eksternal - Sentral</div>
                                <div class="item-time">
                                    <span>Agenda sentral eksternal kantor direksi.</span>
                                </div>
                            </div>
                        </div>
                        <a class="item-more" href="{{ route('lap_agenda_sentral_eks') }}">
                            <i></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <div class="orders-container">
                <div class="orders-header">
                    <h6>Laporan Disposisi Direksi</h6>
                </div>
                <ul class="orders-list">
                    <li class="order-item">
                        <div class="row">
                            <div class="col-lg-11 col-md-11 col-sm-11 col-xs-11 item-left">
                                <div class="item-booker">Disposisi Surat Masuk Direksi</div>
                                <div class="item-time">
                                    <span>Disposisi surat masuk direksi.</span>
                                </div>
                            </div>
                        </div>
                        <a class="item-more" href="{{ route('lap_disposisi_dir_sm') }}">
                             <i class="fa fa-camera-retro"></i> 
                        </a>
                    </li>
                    <li class="order-item top">
                        <div class="row">
                            <div class="col-lg-11 col-md-11 col-sm-11 col-xs-11 item-left">
                                <div class="item-booker">Disposisi Surat Keluar Direksi</div>
                                <div class="item-time">
                                    <span>Disposisi surat keluar direksi.</span>
                                </div>
                            </div>
                        </div>
                        <a class="item-more" href="{{ route('lap_disposisi_dir_sk') }}">
                            <i></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-md-12">
            <div class="well with-header with-footer">
                <div class="header bg-palegreen">
                    Data Surat Keluar
                </div>
                <table class="table table-hover table-striped table-bordered table-responsive">
                    <thead class="bordered-blueberry">
                        <tr>
                            <th rowspan="2" class="text-center col-md-1" style="vertical-align: middle;">#</th>
                            <th rowspan="2" class="text-center col-md-7" style="vertical-align: middle;" width="20%">Bagian</th>
                            <th colspan="2" class="text-center">Surat Keluar</th>
                            <th rowspan="2" class="text-center col-md-1" style="vertical-align: middle;">Progress %</th>
                        </tr>
                        <tr>
                            <th class="text-center">Jumlah</th>
                            <th class="text-center">Belum diunggah</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="5" class="text-center"><span class="label label-success"><h5>TABEL MASIH DALAM TAHAP PENGEMBANGAN</h5></span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
