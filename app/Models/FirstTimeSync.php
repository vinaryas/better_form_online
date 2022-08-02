<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FirstTimeSync extends Model
{
    protected $table = 'first_time_sync';
    protected $guarded = [];

    const UPDATED_AT = null;
    const CREATED_AT = null;
}
