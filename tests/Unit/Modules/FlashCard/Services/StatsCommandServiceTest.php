<?php

namespace Tests\Unit\Modules\FlashCard\Services;

use App\Models\FlashCard;
use App\Models\User;
use App\Modules\FlashCard\Interfaces\FlashCardRepositoryInterface;
use App\Modules\FlashCard\Interfaces\GetOrCreateUserServiceInterface;
use App\Modules\FlashCard\Interfaces\ShowUserStatsCommandServiceInterface;
use App\Modules\FlashCard\Services\StatsCommandService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Collection;
use Tests\TestCase;
use Mockery;

class StatsCommandServiceTest extends TestCase
{
    use RefreshDatabase;

    /** @test  */
    public function invoke_correctly()
    {
        //Arrange
        $user = User::factory()->create();
        $flashCards = FlashCard::factory(3)->make();
        $getOrCreateServiceMock = Mockery::mock(GetOrCreateUserServiceInterface::class);
        $getOrCreateServiceMock->shouldReceive('__invoke')->once()->andReturn($user);
        $showUserStatsCommandServiceInterfaceMock = Mockery::mock(ShowUserStatsCommandServiceInterface::class);
        $showUserStatsCommandServiceInterfaceMock->shouldReceive('__invoke')
            ->withArgs(function (
                Collection $collection,
                bool $isPractice
            ) use ($flashCards) {
                return $collection == $flashCards;
            })
            ->once()
            ->andReturn();

        $flashCardRepositoryMock = Mockery::mock(FlashCardRepositoryInterface::class);
        $flashCardRepositoryMock->shouldReceive('getFlashCardsByUserId')
            ->with($user->id)
            ->once()
            ->andReturn($flashCards);

        $service = new StatsCommandService(
            $flashCardRepositoryMock,
            $getOrCreateServiceMock,
            $showUserStatsCommandServiceInterfaceMock
        );

        //ACT
        $service();
    }
}
