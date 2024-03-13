<?php

namespace Tests\Unit\Modules\FlashCard\Actions;

use App\Models\FlashCard;
use App\Models\UserFlashCard;
use Tests\TestCase;
use App\Modules\FlashCard\Actions\PracticeCommandAction;
use App\Modules\FlashCard\Interfaces\FlashCardRepositoryInterface;
use App\Modules\FlashCard\Interfaces\GetOrCreateUserServiceInterface;
use App\Modules\FlashCard\Interfaces\ShowUserStatsCommandServiceInterface;
use App\Modules\FlashCard\Interfaces\AnswerCardCommandServiceInterface;
use Illuminate\Console\Command;
use Mockery;
use App\Models\User;

class PracticeCommandActionTest extends TestCase
{
    /** @test */
    public function invoke_method_exits_gracefully()
    {
        // Arrange
        $flashCardRepositoryMock = Mockery::mock(FlashCardRepositoryInterface::class);
        $getOrCreateUserServiceMock = Mockery::mock(GetOrCreateUserServiceInterface::class);
        $showUserStatsCommandServiceMock = Mockery::mock(ShowUserStatsCommandServiceInterface::class);
        $showUserStatsCommandServiceMock->shouldReceive('__invoke');

        $answerCardCommandServiceInterfaceMock = Mockery::mock(AnswerCardCommandServiceInterface::class);
        $answerCardCommandServiceInterfaceMock->shouldReceive('__invoke');
        $this->app->instance(AnswerCardCommandServiceInterface::class, $answerCardCommandServiceInterfaceMock);

        $userFlashCard = UserFlashCard::factory()->create();
        $user = User::find($userFlashCard->user_id);
        $getOrCreateUserServiceMock->shouldReceive('__invoke')
            ->once()
            ->andReturn($user);

        $flashCardRepositoryMock->shouldReceive('getFlashCardsByUserId')
            ->twice()
            ->with($user->id)
            ->andReturn(FlashCard::all());

        $commandMock = Mockery::mock(Command::class);
        $commandMock->shouldReceive('choice')->twice()->andReturn('AnswerCard', 'Exit');

        $commandMock->shouldReceive('info')
            ->with('Exiting...')
            ->once();

        $practiceCommandAction = new PracticeCommandAction(
            $flashCardRepositoryMock,
            $getOrCreateUserServiceMock,
            $showUserStatsCommandServiceMock,
            $commandMock
        );

        // ACT
        ($practiceCommandAction)();
    }
}
