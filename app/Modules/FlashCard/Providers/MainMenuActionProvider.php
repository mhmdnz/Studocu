<?php

namespace App\Modules\FlashCard\Providers;

use App\Modules\FlashCard\Interfaces\MainMenoActionInterface;
use Illuminate\Support\ServiceProvider;
use App\Modules\FlashCard\Actions\MainMenoAction;

class MainMenuActionProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(MainMenoActionInterface::class, MainMenoAction::class);
    }
}
