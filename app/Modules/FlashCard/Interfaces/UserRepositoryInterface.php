<?php

namespace App\Modules\FlashCard\Interfaces;

use App\Models\User;
use App\Modules\FlashCard\Enums\FlashCardStatus;

interface UserRepositoryInterface
{
    public function getUserById(int $userId): User;

    public function updateFlashCardStatus(
        int $userId,
        int $flashCardId,
        FlashCardStatus $flashCardStatus
    ):void;

    public function create(string $name): User;

    public function getUserFlashCardsCountByStatus(int $userId, FlashCardStatus $flashCardStatus): int;

    public function detachAllFlashCards(): void;
}
