<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreLectureRequest;
use App\Http\Resources\LectureResource;
use App\Models\Lecture;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;
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

    public function destroy(Lecture $lecture): JsonResponse
    {
        $lecture->classrooms()->detach([$lecture->id]);
        $lecture->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
