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

class coLap_sm_int extends Controller
{
    public function index()
    {
    	return view('lap_sm_int');
    }

    public function list(Request $request)
    {
        // $listSurat = DB::table("tbl_surat_keluar")
        //                 ->where('stat_agenda_sentral', 0)
        //                 ->where('stat_agenda_dir', 0)
        //                 ->where(function($query){
        //                     $query->where('jenis_surat', 0);
        //                     $query->orWhere('jenis_surat', 2);
        //                 })
        //                 ->orderBy('nomor_surat', 'desc')
        // 				->get();

        $listSurat = DB::table("tbl_surat_masuk")
                    ->where('jenis_surat', 0)
                    ->where('tahun_surat', $request->tahun)
                    ->orderBy('tanggal_surat', 'desc')
                    ->get();

        $no = 0;
        $data = array();
        foreach ($listSurat as $list) {
            $arrTujuan = explode(',', $list->tujuan);
            $arrTujuan = array_map('floatval', $arrTujuan);
            $tujuan = DB::table('tbl_bagian')->select('nama_bagian')->whereIn('id_bagian', $arrTujuan)->get();

            $no++;
            $baris = array();
            $row = array();

            foreach($tujuan as $bag => $x) {
                $y = $bag+1;
                $baris[] = $x->nama_bagian;
            }
            $row[] = $no;
            $row[] = $list->nomor_agenda;
            $row[] = $list->nomor_surat;
            $row[] = date('d M Y', strtotime($list->tanggal_surat));
            $row[] = $list->perihal;
            $row[] = "<button type='button' class='btn btn-default btn-xs shiny icon-only palegreen tooltip-palegreen' onclick='detail(".$list->id_surat_masuk.")' data-toggle='tooltip' data-placement='top' data-original-title='Agenda Surat' href='javascript:void(0);'><i class='fa fa-eye'></i></button>";
            $data[] = $row;
        }

        return DataTables::of($data)->escapeColumns([])->make(true);
    }

    public function detail($id)
    {
        $surat = DB::table('tbl_surat_masuk')->select('id_surat_keluar','nomor_agenda','tanggal_agenda')->where('id_surat_masuk', $id)->first();
        $detail = DB::table('tbl_surat_keluar')->where('id_surat_keluar', $surat->id_surat_keluar)->first();

        $arrTindasan = explode(',', $detail->tindasan);
        $arrTindasan = array_map('floatval', $arrTindasan);
        $tindasan = DB::table('tbl_bagian')->whereIn('id_bagian', $arrTindasan)->get();

        $arrTujuan = explode(',', $detail->tujuan);
        $arrTujuan = array_map('floatval', $arrTujuan);
        $tujuan = DB::table('tbl_bagian')->whereIn('id_bagian', $arrTujuan)->get();

        return view('modal/modal_detailLap_sm_int', compact(['detail','tindasan','tujuan','surat']));
    }
}
