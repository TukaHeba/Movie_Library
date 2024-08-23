<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     * @var array<int, string>.
     */
    protected $fillable = [
        'user_id',
        'movie_id',
        'rating',
        'review',
    ];

    /**
     * The attributes that should be cast to native types.
     * @var array<string, string>.
     */
    protected $casts = [
        'rating' => 'integer',
    ];

    /**
     * Get the user that owns the rating.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     *Get the movie that the rating is for.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }
}
