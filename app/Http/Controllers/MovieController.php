<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use App\Services\ApiResponseService;
use App\Http\Resources\MovieResource;
use App\Http\Requests\StoreMovieRequest;
use App\Http\Requests\UpdateMovieRequest;
use App\Services\MovieService;

class MovieController extends Controller
{
    /**
     * MovieService instance.
     * @var MovieService
     */    
    protected $movieService;

    /**
     * Inject MovieService dependency into the controller.
     * @param MovieService $movieService
     */
    public function __construct(MovieService $movieService)
    {
        $this->movieService = $movieService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return $this->movieService->listMovies($request);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMovieRequest $request)
    {
        $validated = $request->validated();

        return $this->movieService->createMovie($validated);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return $this->movieService->showMovie($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMovieRequest $request, $id)
    {
        return $this->movieService->updateMovie($id, $request->all(), $request->rules());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        return $this->movieService->deleteMovie($id);
    }
}
