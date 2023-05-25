<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreClassroomRequest;
use App\Http\Resources\ClassroomResource;
use App\Models\Classroom;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Cache;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResource
    {
        return ClassroomResource::collection(Cache::remember('classrooms', 60 * 60 * 24, function () {
            return Classroom::all();
        }));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClassroomRequest $request): ClassroomResource
    {
        $classroom = Classroom::create($request->validated());

        return ClassroomResource::make($classroom->fresh());
    }

    /**
     * Display the specified resource.
     */
    public function show(Classroom $classroom): ClassroomResource
    {
        return ClassroomResource::make($classroom);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
