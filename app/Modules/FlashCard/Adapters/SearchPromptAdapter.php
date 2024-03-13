<?php

namespace app\Modules\FlashCard\Adapters;

use App\Modules\FlashCard\Interfaces\SearchPromptInterface;
use function Laravel\Prompts\search;

class SearchPromptAdapter implements SearchPromptInterface
{
    public function search(string $label, callable $options, string $placeholder): mixed
    {
        return search(label: $label, options: $options, placeholder: $placeholder);
    }
}
