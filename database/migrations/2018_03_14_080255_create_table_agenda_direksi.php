<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableAgendaDireksi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_agenda_direksi', function(Blueprint $table){
            $table->increments('id_agenda');
            $table->integer('id_surat_masuk');
            $table->date('tanggal_agenda');
            $table->integer('nomor_agenda');
            $table->integer('id_jns_dispo');
            $table->integer('id_tujuan_dispo');
            $table->date('tanggal_agenda_dispo');
            $table->string('nomor_agenda_dispo', 50);
            $table->string('tujuan_dispo', 100);
            $table->string('direksi_dispo', 50);
            $table->text('uraian_dispo');
            $table->date('tanggal_bagian');
            $table->text('keterangan');
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
