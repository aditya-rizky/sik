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
use Redirect;

class coDisposisi_dir_sk extends Controller
{
    public function index()
    {
    	$dir = DB::table('tbl_bagian')->where('grup_bagian', 0)->orderBy('grup_bagian')->orderBy('id_bagian')->get();
    	$bag = DB::table('tbl_bagian')->where('grup_bagian', 1)->orderBy('grup_bagian')->orderBy('id_bagian')->get();
        $dispo = DB::table('tbl_disposisi_direksi')->orderBy('id_disposisi_direksi')->get();
    	return view('disposisi_dir_sk', compact(['dir','dispo','bag']));
    }

    public function list(Request $request)
    {
    	$listSurat = DB::table("tbl_agenda_direksi")
                        ->select('id_agenda','tbl_surat_keluar.nomor_surat','tbl_agenda_direksi.nomor_agenda','tbl_agenda_direksi.tanggal_agenda','tbl_surat_keluar.perihal')
                        ->join('tbl_surat_keluar', 'tbl_surat_keluar.id_surat_keluar', '=', 'tbl_agenda_direksi.id_surat_masuk_keluar')
                        ->where('tbl_agenda_direksi.jenis_surat', 2)
                        ->where('tbl_agenda_direksi.id_tujuan_dispo', $request->id_direktur)
                        ->where('tbl_agenda_direksi.tahun_agenda', $request->tahun)
                        ->orderBy('tbl_agenda_direksi.nomor_agenda', 'desc')
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
            $row[] = "<button type='button' class='btn btn-default btn-xs shiny icon-only azure tooltip-azure' onclick='detail(".$list->id_agenda.")' data-toggle='tooltip' data-placement='top' data-original-title='Detail Agenda' href='javascript:void(0);'><i class='fa fa-eye'></i></button>
                      <a href='disposisi_direksi_sk/".$list->id_agenda."/disposisi' class='btn btn-default btn-xs shiny icon-only azure tooltip-azure' data-toggle='tooltip' data-placement='top' data-original-title='Disposisi Surat'><i class='fa fa-pencil'></i></a>";
            $data[] = $row;
        }

        return DataTables::of($data)->escapeColumns([])->make(true);
    }

    public function disposisi($id)
    {
    	$surat = DB::table('tbl_agenda_direksi')->where('id_agenda', $id)->first();
        $jns = (($surat->jenis_surat == 0) ? $x = "_surat_masuk" : $x = "_surat_keluar");
        $detail = DB::table('tbl'.$x)->select('nomor_surat','perihal','keterangan')->where('id'.$x, $surat->id_surat_masuk_keluar)->first();
        $url = url('disposisi_direksi_sk/'.$id.'/update');
        $selected_disposisi = explode(",", $surat->direksi_dispo);
        $selected_tujuan = explode(",", $surat->tujuan_dispo);
        $dir = DB::table('tbl_bagian')->where('grup_bagian', 0)->orderBy('id_bagian')->get();
        $bag = DB::table('tbl_bagian')->where('grup_bagian', 1)->orderBy('id_bagian')->get();
        $dispo = DB::table('tbl_disposisi_direksi')->orderBy('id_disposisi_direksi')->get();
        return view('form_ubah/edit_disposisi_dir_sk', compact(['surat','url','selected_disposisi','selected_tujuan','detail','dir','bag','dispo']));
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

        return view('modal/modal_detaildispo_dir_sk', compact(['detail','tindasan','tujuan','tujuan_dispo','direksi_dispo','surat']));
    }

    public function update(Request $request, $id)
    {
        if(empty($request->disposisi_direksi)){
            $arrDisposisi_dir = "";
        }else{
            $arrDisposisi_dir = implode(',', $request->disposisi_direksi);
        }

        if(empty($request->tujuan_disposisi)){
            $arrTujuan_dir = "";
        }else{
            $arrTujuan_dir = implode(',', $request->tujuan_disposisi);
        }

        DB::table('tbl_agenda_direksi')->where('id_agenda', $id)->update([
            'tujuan_dispo' => $arrTujuan_dir,
            'direksi_dispo' => $arrDisposisi_dir,
            'uraian_dispo' => $request->uraian_disposisi,
            'tanggal_bagian' => $request->tanggal_bagian,
            'updated_at' => \Carbon\Carbon::now()
        ]);

        DB::table('tbl_surat_keluar')->where('id_surat_keluar', $request->id_surat_masuk_keluar)->update([
            'keterangan' => $request->keterangan,
            'updated_at' => \Carbon\Carbon::now()
        ]);

        return Redirect::to('disposisi_direksi_sk')->with('message', 'Data berhasil diubah.');
    }
}
