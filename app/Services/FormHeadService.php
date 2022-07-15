<?php

namespace App\Services;

use App\Models\FormHead;

class FormHeadService
{
   private $FormHead;

   public function __construct(FormHead $FormHead)
    {
        $this->FormHead = $FormHead;
    }

   public function all()
	{
		return $this->FormHead->query();
	}

    public function store($data)
    {
        return $this->FormHead->create($data);
    }

    public function countForm($userId)
    {
        return $this->FormHead->where('created_by', $userId);
    }

    public function countAdmin()
    {
        return $this->FormHead->query();
    }

}


