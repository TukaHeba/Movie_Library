<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRatingRequest;
use App\Http\Requests\UpdateRatingRequest;
use App\Models\Rating;
use App\Models\Movie;
use App\Services\RatingService;

class RatingController extends Controller
{
    /**
     * RatingService instance.
     * @var RatingService
     */
    protected $ratingService;

    /**
     * Inject RatingService dependency into the controller.
     * @param RatingService $movieService
     */
    public function __construct(RatingService $ratingService)
    {
        $this->ratingService = $ratingService;
    }

    /**
     * Store a new rating in storage.
     *
     * @param \App\Http\Requests\StoreRatingRequest $request
     * @param \App\Models\Movie $movie
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreRatingRequest $request, Movie $movie)
    {
        $validated = $request->validated();
        return $this->ratingService->store($validated, $movie);
    }

    /**
     * Update the specified rating.
     *
     * @param \App\Http\Requests\UpdateRatingRequest $request
     * @param \App\Models\Movie $movie
     * @param \App\Models\Rating $rating
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateRatingRequest $request, Movie $movie, Rating $rating)
    {
        $validated = $request->validated();
        return $this->ratingService->update($validated, $rating);
    }

    /**
     * Remove the specified rating from storage.
     *
     * @param \App\Models\Movie $movie
     * @param \App\Models\Rating $rating
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Movie $movie, Rating $rating)
    {
        return $this->ratingService->delete($rating);
    }
}
