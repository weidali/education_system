<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Lecture extends Model
{
    use HasFactory;

    protected $fillable = [
        'theme',
        'description',
    ];

    public function classrooms(): BelongsToMany
    {
        return $this->belongsToMany(Classroom::class)
            ->using(ClassroomLecture::class)
            ->withPivot('started_at');
    }
}
