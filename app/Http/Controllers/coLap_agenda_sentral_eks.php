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

class coLap_agenda_sentral_eks extends Controller
{
    public function index()
    {
    	return view('lap_agenda_sentral_eks');
    }

    public function list(Request $request)
    {
    	$id_asal = Auth::user()->id_bagian;
        $listSurat = DB::table("tbl_surat_masuk")
        				->whereRaw("((',' || RTRIM(tujuan) || ',') LIKE '%,".$id_asal.",%'
                                    OR (',' || RTRIM(tindasan) || ',') LIKE '%,".$id_asal.",%')
                                    AND jenis_surat = 1 AND nama_pengirim LIKE '%".$request->nama_pengirim."%' AND tahun_surat = ".$request->tahun)
                        // ->where('jenis_surat', 0)
                        // ->where(function($query){
                        //     $query->where('jenis_surat', 0);
                        //     $query->orWhere('jenis_surat', 2);
                        // })
                        ->orderBy('nomor_surat', 'desc')
        				->get();
        $no = 0;
        $data = array();
        foreach ($listSurat as $list) {
            $no++;
            $row = array();

            $row[] = $no;
            $row[] = $list->nomor_agenda;
            $row[] = date('d M Y', strtotime($list->tanggal_agenda));
            $row[] = $list->nomor_surat;
            $row[] = $list->perihal;
            $row[] = "<button type='button' class='btn btn-default btn-xs shiny icon-only blueberry tooltip-blueberry' onclick='detail(".$list->id_surat_masuk.")' data-toggle='tooltip' data-placement='top' data-original-title='Agenda Surat' href='javascript:void(0);'><i class='fa fa-eye'></i></button>";
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
        return view('modal/modal_agendadireksi', compact(['detail','tindasan','tujuan']));
    }
}
