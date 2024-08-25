<?php

namespace App\Services;

use App\Models\Movie;
use Illuminate\Http\Request;
use App\Services\ApiResponseService;
use App\Http\Resources\MovieResource;
use App\Repositories\MovieRepository;
use Illuminate\Support\Facades\Validator;

class MovieService
{
    protected $movieRepository;

    public function __construct(MovieRepository $movieRepository)
    {
        $this->movieRepository = $movieRepository;
    }

    // Extract filters and sorting parameters from the request
    // Get the paginated movies from the repository
    public function listMovies(Request $request)
    {
        $filters = $request->only(['genre']);
        $sort = $request->query('sort');

        $paginator = $this->movieRepository->getFilters($filters, $sort);

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
