<?php

namespace App\Providers;

use App\Interfaces\CompressorRepositoryInterface;
use App\Repositories\CompressorRepository;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(CompressorRepositoryInterface::class, CompressorRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // custom response for requests.
        Response::macro('success', function ($result = [], $message = "Successfully Done.", $statusCode = 500) {
            return Response::make(['status' => true, 'result' => $result, 'message' => $message], 200);
        });
        Response::macro('error', function ($message = "Something Wrong...!", $statusCode = 500) {
            return Response::make(['status' => false, 'message' => $message], $statusCode);
        });
    }
}
