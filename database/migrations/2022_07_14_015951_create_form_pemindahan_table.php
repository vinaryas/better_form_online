<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormPemindahanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_pemindahan', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('form_head_id');
            $table->integer('created_by');
            $table->integer('nik');
            $table->integer('region_id');
            $table->integer('from_store');
            $table->integer('to_store');
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
        Schema::dropIfExists('form_pemindahan');
    }
}
