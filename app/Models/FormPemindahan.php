<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormPemindahan extends Model
{
    protected $table ='form_pemindahan';
    protected $guarded = [];

    public function user()
    {
    	return $this->hasOne(User::class, 'id', 'created_by');
    }

    public function store1()
    {
        return $this->hasOne(Store::class, 'id', 'from_store');
    }

    public function store2()
    {
        return $this->hasOne(Store::class, 'id', 'to_store');
    }

}
