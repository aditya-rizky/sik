<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// ===============================================================================================================================================

// MASTER DATA

// ===============================================================================================================================================

Route::get('/', 'HomeController@index')->middleware('auth', 'cek_password');
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@login');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

Route::group(['middleware' => ['web','auth','role_admin','cek_password']], function(){
	// Route modul bagian
	Route::get('/bagian', 'coBagian@index')->name('bagian');
	Route::get('/bagian/data', 'coBagian@listData')->name('bagian.data');
	Route::post('/bagian/store', 'cobagian@store')->name('bagian.simpan');
	Route::get('/bagian/{id?}/edit', 'cobagian@edit');
	Route::put('/bagian/{id?}', 'cobagian@update');
	Route::delete('/bagian/{id?}', 'coBagian@destroy');

	// Route modul jabatan
	Route::get('/jabatan', 'coJabatan@index')->name('jabatan');
	Route::get('/jabatan/data', 'coJabatan@listData')->name('jabatan.data');
	Route::post('/jabatan/store', 'coJabatan@store')->name('jabatan.simpan');
	Route::get('/jabatan/{id?}/edit', 'coJabatan@edit');
	Route::put('/jabatan/{id?}', 'coJabatan@update');
	Route::delete('/jabatan/{id?}', 'coJabatan@destroy');

	// Route modul golongan
	Route::get('/golongan', 'coGolongan@index')->name('golongan');
	Route::get('/golongan/data', 'coGolongan@listData')->name('golongan.data');
	Route::post('/golongan/store', 'coGolongan@store')->name('golongan.simpan');
	Route::get('/golongan/{id?}/edit', 'coGolongan@edit');
	Route::put('/golongan/{id?}', 'coGolongan@update');
	Route::delete('/golongan/{id?}', 'coGolongan@destroy');

	// Route modul masa kerja
	Route::get('/masakerja', 'coMasakerja@index')->name('masakerja');
	Route::get('/masakerja/data', 'coMasakerja@listData')->name('masakerja.data');
	Route::post('/masakerja/store', 'coMasakerja@store')->name('masakerja.simpan');
	Route::get('/masakerja/{id?}/edit', 'coMasakerja@edit');
	Route::put('/masakerja/{id?}', 'coMasakerja@update');
	Route::delete('/masakerja/{id?}', 'coMasakerja@destroy');

	// Route modul masa pendidikan
	Route::get('/pendidikan', 'coPendidikan@index')->name('pendidikan');
	Route::get('/pendidikan/data', 'coPendidikan@listData')->name('pendidikan.data');
	Route::post('/pendidikan/store', 'coPendidikan@store')->name('pendidikan.simpan');
	Route::get('/pendidikan/{id?}/edit', 'coPendidikan@edit');
	Route::put('/pendidikan/{id?}', 'coPendidikan@update');
	Route::delete('/pendidikan/{id?}', 'coPendidikan@destroy');

	// Route modul masa hak akses
	Route::get('/hakakses', 'coHakakses@index')->name('hakakses');
	Route::get('/hakakses/data', 'coHakakses@listData')->name('hakakses.data');
	Route::post('/hakakses/store', 'coHakakses@store')->name('hakakses.simpan');
	Route::get('/hakakses/{id?}/edit', 'coHakakses@edit');
	Route::put('/hakakses/{id?}', 'coHakakses@update');
	Route::delete('/hakakses/{id?}', 'coHakakses@destroy');

	// Route modul jenis surat
	Route::get('/jenis_surat', 'coJenis_surat@index')->name('jenis_surat');
	Route::get('/jenis_surat/data', 'coJenis_surat@listData')->name('jenis_surat.data');
	Route::post('/jenis_surat/store', 'coJenis_surat@store')->name('jenis_surat.simpan');
	Route::get('/jenis_surat/{id?}/edit', 'coJenis_surat@edit');
	Route::put('/jenis_surat/{id?}', 'coJenis_surat@update');
	Route::delete('/jenis_surat/{id?}', 'coJenis_surat@destroy');

	// Route modul sifat surat
	Route::get('/sifat_surat', 'coSifatsurat@index')->name('sifat_surat');
	Route::get('/sifat_surat/data', 'coSifatsurat@listData')->name('sifat_surat.data');
	Route::post('/sifat_surat/store', 'coSifatsurat@store')->name('sifat_surat.simpan');
	Route::get('/sifat_surat/{id?}/edit', 'coSifatsurat@edit');
	Route::put('/sifat_surat/{id?}', 'coSifatsurat@update');
	Route::delete('/sifat_surat/{id?}', 'coSifatsurat@destroy');

	// Route modul masa karyawan
	Route::get('/karyawan', 'coKaryawan@index')->name('karyawan');
	Route::get('/karyawan/data', 'coKaryawan@listData')->name('karyawan.data');
	Route::post('/karyawan/store', 'coKaryawan@store')->name('karyawan.simpan');
	Route::get('/karyawan/{id?}/edit', 'coKaryawan@edit');
	Route::post('/karyawan/{id?}', 'coKaryawan@update');
	Route::get('/karyawan/{id?}/editFoto', 'coKaryawan@editFoto');
	Route::post('/karyawan/editFoto/{id?}', 'coKaryawan@updateFoto');
	Route::delete('/karyawan/{id?}', 'coKaryawan@destroy');

	// Route modul pengguna
	Route::get('/pengguna', 'coPengguna@index')->name('pengguna');
	Route::get('/pengguna/data', 'coPengguna@listData')->name('pengguna.data');
	Route::post('/pengguna/store', 'coPengguna@store')->name('pengguna.simpan');
	Route::get('/pengguna/{id?}/edit', 'coPengguna@edit');
	Route::put('/pengguna/{id?}', 'coPengguna@update');
	Route::put('/pengguna/editPassword/{id?}', 'coPengguna@updatePassword');
	Route::delete('/pengguna/{id?}', 'coPengguna@destroy');
});

