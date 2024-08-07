<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbArtikelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_artikels', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_kategori_artikel')->unsigned();
            $table->string('judul');
            $table->string('slug');
            $table->text('teks');
            $table->string('gambar')->nullable();
            $table->foreign('id_kategori_artikel')->references('id')->on('tb_kategori_artikels');
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
        Schema::dropIfExists('tb_artikels');
    }
}
