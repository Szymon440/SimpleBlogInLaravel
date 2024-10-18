<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->count(10)->create()->each(function ($user) {
            $user->posts()->saveMany(Post::factory()->count(3)->make());
            Role::create([
                'user_id' => $user->id,
                'name' => 'user',
            ]);
        });

        $admin = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('secret'),
        ]);

        Role::create([
            'user_id' => $admin->id,
            'name' => 'admin',
        ]);
    }
}
