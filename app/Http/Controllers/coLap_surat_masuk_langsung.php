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

class coLap_surat_masuk_langsung extends Controller
{
    public function index()
    {
    	return view('lap_surat_masuk_langsung');
    }

    public function list()
    {
    	$id_asal = Auth::user()->id_bagian;
        $konseptor = DB::table("tbl_surat_keluar")
                    // ->where('jenis_surat', 0)
                    ->whereRaw("((',' || RTRIM(tujuan) || ',') LIKE '%,".$id_asal.",%'
                                    AND jenis_surat = 0)")
                    ->orderBy('tanggal_surat', 'desc')
                    ->get();
        $no = 0;
        $data = array();
        foreach ($konseptor as $list) {
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
            $row[] = date('d M Y', strtotime($list->tanggal_surat));
            $row[] = $baris;
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

        $arrTindasan = explode(',', $detail->tindasan);
        $arrTindasan = array_map('floatval', $arrTindasan);
        $tindasan = DB::table('tbl_bagian')->whereIn('id_bagian', $arrTindasan)->get();

        $arrTujuan = explode(',', $detail->tujuan);
        $arrTujuan = array_map('floatval', $arrTujuan);
        $tujuan = DB::table('tbl_bagian')->whereIn('id_bagian', $arrTujuan)->get();
        return view('modal/modal_detailLap_surat_masuk_langsung', compact(['detail','tindasan','tujuan']));
    }
}
