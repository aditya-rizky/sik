<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableSuratMasukInternal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_surat_masuk', function(Blueprint $table){
            $table->increments('id_surat_masuk');
            $table->integer('jenis_surat')->comment('0 utk internal, 1 utk eksternal');
            $table->integer('id_surat_keluar')->nullable();
            $table->integer('id_klasifikasi');
            $table->date('tanggal_agenda');
            $table->integer('nomor_agenda');
            $table->string('nomor_surat', 100)->nullable();
            $table->date('tanggal_surat')->nullable();
            $table->text('nama_pengirim')->nullable();
            $table->string('tujuan')->nullable();
            $table->text('perihal');
            $table->string('tindasan', 50)->nullable();
            $table->integer('tahun_surat');
            $table->integer('stat_agenda_dir')->comment('0 utk belum, 1 utk sudah');
            $table->text('path_surat')->nullable();
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
