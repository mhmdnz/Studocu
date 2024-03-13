<?php

namespace Tests\Unit\Modules\FlashCard\Services;

use App\Models\FlashCard;
use App\Modules\FlashCard\Interfaces\FlashCardRepositoryInterface;
use App\Modules\FlashCard\Interfaces\UserRepositoryInterface;
use App\Modules\FlashCard\Services\CreateFlashCardCommandService;
use Illuminate\Console\Command;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;

class CreateFlashCardCommandServiceTest extends TestCase
{
    use RefreshDatabase;

    /** @test  */
    public function invoke_correctly()
    {
        //Arrange
        $flashCardRepositoryMock = Mockery::mock(FlashCardRepositoryInterface::class);
        $flashCardRepositoryMock->shouldReceive('create')->once()->andReturn(FlashCard::factory()->make());

        $userRepositoryMock = Mockery::mock(UserRepositoryInterface::class);

        $commandMock = Mockery::mock(Command::class);
        $commandMock->shouldReceive('ask')->with('Enter flash card question?')->andReturn('question');
        $commandMock->shouldReceive('ask')->with('Enter flash card answer?')->andReturn('question');

        $service = new CreateFlashCardCommandService($commandMock, $flashCardRepositoryMock, $userRepositoryMock);

        //ACT
        $service();
    }

    /** @test  */
    public function invoke_with_question_issue()
    {
        //Arrange
        $flashCardRepositoryMock = Mockery::mock(FlashCardRepositoryInterface::class);
        $flashCardRepositoryMock->shouldReceive('create')->once()->andReturn(FlashCard::factory()->make());

        $userRepositoryMock = Mockery::mock(UserRepositoryInterface::class);

        $commandMock = Mockery::mock(Command::class);
        $commandMock->shouldReceive('ask')->with('Enter flash card question?')->andReturn('a');//Not Accepted Question
        $commandMock->shouldReceive('ask')->with('Enter flash card answer?')->andReturn('question');
        $commandMock->shouldReceive('error')->once();

        $service = new CreateFlashCardCommandService($commandMock, $flashCardRepositoryMock, $userRepositoryMock);

        //ACT
        $service();
    }

    /** @test  */
    public function invoke_with_duplicate_question_issue()
    {
        //Arrange
        $flashCard = FlashCard::factory()->create();
        $flashCardRepositoryMock = Mockery::mock(FlashCardRepositoryInterface::class);
        $flashCardRepositoryMock->shouldReceive('create')->once()->andReturn(FlashCard::factory()->make());

        $userRepositoryMock = Mockery::mock(UserRepositoryInterface::class);

        $commandMock = Mockery::mock(Command::class);
        $commandMock->shouldReceive('ask')->with('Enter flash card question?')->andReturn($flashCard->question);//already exist question
        $commandMock->shouldReceive('ask')->with('Enter flash card answer?')->andReturn('question');
        $commandMock->shouldReceive('error')->once();

        $service = new CreateFlashCardCommandService($commandMock, $flashCardRepositoryMock, $userRepositoryMock);

        //ACT
        $service();
    }

    /** @test  */
    public function invoke_with_answer_issue()
    {
        //Arrange
        $flashCardRepositoryMock = Mockery::mock(FlashCardRepositoryInterface::class);
        $flashCardRepositoryMock->shouldReceive('create')->once()->andReturn(FlashCard::factory()->make());

        $userRepositoryMock = Mockery::mock(UserRepositoryInterface::class);

        $commandMock = Mockery::mock(Command::class);
        $commandMock->shouldReceive('ask')->with('Enter flash card question?')->andReturn('question');
        $commandMock->shouldReceive('ask')->with('Enter flash card answer?')->andReturn('q');//not accepted answer
        $commandMock->shouldReceive('error')->once();

        $service = new CreateFlashCardCommandService($commandMock, $flashCardRepositoryMock, $userRepositoryMock);

        //ACT
        $service();
    }
}
