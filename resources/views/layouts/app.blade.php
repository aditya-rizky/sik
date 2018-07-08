<!-- ==================================================================================
*   Web Analyst + Design + Develop by Aditya Rizky Dinna Cahya - Staf TI PT Perkebunan Nusantara IX
*   Project : Sistem Informasi Kesekretariatan - Surakarta, 01 April 2018
*   
*   :: plz..don't remove this text if u are "the real open-sourcer" ::
==================================================================================== -->
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8">
    <title>PTPN IX</title>

    <meta name="description" content="Sistem Informasi Kesekretariatan" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />  
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!--Basic Styles-->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/font-awesome.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/weather-icons.min.css') }}" rel="stylesheet" />

    <!--Fonts-->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,600,700,300" rel="stylesheet" type="text/css">

    <!--Beyond styles-->
    <link href="{{ asset('assets/css/beyond.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/skins/green.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/demo.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/typicons.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/animate.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/js/sweetalert2/sweetalert2.css') }}" rel="stylesheet">

    <link rel="shortcut icon" href="{{ asset('assets/img/logo-icon.png') }}" type="image/x-icon">

    @yield('css')
</head>
<body>
    <div class="loading-container">
        <div class="loader"></div>
    </div>

    <div class="navbar navbar-fixed-top">
        <div class="navbar-inner">
            <div class="navbar-container">
                <div class="navbar-header pull-left">
                    <a href="#" class="navbar-brand">
                        <small>
                            <img src="{{ asset('assets/img/logo-sidebar.png') }}" alt="logo" />
                        </small>
                    </a>
                </div>

                <div class="sidebar-collapse" id="sidebar-collapse">
                    <i class="collapse-icon fa fa-bars"></i>
                </div>

                <div class="navbar-header pull-right">
                    <div class="navbar-account">
                        <ul class="account-area">
                            <li>
                                <a href="#" class="login-area dropdown-toggle" data-toggle="dropdown">
                                    <div class="avatar" title="View your public profile">
                                        <img src="{{ asset('assets/img/icons8-circled-user-male-skin-type-5.png') }}">
                                    </div>
                                    <section>
                                        <h2><span class="profile"><span>{{ Auth::user()->name }}</span></span></h2>
                                    </section>
                                </a>
                                <ul class="pull-right dropdown-menu dropdown-arrow dropdown-login-area">
                                    <li class="username"><a>{{ Auth::user()->name }}</a></li>
                                    <li class="email"><a>{{ Auth::user()->email }}</a></li>
                                    <li>
                                        <div class="avatar-area">
                                            <img src="{{ asset('assets/img/icons8-circled-user-male-skin-type-5.png') }}" class="avatar">
                                        </div>
                                    </li>
                                    <li class="edit">
                                        <a href="#" class="pull-left">Profile</a>
                                        <a href="#" class="pull-right">Setting</a>
                                    </li>
                                    <li class="dropdown-footer">
                                        <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                            Keluar
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="main-container container-fluid">
        <div class="page-container">
            <div class="page-sidebar sidebar-fixed" id="sidebar">
                <ul class="nav sidebar-menu">
                    <li class="{{ set_active(['home','lap_sm_eks','lap_sm_int','lap_sk_dir_int']) }}">
                        <a href="{{ route('home') }}">
                            <i class="menu-icon fa fa-university"></i>
                            <span class="menu-text">Beranda</span>
                        </a>
                    </li>
                    @if(Auth::user()->id_role == 1)
                    <li class="{{ set_active_open(['bagian','jabatan','golongan','masakerja','pendidikan','hakakses','karyawan','pengguna','klasifikasi','jenis_surat','sifat_surat','jenis_disposisi','retensi_aktif','retensi_inaktif','retensi_deskripsi']) }}">
                        <a href="#" class="menu-dropdown">
                            <i class="menu-icon fa fa-database"></i>

                            <span class="menu-text">
                                Master Data
                            </span>

                            <i class="menu-expand"></i>
                        </a>

                        <ul class="submenu">
                            <li class="{{ set_active('bagian') }}">
                                <a href="{{ route('bagian') }}"><span class="menu-text">Data Bagian</span></a>
                            </li>
                            <li class="{{ set_active('jabatan') }}">
                                <a href="{{ route('jabatan') }}"><span class="menu-text">Data Jabatan</span></a>
                            </li>
                            <li class="{{ set_active('golongan') }}">
                                <a href="{{ route('golongan') }}"><span class="menu-text">Data Golongan</span></a>
                            </li>
                            <li class="{{ set_active('masakerja') }}">
                                <a href="{{ route('masakerja') }}"><span class="menu-text">Data Masa Kerja</span></a>
                            </li>
                            <li class="{{ set_active('pendidikan') }}">
                                <a href="{{ route('pendidikan') }}"><span class="menu-text">Data Pendidikan</span></a>
                            </li>
                            <li class="{{ set_active('hakakses') }}">
                                <a href="{{ route('hakakses') }}"><span class="menu-text">Data Hak Akses</span></a>
                            </li>
                            <li class="{{ set_active('jenis_surat') }}">
                                <a href="{{ route('jenis_surat') }}"><span class="menu-text">Data Jenis Surat</span></a>
                            </li>
                            <li class="{{ set_active('jenis_disposisi') }}">
                                <a href="{{ route('jenis_disposisi') }}"><span class="menu-text">Data Jenis Disposisi Direksi</span></a>
                            </li>
                            <li class="{{ set_active('sifat_surat') }}">
                                <a href="{{ route('sifat_surat') }}"><span class="menu-text">Data Sifat Surat</span></a>
                            </li>
                            <li class="{{ set_active('karyawan') }}">
                                <a href="{{ route('karyawan') }}"><span class="menu-text">Data Karyawan</span></a>
                            </li>
                            <li class="{{ set_active('pengguna') }}">
                                <a href="{{ route('pengguna') }}"><span class="menu-text">Data Pengguna</span></a>
                            </li>
                            <li class="{{ set_active('klasifikasi') }}">
                                <a href="{{ route('klasifikasi') }}"><span class="menu-text">Data Klasifikasi</span></a>
                            </li>
                            <li class="{{ set_active('retensi_aktif') }}">
                                <a href="{{ route('retensi_aktif') }}"><span class="menu-text">Data Retensi Aktif</span></a>
                            </li>
                            <li class="{{ set_active('retensi_inaktif') }}">
                                <a href="{{ route('retensi_inaktif') }}"><span class="menu-text">Data Retensi Inaktif</span></a>
                            </li>
                            <li class="{{ set_active('retensi_deskripsi') }}">
                                <a href="{{ route('retensi_deskripsi') }}"><span class="menu-text">Data Retensi Deskripsi</span></a>
                            </li>
                        </ul>
                    </li>
                    <li class="{{ set_active_open(['surat_keluar_int','surat_keluar_int.tambah','surat_keluar_eks','surat_keluar_eks.tambah','surat_keluar_karyawan','surat_keluar_karyawan.tambah','surat_keluar_direktur_internal','surat_keluar_direktur_internal.tambah','surat_keluar_direktur_eksternal','surat_keluar_direktur_eksternal.tambah','surat_masuk_eksternal','surat_masuk_eksternal.tambah','surat_masuk_internal']) }}">
                        <a href="#" class="menu-dropdown">
                            <i class="menu-icon fa fa-book"></i>

                            <span class="menu-text">
                                Agenda Sentral
                            </span>

                            <i class="menu-expand"></i>
                        </a>

                        <ul class="submenu">
                            <li class="{{ set_active(['surat_masuk_eksternal','surat_masuk_eksternal.tambah']) }}">
                                <a href="{{ route('surat_masuk_eksternal') }}"><span class="menu-text">Surat Masuk Eksternal</span></a>
                            </li>
                            <li class="{{ set_active('surat_masuk_internal') }}">
                                <a href="{{ route('surat_masuk_internal') }}"><span class="menu-text">Surat Masuk Internal</span></a>
                            </li>
                            <li class="{{ set_active_open(['surat_keluar_direktur_internal','surat_keluar_direktur_internal.tambah','surat_keluar_direktur_eksternal','surat_keluar_direktur_eksternal.tambah']) }}">
                                <a href="#" class="menu-dropdown">
                                    <span class="menu-text">
                                        Surat Keluar Direksi
                                    </span>
                                    <i class="menu-expand"></i>
                                </a>

                                <ul class="submenu">
                                    <li class="{{ set_active(['surat_keluar_direktur_internal','surat_keluar_direktur_internal.tambah']) }}">
                                        <a href="{{ route('surat_keluar_direktur_internal') }}">
                                            <span class="menu-text">Internal</span>
                                        </a>
                                    </li>
                                    <li class="{{ set_active(['surat_keluar_direktur_eksternal','surat_keluar_direktur_eksternal.tambah']) }}">
                                        <a href="{{ route('surat_keluar_direktur_eksternal') }}">
                                            <span class="menu-text">Eksternal</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="{{ set_active(['surat_keluar_int','surat_keluar_int.tambah']) }}">
                                <a href="{{ route('surat_keluar_int') }}"><span class="menu-text">Surat Keluar Internal</span></a>
                            </li>
                            <li class="{{ set_active(['surat_keluar_eks','surat_keluar_eks.tambah']) }}">
                                <a href="{{ route('surat_keluar_eks') }}"><span class="menu-text">Surat Keluar Eksternal</span></a>
                            </li>
                            <li class="{{ set_active(['surat_keluar_karyawan','surat_keluar_karyawan.tambah']) }}">
                                <a href="{{ route('surat_keluar_karyawan') }}"><span class="menu-text">Surat Keluar Karyawan</span></a>
                            </li>
                        </ul>
                    </li>
                    <li class="{{ set_active_open(['agenda_direksi','agenda_direksi_langsung','disposisi_direksi_sm','disposisi_direksi_sk','agenda_sk_direksi','filter_sm_direksi']) }}">
                        <a href="#" class="menu-dropdown">
                            <i class="menu-icon fa fa-user-secret"></i>

                            <span class="menu-text">
                                Agenda Direksi
                            </span>

                            <i class="menu-expand"></i>
                        </a>

                        <ul class="submenu">
                            <li class="{{ set_active('filter_sm_direksi') }}">
                                <a href="{{ route('filter_sm_direksi') }}"><span class="menu-text">Filter Surat Masuk Direksi</span></a>
                            </li>
                            <li class="{{ set_active_open(['disposisi_direksi_sm','disposisi_direksi_sk']) }}">
                                <a href="" class="menu-dropdown">
                                    <span class="menu-text">
                                        Disposisi Direksi
                                    </span>
                                    <i class="menu-expand"></i>
                                </a>

                                <ul class="submenu">
                                    <li class="{{ set_active_open(['disposisi_direksi_sm']) }}">
                                        <a href="{{ route('disposisi_direksi_sm') }}">
                                            <span class="menu-text">Surat Masuk</span>
                                        </a>
                                    </li>
                                    <li class="{{ set_active_open(['disposisi_direksi_sk']) }}">
                                        <a href="{{ route('disposisi_direksi_sk') }}">
                                            <span class="menu-text">Surat Keluar</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="{{ set_active_open(['agenda_direksi','agenda_direksi_langsung']) }}">
                                <a href="" class="menu-dropdown">
                                    <span class="menu-text">
                                        Surat Masuk Direksi
                                    </span>
                                    <i class="menu-expand"></i>
                                </a>

                                <ul class="submenu">
                                    <li class="{{ set_active_open(['agenda_direksi']) }}">
                                        <a href="{{ route('agenda_direksi') }}">
                                            <span class="menu-text">Sentral</span>
                                        </a>
                                    </li>
                                    <li class="{{ set_active_open(['agenda_direksi_langsung']) }}">
                                        <a href="{{ route('agenda_direksi_langsung') }}">
                                            <span class="menu-text">Langsung</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="{{ set_active('agenda_sk_direksi') }}">
                                <a href="{{ route('agenda_sk_direksi') }}"><span class="menu-text">Surat Keluar Direksi</span></a>
                            </li>
                        </ul>
                    </li>
                    @elseif(Auth::user()->id_role == 2)
                    <li class="{{ set_active_open(['bagian','jabatan','golongan','masakerja','pendidikan','hakakses','karyawan','pengguna','klasifikasi','jenis_surat','sifat_surat','jenis_disposisi','retensi_aktif','retensi_inaktif','retensi_deskripsi']) }}">
                        <a href="#" class="menu-dropdown">
                            <i class="menu-icon fa fa-database"></i>

                            <span class="menu-text">
                                Master Data
                            </span>

                            <i class="menu-expand"></i>
                        </a>

                        <ul class="submenu">
                            <li class="{{ set_active('jenis_disposisi') }}">
                                <a href="{{ route('jenis_disposisi') }}"><span class="menu-text">Data Jenis Disposisi Direksi</span></a>
                            </li>
                            <li class="{{ set_active('klasifikasi') }}">
                                <a href="{{ route('klasifikasi') }}"><span class="menu-text">Data Klasifikasi</span></a>
                            </li>
                            <li class="{{ set_active('retensi_aktif') }}">
                                <a href="{{ route('retensi_aktif') }}"><span class="menu-text">Data Retensi Aktif</span></a>
                            </li>
                            <li class="{{ set_active('retensi_inaktif') }}">
                                <a href="{{ route('retensi_inaktif') }}"><span class="menu-text">Data Retensi Inaktif</span></a>
                            </li>
                            <li class="{{ set_active('retensi_deskripsi') }}">
                                <a href="{{ route('retensi_deskripsi') }}"><span class="menu-text">Data Retensi Deskripsi</span></a>
                            </li>
                        </ul>
                    </li>
                    <li class="{{ set_active_open(['surat_keluar_int','surat_keluar_int.tambah','surat_keluar_eks','surat_keluar_eks.tambah','surat_keluar_karyawan','surat_keluar_karyawan.tambah','surat_keluar_direktur_internal','surat_keluar_direktur_internal.tambah','surat_keluar_direktur_eksternal','surat_keluar_direktur_eksternal.tambah','surat_masuk_eksternal','surat_masuk_eksternal.tambah','surat_masuk_internal']) }}">
                        <a href="#" class="menu-dropdown">
                            <i class="menu-icon fa fa-book"></i>

                            <span class="menu-text">
                                Agenda Sentral
                            </span>

                            <i class="menu-expand"></i>
                        </a>

                        <ul class="submenu">
                            <li class="{{ set_active(['surat_masuk_eksternal','surat_masuk_eksternal.tambah']) }}">
                                <a href="{{ route('surat_masuk_eksternal') }}"><span class="menu-text">Surat Masuk Eksternal</span></a>
                            </li>
                            <li class="{{ set_active('surat_masuk_internal') }}">
                                <a href="{{ route('surat_masuk_internal') }}"><span class="menu-text">Surat Masuk Internal</span></a>
                            </li>
                        </ul>
                    </li>
                    @endif
                </ul>
            </div>

            <div class="page-content">
                <div class="page-breadcrumbs">
                    <ul class="breadcrumb">
                        @yield('breadcrumb')
                    </ul>
                </div>
                
                <!-- <div class="page-header position-relative">
                    <div class="header-title">
                        <h1>
                            @yield('title')
                        </h1>
                    </div>
                </div> -->
                
                <div class="page-body">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    <!--Basic Scripts-->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/slimscroll/jquery.slimscroll.min.js') }}"></script>

    <!--Beyond Scripts-->
    <script src="{{ asset('assets/js/beyond.js') }}"></script>
    <script src="{{ asset('assets/js/sweetalert2/sweetalert2.min.js') }}"></script>
    @yield('script')
</body>
</html>