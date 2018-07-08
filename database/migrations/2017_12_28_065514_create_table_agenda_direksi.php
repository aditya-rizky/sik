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
            $table->increments('id_agenda_direksi');
            $table->integer('id_jenis_surat');
            $table->integer('id_tujuan');
            $table->date('tanggal_agenda');
            $table->integer('id_surat_keluar');
            $table->string('nomor_agenda', 50);
            $table->string('tujuan_disposisi', 100);
            $table->string('disposisi_direksi', 100);
            $table->text('uraian_disposisi');
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
