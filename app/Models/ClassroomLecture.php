<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ClassroomLecture extends Pivot
{
    protected $casts = [
        'started_at'  => 'date:d-m-Y',
    ];
}
