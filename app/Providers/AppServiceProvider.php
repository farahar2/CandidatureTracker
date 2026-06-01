<?php

namespace App\Providers;

use App\Models\Application;
use App\Models\Interview;
use App\Policies\ApplicationPolicy;
use App\Policies\InterviewPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Gate::policy(Application::class, ApplicationPolicy::class);
        Gate::policy(Interview::class, InterviewPolicy::class);
    }
}