<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SuggestionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run(): void
    {


        \DB::table('suggestions')->delete();

        \DB::table('suggestions')->insert(array(
            0 =>
                array(
                    'id' => 1,
                    'title' => 'React JS - Beginner to Master',
                    'slug' => 'react-js-beginner-to-master',
                    'technology' => 'React',
                    'tags' => '["react"," javascript"," dom"]',
                    'desc' => 'Learn about reactjs fundamentals with practical projects',
                    'show_roadmap' => 1,
                    'is_featured' => 1,
                    'user_id' => 1,
                    'status' => 'planned',
                    'created_at' => '2025-07-13 12:55:48',
                    'updated_at' => '2025-07-13 12:55:48',
                ),
            1 =>
                array(
                    'id' => 2,
                    'title' => 'Learn TailwindCSS - Build UI Practically!',
                    'slug' => 'learn-tailwindcss-build-ui-practically',
                    'technology' => 'Tailwind CSS',
                    'tags' => '["tailwindcss"," frontend"," css"]',
                    'desc' => 'Learn about tailwindcss in detail with practical projects!',
                    'show_roadmap' => 1,
                    'is_featured' => 1,
                    'user_id' => 1,
                    'status' => 'considering',
                    'created_at' => '2025-07-13 13:01:05',
                    'updated_at' => '2025-07-13 13:01:05',
                ),
        ));


    }
}
