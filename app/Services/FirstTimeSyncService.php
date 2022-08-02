<?php

namespace App\Services;

use App\Models\ModelsConnection\FirstTimeSync;
use Illuminate\Support\Facades\DB;

class FirstTimeSyncService
{
    private $db;
    private $FirstTimeSync;

    public function __construct(FirstTimeSync $FirstTimeSync)
    {
        $this->db = DB::connection('mysql2');
        $this->FirstTimeSync = $FirstTimeSync;
    }

    public function all()
    {
        return $this->FirstTimeSync->query();
    }

    public function update($data, $stores)
    {
        return $this->FirstTimeSync->where('store', $stores)->update($data);
    }
}
