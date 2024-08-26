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
        // Calculate the average rating
        $ratingAvg = $this->ratings->isEmpty() ? 0 : round($this->ratings->avg('rating'), 1);

        return [
            'title' => $this->title,
            'director' => $this->director,
            'genre' => $this->genre,
            'release_year' => $this->release_year,
            'description' => $this->description,
            'average_rating' => $ratingAvg,
        ];
    }
}
