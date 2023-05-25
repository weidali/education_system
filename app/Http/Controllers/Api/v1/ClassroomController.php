<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreClassroomRequest;
use App\Http\Resources\ClassroomResource;
use App\Models\Classroom;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;

class ClassroomController extends Controller
{
    public function index(): JsonResource
    {
        return ClassroomResource::collection(Cache::remember('classrooms', 60 * 60 * 24, function () {
            return Classroom::all();
        }));
    }
    public function getClassrooms(): JsonResource
    {
        $perPage = 10;
        return ClassroomResource::collection(Classroom::paginate($perPage));
    }

    public function store(StoreClassroomRequest $request): ClassroomResource
    {
        $classroom = Classroom::create($request->validated());

        return ClassroomResource::make($classroom->fresh());
    }

    public function show(Classroom $classroom): ClassroomResource
    {
        return ClassroomResource::make($classroom);
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(Classroom $classroom): JsonResponse
    {
        $studentsQueryBuilder = $classroom->students();
        $studentsQueryBuilder->update(['classroom_id' => null]);

        $classroom->lectures()->detach([$classroom->id]);

        $classroom->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
