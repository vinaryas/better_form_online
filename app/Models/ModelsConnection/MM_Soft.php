<?php

namespace App\Models\ModelsConnection;

use Illuminate\Database\Eloquent\Model;

class MM_Soft extends Model
{
    protected $connection = 'mysql2';
    protected $table = 'cashier';
    protected $guarded = [];

    const UPDATED_AT = null;
    const CREATED_AT = null;
}
