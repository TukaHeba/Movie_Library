<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use App\Services\ApiResponseService;
use App\Http\Requests\StoreMovieRequest;
use App\Http\Requests\UpdateMovieRequest;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $movies = Movie::paginate(2);
        return ApiResponseService::paginated($movies, 'Movies retrieved successfully', 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMovieRequest $request)
    {
        $validated = $request->validated();

        $movie = Movie::create($validated);
        return ApiResponseService::success($movie, 'Movie created successfully', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $movie = Movie::find($id);
        if (!$movie) {
            return ApiResponseService::error(null, 'Movie not found', 404);
        }
        return ApiResponseService::success($movie, 'Movie retrieved successfully', 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMovieRequest $request, $id)
    {
        $movie = Movie::find($id);
        if (!$movie) {
            return ApiResponseService::error(null, 'Movie not found', 404);
        }

        $validated = $request->validated();

        $movie->update($validated);
        return ApiResponseService::success($movie, 'Movie updated successfully', 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $movie = Movie::find($id);
        if (!$movie) {
            return ApiResponseService::error(null, 'Movie not found', 404);
        }

        $movie->delete();
        return ApiResponseService::success(null, 'Movie deleted successfully', 200);
    }
}
