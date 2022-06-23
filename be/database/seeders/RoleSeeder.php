<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'role' => 'Administrator',
            'description' => 'This role has the abilities to manage and create expense categories and users` accounts/expenses'
        ]);

        Role::create([
            'role' => 'User',
            'description' => 'This role has the abilities to manage and create their expenses'
        ]);
    }
}
