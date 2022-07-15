<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserStore extends Model
{
    protected $table = 'user_store';
    protected $guarded = [];

    public function stores()
    {
    	return $this->hasOne(Store::class, 'id', 'store_id');
    }

    public function user()
    {
    	return $this->hasOne(User::class, 'id', 'user_id');
    }
}
