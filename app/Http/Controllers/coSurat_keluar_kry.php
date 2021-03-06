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
use Auth;
use Redirect;

class coSurat_keluar_kry extends Controller
{
    public function index()
    {
    	return view('surat_keluar_kry');
    }

    public function tambah()
    {
        $sifat = DB::table('tbl_sifat_surat')->orderBy('id_sifat_surat')->get();
        $all = DB::table('tbl_bagian')->orderBy('grup_bagian')->orderBy('id_bagian')->get();
        $kry = DB::table('tbl_karyawan')->orderBy('id_karyawan')->get();
        $idBagian = DB::table('tbl_bagian')->where('id_bagian', Auth::user()->id_bagian)->first();
        $kdBagian = $idBagian->kode_bagian;
        return view('form_tambah/add_surat_keluar_kry', compact(['sifat','all','idBagian','kry','kdBagian']));
    }

    public function listKlasifikasi()
    {
    	$klas = DB::table("tbl_klasifikasi")->select('id_klas','kode_klas','nama_klas')->get();
        $no = 0;
        $data = array();
        foreach ($klas as $list) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $list->id_klas;
            $row[] = $list->kode_klas;
            $row[] = $list->nama_klas;
            $data[] = $row;
        }

        return DataTables::of($data)->escapeColumns([])->make(true);
    }

    public function listKonseptor()
    {
        $konseptor = DB::table("tbl_karyawan")->select('id_karyawan','nama_karyawan')->where('id_bagian', Auth::user()->id_bagian)->where('status_konseptor', 1)->get();
        $no = 0;
        $data = array();
        foreach ($konseptor as $list) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $list->id_karyawan;
            $row[] = $list->nama_karyawan;
            $data[] = $row;
        }

        return DataTables::of($data)->escapeColumns([])->make(true);
    }

    public function list()
    {
        $konseptor = DB::table("tbl_surat_keluar")
                    ->where('jenis_surat', 2)
                    ->where('id_bagian', Auth::user()->id_bagian)
                    ->orderBy('tanggal_surat', 'desc')
                    ->get();
        $no = 0;
        $data = array();
        foreach ($konseptor as $list) {
            $arrTujuan = explode(',', $list->tujuan);
            $arrTujuan = array_map('floatval', $arrTujuan);
            $tujuan = DB::table('tbl_karyawan')->select('nama_karyawan')->whereIn('id_karyawan', $arrTujuan)->get();

            $no++;
            $baris = array();
            $row = array();

            foreach($tujuan as $bag => $x) {
                $y = $bag+1;
                $baris[] = $x->nama_karyawan;
            }

            $row[] = $no;
            $row[] = $list->nomor_surat;
            $row[] = date('d M Y', strtotime($list->tanggal_surat));
            $row[] = $baris;
            $row[] = $list->perihal;
            $row[] = "<button type='button' class='btn btn-default btn-xs shiny icon-only sky tooltip-sky' onclick='detail(".$list->id_surat_keluar.")' data-toggle='tooltip' data-placement='top' data-original-title='Detail Surat' href='javascript:void(0);'><i class='fa fa-eye'></i></button>
                      <a href='surat_keluar_karyawan/".$list->id_surat_keluar."/ubah' class='btn btn-default btn-xs shiny icon-only sky tooltip-sky' data-toggle='tooltip' data-placement='top' data-original-title='Ubah Surat'><i class='fa fa-pencil'></i></a>";
            $data[] = $row;
        }

        return DataTables::of($data)->escapeColumns([])->make(true);
    }

    public function detail($id)
    {
        $detail = DB::table('tbl_surat_keluar')
                    ->join('tbl_karyawan', 'tbl_surat_keluar.id_konseptor', '=', 'tbl_karyawan.id_karyawan')
                    ->join('users', 'tbl_surat_keluar.id_pembuat', '=', 'users.id')
                    ->where('id_surat_keluar', $id)->first();
        $arrTindasan = explode(',', $detail->tindasan);
        $arrTindasan = array_map('floatval', $arrTindasan);
        $tindasan = DB::table('tbl_bagian')->whereIn('id_bagian', $arrTindasan)->get();

        $arrTujuan = explode(',', $detail->tujuan);
        $arrTujuan = array_map('floatval', $arrTujuan);
        $tujuan = DB::table('tbl_karyawan')->whereIn('id_karyawan', $arrTujuan)->get();
        return view('modal/modal_detailsk_karyawan', compact(['detail','tindasan','tujuan']));
    }

    public function ubah($id)
    {
        $surat = DB::table('tbl_surat_keluar')
                ->join('tbl_klasifikasi', 'tbl_klasifikasi.id_klas', '=', 'tbl_surat_keluar.id_klasifikasi')
                ->join('tbl_karyawan', 'tbl_karyawan.id_karyawan', '=', 'tbl_surat_keluar.id_konseptor')
                ->where('id_surat_keluar', $id)->first();

        $url = url('surat_keluar_karyawan/'.$id.'/update');
        $selected_tindasan = explode(",", $surat->tindasan);
        $selected_tujuan = explode(",", $surat->tujuan);
        $sifat = DB::table('tbl_sifat_surat')->orderBy('id_sifat_surat')->get();
        $all = DB::table('tbl_bagian')->orderBy('grup_bagian')->orderBy('id_bagian')->get();
        $idBagian = DB::table('tbl_bagian')->where('id_bagian', Auth::user()->id_bagian)->first();
        $kry = DB::table('tbl_karyawan')->orderBy('id_karyawan')->get();
        return view('form_ubah/edit_surat_keluar_kry', compact(['surat','sifat','all','idBagian','kry','selected_tindasan','selected_tujuan','url']));
    }

    public function update(Request $request, $id)
    {
        if(empty($request->tindasan)){
            $arrTindasan = "";
        }else{
            $arrTindasan = implode(',', $request->tindasan);
        }

        $arrTujuan = implode(',', $request->nama_tujuan);
        DB::table('tbl_surat_keluar')->where('id_surat_keluar', $id)->update([
            'tanggal_surat' => $request->tanggal_surat,
            'sifat_surat' => $request->sifat_surat,
            'tujuan' => $arrTujuan,
            'perihal' => $request->perihal,
            'id_konseptor' => $request->id_konseptor,
            'tindasan' => $arrTindasan,
            'updated_at' => \Carbon\Carbon::now()
        ]);
        
        return Redirect::to('surat_keluar_karyawan')->with('message', 'Data berhasil diubah.');
    }

    public function store(Request $request)
    {
        $thn = substr($request->tanggal_surat, 0, 4);
        $getNumber = DB::table('tbl_temp_surat_keluar')->where('tahun', $thn)->where('id_klasifikasi', $request->id_klas)->first();

        if(empty($request->tindasan)){
            $arrTindasan = "";
        }else{
            $arrTindasan = implode(',', $request->tindasan);
        }

        $arrTujuan = implode(',', $request->nama_tujuan);
        if($getNumber == NULL){
            $urut = 1;
            DB::table('tbl_temp_surat_keluar')->insert([
                'id_klasifikasi' => $request->id_klas,
                'tahun' => $thn,
                'nomor_urut' => $urut,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ]);
        }else{
            $urut = $getNumber->nomor_urut;
            $urut += 1;
            DB::table('tbl_temp_surat_keluar')->where('id_temp_surat_keluar', $getNumber->id_temp_surat_keluar)->update([
                'nomor_urut' => $urut,
                'updated_at' => \Carbon\Carbon::now()
            ]);
        }

        $noSurat = $request->kode_klasifikasi."/".$urut."/".$request->kd_bagian."/".$thn;
        DB::table('tbl_surat_keluar')->insert([
            'jenis_surat' => 2,
            'id_bagian' => Auth::user()->id_bagian,
            'id_klasifikasi' => $request->id_klas,
            'nomor_surat' => $noSurat,
            'tanggal_surat' => $request->tanggal_surat,
            'sifat_surat' => $request->sifat_surat,
            'tujuan' => $arrTujuan,
            'perihal' => $request->perihal,
            'id_pembuat' => Auth::user()->id,
            'id_konseptor' => $request->id_konseptor,
            'tindasan' => $arrTindasan,
            'id_hak_akses' => Auth::user()->id_role,
            'tahun_surat' => $thn,
            'stat_agenda_sentral' => 0,
            'stat_agenda_dir' => 0,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);

        return response()->json(['status'=>'1', 'nomor'=>$noSurat]);
    }
}
