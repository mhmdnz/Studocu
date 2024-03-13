<?php

namespace Tests\Unit\Modules\FlashCard\Providers;

use App\Modules\FlashCard\Actions\PracticeCommandAction;
use App\Modules\FlashCard\Interfaces\PracticeCommandActionInterface;
use Tests\TestCase;

class PracticeCommandActionProviderTest extends TestCase
{
    /** @test */
    public function check_service_bound_correctly()
    {
        $service = $this->app->make(PracticeCommandActionInterface::class);

        $this->assertInstanceOf(PracticeCommandAction::class, $service);
    }
}
