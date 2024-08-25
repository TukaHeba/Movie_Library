<?php

namespace App\Services;

use App\Models\Movie;
use Illuminate\Http\Request;
use App\Services\ApiResponseService;
use App\Http\Resources\MovieResource;
use Illuminate\Support\Facades\Validator;

class MovieService
{
    // Start building the query
    // Filter by genre if provided
    // Sort by release_year if provided
    // Apply pagination to the query
    // Return the paginated response with transformed data

    public function listMovies(Request $request)
    {
        $query = Movie::query();

        if ($request->has('genre') && !empty($request->query('genre'))) {
            $query->where('genre', $request->query('genre'));
        }

        if ($request->has('sort') && in_array(strtolower($request->query('sort')), ['asc', 'desc'])) {
            $query->orderBy('release_year', $request->query('sort'));
        }

        $paginator = $query->paginate(10);

        return ApiResponseService::paginated($paginator, MovieResource::class, 'Movies retrieved successfully', 200);
    }

    public function createMovie(array $data)
    {
        $movie = Movie::create($data);
        return ApiResponseService::success($movie, 'Movie created successfully', 201);
    }

    public function showMovie(int $id)
    {
        $movie = Movie::find($id);

        if (!$movie) {
            return ApiResponseService::error(null, 'Movie not found', 404);
        }

        return ApiResponseService::success(new MovieResource($movie), 'Movie retrieved successfully', 200);
    }

    // Manually validate the data against the given rules
    // If validation passes, update the movie
    public function updateMovie(int $id, array $data, array $rules)
    {
        $movie = Movie::find($id);

        if (!$movie) {
            return ApiResponseService::error(null, 'Movie not found', 404);
        }

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return ApiResponseService::error($validator->errors(), 'Validation failed', 422);
        }

        $movie->update($validator->validated());
        return ApiResponseService::success(new MovieResource($movie), 'Movie updated successfully', 200);
    }


    public function deleteMovie(int $id)
    {
        $movie = Movie::find($id);

        if (!$movie) {
            return ApiResponseService::error(null, 'Movie not found', 404);
        }

        if ($movie->delete()) {
            return ApiResponseService::success(null, 'Movie deleted successfully', 200);
        } else {
            return ApiResponseService::error(null, 'Failed to delete movie', 500);
        }
    }
}
