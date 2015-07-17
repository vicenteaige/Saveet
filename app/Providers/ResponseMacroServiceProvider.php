<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Routing\ResponseFactory;

class ResponseMacroServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(ResponseFactory $factory)
    {
        $factory->macro('api', function ($httpStatus, $outcome, $error, $body) use ($factory) {
            return $factory->json([
                'header' => [
                    'success' => $outcome,
                    'msg' => $error
                ],
                'body' => [
                    $body
                ]
            ], $httpStatus);
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
