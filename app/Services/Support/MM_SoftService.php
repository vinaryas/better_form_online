<?php

namespace App\Services\Support;

use App\Services\MM_SoftService as SupportService;
use Illuminate\Support\Facades\Facade;

class MM_SoftService extends Facade
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
