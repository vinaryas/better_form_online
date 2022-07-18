<?php

namespace App\Services;

use App\Models\Reason;

class ReasonService
{
	private $Reason;

    public function __construct(Reason $Reason)
    {
        $this->Reason = $Reason;
    }

	public function all(){
		return $this->Reason->query();
	}

}
