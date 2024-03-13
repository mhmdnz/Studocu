<?php

namespace Tests\Unit\Modules\FlashCard\Providers;

use App\Modules\FlashCard\Interfaces\UserRepositoryInterface;
use App\Modules\FlashCard\Repositories\UserRepository;
use Tests\TestCase;

class UserRepositoryProviderTest extends TestCase
{
    /** @test */
    public function check_service_bound_correctly()
    {
        $service = $this->app->make(UserRepositoryInterface::class);

        $this->assertInstanceOf(UserRepository::class, $service);
    }
}
