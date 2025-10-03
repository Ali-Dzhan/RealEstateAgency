<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clients = [
            ['username' => 'client1', 'name' => 'Георги Иванов', 'phone' => '+359887112233', 'email' => 'georgi.ivanov@example.com'],
            ['username' => 'client2', 'name' => 'Елена Николова', 'phone' => '+359887445566', 'email' => 'elena.nikolova@example.com'],
        ];

        foreach ($clients as $c) {
            $user = User::where('username', $c['username'])->first();
            Client::create([
                'user_id' => $user->id,
                'name' => $c['name'],
                'phone' => $c['phone'],
                'email' => $c['email'],
            ]);
        }
    }
}
