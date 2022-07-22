<?php

namespace App\Services;

use App\Models\FormPembuatan;

class FormPembuatanService
{
   private $FormPembuatan;

   public function __construct(FormPembuatan $FormPembuatan)
    {
        $this->FormPembuatan = $FormPembuatan;
    }

    public function all()
    {
		return $this->FormPembuatan->query();
	}

    public function store($data)
    {
        return $this->FormPembuatan->create($data);
    }

    public function update($data, $id)
    {
        return $this->FormPembuatan->where('id', $id)->update($data);
    }

    public function getById($id)
    {
        return $this->FormPembuatan->where('id', $id);
    }

    public function getByFormHeadId($id)
    {
        return $this->FormPembuatan->where('form_head_id', $id);
    }

    public function getByUserId($user_id)
    {
        return $this->FormPembuatan->where('created_by', $user_id);
    }

    public function getByUserIdActive($user_id)
    {
        return $this->FormPembuatan->where('created_by', $user_id)
        ->where('status', config('setting_app.status_approval.approve'))
        ->where('role_next_app', 0);
    }

    public function getApproveFilter($roleId)
    {
        return $this->FormPembuatan->where('role_next_app', $roleId);
    }

    public function getApproveFilterByStore($roleId, $storeId)
    {
        return $this->FormPembuatan->where('role_next_app', $roleId)->whereIn('store_id', $storeId);
    }

    public function countForm($userId)
    {
        return $this->FormPembuatan->where('created_by', $userId);
    }

}
