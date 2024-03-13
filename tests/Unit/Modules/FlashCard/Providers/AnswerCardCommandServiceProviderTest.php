<?php

namespace Tests\Unit\Modules\FlashCard\Providers;

use Tests\TestCase;
use App\Modules\FlashCard\Interfaces\AnswerCardCommandServiceInterface;
use App\Modules\FlashCard\Services\AnswerCardCommandService;

class AnswerCardCommandServiceProviderTest extends TestCase
{
    /** @test */
    public function check_service_bound_correctly()
    {
        $service = $this->app->make(AnswerCardCommandServiceInterface::class);

        $this->assertInstanceOf(AnswerCardCommandService::class, $service);
    }
}
