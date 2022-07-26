<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDeletedUserFormPenghapusan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('form_penghapusan', function (Blueprint $table) {
            $table->string('deleted_user')->after('form_head_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('form_penghapusan', function (Blueprint $table) {
            $table->removeColumn('deleted_user');
        });
    }
}
