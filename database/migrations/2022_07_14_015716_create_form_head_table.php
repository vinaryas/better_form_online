<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormHeadTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_head', function (Blueprint $table) {
            $table->id();
            $table->integer('created_by');
            $table->integer('nik');
            $table->integer('region_id');
            $table->string('type');
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
        Schema::dropIfExists('form_head');
    }
}
