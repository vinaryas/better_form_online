<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMappingAppPenghapusanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mapping_app_penghapusan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('region_id');
            $table->unsignedBigInteger('role_id');
            $table->unsignedBigInteger('aplikasi_id');
            $table->integer('position');
            $table->timestamps();

            $table->foreign('role_id')->references('id')->on('roles');
            $table->foreign('aplikasi_id')->references('id')->on('aplikasi');
            $table->foreign('region_id')->references('id')->on('regions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mapping_app_penghapusan');
    }
}
