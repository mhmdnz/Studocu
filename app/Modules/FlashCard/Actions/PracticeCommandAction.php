<?php

namespace App\Modules\FlashCard\Actions;

use App\Modules\FlashCard\Interfaces\AnswerCardCommandServiceInterface;
use App\Modules\FlashCard\Interfaces\FlashCardRepositoryInterface;
use App\Modules\FlashCard\Interfaces\GetOrCreateUserServiceInterface;
use App\Modules\FlashCard\Interfaces\PracticeCommandActionInterface;
use App\Modules\FlashCard\Interfaces\ShowUserStatsCommandServiceInterface;
use Illuminate\Console\Command;

readonly class PracticeCommandAction implements PracticeCommandActionInterface
{
    public function __construct(
        private FlashCardRepositoryInterface $flashCardRepository,
        private GetOrCreateUserServiceInterface $getOrCreateUserService,
        private ShowUserStatsCommandServiceInterface $showUserStatsCommandService,
        private Command $command
    ) {
    }

    public function __invoke(): void
    {
        $user = ($this->getOrCreateUserService)();
        $this->practiceOptions($user);
    }

    private function practiceOptions($user): void
    {
        $options = config('menu.practice-options');
        $getUserFlashCards = $this->flashCardRepository->getFlashCardsByUserId($user->id);
        ($this->showUserStatsCommandService)($getUserFlashCards);

        $choice = $this->command->choice(
            'Choose an option',
            array_keys($options),
            1
        );

        if ($choice == $options['Exit']) {
            $this->command->info('Exiting...');
        } else if($choice == $options['AnswerCard']) {
            (resolve(AnswerCardCommandServiceInterface::class)($user));
            $this->practiceOptions($user);
        }
    }
}
