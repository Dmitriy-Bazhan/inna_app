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
        $aliases = [1 => 'first_post', 2 => 'second_post', 3 => 'third_post', 4 => 'fourth_post'];
        foreach ($aliases as $key => $alias) {
            Post::create(
                [
                    'alias' => $alias,
                    'image_big' => 'post_' . $key . '_big_image',
                    'image_small' => 'post_' . $key . '_small_image',
                ]
            );
            PostData::create(
                [
                    'post_id' => $key,
                    'lang' => 'ua',
                    'title' => 'POST ' . $key . 'TITLE ON UA',
                    'short_description' => 'POST ' . $key . ' UKRAINIAN SHORT DESCRIPTION DESCRIPTION DESCRIPTION DESCRIPTION DESCRIPTION',
                    'content' => 'POST ' . $key . ' UKRAINIAN CONTENT CONTENT CONTENT CONTENT CONTENT CONTENT CONTENT
                    CONTENT CONTENT CONTENT CONTENT CONTENT CONTENT CONTENT CONTENT CONTENT CONTENT CONTENT CONTENT CONTENT CONTENT',
                ]
            );
            PostData::create(
                [
                    'post_id' => $key,
                    'lang' => 'ru',
                    'title' => 'POST ' . $key . 'TITLE ON RU',
                    'short_description' => 'POST ' . $key . ' RUSSIAN SHORT DESCRIPTION DESCRIPTION DESCRIPTION DESCRIPTION DESCRIPTION',
                    'content' => 'POST ' . $key . ' RUSSIAN CONTENT CONTENT CONTENT CONTENT CONTENT CONTENT CONTENT
                    CONTENT CONTENT CONTENT CONTENT CONTENT CONTENT CONTENT CONTENT CONTENT CONTENT CONTENT CONTENT CONTENT CONTENT',
                ]
            );

        }
        // \App\Models\User::factory(10)->create();
    }
}
