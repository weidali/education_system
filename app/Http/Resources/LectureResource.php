<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LectureResource extends JsonResource
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
            'theme' => $this->theme,
            'description' => $this->description,
            'classrooms' => $this->when(
                $request->routeIs('lectures.show'),
                function () {
                    return ClassroomResource::collection($this->classrooms) ?? null;
                }
            ),
            'created' => $this->created_at->format('d-m-Y'),
        ];
    }
}
