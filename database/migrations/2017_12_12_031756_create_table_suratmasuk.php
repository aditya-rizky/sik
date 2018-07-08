<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableSuratmasuk extends Migration
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
            $table->char('tipe_agenda', 1);
            $table->date('tangga_agenda');
            $table->integer('nomor_agenda');
            $table->string('nomor_surat', 100);
            $table->date('tanggal_surat');
            $table->integer('id_pengirim');
            $table->string('nama_pengirim', 150);
            $table->integer('id_tujuan');
            $table->text('perihal');
            $table->integer('id_klasifikasi');
            $table->string('tindasan', 100);
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
