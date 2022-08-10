<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Movie extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $appends = ['image_path', 'poster_path', 'is_favorite'];

    //attribute ===========================================================

    public function getImagePathAttribute()
    {
        return Storage::url('images/' . $this->image);
    }

    public function getPosterPathAttribute()
    {
        return Storage::url('images/' . $this->poster);
    }

    public function getIsFavoriteAttribute()
    {
        if (auth()->user()) {
            return (bool)$this->users()->where('user_id', auth()->user()->id)->count();
        }
        return false;
    }

    // relations ===========================================================

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'movie_category');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_movie');
    }

    //scope  =================================================================

    public function scopeWhenSearch($query, $search)
    {
        return $query->when($search, function ($q) use ($search) {
            return $q->where('name', 'like', "%$search%")
                ->orWhere('description', 'like', "%$search%")
                ->orWhere('year', 'like', "%$search%")
                ->orWhere('rating', 'like', "%$search%");
        });

    }

    public function scopeWhenCategory($query, $category)
    {
        return $query->when($category, function ($q) use ($category) {
            return $q->whereHas('categories', function ($qu) use ($category) {
                return $qu->whereIn('category_id', (array)$category)
                    ->orWhere('name', (array)$category);
            });
        });
    }

    public function scopeWhenFavorite($query, $favorite)
    {
        return $query->when($favorite, function ($q) use ($favorite) {
            return $q->whereHas('users', function ($qu) use ($favorite) {
                return $qu->where('user_id', auth()->user()->id);

            });
        });
    }
}
