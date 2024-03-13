<?php

namespace App\Modules\FlashCard\Services;

use App\Modules\FlashCard\Enums\FlashCardStatus;
use App\Modules\FlashCard\Interfaces\ShowUserStatsCommandServiceInterface;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;

readonly class ShowUserStatsCommandService implements ShowUserStatsCommandServiceInterface
{
    private const string TOTAL_FIELD_NAME = 'Total';
    private const string ANSWERED_PERCENTAGE_FIELD_NAME = 'Answered Percentage';
    private const string CORRECT_PERCENTAGE_FIELD_NAME = 'Correct Percentage';

    public function __construct(private Command $command)
    {
    }

    public function __invoke(Collection $userFlashCards, bool $isPractice = true): void
    {
        if ($isPractice) {
            $this->showQuestionTable($userFlashCards);
        }
        $this->showProgress($userFlashCards, $isPractice);
    }

    private function showProgress(Collection $userFlashCards, bool $isPractice): void
    {
        $total = $userFlashCards->count();
        $correctCount = 0;
        $answeredCount = 0;

        foreach ($userFlashCards as $flashCard) {
            if ($flashCard->status == FlashCardStatus::Correct->value) {
                $correctCount++;
            }
            if ($flashCard->status == FlashCardStatus::Correct->value ||
                $flashCard->status == FlashCardStatus::Incorrect->value) {
                $answeredCount++;
            }
        }

        $successRate = $this->formatPercentage($correctCount, $total);

        $data = [[
            self::TOTAL_FIELD_NAME => $total,
            self::CORRECT_PERCENTAGE_FIELD_NAME => $successRate
        ]];

        if (!$isPractice) {
            $answeredRate = $this->formatPercentage($answeredCount, $total);
            $data[0][self::ANSWERED_PERCENTAGE_FIELD_NAME] = $answeredRate;
        }

        $this->command->table(
            array_keys($data[0]),
            $data
        );
    }

    private function showQuestionTable(Collection $userFlashCards): void
    {
        $fields = ['id', 'question', 'status'];
        $this->command->table(
            $fields,
            $userFlashCards->map(function ($item) {
                return (array)$item;
            })->toArray()
        );
    }

    private function formatPercentage(int $count, int $total): float
    {
        return number_format($count * 100 / $total, 2);
    }
}
