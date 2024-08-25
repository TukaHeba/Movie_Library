<?php

namespace App\Repositories;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieRepository
{
    /**
     * Get the filtered and sorted list of movies.
     * Apply filtering and sorting by release_year, then apply pagination
     * 
     * @param array $filters
     * @param string|null $sort
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getFilters(array $filters = [], ?string $sort = null)
    {
        $query = Movie::query();

        if (!empty($filters['genre'])) {
            $query->where('genre', $filters['genre']);
        }

        if (in_array(strtolower($sort), ['asc', 'desc'])) {
            $query->orderBy('release_year', $sort);
        }

        return $query->paginate(10);
    }
}
