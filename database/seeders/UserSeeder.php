<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Favour',
            'email' => 'admin@favour.biz',
            'password' => Hash::make('password'),
            'role' => 'ADMIN',
            'email_verified_at' => now()
        ]);
    }
}
