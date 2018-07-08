<?php

// ==================================================================================
// *   Web Analyst + Design + Develop by Aditya Rizky Dinna Cahya - Staf TI PT Perkebunan Nusantara IX
// *   Project : Sistem Informasi Kesekretariatan - Surakarta, 01 April 2018
// *   
// *   :: plz..don't remove this text if u are "the real open-sourcer" ::
// ====================================================================================

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DataTables;
use Redirect;

class coSurat_masuk_eks extends Controller
{
    public function index()
    {
    	return view('surat_masuk_eks');
    }

    public function tambah()
    {
        $all = DB::table('tbl_bagian')->orderBy('grup_bagian')->orderBy('id_bagian')->get();
        return view('form_tambah/add_surat_masuk_eks', compact(['all']));
    }

    public function listKlasifikasi()
    {
        $klas = DB::table("tbl_klasifikasi")->select('id_klas','kode_klas','nama_klas')->get();
        $no = 0;
        $data = array();
        foreach ($klas as $list) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $list->id_klas;
            $row[] = $list->kode_klas;
            $row[] = $list->nama_klas;
            $data[] = $row;
        }

        return DataTables::of($data)->escapeColumns([])->make(true);
    }

    public function list()
    {
        $konseptor = DB::table("tbl_surat_masuk")
                    ->where('jenis_surat', 1)
                    ->orderBy('tanggal_surat', 'desc')
                    ->get();
        $no = 0;
        $data = array();
        foreach ($konseptor as $list) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $list->nomor_agenda;
            $row[] = date('d M Y', strtotime($list->tanggal_agenda));
            $row[] = $list->nomor_surat;
            $row[] = $list->perihal;
            $row[] = "<button type='button' class='btn btn-default btn-xs shiny icon-only purple tooltip-purple' onclick='detail(".$list->id_surat_masuk.")' data-toggle='tooltip' data-placement='top' data-original-title='Detail Surat' href='javascript:void(0);'><i class='fa fa-eye'></i></button>
                      <a href='surat_masuk_eksternal/".$list->id_surat_masuk."/ubah' class='btn btn-default btn-xs shiny icon-only purple tooltip-purple' data-toggle='tooltip' data-placement='top' data-original-title='Ubah Surat'><i class='fa fa-pencil'></i></a>";
            $data[] = $row;
        }

        return DataTables::of($data)->escapeColumns([])->make(true);
    }

    public function detail($id)
    {
        $detail = DB::table('tbl_surat_masuk')->where('id_surat_masuk', $id)->first();
        $arrTindasan = explode(',', $detail->tindasan);
        $arrTindasan = array_map('floatval', $arrTindasan);
        $tindasan = DB::table('tbl_bagian')->whereIn('id_bagian', $arrTindasan)->get();

        $arrTujuan = explode(',', $detail->tujuan);
        $arrTujuan = array_map('floatval', $arrTujuan);
        $tujuan = DB::table('tbl_bagian')->whereIn('id_bagian', $arrTujuan)->get();
        return view('modal/modal_detailsm_eksternal', compact(['detail','tindasan','tujuan']));
    }

    public function ubah($id)
    {
        $surat = DB::table('tbl_surat_masuk')->where('id_surat_masuk', $id)
                    ->join('tbl_klasifikasi', 'tbl_surat_masuk.id_klasifikasi', '=', 'tbl_klasifikasi.id_klas')
                    ->first();

        $url = url('surat_masuk_eksternal/'.$id.'/update');
        $selected_tindasan = explode(",", $surat->tindasan);
        $selected_tujuan = explode(",", $surat->tujuan);
        $sifat = DB::table('tbl_sifat_surat')->orderBy('id_sifat_surat')->get();
        $all = DB::table('tbl_bagian')->orderBy('grup_bagian')->orderBy('id_bagian')->get();
        return view('form_ubah/edit_surat_masuk_eks', compact(['surat','sifat','all','selected_tindasan','selected_tujuan','url']));
    }

    public function update(Request $request, $id)
    {
        if(empty($request->tindasan)){
            $arrTindasan = "";
        }else{
            $arrTindasan = implode(',', $request->tindasan);
        }

        $cek_agenda_dir = DB::table('tbl_agenda_direksi')->where('id_surat_masuk_keluar', $id)->where('jenis_surat', 0)->first();
        if($cek_agenda_dir == NULL){
            $arrTujuan = implode(',', $request->nama_tujuan);
            DB::table('tbl_surat_masuk')->where('id_surat_masuk', $id)->update([
                'tanggal_surat' => $request->tanggal_surat,
                'nomor_surat' => $request->nomor_surat,
                'id_klasifikasi' => $request->id_klasifikasi,
                'nama_pengirim' => $request->nama_pengirim,
                'tujuan' => $arrTujuan,
                'perihal' => $request->perihal,
                'tindasan' => $arrTindasan,
                'updated_at' => \Carbon\Carbon::now()
            ]);

            return Redirect::to('surat_masuk_eksternal')->with('status', "<div class='alert alert-success alert-dismissible fade in' role='alert'>
                                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button>
                                    <strong>Sukses !</strong> Data berhasil diubah.
                                </div>");
        }else{
            return Redirect::to('surat_masuk_eksternal')->with('status', "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
                                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button>
                                    <strong>Gagal !</strong> Data gagal diperbaharui, sudah diagenda direksi.
                                </div>");
        }
    }

    public function store(Request $request)
    {
        $thn = substr($request->tanggal_agenda, 0, 4);
        $getNumber = DB::table('tbl_temp_surat_masuk')->where('tahun', $thn)->first();

        if(empty($request->tindasan)){
            $arrTindasan = "";
        }else{
            $arrTindasan = implode(',', $request->tindasan);
        }

        $arrTujuan = implode(',', $request->nama_tujuan);
        if($getNumber == NULL){
            $urut = 1;
            DB::table('tbl_temp_surat_masuk')->insert([
                'tahun' => $thn,
                'nomor_urut' => $urut,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ]);
        }else{
            $urut = $getNumber->nomor_urut;
            $urut += 1;
            DB::table('tbl_temp_surat_masuk')->where('id_temp_surat_masuk', $getNumber->id_temp_surat_masuk)->update([
                'nomor_urut' => $urut,
                'updated_at' => \Carbon\Carbon::now()
            ]);
        }

        DB::table('tbl_surat_masuk')->insert([
            'jenis_surat' => 1,
            'id_klasifikasi' => $request->id_klasifikasi,
            'tanggal_agenda' => $request->tanggal_agenda,
            'nomor_agenda' => $urut,
            'nomor_surat' => $request->nomor_surat,
            'tanggal_surat' => $request->tanggal_surat,
            'nama_pengirim' => $request->nama_pengirim,
            'tujuan' => $arrTujuan,
            'perihal' => $request->perihal,
            'tindasan' => $arrTindasan,
            'tahun_surat' => $thn,
            'stat_agenda_dir' => 0,
            'id_bagian' => 0,
            'status_filter' => 0,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);

        return response()->json(['status'=>'1', 'nomor'=>$urut]);
    }
}
