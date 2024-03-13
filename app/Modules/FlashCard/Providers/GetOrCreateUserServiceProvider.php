<?php

namespace App\Modules\FlashCard\Providers;

use App\Modules\FlashCard\Interfaces\GetOrCreateUserServiceInterface;
use App\Modules\FlashCard\Services\GetOrCreateUserService;
use Illuminate\Support\ServiceProvider;

class GetOrCreateUserServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->singleton(GetOrCreateUserServiceInterface::class, GetOrCreateUserService::class);
    }
}
