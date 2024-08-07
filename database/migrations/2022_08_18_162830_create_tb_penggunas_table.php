<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbPenggunasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_penggunas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user')->unsigned();
            $table->bigInteger('id_wilayah')->unsigned();
            $table->date('tgl_lahir')->nullable();
            $table->string('jenis_kelamin');
            $table->string('agama');
            $table->string('no_telepon');
            $table->boolean('isActive');
            $table->foreign('id_wilayah')->references('id')->on('tb_wilayahs');
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
        Schema::dropIfExists('tb_penggunas');
    }
}
