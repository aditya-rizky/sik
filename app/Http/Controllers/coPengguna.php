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
use Hash;

class coPengguna extends Controller
{
    public function index()
    {
    	$karyawan = DB::table('tbl_karyawan')->orderBy('nama_karyawan')->get();
    	$role = DB::table('tbl_hakakses')->get();
    	return view('pengguna', compact(['karyawan','role']));
    }

    public function listData()
    {
        $pengguna = DB::table('users')->join('tbl_hakakses', 'users.id_role', '=', 'tbl_hakakses.id_hakakses')->join('tbl_bagian', 'users.id_bagian', '=', 'tbl_bagian.id_bagian')->get();
        $no = 0;
        $data = array();
        foreach ($pengguna as $list) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $list->name;
            $row[] = $list->email;
            $row[] = $list->nama_bagian;
            $row[] = $list->nama_hakakses;
            $row[] = "<button type='button' class='btn btn-default btn-xs shiny icon-only blue tooltip-blue' onclick='editData(".$list->id.")' data-toggle='tooltip' data-placement='top' title='Ubah Data'><span class='fa fa-pencil'></span></button>
            		  <button type='button' class='btn btn-default btn-xs shiny icon-only danger tooltip-danger' onclick='deleteData(".$list->id.")' data-toggle='tooltip' data-placement='top' data-original-title='Hapus Data' href='javascript:void(0);'><i class='fa fa-times'></i></button>
                      <button type='button' class='btn btn-default btn-xs shiny icon-only purple tooltip-purple' onclick='editPassword(".$list->id.")' data-toggle='tooltip' data-placement='top' data-original-title='Reset Password' href='javascript:void(0);'><i class='fa fa-file-photo-o'></i></button>";
            $data[] = $row;
        }

        return DataTables::of($data)->escapeColumns([])->make(true);
    }

    public function store(Request $request)
    {
    	$cekKaryawan = DB::table('users')->where('id_karyawan', $request->karyawan)->first();
    	if($cekKaryawan == NULL){
    		$detailKaryawan = DB::table('tbl_karyawan')->where('id_karyawan', $request->karyawan)->first();
	    	DB::table('users')->insert([
	    		'name' => $detailKaryawan->nama_karyawan,
	    		'email' => $detailKaryawan->email,
	    		'password' => Hash::make("123456"),
	    		'id_role' => $request->role,
	    		'id_karyawan' => $request->karyawan,
                'id_bagian' => $detailKaryawan->id_bagian,
	    		'created_at' => \Carbon\Carbon::now(),
	    		'updated_at' => \Carbon\Carbon::now()
	    	]);
    		return response()->json(['status'=>'1']);
    	}else{
    		return response()->json(['status'=>'3']);
    	}
    }

    public function edit($id)
    {
        $pengguna = DB::table('users')->where('id', $id)->first();
        echo json_encode($pengguna);
    }

    public function update(Request $request, $id)
    {
        DB::table('users')->where('id', $id)->update([
        	'id_role' => $request->role,
            'updated_at' => \Carbon\Carbon::now()
        ]);
        return response()->json(['status'=>'2']);
    }

    public function updatePassword(Request $request, $id)
    {
        DB::table('users')->where('id', $id)->update([
        	'password' => Hash::make("123456"),
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);
        return response()->json(['status'=>'3']);
    }

    public function destroy($id)
    {
        DB::table('users')->where('id', $id)->delete();
        return response()->json(['status'=>'3']);
    }
}
