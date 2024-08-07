<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbHalamansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_halamans', function (Blueprint $table) {
            $table->id();
            $table->string('judul')->nullable();
            $table->string('slug')->nullable();
            $table->string('atas_kiri')->nullable();
            $table->string('atas_tengah')->nullable();
            $table->string('atas_kanan')->nullable();
            $table->string('tengah_kiri')->nullable();
            $table->string('tengah')->nullable();
            $table->string('tengah_kanan')->nullable();
            $table->string('bawah_kiri')->nullable();
            $table->string('bawah_tengah')->nullable();
            $table->string('bawah_kanan')->nullable();
            $table->text('teks')->nullable();
            $table->string('gambar')->nullable();
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
        Schema::dropIfExists('tb_halamans');
    }
}
