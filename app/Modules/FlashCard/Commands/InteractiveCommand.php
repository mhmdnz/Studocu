<?php

namespace App\Modules\FlashCard\Commands;

use App\Modules\FlashCard\Interfaces\MainMenoActionInterface;
use Illuminate\Console\Command;
use Illuminate\Contracts\Console\PromptsForMissingInput;

class InteractiveCommand extends Command implements PromptsForMissingInput
{
    protected $signature = 'flashcard:interactive';

    protected $description = 'Play with flash cards';

    public function __construct(private readonly MainMenoActionInterface $mainMenoAction)
    {
        parent::__construct();
    }

    public function handle(): void
    {
        ($this->mainMenoAction)($this);
    }
}
