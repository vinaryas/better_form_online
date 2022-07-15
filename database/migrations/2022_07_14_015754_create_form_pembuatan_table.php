<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormPembuatanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_pembuatan', function (Blueprint $table) {
            $table->id();
            $table->integer('aplikasi_id');
            $table->bigInteger('form_head_id');
            $table->integer('created_by');
            $table->string('user_id_aplikasi')->nullable();
            $table->string('pass')->nullable();
            $table->integer('store_id')->nullable();
            $table->integer('role_last_app');
            $table->integer('role_next_app');
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
        Schema::dropIfExists('form_pembuatan');
    }
}
