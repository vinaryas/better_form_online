<?php

namespace App\Services\Support;

use App\Services\PermissionRoleService as SupportService;
use Illuminate\Support\Facades\Facade;

class PermissionRoleService extends Facade
{
	/**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return SupportService::class;
    }
}
