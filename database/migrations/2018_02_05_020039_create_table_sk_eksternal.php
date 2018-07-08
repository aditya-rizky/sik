<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableSkEksternal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_sk_eksternal', function(Blueprint $table){
            $table->increments('id_sk_eksternal');
            $table->integer('id_bagian');
            $table->integer('id_klasifikasi');
            $table->string('nomor_surat', 100);
            $table->date('tanggal_surat');
            $table->string('sifat_surat', 3);
            $table->text('nama_tujuan');
            $table->text('perihal');
            $table->integer('id_pembuat');
            $table->integer('id_konseptor');
            $table->string('tindasan', 50);
            $table->text('path_surat');
            $table->integer('hak_akses');
            $table->string('status_agenda', 1);
            $table->integer('tahun_surat');
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
