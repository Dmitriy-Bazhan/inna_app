<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\CategoryData;
use App\Models\Post;
use App\Models\PostData;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Dima',
            'email' => 'dimka@gmail.com',
            'role' => '2',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'name' => 'Inna',
            'email' => 'inna@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'name' => 'new',
            'email' => 'new@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'name' => 'test',
            'email' => 'test@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ]);


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

        $categories = ['Одежда', 'Обувь', 'Фурнитура'];
        $insideCategories = ['Мужская', 'Женская', 'Детская'];

        foreach ($categories as $category) {
            $newCategory = Category::create([
                'alias' => Str::slug($category, '-'),
            ]);

            $id = $newCategory->id;

            CategoryData::create([
                'category_id' => $id,
                'lang' => 'ua',
                'title' => $category . ' ON UA',
                'short_description' => 'short_description of ' . $category . ' ON UA',
                'description' => 'description of category ' . $category . ' ON UA',
            ]);

            CategoryData::create([
                'category_id' => $id,
                'lang' => 'ru',
                'title' => $category . ' ON RU',
                'short_description' => 'short_description of ' . $category . ' ON RU',
                'description' => 'description of category ' . $category . ' ON RU',
            ]);
        }

        foreach ($insideCategories as $insideCategory) {
            foreach ($categories as $key => $category) {
                $newCategory = Category::create([
                    'alias' => Str::slug($insideCategory . ' ' . $category, '-'),
                    'parent_id' => ++$key,
                ]);

                $id = $newCategory->id;

                CategoryData::create([
                    'category_id' => $id,
                    'lang' => 'ua',
                    'title' => $insideCategory . ' ' . $category . ' ON UA',
                    'short_description' => 'short_description of ' . $insideCategory . ' ' . $category . ' ON UA',
                    'description' => 'description of category ' . $insideCategory . ' ' . $category . ' ON UA',
                ]);

                CategoryData::create([
                    'category_id' => $id,
                    'lang' => 'ru',
                    'title' => $insideCategory . ' ' . $category . ' ON RU',
                    'short_description' => 'short_description of ' . $insideCategory . ' ' . $category . ' ON RU',
                    'description' => 'description of category ' . $insideCategory . ' ' . $category . ' ON RU',
                ]);

            }
        }

        $this->call([
            ProductSeeder::class
        ]);


        // \App\Models\User::factory(10)->create();
    }
}
