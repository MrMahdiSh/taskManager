<?php

namespace App\Providers;

use App\Contracts\VerifyInterface;
use App\Models\Task;
use App\Services\Auth\EmailVerificationService;
use App\Services\Auth\VerifyEmailService;
use App\Services\task\TaskService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(TaskService::class, function ($app) {
            return new TaskService(new Task());
        });

        $this->app->bind(VerifyInterface::class, EmailVerificationService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
