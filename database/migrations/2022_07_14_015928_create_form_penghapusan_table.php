<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormPenghapusanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_penghapusan', function (Blueprint $table) {
            $table->id();
            $table->integer('aplikasi_id');
            $table->bigInteger('form_head_id');
            $table->integer('created_by');
            $table->integer('store_id')->nullable();
            $table->integer('status');
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
        Schema::dropIfExists('form_penghapusan');
    }
}
