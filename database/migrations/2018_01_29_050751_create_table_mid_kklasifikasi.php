<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableMidKklasifikasi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_mid_klasifikasi', function(Blueprint $table){
            $table->increments('id_mid_klas');
            $table->integer('id_top_klas');
            $table->string('kode_mid_klas', 10);
            $table->string('nama_mid_klas', 150);
            $table->string('status_mid_klas', 1);
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
