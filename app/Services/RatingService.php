<?php

namespace App\Services;

use App\Models\Rating;
use App\Models\Movie;
use Illuminate\Support\Facades\Auth;
use App\Services\ApiResponseService;

class RatingService
{
    /**
     * Check if the authenticated user is authorized
     * If not authorized, return an unauthorized respons.
     *
     * @param Rating $rating
     * @return \Illuminate\Http\JsonResponse|null
     */
    protected function checkAuthorization(Rating $rating)
    {
        if ($rating->user_id !== auth()->id()) {
            return ApiResponseService::error(null, 'Unauthorized', 403);
        }

        return null;
    }

    /**
     * Store a new rating.
     *
     * @param array $validated
     * @param \App\Models\Movie $movie
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(array $validated, Movie $movie)
    {
        $rating = Rating::create([
            'user_id' => auth()->id(),
            'movie_id' => $movie->id,
            'rating' => $validated['rating'],
            'review' => $validated['review'] ?? null,
        ]);

        return ApiResponseService::success($rating, 'Rating created successfully.');
    }

    /**
     * Update the specified rating, with authorization check.
     *
     * @param array $validated
     * @param \App\Models\Rating $rating
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(array $validated, Rating $rating)
    {
        if ($authorizationResponse = $this->checkAuthorization($rating)) {
            return $authorizationResponse;
        }

        $rating->update([
            'rating' => $validated['rating'],
            'review' => $validated['review'] ?? $rating->review,
        ]);

        return ApiResponseService::success($rating, 'Rating updated successfully.');
    }

    /**
     * Delete the specified rating, with authorization check.
     *
     * @param \App\Models\Rating $rating
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Rating $rating)
    {
        if ($authorizationResponse = $this->checkAuthorization($rating)) {
            return $authorizationResponse;
        }

        $rating->delete();

        return ApiResponseService::success(null, 'Rating deleted successfully.');
    }
}
