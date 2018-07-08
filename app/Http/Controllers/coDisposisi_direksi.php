<?php

// ==================================================================================
// *   Web Analyst + Design + Develop by Aditya Rizky Dinna Cahya - Staf TI PT Perkebunan Nusantara IX
// *   Project : Sistem Informasi Kesekretariatan - Surakarta, 01 April 2018
// *   
// *   :: plz..don't remove this text if u are "the real open-sourcer" ::
// ====================================================================================

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use DB;

class coDisposisi_direksi extends Controller
{
    public function index()
    {
    	$all = DB::table('tbl_bagian')->orderBy('grup_bagian')->orderBy('id_bagian')->get();
        $dispo = DB::table('tbl_disposisi_direksi')->orderBy('id_disposisi_direksi')->get();
    	return view('disposisi_direksi', compact(['all','dispo']));
    }

    public function listDisposisi()
    {
        $dispo = DB::table("tbl_agenda_direksi")
                     ->select('id_agenda_direksi','nomor_agenda','tanggal_agenda','uraian_disposisi','nomor_surat','tipe_surat')
                     ->orderBy('nomor_agenda')
                     ->get();
        $no = 0;
        $data = array();
        foreach ($dispo as $list) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $list->nomor_agenda;
            $row[] = date('d M Y', strtotime($list->tanggal_agenda));
            $row[] = $list->nomor_surat;
            $row[] = $list->uraian_disposisi;
            $row[] = "<button type='button' class='btn btn-default btn-xs shiny icon-only warning tooltip-warning' onclick='detail_disposisi(".$list->id_agenda_direksi.")' data-toggle='tooltip' data-placement='top' data-original-title='Lihat Data' href='javascript:void(0);'><i class='fa fa-eye'></i></button>
            		  <button type='button' class='btn btn-default btn-xs shiny icon-only blue tooltip-blue' onclick='disposisi_direksi(".$list->id_agenda_direksi.")' data-toggle='tooltip' data-placement='top' title='Ubah Data'><span class='fa fa-pencil'></span></button>";
            $data[] = $row;
        }

        return DataTables::of($data)->escapeColumns([])->make(true);
    }

    public function detailDisposisi($id)
    {
        $detail = DB::table('tbl_agenda_direksi')
        			->select('nomor_surat','nomor_agenda','tanggal_agenda','uraian_disposisi','tujuan_disposisi','disposisi_direksi','tanggal_bagian')
                    ->where('id_agenda_direksi', $id)->first();
        $arrTujuan = explode(',', $detail->tujuan_disposisi);
        $arrDisposisi = explode(',', $detail->disposisi_direksi);
        $arrTujuan = array_map('floatval', $arrTujuan);
        $arrDisposisi = array_map('floatval', $arrDisposisi);
        $tujuan = DB::table('tbl_bagian')->whereIn('id_bagian', $arrTujuan)->get();
        $disposisi = DB::table('tbl_disposisi_direksi')->whereIn('id_disposisi_direksi', $arrDisposisi)->get();
        return view('modal/modal_detaildisposisi', compact(['detail', 'tujuan','disposisi']));
    }

    public function agenda_disposisi($id)
    {
        $detail = DB::table('tbl_agenda_direksi')->select('id_agenda_direksi','nomor_agenda','nomor_surat','tanggal_bagian','uraian_disposisi','tujuan_disposisi','disposisi_direksi')
        			->where('id_agenda_direksi', $id)->first();
        echo json_encode($detail);
    }

    public function update(Request $request, $id)
    {
    	if(empty($request->tujuan_disposisi)){
            $arrTujuan = "";
        }else{
            $arrTujuan = implode(',', $request->tujuan_disposisi);
        }

        if(empty($request->disposisi_direksi)){
            $arrDisposisi = "";
        }else{
            $arrDisposisi = implode(',', $request->disposisi_direksi);
        }

        DB::table('tbl_agenda_direksi')->where('id_agenda_direksi', $id)->update([
        	'tujuan_disposisi' => $arrTujuan,
        	'disposisi_direksi' => $arrDisposisi,
        	'uraian_disposisi' => $request->uraian_disposisi,
            'tanggal_bagian' => $request->tanggal_distribusi,
        	'updated_at' => \Carbon\Carbon::now()
        ]);
        return response()->json(['status'=>'1']);
    }
}
