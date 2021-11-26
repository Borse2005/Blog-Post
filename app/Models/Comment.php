<?php

namespace App\Models;

use App\Scopes\DeletedAdminScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;

class Comment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'content',
        'post_id',
        'user_id'
    ];

    public function post(){
        return $this->belongsToMany(Post::class);
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
       

    public static function boot(){
        static::addGlobalScope(new DeletedAdminScope);

        parent::boot();

        Static::creating(function(Comment $comment){
            Cache::forget("blog-posts-{$comment->post_id}");
            Cache::forget("comments");
        });

    }
}
