<?php

namespace App\Observers;

use App\Models\Classroom;
use Illuminate\Support\Facades\Cache;

class ClassroomObserver
{
    public function created(Classroom $classroom): void
    {
        Cache::forget('classrooms');
    }

    public function updated(Classroom $classroom): void
    {
        //
    }

    public function deleted(Classroom $classroom): void
    {
        Cache::forget('classrooms');
    }
}
