<?php

namespace Tests\Unit\Modules\FlashCard\Services;

use App\Modules\FlashCard\Interfaces\FlashCardRepositoryInterface;
use App\Modules\FlashCard\Interfaces\UserRepositoryInterface;
use App\Modules\FlashCard\Services\ResetCommandService;
use Illuminate\Console\Command;
use Tests\TestCase;
use Mockery;

class ResetCommandServiceTest extends TestCase
{
    /** @test  */
    public function invoke_correctly()
    {
        $userRepositoryMock = Mockery::mock(UserRepositoryInterface::class);
        $userRepositoryMock->shouldReceive('detachAllFlashCards')
            ->once()
            ->andReturn();

        $flashCardRepositoryMock = Mockery::mock(FlashCardRepositoryInterface::class);

        $commandMock = Mockery::mock(Command::class);
        $commandMock->shouldReceive('info')
            ->with('All answered removed!!')
            ->once()
            ->andReturn();

        $service = new ResetCommandService($commandMock, $flashCardRepositoryMock, $userRepositoryMock);

        //ACT
        $service();
    }
}
