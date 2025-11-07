<?php

namespace Tests\Unit;

use App\Models\Property;
use App\Models\PropertyType;
use App\Models\Region;
use App\Models\Agent;
use App\Models\Client;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PropertyTest extends TestCase
{
    use RefreshDatabase;

    public function test_property_can_be_created_with_valid_data(): void
    {
        $user = User::create([
            'username' => 'user1',
            'email' => 'user@example.com',
            'password' => bcrypt('password'),
            'role' => 'agent',
        ]);

        $propertyType = PropertyType::create(['name' => 'House']);
        $region = Region::create(['name' => 'Central District']);
        $agent = Agent::create([
            'user_id' => $user->id,
            'first_name' => 'Agent',
            'last_name' => 'Smith',
            'email' => 'agent@example.com',
            'phone' => '1234567890',
        ]);

        $property = Property::create([
            'address' => '123 Main Street',
            'price' => 250000,
            'area' => 120.5,
            'rooms' => 3,
            'property_type_id' => $propertyType->id,
            'region_id' => $region->id,
            'agent_id' => $agent->id,
            'status' => 'available',
        ]);

        $this->assertDatabaseHas('properties', [
            'address' => '123 Main Street',
            'price' => 250000,
            'status' => 'available',
        ]);

        $this->assertInstanceOf(Property::class, $property);
        $this->assertEquals('123 Main Street', $property->address);
    }

    public function test_property_belongs_to_property_type_region_and_agent(): void
    {
        $user = User::create([
            'username' => 'user2',
            'email' => 'user2@example.com',
            'password' => bcrypt('password'),
            'role' => 'agent',
        ]);

        $propertyType = PropertyType::create(['name' => 'Apartment']);
        $region = Region::create(['name' => 'Downtown']);
        $agent = Agent::create([
            'user_id' => $user->id,
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john@example.com',
            'phone' => '9876543210',
        ]);

        $property = Property::create([
            'address' => '456 Oak Avenue',
            'price' => 180000,
            'area' => 85.0,
            'rooms' => 2,
            'property_type_id' => $propertyType->id,
            'region_id' => $region->id,
            'agent_id' => $agent->id,
            'status' => 'available',
        ]);

        $this->assertEquals('Apartment', $property->type->name);
        $this->assertEquals('Downtown', $property->region->name);
        $this->assertEquals('John', $property->agent->first_name);
        $this->assertEquals('Doe', $property->agent->last_name);
    }

    public function test_property_can_have_multiple_viewings(): void
    {
        $user = User::create([
            'username' => 'user3',
            'email' => 'user3@example.com',
            'password' => bcrypt('password'),
            'role' => 'agent',
        ]);

        $propertyType = PropertyType::create(['name' => 'Villa']);
        $region = Region::create(['name' => 'Suburbs']);
        $agent = Agent::create([
            'user_id' => $user->id,
            'first_name' => 'Agent',
            'last_name' => 'Brown',
            'email' => 'brown@example.com',
            'phone' => '5551234567',
        ]);

        $property = Property::create([
            'address' => '789 Elm Street',
            'price' => 350000,
            'area' => 200.0,
            'rooms' => 5,
            'property_type_id' => $propertyType->id,
            'region_id' => $region->id,
            'agent_id' => $agent->id,
            'status' => 'available',
        ]);

        // Create users for clients
        $clientUser1 = User::create([
            'username' => 'client1',
            'email' => 'client1@example.com',
            'password' => bcrypt('password'),
            'role' => 'client',
        ]);

        $clientUser2 = User::create([
            'username' => 'client2',
            'email' => 'client2@example.com',
            'password' => bcrypt('password'),
            'role' => 'client',
        ]);

        // Create clients with user_id
        $client1 = Client::create([
            'user_id' => $clientUser1->id,
            'name' => 'John Doe',
            'email' => 'client1@example.com',
            'phone' => '1112223333',
        ]);

        $client2 = Client::create([
            'user_id' => $clientUser2->id,
            'name' => 'Jane Doe',
            'email' => 'client2@example.com',
            'phone' => '4445556666',
        ]);

        $property->viewings()->create([
            'client_id' => $client1->id,
            'agent_id' => $agent->id,
            'scheduled_on' => now()->addDays(1),
            'status' => 'pending',
        ]);

        $property->viewings()->create([
            'client_id' => $client2->id,
            'agent_id' => $agent->id,
            'scheduled_on' => now()->addDays(2),
            'status' => 'completed',
        ]);

        $this->assertCount(2, $property->viewings);
    }
}
