<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
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
            'description' => $this->description,
            'completion_date' => $this->completion_date,
            'status' => $this->status,
            'user_id' => $this->user_id,
            'user' => $this->user->name,
            'created_at' => $this->created_at,
        ];
    }
}
