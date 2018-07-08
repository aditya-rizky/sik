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
            $table->integer('id_bagian')->unsigned();
            $table->integer('id_klasifikasi')->unsigned();
            $table->integer('nomor')->unsigned();
            $table->date('tanggal_surat');
            $table->string('sifat_surat', 3);
            $table->integer('id_tujuan')->unsigned();
            $table->string('nama_tujuan', 150);
            $table->string('perihal', 150);
            $table->integer('id_pembuat')->unsigned();
            $table->integer('id_konseptor')->unsigned();
            $table->string('tindasan', 50);
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
