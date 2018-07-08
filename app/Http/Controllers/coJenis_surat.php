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

class coJenis_surat extends Controller
{
    public function index()
    {
    	return view('jenis_surat');
    }

    public function listData()
    {
        $jns = DB::table('tbl_jenis_surat')->orderBy('id_jenis_surat')->get();
        $no = 0;
        $data = array();
        foreach ($jns as $list) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = (($list->status_jenis == "Y") ? "<span class='badge badge-success tooltip-success' data-toggle='tooltip' data-placement='top' title='Status Aktif'><i class='menu-icon fa fa-check'></i></span> " : "<span class='badge badge-danger tooltip-danger' data-toggle='tooltip' data-placement='top' title='Status Non Aktif'><i class='menu-icon fa fa-close'></i></span> ").$list->nama_jenis;
            $row[] = $list->deskripsi;
            $row[] = $list->kode_jenis;
            $row[] = "<button type='button' class='btn btn-default btn-xs shiny icon-only blue tooltip-blue' onclick='editData(".$list->id_jenis_surat.")' data-toggle='tooltip' data-placement='top' title='Ubah Data'><span class='fa fa-pencil'></span></button>";
            $data[] = $row;
        }

        return DataTables::of($data)->escapeColumns([])->make(true);
    }

    public function store(Request $request)
    {
    	DB::table('tbl_jenis_surat')->insert([
    		'nama_jenis' => $request->nama_jenis,
    		'kode_jenis' => $request->kode_jenis,
    		'deskripsi' => $request->deskripsi,
            'status_jenis' => $request->status_jenis,
    		'created_at' => \Carbon\Carbon::now(),
    		'updated_at' => \Carbon\Carbon::now()
    	]);
    	return response()->json(['status'=>'1']);
    }

    public function edit($id)
    {
        $jns = DB::table('tbl_jenis_surat')->where('id_jenis_surat', $id)->first();
        echo json_encode($jns);
    }

    public function update(Request $request, $id)
    {
        DB::table('tbl_jenis_surat')->where('id_jenis_surat', $id)->update([
        	'nama_jenis' => $request->nama_jenis,
        	'kode_jenis' => $request->kode_jenis,
        	'deskripsi' => $request->deskripsi,
            'status_jenis' => $request->status_jenis,
        	'updated_at' => \Carbon\Carbon::now()
        ]);
        return response()->json(['status'=>'2']);
    }
}
