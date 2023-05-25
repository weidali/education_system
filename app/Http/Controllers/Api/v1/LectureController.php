<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreLectureRequest;
use App\Http\Resources\LectureResource;
use App\Models\Lecture;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Cache;

class LectureController extends Controller
{
    public function index(): JsonResource
    {
        return LectureResource::collection(Cache::remember('classrooms', 60 * 60 * 24, function () {
            return Lecture::all();
        }));
    }

    public function store(StoreLectureRequest $request): LectureResource
    {
        $lecture = Lecture::create($request->validated());

        return LectureResource::make($lecture->fresh());
    }

    public function show(Lecture $lecture): LectureResource
    {
        return LectureResource::make($lecture);
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
