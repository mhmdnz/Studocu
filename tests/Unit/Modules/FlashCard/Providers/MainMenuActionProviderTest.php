<?php

namespace Tests\Unit\Modules\FlashCard\Providers;

use App\Modules\FlashCard\Actions\MainMenoAction;
use App\Modules\FlashCard\Interfaces\MainMenoActionInterface;
use Tests\TestCase;

class MainMenuActionProviderTest extends TestCase
{
    /** @test  */
    public function check_service_bound_correctly()
    {
        $repository = $this->app->make(MainMenoActionInterface::class);

        $this->assertInstanceOf(MainMenoAction::class, $repository);
    }
}
