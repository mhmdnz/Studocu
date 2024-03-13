<?php

namespace App\Modules\FlashCard\Services;

use App\Modules\FlashCard\Bridges\CommandServiceBridge;

class ResetCommandService extends CommandServiceBridge
{

    public function __invoke(): void
    {
        $this->userRepository->detachAllFlashCards();
        $this->command->info('All answered removed!!');
    }
}
