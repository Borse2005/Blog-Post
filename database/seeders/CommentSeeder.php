<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        $posts = Post::all();
        $users = User::all();
        $user = User::count();
        $comments = max((int)$this->command->ask('How many comments would you like?', 20), 1);
        $post = $comments / 2;
        $poster = $post - $user;

        Comment::factory($comments)->make()->each(function($comment) use($users, $posts) {
            $comment->commentable_id = $posts->random()->id;
            $comment->commentable_type = 'App\Models\Post';
            $comment->user_id = $users->random()->id;
            $comment->save();
        });

        Comment::factory($poster)->make()->each(function($comment) use($users, $posts) {
            $comment->commentable_id = $users->random()->id;
            $comment->commentable_type = 'App\Models\User';
            $comment->user_id = $users->random()->id;
            $comment->save();
        });
    }
}
