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
use Auth;
use Hash;
use Redirect;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // SEKRETARIS PERUSAHAAN
        // $jml_90 = DB::table('tbl_sk_internal')->where('id_bagian', 1)->count();
        // $upload_90 = DB::table('tbl_sk_internal')->where('id_bagian', 1)->whereNull('path_surat')->count();
        // $prg_90 = ($jml_90 == 0) ? 0 : (100 - (($upload_90/$jml_90)*100));

        // SPI
        // $jml_91 = DB::table('tbl_sk_internal')->where('id_bagian', 3)->count();
        // $upload_91 = DB::table('tbl_sk_internal')->where('id_bagian', 3)->whereNull('path_surat')->count();
        // $prg_91 = ($jml_91 == 0) ? 0 : (100 - (($upload_91/$jml_91)*100));
        // return view('home', compact(['jml_90','upload_90','prg_90','jml_91','upload_91','prg_91']));

        return view('home');
    }

    public function ganti_password()
    {
        $id = Auth::user()->id;
        $url = url('ganti_password/'.$id.'/update_password');
        return view('ganti_password', compact(['id','url']));
    }

    public function update_password(Request $request, $id)
    {
        DB::table('users')->where('id', $id)->update([
            'password' => Hash::make($request->new_pwd_1),
            'updated_at' => \Carbon\Carbon::now()
        ]);
        
        return Redirect::to('home')->with('message', 'Data berhasil diubah.');
    }

    public function forbidden()
    {
        return view('forbidden');
    }
}
