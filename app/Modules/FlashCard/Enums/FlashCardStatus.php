<?php

namespace App\Modules\FlashCard\Enums;

enum FlashCardStatus: string
{
    case Correct = 'correct';
    case Incorrect = 'incorrect';
}
