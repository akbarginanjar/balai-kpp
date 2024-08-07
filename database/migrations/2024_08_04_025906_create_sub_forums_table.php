<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubForumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_forums', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('forum_id')->unsigned();
            $table->foreign('forum_id')->references('id')->on('forums');
            $table->string('kepada');
            $table->string('name');
            $table->string('email');
            $table->text('deskripsi');
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
        Schema::dropIfExists('sub_forums');
    }
}
