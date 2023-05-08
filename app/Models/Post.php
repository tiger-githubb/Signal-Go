<?php

namespace App\Models;

use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;
    use Sluggable;

    protected $guarded = [];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public static function boot()
    {
        parent::boot();

        self::creating(function ($post) {
            $post->user()->associate(auth()->user()->id);
            $post->category()->associate(request()->category);
        });

        self::updating(function ($post) {
            $post->category()->associate(request()->category);
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // str title : first word in Maj
    public function getTitleAttribute($attribute)
    {
        return Str::title($attribute);
    }

    // str content : reduce text to 115 caracter
    //public function getContentAttribute($attribute)
    //{
    //return Str::limit($attribute, 115, '...');
    //}
}
