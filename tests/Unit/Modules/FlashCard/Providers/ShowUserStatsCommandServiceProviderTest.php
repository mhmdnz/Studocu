<?php

namespace Tests\Unit\Modules\FlashCard\Providers;

use App\Modules\FlashCard\Interfaces\ShowUserStatsCommandServiceInterface;
use app\Modules\FlashCard\Services\ShowUserStatsCommandService;
use Tests\TestCase;

class ShowUserStatsCommandServiceProviderTest extends TestCase
{
    /** @test */
    public function check_service_bound_correctly()
    {
        $service = $this->app->make(ShowUserStatsCommandServiceInterface::class);

        $this->assertInstanceOf(ShowUserStatsCommandService::class, $service);
    }
}
