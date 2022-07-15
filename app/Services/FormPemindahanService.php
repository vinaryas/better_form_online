<?php

namespace App\Services;

use App\Models\FormPemindahan;

class FormPemindahanService
{
   private $FormPemindahan;

   public function __construct(FormPemindahan $FormPemindahan)
    {
        $this->FormPemindahan = $FormPemindahan;
    }

   public function all()
	{
		return $this->FormPemindahan->query();
	}

    public function store($data)
    {
        return $this->FormPemindahan->create($data);
    }
}
