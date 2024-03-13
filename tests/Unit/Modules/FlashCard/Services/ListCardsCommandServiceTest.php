<?php

namespace Tests\Unit\Modules\FlashCard\Services;

use App\Modules\FlashCard\Interfaces\FlashCardRepositoryInterface;
use App\Modules\FlashCard\Interfaces\UserRepositoryInterface;
use App\Modules\FlashCard\Services\ListCardsCommandService;
use Illuminate\Console\Command;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Mockery;

class ListCardsCommandServiceTest extends TestCase
{
    use RefreshDatabase;

    /** @test  */
    public function invoke_correctly()
    {
        //Arrange
        $mockedFields = ['id', 'question', 'answer'];
        $userRepositoryMock = Mockery::mock(UserRepositoryInterface::class);

        $flashCardRepositoryMock = Mockery::mock(FlashCardRepositoryInterface::class);
        $flashCardRepositoryMock->shouldReceive('getList')
            ->with($mockedFields)
            ->once()->andReturn(collect());

        $commandMock = Mockery::mock(Command::class);
        $commandMock->shouldReceive('table')
            ->once()
            ->andReturn();

        $service = new ListCardsCommandService($commandMock, $flashCardRepositoryMock, $userRepositoryMock);

        //ACT
        $service();
    }
}
