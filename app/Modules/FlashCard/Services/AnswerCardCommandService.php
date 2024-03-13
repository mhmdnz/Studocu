<?php

namespace app\Modules\FlashCard\Services;

use App\Models\User;
use App\Modules\FlashCard\Enums\FlashCardStatus;
use App\Modules\FlashCard\Interfaces\AnswerCardCommandServiceInterface;
use App\Modules\FlashCard\Interfaces\FlashCardRepositoryInterface;
use App\Modules\FlashCard\Interfaces\SearchPromptInterface;
use App\Modules\FlashCard\Interfaces\UserRepositoryInterface;
use Illuminate\Console\Command;

readonly Class AnswerCardCommandService implements AnswerCardCommandServiceInterface
{

    public function __construct(
        private FlashCardRepositoryInterface $flashCardRepository,
        private UserRepositoryInterface $userRepository,
        private Command $command,
        private SearchPromptInterface $searchPrompt
    ) {
    }

    public function __invoke(User $user): void
    {
        $flashCardId = $this->searchPrompt->search(
            label: 'Take a card number to answer',
            options: fn ($value) => strlen($value) > 0
                ? $this->flashCardRepository->getFlashCardsByUserId($user->id)
                    ->filter(function ($flashCard) use($value) {

                    return (
                        $flashCard->status == 'not_answered' ||
                        $flashCard->status == FlashCardStatus::Incorrect->value
                    ) &&
                        $flashCard->id == $value;
                })->pluck('id')->toArray()
                : [],
            placeholder: 'E.g. 1 or 2 ...',
        );
        $flashCard = $this->flashCardRepository->getFlashCard($flashCardId);
        $answer = $this->command->ask('Enter flash card answer?');
        $result = $flashCard->answer == $answer ? FlashCardStatus::Correct : FlashCardStatus::Incorrect;
        $this->userRepository->updateFlashCardStatus($user->id, $flashCardId, $result);
    }
}
