<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_settings', function (Blueprint $table) {
            $table->id();
            $table->string('icon');
            $table->string('judul');
            $table->string('alamat');
            $table->string('call_us');
            $table->string('email_us');
            $table->string('facebook');
            $table->string('twitter');
            $table->string('linkedin');
            $table->string('instagram');
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
        Schema::dropIfExists('tb_settings');
    }
}
