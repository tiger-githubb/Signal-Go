<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
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
        $defaultCategory = Category::where('default', true)->first();

        $categories = Category::factory(1)->create();
    
        User::factory(2)->create()->each(function ($user) use ($categories, $defaultCategory) {
            Post::factory(1)->create([
                'user_id' => $user->id,
                'category_id' => ($categories->random())->id
            ])->each(function ($post) use ($defaultCategory) {
                if (!$post->category()->exists()) {
                    $post->category()->associate($defaultCategory)->save();
                }
            });
        });
    }
}