Route::group(['middleware' => ['web','auth','role_sekretariat','cek_password']], function(){
	// Route modul disposisi direksi
	Route::get('/jenis_disposisi', 'coJenisdisposisi_direksi@index')->name('jenis_disposisi');
	Route::get('/jenis_disposisi/data', 'coJenisdisposisi_direksi@listData')->name('jenis_disposisi.data');
	Route::post('/jenis_disposisi/store', 'coJenisdisposisi_direksi@store')->name('jenis_disposisi.simpan');
	Route::get('/jenis_disposisi/{id?}/edit', 'coJenisdisposisi_direksi@edit');
	Route::put('/jenis_disposisi/{id?}', 'coJenisdisposisi_direksi@update');
	Route::delete('/jenis_disposisi/{id?}', 'coJenisdisposisi_direksi@destroy');

	// Route modul klasifikasi
	Route::get('/klasifikasi', 'coKlasifikasi@index')->name('klasifikasi');
	Route::get('/klasifikasi/data', 'coKlasifikasi@listData')->name('klasifikasi.data');
	Route::get('/klasifikasi/listTop', 'coKlasifikasi@listTop')->name('klasifikasi.listTop');
	Route::get('/klasifikasi/listMiddle', 'coKlasifikasi@listMiddle')->name('klasifikasi.listMiddle');
	Route::post('/klasifikasi/store_top', 'coKlasifikasi@store_top')->name('klasifikasi.simpan_top');
	Route::post('/klasifikasi/store_mid', 'coKlasifikasi@store_mid')->name('klasifikasi.simpan_mid');
	Route::post('/klasifikasi/store_bot', 'coKlasifikasi@store_bot')->name('klasifikasi.simpan_bot');

	// Route modul retensi aktif
	Route::get('/retensi_aktif', 'coRetensi_aktif@index')->name('retensi_aktif');
	Route::get('/retensi_aktif/data', 'coRetensi_aktif@listData')->name('retensi_aktif.data');
	Route::post('/retensi_aktif/store', 'coRetensi_aktif@store')->name('retensi_aktif.simpan');
	Route::get('/retensi_aktif/{id?}/edit', 'coRetensi_aktif@edit');
	Route::put('/retensi_aktif/{id?}', 'coRetensi_aktif@update');

	// Route modul retensi inaktif
	Route::get('/retensi_inaktif', 'coRetensi_inaktif@index')->name('retensi_inaktif');
	Route::get('/retensi_inaktif/data', 'coRetensi_inaktif@listData')->name('retensi_inaktif.data');
	Route::post('/retensi_inaktif/store', 'coRetensi_inaktif@store')->name('retensi_inaktif.simpan');
	Route::get('/retensi_inaktif/{id?}/edit', 'coRetensi_inaktif@edit');
	Route::put('/retensi_inaktif/{id?}', 'coRetensi_inaktif@update');

	// Route modul retensi deskripsi
	Route::get('/retensi_deskripsi', 'coRetensi_deskripsi@index')->name('retensi_deskripsi');
	Route::get('/retensi_deskripsi/data', 'coRetensi_deskripsi@listData')->name('retensi_deskripsi.data');
	Route::post('/retensi_deskripsi/store', 'coRetensi_deskripsi@store')->name('retensi_deskripsi.simpan');
	Route::get('/retensi_deskripsi/{id?}/edit', 'coRetensi_deskripsi@edit');
	Route::put('/retensi_deskripsi/{id?}', 'coRetensi_deskripsi@update');
});

