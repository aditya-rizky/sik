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

class coSurat_masuk_int extends Controller
{
    public function index()
    {
    	return view('surat_masuk_int');
    }

    public function list_suratmasuk()
    {
        $listSurat = DB::table("tbl_surat_keluar")
                        ->where('stat_agenda_sentral', 0)
                        ->where('stat_agenda_dir', 0)
                        ->where(function($query){
                            $query->where('jenis_surat', 0);
                        })
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
            $row[] = $list->nomor_surat;
            $row[] = $baris;
            $row[] = $list->perihal;
            $row[] = date('d M Y', strtotime($list->tanggal_surat));
            $row[] = "<button type='button' class='btn btn-default btn-xs shiny icon-only magenta tooltip-magenta' onclick='agenda_surat(".$list->id_surat_keluar.")' data-toggle='tooltip' data-placement='top' data-original-title='Agenda Surat' href='javascript:void(0);'><i class='fa fa-pencil'></i></button>";
            $data[] = $row;
        }

        return DataTables::of($data)->escapeColumns([])->make(true);
    }

    public function agenda_sentral($id)
    {
        $detail = DB::table('tbl_surat_keluar')
                    ->join('tbl_karyawan', 'tbl_surat_keluar.id_konseptor', '=', 'tbl_karyawan.id_karyawan')
                    ->join('users', 'tbl_surat_keluar.id_pembuat', '=', 'users.id')
                    ->where('id_surat_keluar', $id)->first();
        $arrTindasan = explode(',', $detail->tindasan);
        $arrTindasan = array_map('floatval', $arrTindasan);
        $tindasan = DB::table('tbl_bagian')->whereIn('id_bagian', $arrTindasan)->get();

        $arrTujuan = explode(',', $detail->tujuan);
        $arrTujuan = array_map('floatval', $arrTujuan);
        $tujuan = DB::table('tbl_bagian')->whereIn('id_bagian', $arrTujuan)->get();
        return view('modal/modal_agendasentral', compact(['detail', 'tindasan','tujuan']));
    }

    public function store(Request $request)
    {
    	$thn = substr($request->tanggal_agenda, 0, 4);
    	$getNumber = DB::table('tbl_temp_surat_masuk')->where('tahun', $thn)->first();
        $cek_agenda = DB::table('tbl_agenda_direksi')->where('id_surat_masuk_keluar', $request->id_surat_keluar)->where('jenis_surat', 1)->first();

        if($cek_agenda == NULL){
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
                'jenis_surat' => 0,
                'id_surat_keluar' => $request->id_surat_keluar,
                'tanggal_agenda' => $request->tanggal_agenda,
                'nomor_agenda' => $urut,
                'tujuan' => $request->id_tujuan,
                'nomor_surat' => $request->nomor_surat,
                'tanggal_surat' => $request->tanggal_surat,
                'perihal' => $request->perihal,
                'stat_agenda_dir' => 0,
                'status_filter' => 0,
                'id_bagian' => $request->id_bagian,
                'tindasan' => $request->tindasan,
                'tahun_surat' => $request->tahun_surat,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ]);

            DB::table('tbl_surat_keluar')->where('id_surat_keluar', $request->id_surat_keluar)->update([
                'stat_agenda_sentral' => 1,
                'updated_at' => \Carbon\Carbon::now()
            ]);

            return response()->json(['status'=>'1', 'nomor'=>$urut]);
        }else{
            $urut = "";
            return response()->json(['status'=>'2', 'nomor'=>$urut]);
        }
    }
}