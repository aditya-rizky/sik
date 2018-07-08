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

class coLap_sk_dir_eks extends Controller
{
    public function index()
    {
    	$tujuan = DB::table('tbl_bagian')->where('grup_bagian', 0)->orderBy('id_bagian')->get();
    	return view('lap_sk_dir_eks')->with('tujuan', $tujuan);
    }

    public function list()
    {
        $konseptor = DB::table("tbl_surat_keluar")
                    ->where('jenis_surat', 4)
                    ->orderBy('tanggal_surat', 'desc')
                    ->get();
        $no = 0;
        $data = array();
        foreach ($konseptor as $list) {
            $no++;
            $row = array();

            $row[] = $no;
            $row[] = $list->nomor_surat;
            $row[] = date('d M Y', strtotime($list->tanggal_surat));
            $row[] = $list->nama_tujuan;
            $row[] = $list->perihal;
            $row[] = "<button type='button' class='btn btn-default btn-xs shiny icon-only azure tooltip-azure' onclick='detail(".$list->id_surat_keluar.")' data-toggle='tooltip' data-placement='top' data-original-title='Detail Surat' href='javascript:void(0);'><i class='fa fa-eye'></i></button>";
            $data[] = $row;
        }

        return DataTables::of($data)->escapeColumns([])->make(true);
    }

    public function detail($id)
    {
        $detail = DB::table('tbl_surat_keluar')
                    ->join('tbl_karyawan', 'tbl_surat_keluar.id_konseptor', '=', 'tbl_karyawan.id_karyawan')
                    ->join('users', 'tbl_surat_keluar.id_pembuat', '=', 'users.id')
                    ->where('id_surat_keluar', $id)->first();

        $agenda = DB::table('tbl_agenda_direksi')
                    ->where('id_surat_masuk_keluar', $id)
                    ->where('jenis_surat', 2)->first();

        $arrTindasan = explode(',', $detail->tindasan);
        $arrTindasan = array_map('floatval', $arrTindasan);
        $tindasan = DB::table('tbl_bagian')->whereIn('id_bagian', $arrTindasan)->get();

        $arrTujuan = explode(',', $detail->tujuan);
        $arrTujuan = array_map('floatval', $arrTujuan);
        $tujuan = DB::table('tbl_bagian')->whereIn('id_bagian', $arrTujuan)->get();

        if($agenda != NULL){
            $arrTujuan_dispo = explode(',', $agenda->tujuan_dispo);
            $arrTujuan_dispo = array_map('floatval', $arrTujuan_dispo);
            $tujuan_dispo = DB::table('tbl_bagian')->whereIn('id_bagian', $arrTujuan_dispo)->get();

            $arrDireksi_dispo = explode(',', $agenda->direksi_dispo);
            $arrDireksi_dispo = array_map('floatval', $arrDireksi_dispo);
            $direksi_dispo = DB::table('tbl_disposisi_direksi')->whereIn('id_disposisi_direksi', $arrDireksi_dispo)->get();
        }else{
            $tujuan_dispo = "";
            $direksi_dispo = "";
        }

        return view('modal/modal_detailLap_sk_dir_eks', compact(['detail','tindasan','tujuan','tujuan_dispo','direksi_dispo','agenda']));
    }
}
