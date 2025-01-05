<?php

namespace Database\Seeders;

use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Anbu Selvan',
            'email' => 'anbuceo@gmail.com',
            'role' => 'admin',
            'password' => bcrypt('123456789'),
        ]);

        User::factory()->create([
            'name' => 'Trisha',
            'email' => 'user@gmail.com',
            'role' => 'user',
            'password' => bcrypt('123456789'),
        ]);

        $this->call([
            CategorySeeder::class,
        ]);
    }
}
