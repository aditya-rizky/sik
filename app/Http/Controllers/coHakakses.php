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

class coHakakses extends Controller
{
    public function index()
    {
    	return view('hakakses');
    }

    public function listData()
    {
        $ha = DB::table('tbl_hakakses')->orderBy('id_hakakses')->get();
        $no = 0;
        $data = array();
        foreach ($ha as $list) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = (($list->status_hakakses == "Y") ? "<span class='badge badge-success tooltip-success' data-toggle='tooltip' data-placement='top' title='Status Aktif'><i class='menu-icon fa fa-check'></i></span> " : "<span class='badge badge-danger tooltip-danger' data-toggle='tooltip' data-placement='top' title='Status Non Aktif'><i class='menu-icon fa fa-close'></i></span> ").$list->nama_hakakses;
            $row[] = "<button type='button' class='btn btn-default btn-xs shiny icon-only blue tooltip-blue' onclick='editData(".$list->id_hakakses.")' data-toggle='tooltip' data-placement='top' title='Ubah Data'><span class='fa fa-pencil'></span></button>";
            $data[] = $row;
        }

        return DataTables::of($data)->escapeColumns([])->make(true);
    }

    public function store(Request $request)
    {
    	DB::table('tbl_hakakses')->insert([
    		'nama_hakakses' => $request->nama_hakakses,
            'status_hakakses' => $request->status_hakakses,
    		'created_at' => \Carbon\Carbon::now(),
    		'updated_at' => \Carbon\Carbon::now()
    	]);
    	return response()->json(['status'=>'1']);
    }

    public function edit($id)
    {
        $ha = DB::table('tbl_hakakses')->where('id_hakakses', $id)->first();
        echo json_encode($ha);
    }

    public function update(Request $request, $id)
    {
        DB::table('tbl_hakakses')->where('id_hakakses', $id)->update([
        	'nama_hakakses' => $request->nama_hakakses,
            'status_hakakses' => $request->status_hakakses,
        	'updated_at' => \Carbon\Carbon::now()
        ]);
        return response()->json(['status'=>'2']);
    }
}
