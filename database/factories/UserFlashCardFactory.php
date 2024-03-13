<?php

namespace Database\Factories;

use App\Models\FlashCard;
use App\Models\User;
use App\Modules\FlashCard\Enums\FlashCardStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserFlashCard>
 */
class UserFlashCardFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory()->create(),
            'flash_card_id' => FlashCard::factory()->create(),
            'status' => $this->faker->randomElement(FlashCardStatus::cases())->value,
        ];
    }
}
