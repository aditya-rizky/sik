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

class coAgenda_sk_direksi extends Controller
{
    public function index()
    {
    	$agenda = DB::table('tbl_jenis_surat')->get();
    	$tujuan = DB::table('tbl_bagian')->where('grup_bagian', 0)->orderBy('id_bagian')->get();
    	$sifat = DB::table('tbl_sifat_surat')->get();
    	$jenis = DB::table('tbl_jenis_surat')->get();
    	return view('agenda_sk_direksi', compact(['agenda','tujuan','sifat','jenis']));
    }

    // LIST TABEL SURAT KELUAR DIREKSI
    public function listSurat_keluar()
    {
        $listSurat = DB::table("tbl_surat_keluar")
                        ->where('stat_agenda_sentral', 0)
                        ->where('stat_agenda_dir', 0)
                        ->where(function($query){
                            $query->where('jenis_surat', 3);
                            $query->orWhere('jenis_surat', 4);
                        })
                        ->orderBy('created_at', 'desc')
        				->get();
        $no = 0;
        $data = array();
        foreach ($listSurat as $list) {
            $no++;
            $row = array();

            $row[] = $no;
            $row[] = $list->nomor_surat;
            $row[] = $list->perihal;
            $row[] = date('d M Y', strtotime($list->tanggal_surat));
            $row[] = "<button type='button' class='btn btn-default btn-xs shiny icon-only darkorange tooltip-darkorange' onclick='agenda_sk_direksi(".$list->id_surat_keluar.")' data-toggle='tooltip' data-placement='top' data-original-title='Agenda Surat' href='javascript:void(0);'><i class='fa fa-pencil'></i></button>";
            $data[] = $row;
        }

        return DataTables::of($data)->escapeColumns([])->make(true);
    }

    // MODAL DETAIL SURAT MASUK / AGENDA DIREKSI
    public function agenda_sk_direksi($id)
    {
        $detail = DB::table('tbl_surat_keluar')->where('id_surat_keluar', $id)->first();
        $arrTindasan = explode(',', $detail->tindasan);
        $arrTindasan = array_map('floatval', $arrTindasan);
        $tindasan = DB::table('tbl_bagian')->whereIn('id_bagian', $arrTindasan)->get();

        $arrTujuan = explode(',', $detail->tujuan);
        $arrTujuan = array_map('floatval', $arrTujuan);
        $tujuan = DB::table('tbl_bagian')->whereIn('id_bagian', $arrTujuan)->get();
        return view('modal/modal_agendaskdireksi', compact(['detail','tindasan','tujuan']));
    }

    // PROSES SIMPAN SURAT KELUAR AGENDA DIREKSI
    public function store(Request $request)
    {
        $thn = substr($request->tanggal_agenda, 0, 4);
        if(isset($request->tampilAgenda)){
            // DENGAN AGENDA
            $nomor = DB::table('tbl_temp_agenda_direksi')
                        ->where('id_direksi', $request->id_tujuan)
                        ->where('id_jenis_surat', $request->id_jenis_surat)
                        ->where('tahun', $thn)
                        ->first();

            $cek = DB::table('tbl_agenda_direksi')
                    ->where('id_surat_masuk_keluar', $request->id_surat_keluar)
                    ->where('tahun_agenda', $thn)
                    ->where('id_tujuan_dispo', $request->id_tujuan)
                    ->where('jenis_surat', 1)
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
                    'id_surat_masuk_keluar' => $request->id_surat_keluar,
                    'id_jns_dispo' => $request->id_jenis_surat,
                    'tanggal_agenda' => $request->tanggal_agenda,
                    'nomor_agenda' => $no_agenda,
                    'jenis_surat' => 2,
                    'tahun_agenda' => $thn,
                    'id_tujuan_dispo' => $request->id_tujuan,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ]);

                DB::table('tbl_surat_keluar')->where('id_surat_keluar', $request->id_surat_keluar)->update([
                    'keterangan' => $request->keterangan,
                    'stat_agenda_dir' => 1,
                    'updated_at' => \Carbon\Carbon::now()
                ]);

                return response()->json(['status'=>'1', 'nomor'=> $no_agenda]);
            }else{
                $no_agenda = "Gagal !";
                return response()->json(['status'=>'2', 'nomor'=> $no_agenda]);
            }
        }else{
            // TANPA AGENDA
            $no_agenda = "Berhasil !";
            DB::table('tbl_surat_keluar')->where('id_surat_keluar', $request->id_surat_keluar)->update([
                'keterangan' => $request->keterangan,
                'stat_agenda_dir' => 1,
                'updated_at' => \Carbon\Carbon::now()
            ]);
            return response()->json(['status'=>'3', 'nomor'=> $no_agenda]);
        }
    }
}