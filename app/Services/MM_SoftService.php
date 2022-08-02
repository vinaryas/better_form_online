<?php

namespace App\Services;

use App\Models\ModelsConnection\MM_Soft;
use Illuminate\Support\Facades\DB;

class MM_SoftService
{
    private $db;
    private $MM_Soft;

    public function __construct(MM_Soft $MM_Soft)
   {
        $this->db = DB::connection('mysql2');
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
