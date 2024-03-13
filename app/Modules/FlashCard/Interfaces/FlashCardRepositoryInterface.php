<?php

namespace App\Modules\FlashCard\Interfaces;

use App\Models\FlashCard;
use Illuminate\Support\Collection;

interface FlashCardRepositoryInterface
{
    public function getFlashCard(int $flashCardId): FlashCard;

    public function create(string $question, string $answer): FlashCard;

    public function getList(array $fields): Collection;

    public function getFlashCardsByUserId(int $userId): Collection;
}
