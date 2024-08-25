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
    /**
     * MovieRepository instance.
     * @var MovieRepository
     */
    protected $movieRepository;

    /**
     * Constructor to inject MovieRepository dependency.
     * @param MovieRepository $movieRepository
     */
    public function __construct(MovieRepository $movieRepository)
    {
        $this->movieRepository = $movieRepository;
    }

    /**
     * Extract filters and sorting parameters from the request
     * Get the paginated movies from the repository

     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function listMovies(Request $request)
    {
        $filters = $request->only(['genre']);
        $sort = $request->query('sort');

        $paginator = $this->movieRepository->getFilters($filters, $sort);

        return ApiResponseService::paginated($paginator, MovieResource::class, 'Movies retrieved successfully', 200);
    }

    /**
     * Create a new movie and store it in the database.
     * @param array $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function createMovie(array $data)
    {
        $movie = Movie::create($data);
        return ApiResponseService::success($movie, 'Movie created successfully', 201);
    }

    /**
     * Show the details of a specific movie by ID.
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function showMovie(int $id)
    {
        $movie = Movie::find($id);

        if (!$movie) {
            return ApiResponseService::error(null, 'Movie not found', 404);
        }

        return ApiResponseService::success(new MovieResource($movie), 'Movie retrieved successfully', 200);
    }

    /**
     * Update the specified movie's information.
     * 
     * Manually validate the data against the given rules
     * If validation passes, update the movie

     * @param int $id
     * @param array $data
     * @param array $rules
     * @return \Illuminate\Http\JsonResponse
     */
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


    /**
     * Delete a specified movie by ID.
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
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
