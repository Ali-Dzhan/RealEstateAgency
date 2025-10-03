<?php

namespace Database\Seeders;

use App\Models\Agent;
use App\Models\Property;
use App\Models\PropertyType;
use App\Models\Region;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $properties = [
            ['type' => 'Апартамент', 'region' => 'София', 'agent' => 'Иван', 'address' => 'ул. Васил Левски 12', 'price' => 120000, 'area' => 85.5, 'rooms' => 3, 'status' => 'available'],
            ['type' => 'Къща', 'region' => 'Варна', 'agent' => 'Мария', 'address' => 'ул. Приморска 45', 'price' => 250000, 'area' => 200, 'rooms' => 5, 'status' => 'available'],
            ['type' => 'Мезонет', 'region' => 'Русе', 'agent' => 'Мария', 'address' => 'ул. Трансмариска 10', 'price' => 350000, 'area' => 350, 'rooms' => 8, 'status' => 'available'],
            ['type' => 'Таван', 'region' => 'Бургас', 'agent' => 'Иван', 'address' => 'ул. Славейков 22', 'price' => 80000, 'area' => 35.5, 'rooms' => 1, 'status' => 'available'],
            ['type' => 'Парцел', 'region' => 'Пловдив', 'agent' => 'Иван', 'address' => 'ул. Каравелов 2', 'price' => 720000, 'area' => 485.5, 'rooms' => 10, 'status' => 'available'],
        ];

        foreach ($properties as $p) {
            $type = PropertyType::where('name', $p['type'])->first();
            $region = Region::where('name', $p['region'])->first();
            $agent = Agent::where('first_name', $p['agent'])->first();

            Property::create([
                'property_type_id' => $type->id,
                'region_id' => $region->id,
                'agent_id' => $agent->id,
                'address' => $p['address'],
                'price' => $p['price'],
                'area' => $p['area'],
                'rooms' => $p['rooms'],
                'status' => $p['status'],
            ]);
        }
    }
}
