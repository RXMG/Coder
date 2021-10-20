<?php

namespace RXMG\Coder;

use Fruitcake\Cors\HandleCors;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;
use Mockery;

class CoderServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if(App::environment('local') && env('CODER', false)) {

            $mock = Mockery::mock(HandleCors::class)
                ->makePartial()
                ->shouldAllowMockingProtectedMethods()
                ->allows(
                    [
                        'shouldRun' => false
                    ]
                );

            app()->instance(
                HandleCors::class,
                $mock
            );
        }
    }
}
