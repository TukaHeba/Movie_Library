<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MovieResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'title' => $this->title,
            'director' => $this->director,
            'genre' => $this->genre,
            'release_year' => $this->release_year,
            'description' => $this->description,
            'ratings' => $this->ratings->map(function ($rating) {
                return [
                    'rating' => $rating->rating,
                    'review' => $rating->review,
                    'user' => $rating->user->name,
                ];
            }),
        ];
    }
}
