<?php

namespace App\Models;

use App\Scopes\LatestScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

class BlogPost extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title',
        'content',
        'user_id'
    ];

    public static function boot()
    {
        parent::boot();

        //static::addGlobalScope(new LatestScope);

        static::deleting(function (BlogPost $blogPost){
            $blogPost->comments()->delete();
        });

        static::restoring(function (BlogPost $blogPost){
            $blogPost->comments()->restore();
        });
    }

    public function scopeMydesc(Builder $query)
    {
        return $query->orderBy(model::CREATED_AT, 'desc');
    }

    public function scopeMostpopular(Builder $query)
    {
        //comments_count
        return $query->withCount('comments')->orderBy('comments_count', 'desc');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->mydesc();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
