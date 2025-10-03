<?php

namespace Database\Seeders;

use App\Models\Agent;
use App\Models\Client;
use App\Models\Offer;
use App\Models\Property;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OfferSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $offers = [
            ['property' => 'ул. Васил Левски 12', 'agent' => 'Иван', 'client' => 'Георги Иванов', 'signed_on' => '2025-10-10', 'price' => 118000],
            ['property' => 'ул. Приморска 45', 'agent' => 'Мария', 'client' => 'Елена Николова', 'signed_on' => '2025-10-12', 'price' => 245000],
            ['property' => 'ул. Трансмариска 10', 'agent' => 'Мария', 'client' => 'Георги Иванов', 'signed_on' => '2025-10-15', 'price' => 345000],
        ];

        foreach ($offers as $o) {
            $property = Property::where('address', $o['property'])->first();
            $agent = Agent::where('first_name', $o['agent'])->first();
            $client = Client::where('name', $o['client'])->first();

            Offer::create([
                'property_id' => $property->id,
                'agent_id' => $agent->id,
                'client_id' => $client->id,
                'signed_on' => $o['signed_on'],
                'price' => $o['price'],
            ]);
        }
    }
}
