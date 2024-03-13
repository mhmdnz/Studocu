<?php

namespace App\Modules\FlashCard\Services;

use App\Modules\FlashCard\Bridges\CommandServiceBridge;

class ListCardsCommandService extends CommandServiceBridge
{

    public function __invoke(): void
    {
        $fields = ['id', 'question', 'answer'];
        $this->command->table(
            $fields,
            $this->flashCardRepository->getList($fields)
        );
    }
}
