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

class coGolongan extends Controller
{
    public function index()
    {
    	return view('golongan');
    }

    public function listData()
    {
        $gol = DB::table('tbl_golongan')->orderBy('id_golongan')->get();
        $no = 0;
        $data = array();
        foreach ($gol as $list) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = (($list->status_golongan == "Y") ? "<span class='badge badge-success tooltip-success' data-toggle='tooltip' data-placement='top' title='Status Aktif'><i class='menu-icon fa fa-check'></i></span> " : "<span class='badge badge-danger tooltip-danger' data-toggle='tooltip' data-placement='top' title='Status Non Aktif'><i class='menu-icon fa fa-close'></i></span> ").$list->nama_golongan;
            $row[] = "<button type='button' class='btn btn-default btn-xs shiny icon-only blue tooltip-blue' onclick='editData(".$list->id_golongan.")' data-toggle='tooltip' data-placement='top' title='Ubah Data'><span class='fa fa-pencil'></span></button>";
            $data[] = $row;
        }

        return DataTables::of($data)->escapeColumns([])->make(true);
    }

    public function store(Request $request)
    {
    	DB::table('tbl_golongan')->insert([
    		'nama_golongan' => $request->nama_golongan,
            'status_golongan' => $request->status_golongan,
    		'created_at' => \Carbon\Carbon::now(),
    		'updated_at' => \Carbon\Carbon::now()
    	]);
    	return response()->json(['status'=>'1']);
    }

    public function edit($id)
    {
        $gol = DB::table('tbl_golongan')->where('id_golongan', $id)->first();
        echo json_encode($gol);
    }

    public function update(Request $request, $id)
    {
        DB::table('tbl_golongan')->where('id_golongan', $id)->update([
        	'nama_golongan' => $request->nama_golongan,
            'status_golongan' => $request->status_golongan,
        	'updated_at' => \Carbon\Carbon::now()
        ]);
        return response()->json(['status'=>'2']);
    }
}
