<?php

namespace App\Modules\FlashCard\Interfaces;

use Illuminate\Console\Command;

interface MainMenoActionInterface
{
    public function __invoke(Command $command): void;
}
