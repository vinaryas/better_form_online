<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormPembuatan extends Model
{
    protected $table ='form_pembuatan';
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

    public function formHead()
    {
        return $this->hasone(FormHead::class, 'id', 'form_head_id');
    }

    public function approval()
    {
        return $this->hasMany(ApprovalPembuatan::class, 'form_pembuatan_id', 'id');
    }

    public function lastApproval()
    {
        return $this->approval()->latest();
    }
}
