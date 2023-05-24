<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Classroom extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
    ];

    public function students(): HasMany
    {
        return $this->hasMany(Student::class);
    }

    public function lectures(): BelongsToMany
    {
        return $this->belongsToMany(Lecture::class)
            ->using(ClassroomLecture::class)
            ->withPivot('started_at');
    }
}
