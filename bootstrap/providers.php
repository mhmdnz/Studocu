<?php

return [
    App\Providers\AppServiceProvider::class,
    App\Modules\FlashCard\Providers\FlashCardRepositoryProvider::class,
    App\Modules\FlashCard\Providers\GetOrCreateUserServiceProvider::class,
    App\Modules\FlashCard\Providers\UserRepositoryProvider::class,
    App\Modules\FlashCard\Providers\MainMenuActionProvider::class,
    App\Modules\FlashCard\Providers\PracticeCommandActionProvider::class,
    App\Modules\FlashCard\Providers\ShowUserStatsCommandServiceProvider::class,
    App\Modules\FlashCard\Providers\AnswerCardCommandServiceProvider::class,
    App\Modules\FlashCard\Providers\SearchPromptProvider::class,
];
