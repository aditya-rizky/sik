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

class coSifatsurat extends Controller
{
    public function index()
    {
    	return view('sifat_surat');
    }

    public function listData()
    {
        $sifat = DB::table('tbl_sifat_surat')->orderBy('id_sifat_surat')->get();
        $no = 0;
        $data = array();
        foreach ($sifat as $list) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = (($list->status_sifat == "Y") ? "<span class='badge badge-success tooltip-success' data-toggle='tooltip' data-placement='top' title='Status Aktif'><i class='menu-icon fa fa-check'></i></span> " : "<span class='badge badge-danger tooltip-danger' data-toggle='tooltip' data-placement='top' title='Status Non Aktif'><i class='menu-icon fa fa-close'></i></span> ").$list->nama_sifat;
            $row[] = $list->deskripsi;
            $row[] = $list->kode_sifat;
            $row[] = "<button type='button' class='btn btn-default btn-xs shiny icon-only blue tooltip-blue' onclick='editData(".$list->id_sifat_surat.")' data-toggle='tooltip' data-placement='top' title='Ubah Data'><span class='fa fa-pencil'></span></button>";
            $data[] = $row;
        }

        return DataTables::of($data)->escapeColumns([])->make(true);
    }

    public function store(Request $request)
    {
    	DB::table('tbl_sifat_surat')->insert([
    		'nama_sifat' => $request->nama_sifat,
    		'kode_sifat' => $request->kode_sifat,
    		'deskripsi' => $request->deskripsi,
            'status_sifat' => $request->status_sifat,
    		'created_at' => \Carbon\Carbon::now(),
    		'updated_at' => \Carbon\Carbon::now()
    	]);
    	return response()->json(['status'=>'1']);
    }

    public function edit($id)
    {
        $sifat = DB::table('tbl_sifat_surat')->where('id_sifat_surat', $id)->first();
        echo json_encode($sifat);
    }

    public function update(Request $request, $id)
    {
        DB::table('tbl_sifat_surat')->where('id_sifat_surat', $id)->update([
        	'nama_sifat' => $request->nama_sifat,
        	'kode_sifat' => $request->kode_sifat,
        	'deskripsi' => $request->deskripsi,
            'status_sifat' => $request->status_sifat,
        	'updated_at' => \Carbon\Carbon::now()
        ]);
        return response()->json(['status'=>'2']);
    }
}
