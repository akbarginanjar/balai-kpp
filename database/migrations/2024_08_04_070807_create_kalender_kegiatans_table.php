<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKalenderKegiatansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kalender_kegiatans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kegiatan');
            $table->string('waktu_kegiatan');
            $table->string('status');
            $table->text('deskripsi');
            $table->string('publish');
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
        Schema::dropIfExists('kalender_kegiatans');
    }
}
