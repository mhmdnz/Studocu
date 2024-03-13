<?php

namespace App\Modules\FlashCard\Factories;

use App\Modules\FlashCard\Interfaces\FlashCardInteractiveInterface;

class CommandFactory
{
    public function __invoke(string $commandType): FlashCardInteractiveInterface
    {
        $className = 'App\Modules\FlashCard\Services\\' . $commandType . 'CommandService';

        return app()->make($className);
    }
}
