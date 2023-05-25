<?php

namespace App\Observers;

use App\Models\Lecture;
use Illuminate\Support\Facades\Cache;

class LectureObserver
{
    public function created(Lecture $lecture): void
    {
        Cache::forget('lectures');
    }

    public function updated(Lecture $lecture): void
    {
        //
    }

    public function deleted(Lecture $lecture): void
    {
        Cache::forget('lectures');
    }
}
