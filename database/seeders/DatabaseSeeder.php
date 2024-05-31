<?php

namespace Database\Seeders;

use App\Models\Room_type;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'name' => 'Admin',
            'address' => 'pwt',
            'phone' => '083156437871',
            'role' => 1,
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin394'),
        ]);

        for($i=0; $i<100; $i++){
            User::create([
                'name' => 'Guest' . $i,
                'address' => 'pwt',
                'phone' => '08' . $i,
                'role' => 2,
                'gender' => 'L',
                'email' => 'guest' . $i . '@gmail.com',
                'password' => Hash::make('guest' . $i),
            ]);
        }
}
}