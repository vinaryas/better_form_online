<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormHead extends Model
{
    protected $table ='form_head';
    protected $guarded = [];

    public function user()
    {
    	return $this->hasOne(User::class, 'id', 'created_by');
    }

    public function store()
    {
        return $this->hasOne(Store::class, 'id', 'store_id');
    }

    public function aplikasi()
    {
        return $this->hasOne(Aplikasi::class, 'id', 'aplikasi_id');
    }

}