// ===============================================================================================================================================

// MASTER TRANSAKSI

// ===============================================================================================================================================

// ROUTE MODUL SURAT KELUAR EKSTERNAL
Route::get('/surat_keluar_eksternal', 'coSurat_keluar_eks@index')->middleware('auth','cek_password')->name('surat_keluar_eks');
Route::get('/surat_keluar_eksternal/data/klasifikasi', 'coSurat_keluar_eks@listKlasifikasi')->name('surat_keluar_eks.klasifikasi');
Route::get('/surat_keluar_eksternal/data/list', 'coSurat_keluar_eks@list')->middleware('auth')->name('surat_keluar_eks.list');
Route::get('/surat_keluar_eksternal/data/konseptor', 'coSurat_keluar_eks@listKonseptor')->name('surat_keluar_eks.konseptor');
Route::get('/surat_keluar_eksternal/tambah', 'coSurat_keluar_eks@tambah')->middleware('auth','cek_password')->name('surat_keluar_eks.tambah');
Route::get('/surat_keluar_eksternal/{id?}/ubah', 'coSurat_keluar_eks@ubah');
Route::get('/surat_keluar_eksternal/{id?}/detail', 'coSurat_keluar_eks@detail');
Route::post('/surat_keluar_eksternal/store', 'coSurat_keluar_eks@store')->name('surat_keluar_eks.simpan');
Route::post('/surat_keluar_eksternal/{id?}/update', 'coSurat_keluar_eks@update');

// ROUTE MODUL SURAT KELUAR INTERNAL
Route::get('/surat_keluar_internal', 'coSurat_keluar_int@index')->middleware('auth','cek_password')->name('surat_keluar_int');
Route::get('/surat_keluar_internal/data/klasifikasi', 'coSurat_keluar_int@listKlasifikasi')->middleware('auth')->name('surat_keluar_int.klasifikasi');
Route::get('/surat_keluar_internal/data/list', 'coSurat_keluar_int@list')->middleware('auth')->name('surat_keluar_int.list');
Route::get('/surat_keluar_internal/data/konseptor', 'coSurat_keluar_int@listKonseptor')->middleware('auth')->name('surat_keluar_int.konseptor');
Route::get('/surat_keluar_internal/tambah', 'coSurat_keluar_int@tambah')->middleware('auth','cek_password')->name('surat_keluar_int.tambah');
Route::get('/surat_keluar_internal/{id?}/ubah', 'coSurat_keluar_int@ubah')->middleware('auth');
Route::get('/surat_keluar_internal/{id?}/detail', 'coSurat_keluar_int@detail');
Route::post('/surat_keluar_internal/store', 'coSurat_keluar_int@store')->name('surat_keluar_int.simpan');
Route::post('/surat_keluar_internal/{id?}/update', 'coSurat_keluar_int@update');

