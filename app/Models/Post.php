<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Category;
use App\Models\User;
use CyrildeWit\EloquentViewable\InteractsWithViews;
use CyrildeWit\EloquentViewable\Contracts\Viewable;



class Post extends Model implements Viewable
{
    use InteractsWithViews;
    use HasFactory;
    use SoftDeletes;


    protected $fillable = ['title', 'description', 'content', 
    'image', 'category_id', 'user_id'];
    public function cateogry() {
        return $this->belongsTo(Category::class);
    }

    public function tags() {
        return $this->belongsToMany(Tag::class);
    }

    public function hasTag($tagId) {
        return in_array($tagId, $this->tags->pluck('id')->toArray());
    }
    public function user() {
        return $this->belongsTo('App\Models\User');
    }
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable')->whereNull('parent_id');
    }
}
