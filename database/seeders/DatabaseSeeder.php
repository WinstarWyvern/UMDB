<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create(
            [
                'name' => 'tono',
                'email' => 'tono@gmail.com',
                'email_verified_at' => now(),
                // 'gender' => 'Male',
                // 'country' => 'Indonesia',
                // 'dateofbirth' => '2001-01-01',
                'isAdmin' => false,
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            ]
        );
        // \App\Models\User::factory(10)->create();
    }
}