// ROUTE MODUL SURAT KELUAR KARYAWAN
Route::get('/surat_keluar_karyawan', 'coSurat_keluar_kry@index')->middleware('auth','cek_password')->name('surat_keluar_karyawan');
Route::get('/surat_keluar_karyawan/data/klasifikasi', 'coSurat_keluar_kry@listKlasifikasi')->middleware('auth')->name('surat_keluar_karyawan.klasifikasi');
Route::get('/surat_keluar_karyawan/data/list', 'coSurat_keluar_kry@list')->middleware('auth')->name('surat_keluar_karyawan.list');
Route::get('/surat_keluar_karyawan/data/konseptor', 'coSurat_keluar_kry@listKonseptor')->middleware('auth')->name('surat_keluar_karyawan.konseptor');
Route::get('/surat_keluar_karyawan/tambah', 'coSurat_keluar_kry@tambah')->middleware('auth','cek_password')->name('surat_keluar_karyawan.tambah');
Route::get('/surat_keluar_karyawan/{id?}/ubah', 'coSurat_keluar_kry@ubah')->middleware('auth');
Route::get('/surat_keluar_karyawan/{id?}/detail', 'coSurat_keluar_kry@detail');
Route::post('/surat_keluar_karyawan/store', 'coSurat_keluar_kry@store')->name('surat_keluar_karyawan.simpan');
Route::post('/surat_keluar_karyawan/{id?}/update', 'coSurat_keluar_kry@update');

// ROUTE MODUL SURAT KELUAR DIREKSI INTERNAL
Route::get('/surat_keluar_direktur_internal', 'coSurat_keluar_dir_int@index')->middleware('auth','cek_password')->name('surat_keluar_direktur_internal');
Route::get('/surat_keluar_direktur_internal/data/klasifikasi', 'coSurat_keluar_dir_int@listKlasifikasi')->middleware('auth')->name('surat_keluar_direktur_internal.klasifikasi');
Route::get('/surat_keluar_direktur_internal/data/list', 'coSurat_keluar_dir_int@list')->middleware('auth')->name('surat_keluar_direktur_internal.list');
Route::get('/surat_keluar_direktur_internal/data/konseptor', 'coSurat_keluar_dir_int@listKonseptor')->middleware('auth')->name('surat_keluar_direktur_internal.konseptor');
Route::get('/surat_keluar_direktur_internal/tambah', 'coSurat_keluar_dir_int@tambah')->middleware('auth','cek_password')->name('surat_keluar_direktur_internal.tambah');
Route::get('/surat_keluar_direktur_internal/{id?}/ubah', 'coSurat_keluar_dir_int@ubah')->middleware('auth');
Route::get('/surat_keluar_direktur_internal/{id?}/detail', 'coSurat_keluar_dir_int@detail');
Route::post('/surat_keluar_direktur_internal/store', 'coSurat_keluar_dir_int@store')->name('surat_keluar_direktur_internal.simpan');
Route::post('/surat_keluar_direktur_internal/{id?}/update', 'coSurat_keluar_dir_int@update');

