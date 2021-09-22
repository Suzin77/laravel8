<?php

namespace App\Models;

use App\Scopes\LatestScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $fillable = [
        'content'
    ];

    public static function boot()
    {
        parent::boot();

        //static::addGlobalScope(new LatestScope);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeMydesc(Builder $query)
    {
        return $query->orderBy(model::CREATED_AT, 'desc');
    }

    public function blogPost()
    {
        return $this->belongsTo(BlogPost::class);
    }
}
