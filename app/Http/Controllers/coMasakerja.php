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

class coMasakerja extends Controller
{
    public function index()
    {
    	return view('masakerja');
    }

    public function listData()
    {
        $mk = DB::table('tbl_masakerja')->orderBy('id_masakerja')->get();
        $no = 0;
        $data = array();
        foreach ($mk as $list) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = (($list->status_masakerja == "Y") ? "<span class='badge badge-success tooltip-success' data-toggle='tooltip' data-placement='top' title='Status Aktif'><i class='menu-icon fa fa-check'></i></span> " : "<span class='badge badge-danger tooltip-danger' data-toggle='tooltip' data-placement='top' title='Status Non Aktif'><i class='menu-icon fa fa-close'></i></span> ").$list->nama_masakerja;
            $row[] = "<button type='button' class='btn btn-default btn-xs shiny icon-only blue tooltip-blue' onclick='editData(".$list->id_masakerja.")' data-toggle='tooltip' data-placement='top' title='Ubah Data'><span class='fa fa-pencil'></span></button>";
            $data[] = $row;
        }

        return DataTables::of($data)->escapeColumns([])->make(true);
    }

    public function store(Request $request)
    {
    	DB::table('tbl_masakerja')->insert([
    		'nama_masakerja' => $request->nama_masakerja,
            'status_masakerja' => $request->status_masakerja,
    		'created_at' => \Carbon\Carbon::now(),
    		'updated_at' => \Carbon\Carbon::now()
    	]);
    	return response()->json(['status'=>'1']);
    }

    public function edit($id)
    {
        $mk = DB::table('tbl_masakerja')->where('id_masakerja', $id)->first();
        echo json_encode($mk);
    }

    public function update(Request $request, $id)
    {
        DB::table('tbl_masakerja')->where('id_masakerja', $id)->update([
        	'nama_masakerja' => $request->nama_masakerja,
            'status_masakerja' => $request->status_masakerja,
        	'updated_at' => \Carbon\Carbon::now()
        ]);
        return response()->json(['status'=>'2']);
    }
}
