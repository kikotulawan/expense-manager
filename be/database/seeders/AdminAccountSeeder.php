<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Ezikiel Tulawan',
            'email' => 'ezikiel@admin.com',
            'password' => 'admin',
            'role_id' => 1, //Administrator Role ID
        ]);
    }
}
