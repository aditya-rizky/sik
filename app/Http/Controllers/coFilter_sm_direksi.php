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

class coFilter_sm_direksi extends Controller
{
    public function index()
    {
    	return view('filter_sm_direksi');
    }

    public function list()
    {
        $konseptor = DB::table("tbl_surat_masuk")
                    ->where('jenis_surat', 1)
                    ->where('status_filter', 0)
                    ->orderBy('tanggal_surat', 'desc')
                    ->get();
        $no = 0;
        $data = array();
        foreach ($konseptor as $list) {
            $no++;
            $row = array();
            $row[] = "<label>
	                        <input type='checkbox' class='inverted' name='id[]' value='".$list->id_surat_masuk."'>
	                        <span class='text'></span>
	                    </label>";
            $row[] = $no;
            $row[] = $list->nomor_surat;
            $row[] = date('d M Y', strtotime($list->tanggal_surat));
            $row[] = $list->nama_pengirim;
            $row[] = $list->perihal;
            $row[] = "<button type='button' class='btn btn-default btn-xs shiny icon-only palegreen tooltip-palegreen' onclick='detail(".$list->id_surat_masuk.")' data-toggle='tooltip' data-placement='top' data-original-title='Detail Surat' href='javascript:void(0);'><i class='fa fa-eye'></i></button>";
            $data[] = $row;
        }

        return DataTables::of($data)->escapeColumns([])->make(true);
    }

    // MODAL DETAIL SURAT MASUK
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

    public function filterSelected(Request $request)
    {
        foreach ($request['id'] as $id) {
        	DB::table('tbl_surat_masuk')->where('id_surat_masuk', $id)->update([
	        	'status_filter' => 1,
	            'updated_at' => \Carbon\Carbon::now()
	        ]);
        }
    }
}
