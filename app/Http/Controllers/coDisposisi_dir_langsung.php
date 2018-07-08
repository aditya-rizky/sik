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
use Redirect;

class coDisposisi_dir_langsung extends Controller
{
    public function index()
    {
    	$agenda = DB::table('tbl_jenis_surat')->get();
    	$tujuan = DB::table('tbl_bagian')->where('grup_bagian', 0)->orderBy('id_bagian')->get();
    	$sifat = DB::table('tbl_sifat_surat')->get();
    	$jenis = DB::table('tbl_jenis_surat')->get();
    	return view('disposisi_dir_langsung', compact(['agenda','tujuan','sifat','jenis']));
    }

    // LIST TABEL SURAT MASUK EKTERNAL
    public function listSurat_masuk(Request $request)
    {
        $listSurat = DB::table("tbl_surat_keluar")
                        ->select('id_surat_keluar','nomor_surat','tanggal_surat','tujuan','perihal')
                        ->join('tbl_bagian', 'tbl_surat_keluar.id_bagian', '=', 'tbl_bagian.id_bagian')
                        ->whereRaw("((',' || RTRIM(tujuan) || ',') LIKE '%,".$request->id_direktur.",%'
                                    OR (',' || RTRIM(tbl_surat_keluar.tindasan) || ',') LIKE '%,".$request->id_direktur.",%')
                                    AND stat_agenda_dir = '0' AND tahun_surat = ".$request->tahun." AND grup_bagian = '1'")
                        ->orderBy('tanggal_surat', 'desc')
                        ->get();
        $no = 0;
        $data = array();
        foreach ($listSurat as $list) {
            $arrTujuan = explode(',', $list->tujuan);
            $arrTujuan = array_map('floatval', $arrTujuan);
            $tujuan = DB::table('tbl_bagian')->select('nama_bagian')->whereIn('id_bagian', $arrTujuan)->get();

            $no++;
            $baris = array();
            $row = array();

            foreach($tujuan as $bag => $x) {
                $y = $bag+1;
                $baris[] = $x->nama_bagian;
            }

            $row[] = $no;
            $row[] = $list->nomor_surat;
            $row[] = date('d M Y', strtotime($list->tanggal_surat));
            $row[] = $baris;
            $row[] = $list->perihal;
            $row[] = "<button type='button' class='btn btn-default btn-xs shiny icon-only darkorange tooltip-darkorange' onclick='detail(".$list->id_surat_keluar.")' data-toggle='tooltip' data-placement='top' data-original-title='Detail Disposisi' href='javascript:void(0);'><i class='fa fa-eye'></i></button>
            		  <a href='disposisi_direksi_langsung/".$list->id_surat_keluar."/disposisi' class='btn btn-default btn-xs shiny icon-only darkorange tooltip-darkorange' data-toggle='tooltip' data-placement='top' data-original-title='Disposisi Surat'><i class='fa fa-pencil'></i></a>";
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
        $tujuan = DB::table('tbl_bagian')->whereIn('id_bagian', $arrTujuan)->get();

        $arrTujuan_dispo = explode(',', $detail->tujuan_dispo);
        $arrTujuan_dispo = array_map('floatval', $arrTujuan_dispo);
        $tujuan_dispo = DB::table('tbl_bagian')->whereIn('id_bagian', $arrTujuan_dispo)->get();

        $arrDireksi_dispo = explode(',', $detail->tujuan_dispo);
        $arrDireksi_dispo = array_map('floatval', $arrDireksi_dispo);
        $direksi_dispo = DB::table('tbl_disposisi_direksi')->whereIn('id_disposisi_direksi', $arrDireksi_dispo)->get();
        return view('modal/modal_detaildispo_dir_langsung', compact(['detail','tindasan','tujuan','tujuan_dispo','direksi_dispo']));
    }

    // MODAL DETAIL SURAT MASUK / AGENDA DIREKSI
    public function disposisi_direksi_langsung($id)
    {
    	$surat = DB::table('tbl_surat_keluar')
                ->where('id_surat_keluar', $id)->first();

        $url = url('disposisi_direksi_langsung/'.$id.'/update');
        $dir = DB::table('tbl_bagian')->where('grup_bagian', 0)->orderBy('id_bagian')->get();
        $bag = DB::table('tbl_bagian')->where('grup_bagian', 1)->orderBy('id_bagian')->get();
        $dispo = DB::table('tbl_disposisi_direksi')->orderBy('id_disposisi_direksi')->get();
        $selected_disposisi = explode(",", $surat->direksi_dispo);
        $selected_tujuan = explode(",", $surat->tujuan_dispo);
        return view('form_ubah/edit_disposisi_dir_langsung', compact(['surat','url','dir','bag','dispo','selected_disposisi','selected_tujuan']));
    }

    public function update(Request $request, $id)
    {
        if(empty($request->tujuan_disposisi)){
            $arrTujuan = "";
        }else{
            $arrTujuan = implode(',', $request->tujuan_disposisi);
        }

        if(empty($request->disposisi_direksi)){
            $arrDisposisi = "";
        }else{
            $arrDisposisi = implode(',', $request->disposisi_direksi);
        }

        DB::table('tbl_surat_keluar')->where('id_surat_keluar', $id)->update([
            'tujuan_dispo' => $arrTujuan,
            'direksi_dispo' => $arrDisposisi,
            'uraian_dispo' => $request->uraian_disposisi,
            'updated_at' => \Carbon\Carbon::now()
        ]);
        
        return Redirect::to('disposisi_direksi_langsung')->with('message', 'Data disposisi Direksi berhasil diubah.');
    }

    // PROSES SIMPAN AGENDA DIREKSI
    public function store(Request $request)
    {
    	$thn = substr($request->tanggal_agenda, 0, 4);
    	$nomor = DB::table('tbl_temp_agenda_direksi')
    				->where('id_direksi', $request->id_tujuan)
    				->where('id_jenis_surat', $request->id_jenis_surat)
    				->where('tahun', $thn)
    				->first();

        $cek = DB::table('tbl_agenda_direksi')
                    ->where('id_surat_masuk_keluar', $request->id_surat_keluar)
                    ->where('tahun_agenda', $thn)
                    ->where('id_tujuan_dispo', $request->id_tujuan)
                    ->where('jenis_surat', 1)
                    ->first();

        if($cek == NULL){
            if($nomor == NULL){
                $urut = 1;
                DB::table('tbl_temp_agenda_direksi')->insert([
                    'id_direksi' => $request->id_tujuan,
                    'id_jenis_surat' => $request->id_jenis_surat,
                    'nomor_urut' => $urut,
                    'tahun' => $thn,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ]);
            }else{
                $urut = $nomor->nomor_urut;
                $urut += 1;
                DB::table('tbl_temp_agenda_direksi')->where('id_temp_agenda', $nomor->id_temp_agenda)->update([
                    'nomor_urut' => $urut,
                    'updated_at' => \Carbon\Carbon::now()
                ]);
            }

            $kodeBagian = DB::table('tbl_bagian')->select('kode_bagian')->where('id_bagian', $request->id_tujuan)->first();
            $kodeJenis = DB::table('tbl_jenis_surat')->select('kode_jenis')->where('id_jenis_surat', $request->id_jenis_surat)->first();
            $no_agenda = $kodeBagian->kode_bagian."/".$urut."/".$kodeJenis->kode_jenis;

            DB::table('tbl_agenda_direksi')->insert([
                'id_surat_masuk_keluar' => $request->id_surat_keluar,
                'tanggal_agenda' => $request->tanggal_agenda,
                'nomor_agenda' => $no_agenda,
                'jenis_surat' => 1,
                'tahun_agenda' => $thn,
                'id_tujuan_dispo' => $request->id_tujuan,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ]);

            return response()->json(['status'=>'1', 'nomor'=> $no_agenda]);
        }else{
            $no_agenda = "Gagal !";
            return response()->json(['status'=>'2', 'nomor'=> $no_agenda]);
        }
    }
}
