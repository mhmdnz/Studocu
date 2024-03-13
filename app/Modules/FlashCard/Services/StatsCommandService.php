<?php

namespace app\Modules\FlashCard\Services;

use App\Modules\FlashCard\Interfaces\FlashCardInteractiveInterface;
use App\Modules\FlashCard\Interfaces\FlashCardRepositoryInterface;
use App\Modules\FlashCard\Interfaces\GetOrCreateUserServiceInterface;
use App\Modules\FlashCard\Interfaces\ShowUserStatsCommandServiceInterface;

readonly class StatsCommandService implements FlashCardInteractiveInterface
{
    public function __construct(
        private FlashCardRepositoryInterface $flashCardRepository,
        private GetOrCreateUserServiceInterface $getOrCreateUserService,
        private ShowUserStatsCommandServiceInterface $showUserStatsCommandService,
    ) {
    }

    public function __invoke(): void
    {
        $user = ($this->getOrCreateUserService)();
        $getUserFlashCards = $this->flashCardRepository->getFlashCardsByUserId($user->id);
        ($this->showUserStatsCommandService)($getUserFlashCards, false);
    }
}