// ROUTE MODUL SURAT KELUAR DIREKSI EKSTERNAL
Route::get('/surat_keluar_direktur_eksternal', 'coSurat_keluar_dir_eks@index')->middleware('auth','cek_password')->name('surat_keluar_direktur_eksternal');
Route::get('/surat_keluar_direktur_eksternal/data/klasifikasi', 'coSurat_keluar_dir_eks@listKlasifikasi')->middleware('auth')->name('surat_keluar_direktur_eksternal.klasifikasi');
Route::get('/surat_keluar_direktur_eksternal/data/list', 'coSurat_keluar_dir_eks@list')->middleware('auth')->name('surat_keluar_direktur_eksternal.list');
Route::get('/surat_keluar_direktur_eksternal/data/konseptor', 'coSurat_keluar_dir_eks@listKonseptor')->middleware('auth')->name('surat_keluar_direktur_eksternal.konseptor');
Route::get('/surat_keluar_direktur_eksternal/tambah', 'coSurat_keluar_dir_eks@tambah')->middleware('auth','cek_password')->name('surat_keluar_direktur_eksternal.tambah');
Route::get('/surat_keluar_direktur_eksternal/{id?}/ubah', 'coSurat_keluar_dir_eks@ubah')->middleware('auth');
Route::get('/surat_keluar_direktur_eksternal/{id?}/detail', 'coSurat_keluar_dir_eks@detail');
Route::post('/surat_keluar_direktur_eksternal/store', 'coSurat_keluar_dir_eks@store')->name('surat_keluar_direktur_eksternal.simpan');
Route::post('/surat_keluar_direktur_eksternal/{id?}/update', 'coSurat_keluar_dir_eks@update');

// ROUTE MODUL SURAT MASUK INTERNAL
Route::get('/surat_masuk_internal', 'coSurat_masuk_int@index')->middleware('auth','cek_password')->name('surat_masuk_internal');
Route::get('/surat_masuk_internal/data', 'coSurat_masuk_int@list_suratmasuk')->middleware('auth')->name('surat_masuk_internal.data');
Route::get('/surat_masuk_internal/{id?}/agenda', 'coSurat_masuk_int@agenda_sentral');
Route::post('/surat_masuk_internal/store', 'coSurat_masuk_int@store')->name('surat_masuk_internal.simpan');

// ROUTE MODUL SURAT MASUK EKSTERNAL
Route::get('/surat_masuk_eksternal', 'coSurat_masuk_eks@index')->middleware('auth','cek_password')->name('surat_masuk_eksternal');
Route::get('/surat_masuk_eksternal/data/klasifikasi', 'coSurat_masuk_eks@listKlasifikasi')->middleware('auth')->name('surat_masuk_eksternal.klasifikasi');
Route::get('/surat_masuk_eksternal/data/list', 'coSurat_masuk_eks@list')->middleware('auth')->name('surat_masuk_eksternal.list');
Route::get('/surat_masuk_eksternal/tambah', 'coSurat_masuk_eks@tambah')->middleware('auth')->name('surat_masuk_eksternal.tambah');
Route::get('/surat_masuk_eksternal/{id?}/ubah', 'coSurat_masuk_eks@ubah')->middleware('auth');
Route::get('/surat_masuk_eksternal/{id?}/detail', 'coSurat_masuk_eks@detail');
Route::post('/surat_masuk_eksternal/store', 'coSurat_masuk_eks@store')->name('surat_masuk_eksternal.simpan');
Route::post('/surat_masuk_eksternal/{id?}/update', 'coSurat_masuk_eks@update');

// ROUTE MODUL SURAT MASUK DIREKSI SENTRAL / AGENDA DIREKSI SENTRAL
Route::get('/agenda_direksi', 'coAgenda_direksi@index')->middleware('auth','cek_password')->name('agenda_direksi');
Route::get('/agenda_direksi/data', 'coAgenda_direksi@listSurat_masuk')->middleware('auth')->name('agenda_direksi.data');
Route::get('/agenda_direksi/{id?}/agenda', 'coAgenda_direksi@agenda_direksi');
Route::post('/agenda_direksi/store', 'coAgenda_direksi@store')->name('agenda_direksi.simpan');

