<?php

namespace Tests\Unit\Modules\FlashCard\Commands;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use App\Modules\FlashCard\Interfaces\MainMenoActionInterface;

class InteractiveCommandTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_calls_main_meno_action()
    {
        //Arrange
        $mock = $this->mock(MainMenoActionInterface::class, function ($mock) {
            $mock->shouldReceive('__invoke')->once();
        });

        $this->app->instance(MainMenoActionInterface::class, $mock);

        //ACT
        Artisan::call('flashcard:interactive');
    }
}
