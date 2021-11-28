<?php

namespace App\Models;

use App\Scopes\DeletedAdminScope;
use App\Trait\Taggable as TraitsTaggable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;

class Comment extends Model
{
    use HasFactory;
    use SoftDeletes;
    use TraitsTaggable;

    protected $fillable = [
        'content',
        'user_id'
    ];

    public function commentable(){
        return $this->morphTo();
    }   

    public function user(){
        return $this->belongsTo(User::class);
    }
    

    public function scopeLatest(Builder $query){
        return $query->addGlobalScope(Static::CREATED_AT, 'desc');
    }

    public function scopeMostCommented(Builder $query){
        return $query->withCount('comment')->orderBy('comment_count', 'desc');
    }
       
    // public function tags()
    // {
    //     return $this->morphToMany(Tag::class, 'taggable');
    // }
    
    public static function boot(){
        static::addGlobalScope(new DeletedAdminScope);

        parent::boot();

        Static::creating(function(Comment $comment){
           
            if ($comment->commentable_type === Post::class) {
                Cache::forget("blog-posts-{$comment->commentable_id}");
                Cache::forget("comments");
            }
        });

    }
}
