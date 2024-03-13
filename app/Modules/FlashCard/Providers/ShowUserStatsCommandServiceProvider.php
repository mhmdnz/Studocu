<?php

namespace App\Modules\FlashCard\Providers;

use App\Modules\FlashCard\Interfaces\ShowUserStatsCommandServiceInterface;
use App\Modules\FlashCard\Services\ShowUserStatsCommandService;
use Illuminate\Support\ServiceProvider;

class ShowUserStatsCommandServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->singleton(
            ShowUserStatsCommandServiceInterface::class,
            ShowUserStatsCommandService::class
        );
    }
}
