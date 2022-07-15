<?php

namespace App\Services;

use App\Models\MappingApprovalPenghapusan;

class MappingApprovalPenghapusanService
{
    private $MappingApprovalPenghapusan;

    public function __construct(MappingApprovalPenghapusan $MappingApprovalPenghapusan)
    {
        $this->MappingApprovalPenghapusan = $MappingApprovalPenghapusan;
    }

    public function getByTypeRoleId($aplikasi, $roleId, $regionId)
    {
        return $this->MappingApprovalPenghapusan
                    ->where('aplikasi_id', $aplikasi)
                    ->where('role_id', $roleId)
                    ->where('region_id', $regionId);
    }

    public function getByPosition($position, $regionId, $aplikasi)
    {
        return $this->MappingApprovalPenghapusan
                    ->where('position', $position)
                    ->where('region_id', $regionId)
                    ->where('aplikasi_id', $aplikasi);
    }
}
