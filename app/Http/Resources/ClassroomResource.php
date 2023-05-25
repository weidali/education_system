<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClassroomResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'lectures' => $this->when(
                $request->routeIs('classrooms.show'),
                function () {
                    return LectureResource::collection($this->lectures) ?? null;
                }
            ),
            'created' => $this->created_at->format('d-m-Y'),
        ];
    }
}
