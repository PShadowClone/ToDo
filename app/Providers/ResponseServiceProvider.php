<?php

namespace App\Providers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class ResponseServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // custom response
        Response::macro('api', function ($message , $status  = STATUS_OK , $data = array()) {
            return Response::json(['status' => $status , 'message' => $message , 'data'=> $data ] , $status , ['Content-Type' => 'application/json']);
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
