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
		return $this->FormPenghapusan->query()->with('form_head');
	}

    public function store($data)
    {
        return $this->FormPenghapusan->create($data);
    }

    public function update($data, $id)
    {
        return $this->FormPenghapusan->where('id', $id)->update($data);
    }

    public function getByUserId($user_id)
    {
        return $this->FormPenghapusan->where('created_by', $user_id);
    }
}
