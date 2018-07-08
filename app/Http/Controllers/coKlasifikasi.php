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

class coKlasifikasi extends Controller
{
    public function index()
    {
        $aktif = DB::table('tbl_retensi_aktif')->orderBy('id_retensi_aktif')->get();
        $inaktif = DB::table('tbl_retensi_inaktif')->orderBy('id_retensi_inaktif')->get();
        $desk = DB::table('tbl_retensi_keterangan')->orderBy('id_retensi_ket')->get();
    	return view('klasifikasi', compact(['aktif','inaktif','desk']));
    }

    public function listData()
    {
        $x = DB::table('tbl_klasifikasi')->orderBy('kode_klas')->get();
        $no = 0;
        $data = array();
        foreach ($x as $list) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $list->kode_klas;
            $row[] = $list->nama_klas;
            $row[] = (($list->status_klas == "Y") ? "<span class='badge badge-success tooltip-success' data-toggle='tooltip' data-placement='top' title='Status Aktif'><i class='menu-icon fa fa-check'></i></span> " : "<span class='badge badge-danger tooltip-danger' data-toggle='tooltip' data-placement='top' title='Status Non Aktif'><i class='menu-icon fa fa-close'></i></span> ");
            $row[] = "<button type='button' class='btn btn-default btn-xs shiny icon-only blue tooltip-blue' onclick='editData(".$list->id_klas.")' data-toggle='tooltip' data-placement='top' title='Ubah Data'><span class='fa fa-pencil'></span></button>";
            $data[] = $row;
        }

        return DataTables::of($data)->escapeColumns([])->make(true);
    }

    public function listTop()
    {
        $parent = DB::table('tbl_top_klasifikasi')->select('kode_parent', 'id_parent', 'deskripsi_parent')->orderBy('kode_parent')->get();
        return json_encode($parent);
    }

    public function listMiddle()
    {
        $middle = DB::table('tbl_klasifikasi')->select('kode_klas', 'id_klas', 'nama_klas')->where('id_level', 1)->orderBy('kode_klas')->get();
        return json_encode($middle);
    }

    public function store_top(Request $request)
    {
    	$cek = DB::table('tbl_top_klasifikasi')->where('kode_parent', $request->kode_top_klas)->first();
    	if($cek == NULL){
    		DB::table('tbl_top_klasifikasi')->insert([
    			'kode_parent' => $request->kode_top_klas,
    			'deskripsi_parent' => $request->nama_top_klas,
                'status_top_klas' => $request->status_top_klas,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
    		]);
    		return response()->json(['status'=>'1']);
    	}else{
    		return response()->json(['status'=>'3']);
    	}
    }

    public function store_mid(Request $request)
    {
        $cek = DB::table('tbl_temp_mid_klas')->where('id_top_klas', $request->kode_middle_klas)->first();
        if($cek == NULL){
            $urut = 1;
            DB::table('tbl_temp_mid_klas')->insert([
                'id_top_klas' => $request->kode_middle_klas,
                'urutan' => $urut,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ]);
        }else{
            $urut = $cek->urutan;
            $urut += 1;
            DB::table('tbl_temp_mid_klas')->where('id_mid_klas', $cek->id_mid_klas)->update([
                'urutan' => $urut,
                'updated_at' => \Carbon\Carbon::now()
            ]);
        }

        $kode_urut = sprintf("%02s", $urut);
        $kode_klas = DB::table('tbl_top_klasifikasi')->select('kode_parent')->where('id_parent', $request->kode_middle_klas)->first();
        $kode = $kode_klas->kode_parent.".".$kode_urut;

        if(isset($request->tampilDetail)){
            DB::table('tbl_klasifikasi')->insert([
                'id_top_klas' => $request->kode_middle_klas,
                'kode_klas' => $kode,
                'nama_klas' => $request->nama_middle_klas,
                'status_klas' => $request->status_mid_klas,
                'id_retensi_aktif' => $request->retensi_aktif,
                'id_retensi_inaktif' => $request->retensi_inaktif,
                'id_retensi_ket' => $request->retensi_deskripsi,
                'id_level' => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ]);
        }else{
            // without detail
            DB::table('tbl_klasifikasi')->insert([
                'id_top_klas' => $request->kode_middle_klas,
                'kode_klas' => $kode,
                'nama_klas' => $request->nama_middle_klas,
                'status_klas' => $request->status_mid_klas,
                'id_level' => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ]);
        }

        return response()->json(['status'=>'1', 'urut'=>$kode]);
    }

    public function store_bot(Request $request)
    {
        $cek = DB::table('tbl_temp_bot_klas')->where('id_mid_klas', $request->kode_bottom_klas)->first();
        if($cek == NULL){
            $urut = 1;
            DB::table('tbl_temp_bot_klas')->insert([
                'id_mid_klas' => $request->kode_bottom_klas,
                'urutan' => $urut,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ]);
        }else{
            $urut = $cek->urutan;
            $urut += 1;
            DB::table('tbl_temp_bot_klas')->where('id_bot_klas', $cek->id_bot_klas)->update([
                'urutan' => $urut,
                'updated_at' => \Carbon\Carbon::now()
            ]);
        }

        $kode_urut = sprintf("%02s", $urut);
        $kode_klas = DB::table('tbl_klasifikasi')->select('kode_klas','id_top_klas')->where('id_klas', $request->kode_bottom_klas)->first();
        $kode = $kode_klas->kode_klas.".".$kode_urut;

        DB::table('tbl_klasifikasi')->insert([
            'id_top_klas' => $kode_klas->id_top_klas,
            'kode_klas' => $kode,
            'nama_klas' => $request->nama_bottom_klas,
            'status_klas' => $request->status_bottom_klas,
            'id_retensi_aktif' => $request->retensi_aktif,
            'id_retensi_inaktif' => $request->retensi_inaktif,
            'id_retensi_ket' => $request->retensi_deskripsi,
            'id_level' => 2,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);

        return response()->json(['status'=>'1', 'urut'=>$kode]);
    }
}
