<?php

namespace App\Modules\FlashCard\Providers;

use App\Modules\FlashCard\Actions\PracticeCommandAction;
use App\Modules\FlashCard\Interfaces\PracticeCommandActionInterface;
use Illuminate\Support\ServiceProvider;

class PracticeCommandActionProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->singleton(PracticeCommandActionInterface::class, PracticeCommandAction::class);
    }
}
