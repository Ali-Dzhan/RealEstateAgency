<?php

namespace Database\Seeders;

use App\Models\Agent;
use App\Models\Client;
use App\Models\Property;
use App\Models\Viewing;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ViewingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $viewings = [
            ['property' => 'ул. Васил Левски 12', 'agent' => 'Иван', 'client' => 'Георги Иванов', 'scheduled_on' => '2025-10-05 10:00:00', 'result' => 'Интерес проявен'],
            ['property' => 'ул. Приморска 45', 'agent' => 'Мария', 'client' => 'Елена Николова', 'scheduled_on' => '2025-10-06 14:00:00', 'result' => 'Не се интересува'],
            ['property' => 'ул. Трансмариска 10', 'agent' => 'Мария', 'client' => 'Георги Иванов', 'scheduled_on' => '2025-10-07 09:00:00', 'result' => 'Обмисля покупка'],
            ['property' => 'ул. Славейков 22', 'agent' => 'Иван', 'client' => 'Елена Николова', 'scheduled_on' => '2025-10-08 16:00:00', 'result' => 'Отказ'],
            ['property' => 'ул. Каравелов 2', 'agent' => 'Иван', 'client' => 'Георги Иванов', 'scheduled_on' => '2025-10-09 11:00:00', 'result' => 'Интерес проявен'],
        ];

        foreach ($viewings as $v) {
            $property = Property::where('address', $v['property'])->first();
            $agent = Agent::where('first_name', $v['agent'])->first();
            $client = Client::where('name', $v['client'])->first();

            Viewing::create([
                'property_id' => $property->id,
                'agent_id' => $agent->id,
                'client_id' => $client->id,
                'scheduled_on' => $v['scheduled_on'],
                'result' => $v['result'],
            ]);
        }
    }
}
