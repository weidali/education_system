<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
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
            'name' => $this->name,
            'email' => $this->email,
            'created' => $this->created_at->format('d-m-Y'),
            'classroom' => $this->when(
                $request->routeIs('students.show') || $request->routeIs('students.store'),
                function () {
                    return $this->classroom->title ?? null;
                }
            ),
        ];
    }
}
