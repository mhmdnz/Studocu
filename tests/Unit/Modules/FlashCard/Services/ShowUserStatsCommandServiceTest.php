<?php

namespace Tests\Unit\Modules\FlashCard\Services;

use App\Models\FlashCard;
use Tests\TestCase;
use Mockery;
use App\Modules\FlashCard\Services\ShowUserStatsCommandService;
use Illuminate\Console\Command;

class ShowUserStatsCommandServiceTest extends TestCase
{
    /** @test */
    public function practice_mode()
    {
        // Arrange
        $commandMock = Mockery::mock(Command::class);
        $commandMock->shouldReceive('table')->twice()->andReturn();

        $flashCards = FlashCard::factory(2)->create();

        $service = new ShowUserStatsCommandService($commandMock);

        // Act
        $service($flashCards, true);
    }

    /** @test */
    public function non_practice_mode()
    {
        // Arrange
        $commandMock = Mockery::mock(Command::class);
        $commandMock->shouldReceive('table')->with(
            $this->anything(),
            $this->callback(function ($data) {
                return array_key_exists('Answered Percentage', $data[0]);
            })
        )->once()->andReturn();

        $flashCards = FlashCard::factory(2)->create();

        $service = new ShowUserStatsCommandService($commandMock);

        // Act
        $service($flashCards, false);
    }
}
