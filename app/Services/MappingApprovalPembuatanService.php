<?php

namespace App\Services;

use App\Models\mappingApprovalPembuatan;

class MappingApprovalPembuatanService
{
    private $MappingApprovalPembuatan;

    public function __construct(MappingApprovalPembuatan $MappingApprovalPembuatan)
    {
        $this->MappingApprovalPembuatan = $MappingApprovalPembuatan;
    }

    public function getByTypeRoleId($aplikasi, $roleId, $regionId)
    {
        return $this->MappingApprovalPembuatan
                    ->where('aplikasi_id', $aplikasi)
                    ->where('role_id', $roleId)
                    ->where('region_id', $regionId);
    }

    public function getByPosition($position, $regionId, $aplikasi)
    {
        return $this->MappingApprovalPembuatan
                    ->where('position', $position)
                    ->where('region_id', $regionId)
                    ->where('aplikasi_id', $aplikasi);
    }
}
