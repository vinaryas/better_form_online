<?php

namespace App\Services;

use App\Models\ApprovalPembuatan;
use App\Services\Support\MappingApprovalPembuatanService;

class ApprovalPembuatanService
{
    private $ApprovalPembuatan;

    public function __construct(ApprovalPembuatan $ApprovalPembuatan)
    {
        $this->ApprovalPembuatan = $ApprovalPembuatan;
    }

    public function all()
    {
        return $this->ApprovalPembuatan->query();
    }

    public function store($data)
    {
        return $this->ApprovalPembuatan->create($data);
    }

    public function getNextApp($aplikasi, $roleId, $regionId)
    {
        $thisPosition = MappingApprovalPembuatanService::getByTypeRoleId($aplikasi, $roleId, $regionId)->first()->position;

        $nextPosition = MappingApprovalPembuatanService::getByPosition($thisPosition + 1, $regionId, $aplikasi)->first();

        return ($nextPosition != null) ? $nextPosition->role_id : 0;
    }


    public function countApproved()
    {
        return $this->ApprovalPembuatan->where('status', 'Approved');
    }

    public function countDisapproved()
    {
        return $this->ApprovalPembuatan->where('status', 'Disapproved');
    }

}
