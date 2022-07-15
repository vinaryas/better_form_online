<?php

namespace App\Services;

use App\Models\ApprovalPenghapusan;
use App\Services\Support\MappingApprovalPenghapusanService;

class ApprovalPenghapusanService
{
private $ApprovalPenghapusan;

    public function __construct(ApprovalPenghapusan $ApprovalPenghapusan)
    {
        $this->ApprovalPenghapusan = $ApprovalPenghapusan;
    }

    public function all()
    {
        return $this->ApprovalPenghapusan->query();
    }

    public function store($data)
    {
        return $this->ApprovalPenghapusan->create($data);
    }

    public function getNextApp($aplikasi, $roleId, $regionId)
    {
        $thisPosition = MappingApprovalPenghapusanService::getByTypeRoleId($aplikasi, $roleId, $regionId)->first()->position;

        $nextPosition = MappingApprovalPenghapusanService::getByPosition($thisPosition + 1, $regionId, $aplikasi)->first();

        return ($nextPosition != null) ? $nextPosition->role_id : 0;
    }

}
