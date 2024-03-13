<?php

namespace App\Modules\FlashCard\Providers;

use App\Modules\FlashCard\Adapters\SearchPromptAdapter;
use App\Modules\FlashCard\Interfaces\SearchPromptInterface;
use Illuminate\Support\ServiceProvider;

class SearchPromptProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(SearchPromptInterface::class, SearchPromptAdapter::class);
    }
}
