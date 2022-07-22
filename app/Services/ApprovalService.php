<?php

namespace App\Services;

use App\Models\Approval;
use App\Services\Support\MappingApprovalFormHeadService;

class ApprovalService
{
    private $Approval;

    public function __construct(Approval $Approval)
    {
        $this->Approval = $Approval;
    }

    public function all()
    {
        return $this->Approval->query();
    }

    public function store($data)
    {
        return $this->Approval->create($data);
    }

    public function getNextApp($roleId, $regionId)
    {
        $thisPosition = MappingApprovalFormHeadService::getByTypeRoleId($roleId, $regionId)->first()->position;

        $nextPosition = MappingApprovalFormHeadService::getByPosition($thisPosition + 1, $regionId)->first();

        return ($nextPosition != null) ? $nextPosition->role_id : 0;
    }
}
