<?php

namespace App\Providers;

use App\Models\Classroom;
use App\Models\Student;
use App\Observers\ClassroomObserver;
use App\Observers\StudentObserver;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        JsonResource::withoutWrapping();

        Student::observe(StudentObserver::class);
        Classroom::observe(ClassroomObserver::class);
    }
}
