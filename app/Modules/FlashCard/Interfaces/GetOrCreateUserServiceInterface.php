<?php

namespace App\Modules\FlashCard\Interfaces;

use App\Models\User;
use Illuminate\Console\Command;

interface GetOrCreateUserServiceInterface
{
    public function __invoke(): User;
}