// ROUTE MODUL SURAT MASUK DIREKSI LANGSUNG / AGENDA DIREKSI LANGSUNG
Route::get('/agenda_direksi_langsung', 'coAgenda_direksi_langsung@index')->middleware('auth','cek_password')->name('agenda_direksi_langsung');
Route::get('/agenda_direksi_langsung/data', 'coAgenda_direksi_langsung@listSurat_masuk')->middleware('auth')->name('agenda_direksi_langsung.data');
Route::get('/agenda_direksi_langsung/{id?}/agenda', 'coAgenda_direksi_langsung@agenda_direksi_langsung');
Route::post('/agenda_direksi_langsung/store', 'coAgenda_direksi_langsung@store')->name('agenda_direksi_langsung.simpan');

// ROUTE MODUL SURAT KELUAR DIREKSI / AGENDA DIREKSI
Route::get('/agenda_sk_direksi', 'coAgenda_sk_direksi@index')->middleware('auth','cek_password')->name('agenda_sk_direksi');
Route::get('/agenda_sk_direksi/data', 'coAgenda_sk_direksi@listSurat_keluar')->middleware('auth')->name('agenda_sk_direksi.data');
Route::get('/agenda_sk_direksi/{id?}/agenda', 'coAgenda_sk_direksi@agenda_sk_direksi');
Route::post('/agenda_sk_direksi/store', 'coAgenda_sk_direksi@store')->name('agenda_sk_direksi.simpan');

// ROUTE MODUL DISPOSISI DIREKSI SURAT MASUK
Route::get('/disposisi_direksi_sm', 'coDisposisi_dir_sm@index')->middleware('auth','cek_password')->name('disposisi_direksi_sm');
Route::get('/disposisi_direksi_sm/data', 'coDisposisi_dir_sm@list')->middleware('auth')->name('disposisi_direksi_sm.data');
Route::get('/disposisi_direksi_sm/{id?}/disposisi', 'coDisposisi_dir_sm@disposisi');
Route::get('/disposisi_direksi_sm/{id?}/detail', 'coDisposisi_dir_sm@detail');
Route::post('/disposisi_direksi_sm/{id?}/update', 'coDisposisi_dir_sm@update');

// ROUTE MODUL DISPOSISI DIREKSI SURAT KELUAR
Route::get('/disposisi_direksi_sk', 'coDisposisi_dir_sk@index')->middleware('auth','cek_password')->name('disposisi_direksi_sk');
Route::get('/disposisi_direksi_sk/data', 'coDisposisi_dir_sk@list')->middleware('auth')->name('disposisi_direksi_sk.data');
Route::get('/disposisi_direksi_sk/{id?}/disposisi', 'coDisposisi_dir_sk@disposisi');
Route::get('/disposisi_direksi_sk/{id?}/detail', 'coDisposisi_dir_sk@detail');
Route::post('/disposisi_direksi_sk/{id?}/update', 'coDisposisi_dir_sk@update');

// ROUTE MODUL FILTER SURAT MASUK DIREKSI
Route::get('/filter_sm_direksi', 'coFilter_sm_direksi@index')->middleware('auth','cek_password')->name('filter_sm_direksi');
Route::get('/filter_sm_direksi/data', 'coFilter_sm_direksi@list')->middleware('auth')->name('filter_sm_direksi.data');
Route::get('/filter_sm_direksi/{id?}/detail', 'coFilter_sm_direksi@detail');
Route::post('/filter_sm_direksi/kirim_terpilih', 'coFilter_sm_direksi@filterSelected')->name('filter_sm_direksi.kirim');

// ===============================================================================================================================================

// LAPORAN

// ===============================================================================================================================================

// ROUTE MODUL LAPORAN SURAT MASUK LANGSUNG
Route::get('/laporan_surat_masuk_langsung', 'coLap_surat_masuk_langsung@index')->middleware('auth','cek_password')->name('lap_surat_masuk_langsung');
Route::get('/laporan_surat_masuk_langsung/data', 'coLap_surat_masuk_langsung@list')->middleware('auth')->name('lap_surat_masuk_langsung.data');
Route::get('/laporan_surat_masuk_langsung/{id?}/detail', 'coLap_surat_masuk_langsung@detail');

