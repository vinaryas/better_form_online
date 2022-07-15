<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class ApprovalPenghapusan extends Model
{
    protected $table ='approval_penghapusan';
    protected $guarded = [];

    public function user()
    {
    	return $this->hasOne(User::class, 'id', 'created_by');
    }

    public function role()
    {
    	return $this->hasOne(Role::class, 'id', 'approver_role_id');
    }

    public function getCreatedAtAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])->translatedFormat('d F Y');
    }
}
