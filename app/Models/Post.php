<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['subseenit_id', 'user_id', 'title', 'post_text', 'post_image', 'post_url', 'votes'];


    public function comments() {
        return $this->hasMany(Comment::class)->latest();
    }
    public function votes() {
        return $this->hasMany(PostVote::class);
    }
    public function subseenit() {
        return $this->belongsTo(Subseenit::class);
    }
    public function user() {
        return $this->belongsTo(User::class);
    }
}
