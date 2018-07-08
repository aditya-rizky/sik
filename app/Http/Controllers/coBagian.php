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

class coBagian extends Controller
{
    public function index()
    {
    	return view('bagian');
    }

    public function listData()
    {
        $bagian = DB::table("tbl_bagian")->select(DB::raw("id_bagian, nama_bagian, kode_bagian, tindasan, grup_bagian, status_bagian, CASE tindasan WHEN 0 THEN 'TIDAK AKTIF' WHEN 1 THEN 'AKTIF' END AS status, CASE grup_bagian WHEN 0 THEN 'DIREKSI' WHEN 1 THEN 'BAGIAN KANTOR DIREKSI' WHEN 2 THEN 'UNIT KERJA' WHEN 3 THEN 'AGROWISATA' WHEN 4 THEN 'LAIN - LAIN' END AS grup"))->orderBy('id_bagian')->get();
        $no = 0;
        $data = array();
        foreach ($bagian as $list){
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = (($list->status_bagian == "Y") ? "<span class='badge badge-success tooltip-success' data-toggle='tooltip' data-placement='top' title='Status Aktif'><i class='menu-icon fa fa-check'></i></span> " : "<span class='badge badge-danger tooltip-danger' data-toggle='tooltip' data-placement='top' title='Status Non Aktif'><i class='menu-icon fa fa-close'></i></span> ").$list->nama_bagian;
            $row[] = $list->kode_bagian;
            $row[] = $list->grup;
            $row[] = $list->status;
            $row[] = "<button type='button' class='btn btn-default btn-xs shiny icon-only blue tooltip-blue' onclick='editData(".$list->id_bagian.")' data-toggle='tooltip' data-placement='top' title='Ubah Data'><span class='fa fa-pencil'></span></button>";
            $data[] = $row;
        }

        return DataTables::of($data)->escapeColumns([])->make(true);
    }

    public function store(Request $request)
    {
    	DB::table('tbl_bagian')->insert([
    		'nama_bagian' => $request->nama_bagian,
    		'kode_bagian' => $request->kode_bagian,
            'tindasan' => $request->tindasan,
            'grup_bagian' => $request->grup_bagian,
            'status_bagian' => $request->status_bagian,
    		'created_at' => \Carbon\Carbon::now(),
    		'updated_at' => \Carbon\Carbon::now()
    	]);
    	return response()->json(['status'=>'1']);
    }

    public function edit($id)
    {
        $bagian = DB::table('tbl_bagian')->where('id_bagian', $id)->first();
        echo json_encode($bagian);
    }

    public function update(Request $request, $id)
    {
        DB::table('tbl_bagian')->where('id_bagian', $id)->update([
        	'nama_bagian' => $request->nama_bagian,
        	'kode_bagian' => $request->kode_bagian,
            'tindasan' => $request->tindasan,
            'grup_bagian' => $request->grup_bagian,
            'status_bagian' => $request->status_bagian,
            'updated_at' => \Carbon\Carbon::now()
        ]);
        return response()->json(['status'=>'2']);
    }
}
