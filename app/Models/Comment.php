<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['parent_id', 'name', 'body'];

    protected $with = ['comments'];

    public function comments()
    {
        return $this->hasMany(Comment::class, 'parent_id')->orderBy('created_at', 'DESC');
    }

    public function parentComment()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    public function scopeFirstLevel($query)
    {
        return $query->whereNull('parent_id')->orderBy('created_at', 'DESC');
    }
}
