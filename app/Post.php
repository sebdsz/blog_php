<?php

namespace App;

use Auth;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title', 'content', 'category_id', 'status', 'published_at', 'user_id'
    ];

    protected $dates = ['published_at'];

    /**
     * @param int $length
     * @return string
     */
    public function excerpt($length = 25)
    {
        return Str::words($this->content, $length);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {

        return $this->belongsTo('App\User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }

    public function picture()
    {

        return $this->hasOne('App\Picture');
    }

    public function scores()
    {
        return $this->hasMany('App\Score');
    }

    public function averageScore()
    {
        $scores = $this->scores;
        if (count($scores) !== 0) {
            $total = 0;
            foreach ($scores as $score) $total += $score->score;
            $nb = count($scores);
            $total = ceil($total / $nb);

            return $total;

        } else

            return null;

    }

    public function scopePublished($query)
    {
        return $query->where('status', '=', 'published');
    }

    public function scopeCategory($query, $id)
    {
        return $query->where('category_id', '=', $id);
    }

    public function date()
    {
        return $this->published_at->formatLocalized('%A %d %B %Y à %Hh%M');
    }

    public function setCategoryIdAttribute($value)
    {
        $this->attributes['category_id'] = ($value == 0) ? NULL : $value;
    }

    public function setUserIdAttribute()
    {
        $this->user_id = Auth::user()->id;
    }

    public function hasTag($id)
    {
        if (is_null($this->tags)) return false;

        foreach ($this->tags as $tag)
            if ($tag->id === $id) return true;


        return false;
    }
}
