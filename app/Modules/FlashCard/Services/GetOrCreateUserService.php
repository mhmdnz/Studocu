<?php

namespace app\Modules\FlashCard\Services;

use App\Models\User;
use App\Modules\FlashCard\Interfaces\GetOrCreateUserServiceInterface;
use App\Modules\FlashCard\Interfaces\SearchPromptInterface;
use App\Modules\FlashCard\Interfaces\UserRepositoryInterface;
use Illuminate\Console\Command;

readonly class GetOrCreateUserService implements GetOrCreateUserServiceInterface
{
    public function __construct(
        private UserRepositoryInterface $userRepository,
        private Command $command,
        private SearchPromptInterface $searchPrompt
    ) {
    }

    public function __invoke(): User
    {
        $userId = $this->searchPrompt->search(
            label: 'Search for a GetOrCreateUserServiceuser: or select studocu user',
            options: fn ($value) => strlen($value) > 0
                ? User::where('name', 'like', "%{$value}%")->pluck('name', 'id')->all()
                : [-1 => 'Create User'],
            placeholder: 'E.g. studocu',
        );

        if ($userId == -1) {
            $name = $this->command->ask('What is your name?');
            $user = $this->userRepository->create($name);
        } else {
            $user = $this->userRepository->getUserById($userId);
        }

        return $user;
    }
}
