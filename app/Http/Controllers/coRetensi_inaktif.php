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

class coRetensi_inaktif extends Controller
{
    public function index()
    {
    	return view('retensi_inaktif');
    }

    public function listData()
    {
        $x = DB::table('tbl_retensi_inaktif')->orderBy('id_retensi_inaktif')->get();
        $no = 0;
        $data = array();
        foreach ($x as $list) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = (($list->status_retensi == "Y") ? "<span class='badge badge-success tooltip-success' data-toggle='tooltip' data-placement='top' title='Status Aktif'><i class='menu-icon fa fa-check'></i></span> " : "<span class='badge badge-danger tooltip-danger' data-toggle='tooltip' data-placement='top' title='Status Non Aktif'><i class='menu-icon fa fa-close'></i></span> ").$list->nama_retensi;
            $row[] = "<button type='button' class='btn btn-default btn-xs shiny icon-only blue tooltip-blue' onclick='editData(".$list->id_retensi_inaktif.")' data-toggle='tooltip' data-placement='top' title='Ubah Data'><span class='fa fa-pencil'></span></button>";
            $data[] = $row;
        }

        return DataTables::of($data)->escapeColumns([])->make(true);
    }

    public function store(Request $request)
    {
    	DB::table('tbl_retensi_inaktif')->insert([
    		'nama_retensi' => $request->nama_retensi,
            'status_retensi' => $request->status_retensi,
    		'created_at' => \Carbon\Carbon::now(),
    		'updated_at' => \Carbon\Carbon::now()
    	]);
    	return response()->json(['status'=>'1']);
    }

    public function edit($id)
    {
        $x = DB::table('tbl_retensi_inaktif')->where('id_retensi_inaktif', $id)->first();
        echo json_encode($x);
    }

    public function update(Request $request, $id)
    {
        DB::table('tbl_retensi_inaktif')->where('id_retensi_inaktif', $id)->update([
        	'nama_retensi' => $request->nama_retensi,
            'status_retensi' => $request->status_retensi,
        	'updated_at' => \Carbon\Carbon::now()
        ]);
        return response()->json(['status'=>'2']);
    }
}
