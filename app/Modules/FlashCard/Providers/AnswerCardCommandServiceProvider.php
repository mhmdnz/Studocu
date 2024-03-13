<?php

namespace App\Modules\FlashCard\Providers;

use App\Modules\FlashCard\Interfaces\AnswerCardCommandServiceInterface;
use App\Modules\FlashCard\Services\AnswerCardCommandService;
use Illuminate\Support\ServiceProvider;

Class AnswerCardCommandServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(AnswerCardCommandServiceInterface::class, AnswerCardCommandService::class);
    }
}
