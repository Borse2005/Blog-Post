<?php

namespace App\Models;

use App\Trait\Taggable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Taggable;

    public const LOCALE = [
        'en' => 'English',
        'es' =>  'Spanish',
        'de' => 'German',
    ];
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'email',
        'email_verified_at',
        'created_at',
        'is_admin',
        'updated_at',
        'locale',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function post(){
        return $this->hasMany(Post::class);
    }

    public function comment(){
        return $this->hasMany(Comment::class);
    }

    public function scopeWithMostActiveUser(Builder $query){
        return $query->withCount('post')->orderBy('post_count', 'desc');
    }

    public function images(){
        return $this->morphOne(Image::class, 'imageable');
    }

    public function commentOn()
    {
        return $this->morphMany(Comment::class, 'commentable')->latest();
    }

    public function scopeMostActiveUserInLastMonth(Builder $query){
        return $query->withCount(['post' => function(Builder $query){
            return $query->whereBetween(Static::CREATED_AT, [now()->subMonth(), now()]);
        }])->has('post', '>=', 2)->orderBy('post_count','desc');
    }

   public  function scopeThatHasCommentPosted(Builder $query, Post $post){
        return $query->whereHas('comment', function($query) use($post){
            return $query->where('commentable_id', '=', $post->id)->where('commentable_type', '=', Post::class);
        });
   }

   public function scopeThatIsAdmin(Builder $query){
        return $query->where('is_admin', true);
   }
}
