<?php

namespace App\Observers;

use App\Models\Student;
use Illuminate\Support\Facades\Cache;

class StudentObserver
{
    /**
     * Handle the Student "created" event.
     */
    public function created(Student $student): void
    {
        Cache::forget('students');
    }
}
