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

class coSk_internal extends Controller
{
    public function index()
    {
        $sifat = DB::table('tbl_sifat_surat')->orderBy('id_sifat_surat')->get();
        $all = DB::table('tbl_bagian')->orderBy('grup_bagian')->orderBy('id_bagian')->get();
        $idBagian = DB::table('tbl_bagian')->where('id_bagian', Auth::user()->id_bagian)->first();
        $kdBagian = $idBagian->kode_bagian;
    	return view('sk_internal', compact(['kdBagian','sifat','all']));
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

    public function listSurat()
    {
        $listSurat = DB::table("tbl_sk_internal")->where('id_bagian', Auth::user()->id_bagian)->orderBy('id_surat_keluar', 'desc')->get();
        $no = 0;
        $data = array();
        foreach ($listSurat as $list) {
            $arrTujuan = explode(',', $list->id_tujuan);
            $arrTujuan = array_map('floatval', $arrTujuan);
            $tujuan = DB::table('tbl_bagian')->select('nama_bagian')->whereIn('id_bagian', $arrTujuan)->get();
            $no++;
            $row = array();
            $baris = array();

            foreach($tujuan as $bag => $x) {
                $y = $bag+1;
                $baris[] = $x->nama_bagian;
            }

            $row[] = $no;
            $row[] = $list->nomor_surat;
            $row[] = $baris;
            $row[] = $list->perihal;
            $row[] = "<button type='button' class='btn btn-default btn-xs shiny icon-only blue tooltip-blue' onclick='editData(".$list->id_surat_keluar.")' data-toggle='tooltip' data-placement='top' title='Ubah Data'><span class='fa fa-pencil'></span></button>
                      <button type='button' class='btn btn-default btn-xs shiny icon-only warning tooltip-warning' onclick='detail_surat(".$list->id_surat_keluar.")' data-toggle='tooltip' data-placement='top' data-original-title='Lihat Data' href='javascript:void(0);'><i class='fa fa-eye'></i></button>
                      <button type='button' class='btn btn-default btn-xs shiny icon-only purple tooltip-purple' onclick='unggah_surat(".$list->id_surat_keluar.")' data-toggle='tooltip' data-placement='top' data-original-title='Unggah Data' href='javascript:void(0);'><i class='fa fa-upload'></i></button>";
            $data[] = $row;
        }

        return DataTables::of($data)->escapeColumns([])->make(true);
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
        DB::table('tbl_sk_internal')->insert([
            'id_bagian' => Auth::user()->id_bagian,
            'id_klasifikasi' => $request->id_klas,
            'nomor_surat' => $noSurat,
            'tanggal_surat' => $request->tanggal_surat,
            'sifat_surat' => $request->sifat_surat,
            'id_tujuan' => $arrTujuan,
            'perihal' => $request->perihal,
            'id_pembuat' => Auth::user()->id,
            'id_konseptor' => $request->id_konseptor,
            'tindasan' => $arrTindasan,
            'hak_akses' => Auth::user()->id_role,
            'tahun_surat' => $thn,
            'status_agenda' => "N",
            'status_agenda_dir' => 0,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);

        return response()->json(['status'=>'1', 'nomor'=>$noSurat]);
    }

    public function detailSurat($id)
    {
        $detail = DB::table('tbl_sk_internal')
                    ->join('tbl_karyawan', 'tbl_sk_internal.id_konseptor', '=', 'tbl_karyawan.id_karyawan')
                    ->join('users', 'tbl_sk_internal.id_pembuat', '=', 'users.id')
                    ->where('id_surat_keluar', $id)->first();
        $arrTindasan = explode(',', $detail->tindasan);
        $arrTindasan = array_map('floatval', $arrTindasan);
        $tindasan = DB::table('tbl_bagian')->whereIn('id_bagian', $arrTindasan)->get();
        $arrTujuan = explode(',', $detail->id_tujuan);
        $arrTujuan = array_map('floatval', $arrTujuan);
        $tujuan = DB::table('tbl_bagian')->whereIn('id_bagian', $arrTujuan)->get();
        return view('modal/modal_detailsk_internal', compact(['detail', 'tindasan','tujuan']));
    }

    public function edit($id)
    {
        $surat = DB::table('tbl_sk_internal')
                ->select('id_surat_keluar', 'id_klasifikasi', 'kode_klas','nama_klas', 'tanggal_surat','sifat_surat','id_tujuan','perihal','id_konseptor','nama_karyawan','tindasan')
                ->join('tbl_klasifikasi', 'tbl_klasifikasi.id_klas', '=', 'tbl_sk_internal.id_klasifikasi')
                ->join('tbl_karyawan', 'tbl_karyawan.id_karyawan', '=', 'tbl_sk_internal.id_konseptor')
                ->where('id_surat_keluar', $id)->first();
        echo json_encode($surat);
    }

    public function update(Request $request, $id)
    {
        $arrTujuan = implode(',', $request->nama_tujuan);
        if(empty($request->tindasan)){
            $arrTindasan = "";
        }else{
            $arrTindasan = implode(',', $request->tindasan);
        }

        DB::table('tbl_sk_internal')->where('id_surat_keluar', $id)->update([
            'tanggal_surat' => $request->tanggal_surat,
            'sifat_surat' => $request->sifat_surat,
            'id_tujuan' => $arrTujuan,
            'perihal' => $request->perihal,
            'id_konseptor' => $request->id_konseptor,
            'tindasan' => $arrTindasan,
            'updated_at' => \Carbon\Carbon::now()
        ]);

        return response()->json(['status'=>'2']);
    }

    public function unggah_surat($id)
    {
        $detail = DB::table('tbl_sk_internal')->select('id_surat_keluar','nomor_surat')->where('id_surat_keluar', $id)->first();
        $idSurat = $detail->id_surat_keluar;
        $noSurat = $detail->nomor_surat;
        return view('modal_unggahsk_internal', compact(['idSurat','noSurat']));
    }    

    // public function updateSurat(Request $request, $id)
    // {
    //     $extensionfile = $request->file_surat->getClientOriginalExtension();
    //     $nosurat = preg_replace('^[a-zćęłńóśźżA-Z0-9\s\.\/]+$', '', $request->noUnggah);
    //     $fullEmail = $nosurat.'.'.$extensionfile;
    //     Storage::disk('public')->delete($request->pathFoto);
    //     Storage::disk('public')->put($fullEmail, File::get($request->ubahFoto));

    //     DB::table('tbl_karyawan')->where('id_karyawan', $id)->update([
    //         'foto' => $fullEmail,
    //     ]);
    //     return response()->json(['status'=>'1','tes'=>$fullEmail]);
    // }
}