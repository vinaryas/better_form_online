<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApprovalPenghapusanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('approval_penghapusan', function (Blueprint $table) {
            $table->id();
            $table->integer('form_penghapusan_id');
            $table->integer('approved_by');
            $table->integer('approver_nik');
            $table->string('approver_name');
            $table->integer('approver_role_id');
            $table->integer('approver_region_id');
            $table->string('status');
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
        Schema::dropIfExists('approval_penghapusan');
    }
}
