<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\LaratrustUserTrait;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use HasApiTokens, HasFactory, Notifiable;


    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $withCount = ['movies'];

    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //attr ========================================================

    public function getNameAttribute($value)
    {
        return ucfirst($value);
    }

    // scope =========================================================

    public function scopeWhenSearch($query, $search)
    {
        return $query->when($search, function ($q) use ($search) {
            return $q->where('name', 'like', "%$search%");
        });

    }

    public function scopeWhereNameNot($query, $name)
    {
        return $query->whereNotIn('name', (array)$name);

    }

    //Relation =====================================================
    public function movies()
    {
        return $this->belongsToMany(Movie::class, 'user_movie');
    }
}
