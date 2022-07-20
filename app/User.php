<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'nik', 'region_id', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function scopegetUserRole($query)
    {
        return $query->join('role_user', 'users.id', '=', 'role_user.user_id')
                     ->join('roles', 'role_user.role_id', '=', 'roles.id')
                     ->select('users.id', 'users.name', 'users.nik', 'users.email', 'roles.name as rolename');
    }

    public function stores()
    {
        return $this->hasManyThrough('App\Models\Store', 'App\Models\UserStore', 'user_id', 'id', 'id', 'store_id');
    }

    public function RoleUser()
    {
        return $this->hasOne(RoleUser::class, 'user_id', 'id');
    }

}
