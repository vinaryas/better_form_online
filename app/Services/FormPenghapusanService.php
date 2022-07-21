<?php

namespace App\Services;

use App\Models\FormPenghapusan;

class FormPenghapusanService
{
   private $FormPenghapusan;

   public function __construct(FormPenghapusan $FormPenghapusan)
    {
        $this->FormPenghapusan = $FormPenghapusan;
    }

   public function all()
	{
		return $this->FormPenghapusan->query();
	}

    public function store($data)
    {
        return $this->FormPenghapusan->create($data);
    }

    public function update($data, $id)
    {
        return $this->FormPenghapusan->where('id', $id)->update($data);
    }

    public function getById($id)
    {
        return $this->FormPenghapusan->where('id', $id);
    }

    public function getByUserId($user_id)
    {
        return $this->FormPenghapusan->where('created_by', $user_id);
    }

    public function getApproveFilter($roleId)
    {
        return $this->FormPenghapusan->where('role_next_app', $roleId);
    }

    public function getApproveFilterByStore($roleId, $storeId)
    {
        return $this->FormPenghapusan->where('role_next_app', $roleId)->whereIn('store_id', $storeId);
    }
}
