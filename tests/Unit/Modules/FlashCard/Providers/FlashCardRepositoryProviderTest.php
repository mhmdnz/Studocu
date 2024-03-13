<?php

namespace Tests\Unit\Modules\FlashCard\Providers;

use Tests\TestCase;
use App\Modules\FlashCard\Interfaces\FlashCardRepositoryInterface;
use App\Modules\FlashCard\Repositories\FlashCardRepository;

class FlashCardRepositoryProviderTest extends TestCase
{
    /** @test  */
    public function check_service_bound_correctly()
    {
        $repository = $this->app->make(FlashCardRepositoryInterface::class);

        $this->assertInstanceOf(FlashCardRepository::class, $repository);
    }
}
