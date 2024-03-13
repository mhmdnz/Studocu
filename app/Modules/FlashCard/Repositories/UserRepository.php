<?php

namespace App\Modules\FlashCard\Repositories;

use App\Models\User;
use App\Modules\FlashCard\Enums\FlashCardStatus;
use App\Modules\FlashCard\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function create(string $name): User
    {
        return User::create([
            'name' => $name
        ]);
    }

    public function updateFlashCardStatus(
        int $userId,
        int $flashCardId,
        FlashCardStatus $flashCardStatus
    ):void {
        $user = User::find($userId);
        $user->flashCards()->syncWithoutDetaching([$flashCardId => ['status' => $flashCardStatus->value]]);
    }

    public function getUserById(int $userId): User
    {
        return User::find($userId);
    }

    public function getUserFlashCardsCountByStatus(int $userId, FlashCardStatus $flashCardStatus): int
    {
        $user = User::find($userId);

        return $user->flashCards()->wherePivot('status', $flashCardStatus->value)->count();
    }

    public function detachAllFlashCards(): void
    {
        User::all()->each(function($user) {
            $user->flashCards()->detach();
        });
    }
}
