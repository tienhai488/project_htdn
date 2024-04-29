<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CandidateResource extends JsonResource
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
            'recruitment' => $this->whenLoaded('recruitment'),
            'name' => $this->name,
            'email' => $this->email,
            'desired_salary' => number_format($this->desired_salary),
            'status' => $this->status->getStatus(),
        ];
    }
}
