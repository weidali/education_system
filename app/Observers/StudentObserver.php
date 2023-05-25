<?php

namespace App\Observers;

use App\Models\Student;
use Illuminate\Support\Facades\Cache;

class StudentObserver
{
    public function created(Student $student): void
    {
        Cache::forget('students');
    }

    public function deleted(Student $student): void
    {
        Cache::forget('students');
    }
}
