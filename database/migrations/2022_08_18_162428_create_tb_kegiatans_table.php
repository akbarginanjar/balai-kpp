<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbKegiatansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_kegiatans', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_kategori_kegiatan')->unsigned();
            $table->string('judul');
            $table->string('slug');
            $table->text('teks');
            $table->string('gambar')->nullable();
            $table->foreign('id_kategori_kegiatan')->references('id')->on('tb_kategori_kegiatans');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->dateTime('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_kegiatans');
    }
}
