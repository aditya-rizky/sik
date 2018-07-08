<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableBottomKlasifikasi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_bot_klasifikasi', function(Blueprint $table){
            $table->increments('id_bot_klas');
            $table->integer('id_mid_klas');
            $table->integer('kode_bot_klas');
            $table->text('nama_bot_klas');
            $table->string('status_bot_klas', 1);
            $table->integer('id_retensi_aktif');
            $table->integer('id_retensi_inaktif');
            $table->integer('id_retensi_ket');
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
