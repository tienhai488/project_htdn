<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SalaryResource extends JsonResource
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
            'user' => $this->user,
            'amount' => number_format($this->amount),
            'position' => $this->position,
            'approved_at' => formatDate($this->approved_at, 'd/m/Y'),
            'approved_by' => $this->approvedBy,
            'created_at' => formatDate($this->created_at, 'd/m/Y'),
        ];
    }
}
