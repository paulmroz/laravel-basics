<?php

namespace App;

use Carbon\Carbon;

class Post extends Model
{
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function addComment($body)
    {
        //Two methods to create the comment
        //$this->comments()->create(compact('body'));
        Comment::create([

            'body'=>$body,
            'post_id'=> $this->id,
            'user_id'=> auth()->id()

        ]);
    }

    public function scopeFilter($query, $filters)
    {
        if ($month = $filters['month']) {
            $query->whereMonth('created_at', Carbon::parse($month)->month);
        }

        if ($year = $filters['year']) {
            $query->whereYear('created_at', $year);
        }
    }


    public static function archives()
    {
        return static::selectRaw('year(created_at)as year, monthname(created_at)as month, COUNT(*) published')
                        ->groupBy('year', 'month')
                        ->orderByRaw('min(created_at) desc')
                        ->get()
                        ->toArray();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
