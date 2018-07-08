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
use Auth;

class coLap_surat_masuk_disposisi extends Controller
{
    public function index()
    {
    	$tujuan = DB::table('tbl_bagian')->where('grup_bagian', 0)->orderBy('id_bagian')->get();
    	return view('lap_surat_masuk_disposisi')->with('tujuan', $tujuan);
    }

    public function list(Request $request)
    {
    	$id_asal = Auth::user()->id_bagian;
        $konseptor = DB::table("tbl_agenda_direksi")
        				->select('id_agenda','tbl_surat_masuk.nomor_surat','tbl_agenda_direksi.nomor_agenda','tbl_agenda_direksi.tanggal_agenda','tbl_surat_masuk.perihal')
                        ->join('tbl_surat_masuk', 'tbl_surat_masuk.id_surat_masuk', '=', 'tbl_agenda_direksi.id_surat_masuk_keluar')
                    ->whereRaw("((',' || RTRIM(tbl_agenda_direksi.tujuan_dispo) || ',') LIKE '%,".$id_asal.",%')
                    			AND tbl_agenda_direksi.jenis_surat = 0 AND tbl_agenda_direksi.id_tujuan_dispo = ".$request->id_direktur)
                    ->orderBy('tbl_agenda_direksi.tanggal_agenda', 'desc')
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
            $row[] = "<button type='button' class='btn btn-default btn-xs shiny icon-only palegreen tooltip-palegreen' onclick='detail(".$list->id_agenda.")' data-toggle='tooltip' data-placement='top' data-original-title='Detail Agenda' href='javascript:void(0);'><i class='fa fa-eye'></i></button>";
            $data[] = $row;
        }

        return DataTables::of($data)->escapeColumns([])->make(true);
    }

    public function detail($id)
    {
        $surat = DB::table('tbl_agenda_direksi')->where('id_agenda', $id)->first();
        $jns = (($surat->jenis_surat == 0) ? $x = "_surat_masuk" : $x = "_surat_keluar");
        $detail = DB::table('tbl'.$x)->where('id'.$x, $surat->id_surat_masuk_keluar)->first();

        $arrTindasan = explode(',', $detail->tindasan);
        $arrTindasan = array_map('floatval', $arrTindasan);
        $tindasan = DB::table('tbl_bagian')->whereIn('id_bagian', $arrTindasan)->get();

        $arrTujuan = explode(',', $detail->tujuan);
        $arrTujuan = array_map('floatval', $arrTujuan);
        $tujuan = DB::table('tbl_bagian')->whereIn('id_bagian', $arrTujuan)->get();

        $arrTujuan_dispo = explode(',', $surat->tujuan_dispo);
        $arrTujuan_dispo = array_map('floatval', $arrTujuan_dispo);
        $tujuan_dispo = DB::table('tbl_bagian')->whereIn('id_bagian', $arrTujuan_dispo)->get();

        $arrDireksi_dispo = explode(',', $surat->direksi_dispo);
        $arrDireksi_dispo = array_map('floatval', $arrDireksi_dispo);
        $direksi_dispo = DB::table('tbl_disposisi_direksi')->whereIn('id_disposisi_direksi', $arrDireksi_dispo)->get();

        return view('modal/modal_detaildispo_dir_sm', compact(['detail','tindasan','tujuan','tujuan_dispo','direksi_dispo','surat']));
    }
}
