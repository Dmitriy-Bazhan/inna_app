<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\PostData;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Post::create(['alias' => 'first_post']);
        Post::create(['alias' => 'second_post']);
        Post::create(['alias' => 'third_post']);

        $posts = Post::all();

        foreach ($posts as $post) {
            PostData::create(
                [
                    'post_id' => $post->id,
                    'lang' => 'ua',
                    'title' => 'POST ' . $post->id . 'TITLE ON UA',
                    'content' => 'POST ' . $post->id . ' UKRAINIAN CONTENT UKRAINIAN CONTENT UKRAINIAN CONTENT',
                ]
            );

            PostData::create(
                [
                    'post_id' => $post->id,
                    'lang' => 'ru',
                    'title' => 'POST ' . $post->id . 'TITLE ON RU',
                    'content' => 'POST ' . $post->id . ' RUSSIAN CONTENT RUSSIAN CONTENT RUSSIAN CONTENT RUSSIAN CONTENT',
                ]
            );
        }

        // \App\Models\User::factory(10)->create();
    }
}
