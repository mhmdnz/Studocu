<?php
namespace App\Modules\FlashCard\Bridges;

use App\Modules\FlashCard\Interfaces\FlashCardRepositoryInterface;
use App\Modules\FlashCard\Interfaces\UserRepositoryInterface;
use Illuminate\Console\Command;
use App\Modules\FlashCard\Interfaces\FlashCardInteractiveInterface;

Abstract class CommandServiceBridge implements FlashCardInteractiveInterface
{
    public function __construct(
        protected readonly Command $command,
        protected readonly FlashCardRepositoryInterface $flashCardRepository,
        protected readonly UserRepositoryInterface $userRepository,
    ) {
    }
}
