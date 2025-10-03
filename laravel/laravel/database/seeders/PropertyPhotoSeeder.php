<?php

namespace Database\Seeders;

use App\Models\Property;
use App\Models\PropertyPhoto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PropertyPhotoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $property_photos = [
            ['property_id' => 1, 'path' => 'laravel/laravel/public/images/apartment.png'],
            ['property_id' => 2, 'path' => 'laravel/laravel/public/images/house.png'],
            ['property_id' => 3, 'path' => 'laravel/laravel/public/images/maisonette.jpg'],
            ['property_id' => 4, 'path' => 'laravel/laravel/public/images/attic.jpg'],
            ['property_id' => 5, 'path' => 'laravel/laravel/public/images/land.jpg'],
        ];

        foreach ($property_photos as $property_photo) {
            PropertyPhoto::create([
                'property_id' => $property_photo['property_id'],
                'path' => $property_photo['path'],
            ]);
        }
    }
}
