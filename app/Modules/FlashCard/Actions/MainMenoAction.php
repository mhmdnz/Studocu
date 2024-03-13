<?php

namespace App\Modules\FlashCard\Actions;

use App\Modules\FlashCard\Factories\CommandFactory;
use App\Modules\FlashCard\Interfaces\PracticeCommandActionInterface;
use Illuminate\Console\Command;
use App\Modules\FlashCard\Interfaces\MainMenoActionInterface;

class MainMenoAction implements MainMenoActionInterface
{
    public function __construct(private CommandFactory $commandFactory)
    {
    }

    public function __invoke(Command $command): void
    {
        $this->presentOptions($command);
    }

    private function presentOptions(Command $command): void
    {
        $options = config('menu.main-options');
        app()->instance(Command::class, $command);

        $choice = $command->choice('Choose an option', array_keys($options), 1);

        if ($choice == $options['Exit']) {
            $command->info('Exiting...');
            return;
        }

        $this->executeChoice($choice);
        $this->presentOptions($command);
    }

    private function executeChoice(string $choice): void
    {
        if ($choice == config('menu.main-options')['Practice']) {
            (resolve(PracticeCommandActionInterface::class))();
        } else {
            (($this->commandFactory)($choice))();
        }
    }
}
