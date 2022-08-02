<?php

namespace App\Models\ModelsConnection;

use Illuminate\Database\Eloquent\Model;

class FirstTimeSync extends Model
{
    protected $connection = 'mysql2';
    protected $table = 'first_time_sync';
    protected $guarded = [];

    const UPDATED_AT = null;
    const CREATED_AT = null;
}
