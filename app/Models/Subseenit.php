<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subseenit extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = ['user_id', 'name', 'description', 'slug'];

    public function posts() {
        return $this->hasMany(Post::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}
