<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['parent_id', 'name', 'body'];

    public function comments()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }
}
