<?php

namespace Database\Seeders;

use App\Models\Agent;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AgentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $agents = [
            ['username' => 'agent1', 'first_name' => 'Иван', 'last_name' => 'Петров', 'phone' => '+359888123456', 'email' => 'ivan.petrov@example.com'],
            ['username' => 'agent2', 'first_name' => 'Мария', 'last_name' => 'Димитрова', 'phone' => '+359888654321', 'email' => 'maria.dimitrova@example.com'],
        ];

        foreach ($agents as $a) {
            $user = User::where('username', $a['username'])->first();
            Agent::create([
                'user_id' => $user->id,
                'first_name' => $a['first_name'],
                'last_name' => $a['last_name'],
                'phone' => $a['phone'],
                'email' => $a['email'],
            ]);
        }

    }
}
