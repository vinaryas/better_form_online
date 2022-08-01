<?php

namespace App\Services;

use App\Models\MM_Soft;

class MM_SoftService
{
   private $MM_Soft;

   public function __construct(MM_Soft $MM_Soft)
   {
        $this->MM_Soft = $MM_Soft;
   }

   public function all()
   {
        return $this->MM_Soft->query();
   }

   public function store($data)
    {
        return $this->MM_Soft->updateOrCreate($data);
    }
}