// ROUTE MODUL LAPORAN SURAT MASUK DISPOSISI
Route::get('/laporan_surat_masuk_disposisi', 'coLap_surat_masuk_disposisi@index')->middleware('auth','cek_password')->name('lap_surat_masuk_disposisi');
Route::get('/laporan_surat_masuk_disposisi/data', 'coLap_surat_masuk_disposisi@list')->middleware('auth')->name('lap_surat_masuk_disposisi.data');
Route::get('/laporan_surat_masuk_disposisi/{id?}/detail', 'coLap_surat_masuk_disposisi@detail');

// ROUTE MODUL LAPORAN SURAT MASUK TINDASAN
Route::get('/laporan_surat_masuk_tindasan', 'coLap_surat_masuk_tindasan@index')->middleware('auth','cek_password')->name('lap_surat_masuk_tindasan');
Route::get('/laporan_surat_masuk_tindasan/data', 'coLap_surat_masuk_tindasan@list')->middleware('auth')->name('lap_surat_masuk_tindasan.data');
Route::get('/laporan_surat_masuk_tindasan/{id?}/detail', 'coLap_surat_masuk_tindasan@detail');

// ROUTE MODUL LAPORAN AGENDA SENTRAL INTERNAL KANTOR DIREKSI
Route::get('/laporan_agenda_sentral_int', 'coLap_agenda_sentral_int@index')->middleware('auth','cek_password')->name('lap_agenda_sentral_int');
Route::get('/laporan_agenda_sentral_int/data', 'coLap_agenda_sentral_int@list')->middleware('auth')->name('lap_agenda_sentral_int.data');
Route::get('/laporan_agenda_sentral_int/{id?}/detail', 'coLap_agenda_sentral_int@detail');

// ROUTE MODUL LAPORAN AGENDA SENTRAL EKSTERNAL KANTOR DIREKSI
Route::get('/laporan_agenda_sentral_eks', 'coLap_agenda_sentral_eks@index')->middleware('auth','cek_password')->name('lap_agenda_sentral_eks');
Route::get('/laporan_agenda_sentral_eks/data', 'coLap_agenda_sentral_eks@list')->middleware('auth')->name('lap_agenda_sentral_eks.data');
Route::get('/laporan_agenda_sentral_eks/{id?}/detail', 'coLap_agenda_sentral_eks@detail');

// ROUTE MODUL LAPORAN DISPOSISI DIREKSI SURAT MASUK
Route::get('/laporan_disposisi_direksi_sm', 'coLap_disposisi_dir_sm@index')->middleware('auth','cek_password')->name('lap_disposisi_dir_sm');
Route::get('/laporan_disposisi_direksi_sm/data', 'coLap_disposisi_dir_sm@list')->middleware('auth')->name('lap_disposisi_dir_sm.data');
Route::get('/laporan_disposisi_direksi_sm/{id?}/detail', 'coLap_disposisi_dir_sm@detail');

// ROUTE MODUL LAPORAN DISPOSISI DIREKSI SURAT KELUAR
Route::get('/laporan_disposisi_direksi_sk', 'coLap_disposisi_dir_sk@index')->middleware('auth','cek_password')->name('lap_disposisi_dir_sk');
Route::get('/laporan_disposisi_direksi_sk/data', 'coLap_disposisi_dir_sk@list')->middleware('auth')->name('lap_disposisi_dir_sk.data');
Route::get('/laporan_disposisi_direksi_sk/{id?}/detail', 'coLap_disposisi_dir_sk@detail');

Route::get('/home', 'HomeController@index')->middleware('auth','cek_password')->name('home');
Route::get('/forbidden', 'HomeController@forbidden')->middleware('auth','cek_password')->name('forbidden');
Route::get('/ganti_password', 'HomeController@ganti_password');
Route::post('/ganti_password/{id?}/update_password', 'HomeController@update_password');