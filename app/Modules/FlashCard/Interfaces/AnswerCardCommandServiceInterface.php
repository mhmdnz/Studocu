<?php

namespace App\Modules\FlashCard\Interfaces;

use App\Models\User;
use Illuminate\Console\Command;

interface AnswerCardCommandServiceInterface
{
    public function __invoke(User $user): void;
}
