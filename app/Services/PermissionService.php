<?php

namespace App\Services;

use App\Models\Permission;

class PermissionService
{
	private $Permission;

    public function __construct(Permission $Permission)
    {
        $this->Permission = $Permission;
    }

	public function all(){
		return $this->Permission->query();
	}

    public function sync($data){
        return $this->Permission->updateOrCreate($data);
    }

    public function find($id){
        return $this->all()->where('id', $id);
    }

}
