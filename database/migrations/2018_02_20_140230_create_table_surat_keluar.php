<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableSuratKeluar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_surat_keluar', function(Blueprint $table){
            $table->increments('id_surat_keluar');
            $table->integer('jenis_surat')->comment('0 utk internal, 1 utk eksternal');
            $table->integer('id_bagian');
            $table->integer('id_klasifikasi');
            $table->string('nomor_surat', 100);
            $table->date('tanggal_surat');
            $table->integer('sifat_surat');
            $table->string('id_tujuan', 50)->nullable();
            $table->text('nama_tujuan')->nullable();
            $table->text('perihal');
            $table->integer('id_pembuat');
            $table->string('tindasan', 50)->nullable();
            $table->integer('id_hak_akses');
            $table->integer('tahun_surat');
            $table->integer('stat_agenda_sentral')->comment('0 utk belum, 1 utk sudah');
            $table->integer('stat_agenda_dir')->comment('0 utk belum, 1 utk sudah');
            $table->text('path_surat');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
