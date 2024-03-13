<?php

namespace Tests\Unit\Modules\FlashCard\Actions;

use App\Modules\FlashCard\Actions\MainMenoAction;
use App\Modules\FlashCard\Factories\CommandFactory;
use App\Modules\FlashCard\Interfaces\FlashCardInteractiveInterface;
use App\Modules\FlashCard\Interfaces\PracticeCommandActionInterface;
use Illuminate\Console\Command;
use Tests\TestCase;
use Mockery;
use Illuminate\Support\Facades\Config;

class MainMenoActionTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Config::shouldReceive('get')
            ->withAnyArgs()
            ->andReturnUsing(function ($key, $default = null) {
                if ($key == 'menu.main-options') {
                    return ['Stat' => 'Stat', 'Practice' => 'Practice', 'Exit' => 'Exit'];
                }
                return $default;
            });
    }

    /** @test */
    public function it_executes_practice_choice_correctly()
    {
        //Arrange
        $practiceCommandMock = Mockery::mock(PracticeCommandActionInterface::class);
        $practiceCommandMock->shouldReceive('__invoke')->once();

        $statCommandServiceMock = Mockery::mock(FlashCardInteractiveInterface::class);
        $statCommandServiceMock->shouldReceive('__invoke')->once();

        $commandFactoryMock = Mockery::mock(CommandFactory::class);
        $commandFactoryMock->shouldReceive('__invoke')->once()->andReturn($statCommandServiceMock);

        $this->app->instance(PracticeCommandActionInterface::class, $practiceCommandMock);

        $commandMock = Mockery::mock(Command::class);
        $commandMock->shouldReceive('choice')->times(3)->andReturn('Practice', 'Stat', 'Exit');
        $commandMock->shouldReceive('info')->once();
        
        $action = new MainMenoAction($commandFactoryMock);

        //ACT
        $action($commandMock);
    }
}
