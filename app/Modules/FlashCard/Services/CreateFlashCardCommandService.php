<?php

namespace App\Modules\FlashCard\Services;

use App\Modules\FlashCard\Bridges\CommandServiceBridge;
use Illuminate\Support\Facades\Validator;

class CreateFlashCardCommandService extends CommandServiceBridge
{
    public function __invoke(): void
    {
        $question = $this->command->ask('Enter flash card question?');
        $answer = $this->command->ask('Enter flash card answer?');

        $data = [
            'question' => $question,
            'answer' => $answer,
        ];

        $validator = Validator::make($data, [
            'question' => 'required|string|max:100|min:5|unique:flash_cards',
            'answer' => 'required|string|max:100|min:5',
        ]);

        if ($validator->fails()) {
            $this->command->error(implode(", ", $validator->errors()->all()));
        }

        $this->flashCardRepository->create($question, $answer);
    }
}

