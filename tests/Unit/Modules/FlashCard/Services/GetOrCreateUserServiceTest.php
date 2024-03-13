<?php

namespace Tests\Unit\Modules\FlashCard\Services;

use App\Models\User;
use App\Modules\FlashCard\Interfaces\SearchPromptInterface;
use App\Modules\FlashCard\Interfaces\UserRepositoryInterface;
use App\Modules\FlashCard\Services\GetOrCreateUserService;
use Illuminate\Console\Command;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Mockery;

class GetOrCreateUserServiceTest extends TestCase
{
    use RefreshDatabase;

    /** @test  */
    public function invoke_with_exist_user()
    {
        //Arrange
        $user = User::factory()->create();

        $userRepositoryMock = Mockery::mock(UserRepositoryInterface::class);
        $userRepositoryMock->shouldReceive('getUserById')
            ->once()
            ->with($user->id)
            ->andReturn($user);

        $commandMock = Mockery::mock(Command::class);
        $searchPromptMock = Mockery::mock(SearchPromptInterface::class);
        $searchPromptMock->shouldReceive('search')->andReturn($user->id);

        $service = new GetOrCreateUserService($userRepositoryMock, $commandMock, $searchPromptMock);

        //ACT
        $service();
    }

    /** @test  */
    public function invoke_with_not_exist_user()
    {
        $user = User::factory()->make();
        //Arrange
        $userRepositoryMock = Mockery::mock(UserRepositoryInterface::class);
        $userRepositoryMock->shouldReceive('create')
            ->once()
            ->with($user->name)
            ->andReturn($user);

        $commandMock = Mockery::mock(Command::class);
        $commandMock->shouldReceive('ask')->once()->andReturn($user->name);

        $searchPromptMock = Mockery::mock(SearchPromptInterface::class);
        $searchPromptMock->shouldReceive('search')->andReturn(-1);

        $service = new GetOrCreateUserService($userRepositoryMock, $commandMock, $searchPromptMock);

        //ACT
        $service();
    }
}
