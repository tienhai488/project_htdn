<?php

namespace App\Http\Resources;

use App\Acl\Acl;
use App\Enums\CandidateStatus;
use App\Models\Recruitment;
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
        $recruitment = Recruitment::find($this->id);
        return [
            'id' => $this->id,
            'title' => $this->title,
            'department' => $this->whenLoaded('department'),
            'position' => $this->whenLoaded('position'),
            'pending_candidates_count' => $recruitment->countCandidate(CandidateStatus::PENDING),
            'interview_candidates_count' => $recruitment->countCandidate(CandidateStatus::INTERVIEW),
            'accept_candidates_count' => $recruitment->countCandidate(CandidateStatus::ACCEPT),
            'refuse_candidates_count' => $recruitment->countCandidate(CandidateStatus::REFUSE),
            'candidates' => $this->whenLoaded('candidates'),
            'quantity' => $this->quantity,
            'expired_time' => formatDate($this->expired_time, 'd/m/Y'),
            'minimum_salary' => number_format($this->minimum_salary),
            'maximum_salary' => number_format($this->maximum_salary),
            'description' => $this->description,
        ];
    }
}
