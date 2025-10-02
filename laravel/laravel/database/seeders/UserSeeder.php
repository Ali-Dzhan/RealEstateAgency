<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            ['username' => 'admin1', 'password' => bcrypt('adminpass'), 'role' => 'admin'],
            ['username' => 'agent1', 'password' => bcrypt('agentpass'), 'role' => 'agent'],
            ['username' => 'agent2', 'password' => bcrypt('agentpass'), 'role' => 'agent'],
            ['username' => 'client1', 'password' => bcrypt('clientpass'), 'role' => 'client'],
            ['username' => 'client2', 'password' => bcrypt('clientpass'), 'role' => 'client'],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
