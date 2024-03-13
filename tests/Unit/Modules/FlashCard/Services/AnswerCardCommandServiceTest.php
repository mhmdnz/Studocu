<?php

namespace Tests\Unit\Modules\FlashCard\Services;

use App\Models\FlashCard;
use App\Models\User;
use App\Modules\FlashCard\Enums\FlashCardStatus;
use App\Modules\FlashCard\Services\AnswerCardCommandService;
use App\Modules\FlashCard\Interfaces\FlashCardRepositoryInterface;
use App\Modules\FlashCard\Interfaces\SearchPromptInterface;
use App\Modules\FlashCard\Interfaces\UserRepositoryInterface;
use Illuminate\Console\Command;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Mockery;

class AnswerCardCommandServiceTest extends TestCase
{
    use RefreshDatabase;

    /** @test  */
    public function invoke_with_correct_answer_updates_status_correctly()
    {
        //Arrange
        $flashCard = FlashCard::factory()->create();
        $user = User::factory()->create();

        $flashCardRepositoryMock = Mockery::mock(FlashCardRepositoryInterface::class);
        $flashCardRepositoryMock->shouldReceive('getFlashCardsByUserId')->andReturn(collect([['id' => $flashCard->id]]));
        $flashCardRepositoryMock->shouldReceive('getFlashCard')->with($flashCard->id)->andReturn($flashCard);

        $userRepositoryMock = Mockery::mock(UserRepositoryInterface::class);
        $userRepositoryMock->shouldReceive('updateFlashCardStatus')->once()->with($user->id, $flashCard->id, FlashCardStatus::Correct);

        $commandMock = Mockery::mock(Command::class);
        $commandMock->shouldReceive('ask')->once()->andReturn($flashCard->answer);

        $searchPromptMock = Mockery::mock(SearchPromptInterface::class);
        $searchPromptMock->shouldReceive('search')->andReturn($flashCard->id);

        $service = new AnswerCardCommandService($flashCardRepositoryMock, $userRepositoryMock, $commandMock, $searchPromptMock);

        //ACT
        $service($user);
    }
}
