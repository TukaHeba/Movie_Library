<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     * @var array<string, string>
     */
    protected $fillable = [
        'title',
        'director',
        'genre',
        'release_year',
        'description',
    ];

    /**
     * The attributes that should be cast to native types.
     * @var array<string, string> 
     */
    protected $casts = [
        'release_year' => 'integer',
    ];

    /**
     * Get all ratings associated with this movie.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }
}
