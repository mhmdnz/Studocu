<?php

namespace App\Modules\FlashCard\Providers;

use App\Modules\FlashCard\Interfaces\UserRepositoryInterface;
use App\Modules\FlashCard\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class UserRepositoryProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->singleton(UserRepositoryInterface::class, UserRepository::class);
    }
}
