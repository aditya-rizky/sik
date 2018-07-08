<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableKaryawan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_karyawan', function(Blueprint $table){
            $table->increments('id_karyawan');
            $table->string('nama_karyawan', 150);
            $table->date('tanggal_lahir');
            $table->date('tanggal_karyawan');
            $table->integer('jenis_kelamin')->unsigned();
            $table->integer('id_bagian')->unsigned();
            $table->integer('id_jabatan')->unsigned();
            $table->integer('id_golongan')->unsigned();
            $table->integer('id_pendidikan')->unsigned();
            $table->integer('status_karyawan')->unsigned();
            $table->integer('status_konseptor')->unsigned();
            $table->string('foto', 150);
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
