<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PermissionRole extends Model
{
    protected $guarded = [];
    protected $table = 'permission_role';
    public $incrementing = false;
    public $timestamps = false;

    public static function getPermissionRole($parent_id, $role_id)
    {
        return DB::select(DB::raw("
            SELECT a.`id`, a.parent_id, a.`name`, a.`display_name`, b.role_id
            FROM permissions a
            LEFT JOIN (
            SELECT * FROM `permission_role` WHERE role_id = {$role_id}
            ) b ON a.id = b.permission_id
            WHERE a.parent_id = {$parent_id}
        "));
    }
}
