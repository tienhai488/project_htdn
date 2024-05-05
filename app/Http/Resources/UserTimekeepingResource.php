<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserTimekeepingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $user = User::find($this->id);
        $timekeeping = $user->getTimekeepingForDate((int)$request->month, (int)$request->year);
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'timekeeping' => $timekeeping,
            'timekeepingData' => getDataTimekeeping($timekeeping, (int)$request->month, (int)$request->year),
        ];
    }
}
