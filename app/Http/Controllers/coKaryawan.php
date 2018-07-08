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
use Storage;
use File;

class coKaryawan extends Controller
{
    public function index()
    {
    	$bagian = DB::table('tbl_bagian')->orderBy('id_bagian')->get();
    	$jbt = DB::table('tbl_jabatan')->orderBy('id_jabatan')->get();
    	$gol = DB::table('tbl_golongan')->orderBy('id_golongan')->get();
    	$ddk = DB::table('tbl_pendidikan')->orderBy('id_pendidikan')->get();
    	return view('karyawan', compact(['bagian','jbt','gol','ddk']));
    }

    public function listData()
    {
        $karyawan = DB::table('tbl_karyawan')
                    ->join('tbl_bagian', 'tbl_karyawan.id_bagian', '=', 'tbl_bagian.id_bagian')
                    ->join('tbl_jabatan', 'tbl_karyawan.id_jabatan', '=', 'tbl_jabatan.id_jabatan')
                    ->orderBy('id_karyawan')
                    ->get();
        $no = 0;
        $data = array();
        foreach ($karyawan as $list) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = (($list->status_karyawan == 1) ? "<span class='badge badge-success tooltip-success' data-toggle='tooltip' data-placement='top' title='Status Aktif'><i class='menu-icon fa fa-check'></i></span> " : "<span class='badge badge-danger tooltip-danger' data-toggle='tooltip' data-placement='top' title='Status Non Aktif'><i class='menu-icon fa fa-close'></i></span> ").$list->nama_karyawan;
            $row[] = $list->nama_bagian;
            $row[] = $list->nama_jabatan;
            $row[] = "<button type='button' class='btn btn-default btn-xs shiny icon-only blue tooltip-blue' onclick='editData(".$list->id_karyawan.")' data-toggle='tooltip' data-placement='top' title='Ubah Data'><span class='fa fa-pencil'></span></button>
                      <button type='button' class='btn btn-default btn-xs shiny icon-only purple tooltip-purple' onclick='editFoto(".$list->id_karyawan.")' data-toggle='tooltip' data-placement='top' data-original-title='Ubah Foto' href='javascript:void(0);'><i class='fa fa-file-photo-o'></i></button>";
            $data[] = $row;
        }

        return DataTables::of($data)->escapeColumns([])->make(true);
    }

    public function store(Request $request)
    {
        $extensionfile = $request->foto->getClientOriginalExtension();
        $email = preg_replace('/\./', '', $request->email);
        $fullEmail = $email.'.'.$extensionfile;
        Storage::disk('public')->put($fullEmail, File::get($request->foto));
        // $url = Storage::url($fullEmail);

        DB::table('tbl_karyawan')->insert([
            'nama_karyawan' => $request->nama_karyawan,
            'tanggal_lahir' => $request->tanggal_lahir,
            'tanggal_karyawan' => $request->tanggal_karyawan,
            'jenis_kelamin' => $request->jenis_kelamin,
            'id_bagian' => $request->bagian,
            'id_jabatan' => $request->jabatan,
            'id_golongan' => $request->golongan,
            'id_pendidikan' => $request->pendidikan,
            'status_karyawan' => $request->status_karyawan,
            'status_konseptor' => $request->status_konseptor,
            'foto' => $fullEmail,
            'email' => $request->email,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);

    	return response()->json(['status'=>'1']);
    }

    public function edit($id)
    {
        $karyawan = DB::table('tbl_karyawan')->where('id_karyawan', $id)->first();
        echo json_encode($karyawan);
    }

    public function editFoto($id)
    {
        $fotoKaryawan = DB::table('tbl_karyawan')->select('id_karyawan','foto','email','nama_karyawan')->where('id_karyawan', $id)->first();
        $a = $fotoKaryawan->id_karyawan;
        $b = "/"."storage"."/".$fotoKaryawan->foto;
        $c = $fotoKaryawan->email;
        $d = $fotoKaryawan->foto;
        $e = $fotoKaryawan->nama_karyawan;
        return view('modal_foto', compact(['a','b','c','d','e']));
    }

    public function update(Request $request, $id)
    {
        DB::table('tbl_karyawan')->where('id_karyawan', $id)->update([
        	'nama_karyawan' => $request->nama_karyawan,
        	'tanggal_lahir' => $request->tanggal_lahir,
            'tanggal_karyawan' => $request->tanggal_karyawan,
            'email' => $request->email,
            'jenis_kelamin' => $request->jenis_kelamin,
            'id_bagian' => $request->bagian,
            'id_jabatan' => $request->jabatan,
            'id_golongan' => $request->golongan,
            'id_pendidikan' => $request->pendidikan,
            'status_konseptor' => $request->status_konseptor,
            'status_karyawan' => $request->status_karyawan
        ]);
        return response()->json(['status'=>'2']);
    }

    public function updateFoto(Request $request, $id)
    {
        $extensionfile = $request->ubahFoto->getClientOriginalExtension();
        $email = preg_replace('/\./', '', $request->emailFoto);
        $fullEmail = $email.'.'.$extensionfile;
        Storage::disk('public')->delete($request->pathFoto);
        Storage::disk('public')->put($fullEmail, File::get($request->ubahFoto));

        DB::table('tbl_karyawan')->where('id_karyawan', $id)->update([
            'foto' => $fullEmail,
        ]);
        return response()->json(['status'=>'4','tes'=>$fullEmail]);
    }
}
