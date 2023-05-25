<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreStudentRequest;
use App\Http\Resources\StudentResource;
use App\Models\Student;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;

class StudentController extends Controller
{
    public function index(): JsonResource
    {
        return StudentResource::collection(Cache::remember('students', 60 * 60 * 24, function () {
            return Student::all();
        }));
    }

    public function store(StoreStudentRequest $request)
    {
        $student = Student::create($request->validated());

        return StudentResource::make($student->fresh());
    }

    public function show(Student $student): StudentResource
    {
        return StudentResource::make($student);
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(Student $student): JsonResponse
    {
        $student->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
