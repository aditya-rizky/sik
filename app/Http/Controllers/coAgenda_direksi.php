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

class coAgenda_direksi extends Controller
{
    public function index()
    {
    	$agenda = DB::table('tbl_jenis_surat')->get();
    	$tujuan = DB::table('tbl_bagian')->where('grup_bagian', 0)->orderBy('id_bagian')->get();
    	$sifat = DB::table('tbl_sifat_surat')->get();
    	$jenis = DB::table('tbl_jenis_surat')->get();
    	return view('agenda_direksi', compact(['agenda','tujuan','sifat','jenis']));
    }

    // LIST TABEL SURAT MASUK EKTERNAL
    public function listSurat_masuk(Request $request)
    {
        $listSurat = DB::table("tbl_surat_masuk")
                        ->select('id_surat_masuk','nomor_surat','nomor_agenda','tanggal_agenda','tujuan','perihal')
                        ->whereRaw("((',' || RTRIM(tujuan) || ',') LIKE '%,".$request->id_direktur.",%'
                                    OR (',' || RTRIM(tindasan) || ',') LIKE '%,".$request->id_direktur.",%')
                                    AND stat_agenda_dir = '0' AND status_filter = 1 AND tahun_surat = ".$request->tahun)
                        ->orderBy('nomor_agenda', 'desc')
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
            $row[] = "<button type='button' class='btn btn-default btn-xs shiny icon-only yellow tooltip-warning' onclick='agenda_direksi(".$list->id_surat_masuk.")' data-toggle='tooltip' data-placement='top' data-original-title='Agenda Surat' href='javascript:void(0);'><i class='fa fa-pencil'></i></button>";
            $data[] = $row;
        }

        return DataTables::of($data)->escapeColumns([])->make(true);
    }

    // MODAL DETAIL SURAT MASUK / AGENDA DIREKSI
    public function agenda_direksi($id)
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

    // PROSES SIMPAN AGENDA DIREKSI
    public function store(Request $request)
    {
    	$thn = substr($request->tanggal_agenda, 0, 4);
    	$nomor = DB::table('tbl_temp_agenda_direksi')
    				->where('id_direksi', $request->id_tujuan)
    				->where('id_jenis_surat', $request->id_jenis_surat)
    				->where('tahun', $thn)
    				->first();

        $cek = DB::table('tbl_agenda_direksi')
                    ->where('id_surat_masuk_keluar', $request->id_surat_masuk)
                    ->where('tahun_agenda', $thn)
                    ->where('id_tujuan_dispo', $request->id_tujuan)
                    ->where('jenis_surat', 0)
                    ->first();

        if($cek == NULL){
            if($nomor == NULL){
                $urut = 1;
                DB::table('tbl_temp_agenda_direksi')->insert([
                    'id_direksi' => $request->id_tujuan,
                    'id_jenis_surat' => $request->id_jenis_surat,
                    'nomor_urut' => $urut,
                    'tahun' => $thn,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ]);
            }else{
                $urut = $nomor->nomor_urut;
                $urut += 1;
                DB::table('tbl_temp_agenda_direksi')->where('id_temp_agenda', $nomor->id_temp_agenda)->update([
                    'nomor_urut' => $urut,
                    'updated_at' => \Carbon\Carbon::now()
                ]);
            }

            $kodeBagian = DB::table('tbl_bagian')->select('kode_bagian')->where('id_bagian', $request->id_tujuan)->first();
            $kodeJenis = DB::table('tbl_jenis_surat')->select('kode_jenis')->where('id_jenis_surat', $request->id_jenis_surat)->first();
            $no_agenda = $kodeBagian->kode_bagian."/".$urut."/".$kodeJenis->kode_jenis;

            DB::table('tbl_agenda_direksi')->insert([
                'id_surat_masuk_keluar' => $request->id_surat_masuk,
                'id_jns_dispo' => $request->id_jenis_surat,
                'tanggal_agenda' => $request->tanggal_agenda,
                'nomor_agenda' => $no_agenda,
                'jenis_surat' => 0,
                'tahun_agenda' => $thn,
                'id_tujuan_dispo' => $request->id_tujuan,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ]);

            return response()->json(['status'=>'1', 'nomor'=> $no_agenda]);
        }else{
            $no_agenda = "Gagal !";
            return response()->json(['status'=>'2', 'nomor'=> $no_agenda]);
        }
    }
}
