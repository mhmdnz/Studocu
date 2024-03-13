<?php

namespace App\Modules\FlashCard\Interfaces;

use Illuminate\Support\Collection;

interface ShowUserStatsCommandServiceInterface
{
    public function __invoke(Collection $userFlashCards, bool $isPractice = true): void;
}
