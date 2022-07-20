<?php

namespace App\Services;

use App\Models\Region;

class RegionService
{
   private $Region;

   public function __construct(Region $Region)
    {
        $this->Region = $Region;
    }

   public function all()
	{
		return $this->Region->query();
	}

    public function sync($data){
        return $this->Region->updateOrCreate($data);
    }

}
