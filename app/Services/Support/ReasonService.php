<?php

namespace App\Services\Support;

use App\Services\ReasonService as SupportService;
use Illuminate\Support\Facades\Facade;

class ReasonService extends Facade
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
