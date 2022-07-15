<?php

namespace App\Services\Support;

use App\Services\Auth\UserService as SupportService;
use Illuminate\Support\Facades\Facade;

class UserService extends Facade
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
