<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMmSoftTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mm_soft', function (Blueprint $table) {
            $table->id();
            $table->integer('cashnum');
            $table->string('nama');
            $table->string('password');
            $table->integer('roles');
            $table->integer('store');
            $table->string('status');
            $table->integer('ac')->default(2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mm_soft');
    }
}
