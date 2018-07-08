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

class coJenisdisposisi_direksi extends Controller
{
    public function index()
    {
    	return view('jenisdisposisi_direksi');
    }

    public function listData()
    {
        $dis = DB::table('tbl_disposisi_direksi')->orderBy('id_disposisi_direksi')->get();
        $no = 0;
        $data = array();
        foreach ($dis as $list) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = (($list->status_aktif == "Y") ? "<span class='badge badge-success tooltip-success' data-toggle='tooltip' data-placement='top' title='Status Aktif'><i class='menu-icon fa fa-check'></i></span> " : "<span class='badge badge-danger tooltip-danger' data-toggle='tooltip' data-placement='top' title='Status Non Aktif'><i class='menu-icon fa fa-close'></i></span> ").$list->nama_disposisi;
            $row[] = "<button type='button' class='btn btn-default btn-xs shiny icon-only blue tooltip-blue' onclick='editData(".$list->id_disposisi_direksi.")' data-toggle='tooltip' data-placement='top' title='Ubah Data'><span class='fa fa-pencil'></span></button>";
            $data[] = $row;
        }

        return DataTables::of($data)->escapeColumns([])->make(true);
    }

    public function store(Request $request)
    {
    	DB::table('tbl_disposisi_direksi')->insert([
    		'nama_disposisi' => $request->nama_disposisi,
    		'status_aktif' => $request->status_aktif,
    		'created_at' => \Carbon\Carbon::now(),
    		'updated_at' => \Carbon\Carbon::now()
    	]);
    	return response()->json(['status'=>'1']);
    }

    public function edit($id)
    {
        $dis = DB::table('tbl_disposisi_direksi')->where('id_disposisi_direksi', $id)->first();
        echo json_encode($dis);
    }

    public function update(Request $request, $id)
    {
        DB::table('tbl_disposisi_direksi')->where('id_disposisi_direksi', $id)->update([
        	'nama_disposisi' => $request->nama_disposisi,
        	'status_aktif' => $request->status_aktif,
        	'updated_at' => \Carbon\Carbon::now()
        ]);
        return response()->json(['status'=>'2']);
    }
}
