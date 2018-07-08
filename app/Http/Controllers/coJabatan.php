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

class coJabatan extends Controller
{
    public function index()
    {
    	return view('jabatan');
    }

    public function listData()
    {
        $jabatan = DB::table('tbl_jabatan')->orderBy('id_jabatan')->get();
        $no = 0;
        $data = array();
        foreach ($jabatan as $list) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = (($list->status_jabatan == "Y") ? "<span class='badge badge-success tooltip-success' data-toggle='tooltip' data-placement='top' title='Status Aktif'><i class='menu-icon fa fa-check'></i></span> " : "<span class='badge badge-danger tooltip-danger' data-toggle='tooltip' data-placement='top' title='Status Non Aktif'><i class='menu-icon fa fa-close'></i></span> ").$list->nama_jabatan;
            $row[] = "<button type='button' class='btn btn-default btn-xs shiny icon-only blue tooltip-blue' onclick='editData(".$list->id_jabatan.")' data-toggle='tooltip' data-placement='top' title='Ubah Data'><span class='fa fa-pencil'></span></button>";
            $data[] = $row;
        }

        return DataTables::of($data)->escapeColumns([])->make(true);
    }

    public function store(Request $request)
    {
    	DB::table('tbl_jabatan')->insert([
    		'nama_jabatan' => $request->nama_jabatan,
            'status_jabatan' => $request->status_jabatan,
    		'created_at' => \Carbon\Carbon::now(),
    		'updated_at' => \Carbon\Carbon::now()
    	]);
    	return response()->json(['status'=>'1']);
    }

    public function edit($id)
    {
        $jabatan = DB::table('tbl_jabatan')->where('id_jabatan', $id)->first();
        echo json_encode($jabatan);
    }

    public function update(Request $request, $id)
    {
        DB::table('tbl_jabatan')->where('id_jabatan', $id)->update([
        	'nama_jabatan' => $request->nama_jabatan,
            'status_jabatan' => $request->status_jabatan,
        	'updated_at' => \Carbon\Carbon::now()
        ]);
        return response()->json(['status'=>'2']);
    }
}
