<?php

namespace App\Modules\FlashCard\Interfaces;

interface SearchPromptInterface
{
    public function search(string $label, callable $options, string $placeholder): mixed;
}
