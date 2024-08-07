<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbKontensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_kontens', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_artikel')->unsigned()->nullable();
            $table->bigInteger('id_kegiatan')->unsigned()->nullable();
            $table->bigInteger('id_halaman')->unsigned()->nullable();
            $table->string('type');
            $table->foreign('id_artikel')->references('id')->on('tb_artikels')->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('id_kegiatan')->references('id')->on('tb_kegiatans')->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('id_halaman')->references('id')->on('tb_halamans')->onUpdate('cascade')
                ->onDelete('cascade');
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
        Schema::dropIfExists('tb_kontens');
    }
}
