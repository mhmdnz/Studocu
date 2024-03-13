<?php

namespace App\Modules\FlashCard\Providers;

use App\Modules\FlashCard\Interfaces\FlashCardRepositoryInterface;
use App\Modules\FlashCard\Repositories\FlashCardRepository;
use Illuminate\Support\ServiceProvider;

class FlashCardRepositoryProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->singleton(FlashCardRepositoryInterface::class, FlashCardRepository::class);
    }
}
