<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RecruitmentResource extends JsonResource
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
            'department' => $this->whenLoaded('department'),
            'position' => $this->whenLoaded('position'),
            'quantity' => $this->quantity,
            'expired_time' => formatDate($this->expired_time, 'd/m/Y'),
            'minimum_salary' => number_format($this->minimum_salary),
            'maximum_salary' => number_format($this->maximum_salary),
            'description' => $this->description,
        ];
    }
}