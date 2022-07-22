<?php

namespace App\Services;

use App\Models\MappingApprovalFormHead;

class MappingApprovalFormHeadService
{
    private $MappingApprovalFormHead;

    public function __construct(MappingApprovalFormHead $MappingApprovalFormHead)
    {
        $this->MappingApprovalFormHead = $MappingApprovalFormHead;
    }

    public function getByTypeRoleId($roleId, $regionId)
    {
        return $this->MappingApprovalFormHead
                    ->where('role_id', $roleId)
                    ->where('region_id', $regionId);
    }

    public function getByPosition($position, $regionId)
    {
        return $this->MappingApprovalFormHead
                    ->where('position', $position)
                    ->where('region_id', $regionId);
    }
}
