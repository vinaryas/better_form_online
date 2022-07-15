<?php

namespace App\Services;

use App\Models\PermissionRole;

class PermissionRoleService
{
	private $PermissionRole;

    public function __construct(PermissionRole $PermissionRole)
    {
        $this->PermissionRole = $PermissionRole;
    }

	public function all(){
		return $this->PermissionRole->query();
	}

    public function store($data){
        return $this->PermissionRole->upsert($data);
    }

    public function find($id){
        return $this->all()->where('id', $id);
    }

}
