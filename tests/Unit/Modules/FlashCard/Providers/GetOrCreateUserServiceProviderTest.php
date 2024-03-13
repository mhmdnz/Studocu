<?php

namespace Tests\Unit\Modules\FlashCard\Providers;

use App\Modules\FlashCard\Interfaces\GetOrCreateUserServiceInterface;
use app\Modules\FlashCard\Services\GetOrCreateUserService;
use Tests\TestCase;

class GetOrCreateUserServiceProviderTest extends TestCase
{
    /** @test  */
    public function check_service_bound_correctly()
    {
        $repository = $this->app->make(GetOrCreateUserServiceInterface::class);

        $this->assertInstanceOf(GetOrCreateUserService::class, $repository);
    }
}
