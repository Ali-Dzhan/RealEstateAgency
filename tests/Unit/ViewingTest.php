<?php

namespace Tests\Unit;

use App\Models\Viewing;
use App\Models\Property;
use App\Models\PropertyType;
use App\Models\Region;
use App\Models\Agent;
use App\Models\Client;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ViewingTest extends TestCase
{
    use RefreshDatabase;

    public function test_viewing_can_be_created_with_valid_data(): void
    {
        $agentUser = User::create([
            'username' => 'agent1',
            'email' => 'agent1@example.com',
            'password' => bcrypt('password'),
            'role' => 'agent',
        ]);

        $clientUser = User::create([
            'username' => 'client1',
            'email' => 'client1@example.com',
            'password' => bcrypt('password'),
            'role' => 'client',
        ]);

        $agent = Agent::create([
            'user_id' => $agentUser->id,
            'first_name' => 'John',
            'last_name' => 'Agent',
            'email' => 'agent1@example.com',
            'phone' => '1234567890',
        ]);

        $client = Client::create([
            'user_id' => $clientUser->id,
            'name' => 'Jane Client',
            'email' => 'client1@example.com',
            'phone' => '0987654321',
        ]);

        $propertyType = PropertyType::create(['name' => 'House']);
        $region = Region::create(['name' => 'Downtown']);

        $property = Property::create([
            'address' => '123 Test Street',
            'price' => 200000,
            'area' => 100.0,
            'rooms' => 3,
            'property_type_id' => $propertyType->id,
            'region_id' => $region->id,
            'agent_id' => $agent->id,
            'status' => 'available',
        ]);

        $viewing = Viewing::create([
            'property_id' => $property->id,
            'agent_id' => $agent->id,
            'client_id' => $client->id,
            'scheduled_on' => now()->addDays(1),
            'status' => 'pending',
        ]);

        $this->assertDatabaseHas('viewings', [
            'property_id' => $property->id,
            'agent_id' => $agent->id,
            'client_id' => $client->id,
            'status' => 'pending',
        ]);

        $this->assertInstanceOf(Viewing::class, $viewing);
    }

    public function test_viewing_belongs_to_property_agent_and_client(): void
    {
        $agentUser = User::create([
            'username' => 'agent2',
            'email' => 'agent2@example.com',
            'password' => bcrypt('password'),
            'role' => 'agent',
        ]);

        $clientUser = User::create([
            'username' => 'client2',
            'email' => 'client2@example.com',
            'password' => bcrypt('password'),
            'role' => 'client',
        ]);

        $agent = Agent::create([
            'user_id' => $agentUser->id,
            'first_name' => 'Bob',
            'last_name' => 'Smith',
            'email' => 'agent2@example.com',
            'phone' => '1112223333',
        ]);

        $client = Client::create([
            'user_id' => $clientUser->id,
            'name' => 'Alice Johnson',
            'email' => 'client2@example.com',
            'phone' => '4445556666',
        ]);

        $propertyType = PropertyType::create(['name' => 'Apartment']);
        $region = Region::create(['name' => 'Uptown']);

        $property = Property::create([
            'address' => '456 Test Avenue',
            'price' => 150000,
            'area' => 80.0,
            'rooms' => 2,
            'property_type_id' => $propertyType->id,
            'region_id' => $region->id,
            'agent_id' => $agent->id,
            'status' => 'available',
        ]);

        $viewing = Viewing::create([
            'property_id' => $property->id,
            'agent_id' => $agent->id,
            'client_id' => $client->id,
            'scheduled_on' => now()->addDays(2),
            'status' => 'pending',
        ]);

        $this->assertEquals('456 Test Avenue', $viewing->property->address);
        $this->assertEquals('Bob', $viewing->agent->first_name);
        $this->assertEquals('Alice Johnson', $viewing->client->name);
    }

    public function test_viewing_status_helpers_work_correctly(): void
    {
        $agentUser = User::create([
            'username' => 'agent3',
            'email' => 'agent3@example.com',
            'password' => bcrypt('password'),
            'role' => 'agent',
        ]);

        $clientUser = User::create([
            'username' => 'client3',
            'email' => 'client3@example.com',
            'password' => bcrypt('password'),
            'role' => 'client',
        ]);

        $agent = Agent::create([
            'user_id' => $agentUser->id,
            'first_name' => 'Test',
            'last_name' => 'Agent',
            'email' => 'agent3@example.com',
            'phone' => '7778889999',
        ]);

        $client = Client::create([
            'user_id' => $clientUser->id,
            'name' => 'Test Client',
            'email' => 'client3@example.com',
            'phone' => '0001112222',
        ]);

        $propertyType = PropertyType::create(['name' => 'Condo']);
        $region = Region::create(['name' => 'Midtown']);

        $property = Property::create([
            'address' => '789 Test Boulevard',
            'price' => 180000,
            'area' => 90.0,
            'rooms' => 2,
            'property_type_id' => $propertyType->id,
            'region_id' => $region->id,
            'agent_id' => $agent->id,
            'status' => 'available',
        ]);

        $pendingViewing = Viewing::create([
            'property_id' => $property->id,
            'agent_id' => $agent->id,
            'client_id' => $client->id,
            'scheduled_on' => now()->addDays(1),
            'status' => 'pending',
        ]);

        $completedViewing = Viewing::create([
            'property_id' => $property->id,
            'agent_id' => $agent->id,
            'client_id' => $client->id,
            'scheduled_on' => now()->subDays(1),
            'status' => 'completed',
        ]);

        $this->assertTrue($pendingViewing->isPending());
        $this->assertFalse($pendingViewing->isCompleted());

        $this->assertTrue($completedViewing->isCompleted());
        $this->assertFalse($completedViewing->isPending());
    }

    public function test_viewing_can_store_review_and_rating(): void
    {
        $agentUser = User::create([
            'username' => 'agent4',
            'email' => 'agent4@example.com',
            'password' => bcrypt('password'),
            'role' => 'agent',
        ]);

        $clientUser = User::create([
            'username' => 'client4',
            'email' => 'client4@example.com',
            'password' => bcrypt('password'),
            'role' => 'client',
        ]);

        $agent = Agent::create([
            'user_id' => $agentUser->id,
            'first_name' => 'Review',
            'last_name' => 'Agent',
            'email' => 'agent4@example.com',
            'phone' => '3334445555',
        ]);

        $client = Client::create([
            'user_id' => $clientUser->id,
            'name' => 'Review Client',
            'email' => 'client4@example.com',
            'phone' => '6667778888',
        ]);

        $propertyType = PropertyType::create(['name' => 'Townhouse']);
        $region = Region::create(['name' => 'Suburbs']);

        $property = Property::create([
            'address' => '321 Review Street',
            'price' => 220000,
            'area' => 110.0,
            'rooms' => 3,
            'property_type_id' => $propertyType->id,
            'region_id' => $region->id,
            'agent_id' => $agent->id,
            'status' => 'available',
        ]);

        $viewing = Viewing::create([
            'property_id' => $property->id,
            'agent_id' => $agent->id,
            'client_id' => $client->id,
            'scheduled_on' => now()->subDays(1),
            'status' => 'completed',
            'client_review' => 'Great property and excellent service!',
            'rating' => 5,
            'agent_notes' => 'Client very interested, potential buyer.',
        ]);

        $this->assertEquals('Great property and excellent service!', $viewing->client_review);
        $this->assertEquals(5, $viewing->rating);
        $this->assertEquals('Client very interested, potential buyer.', $viewing->agent_notes);
    }
}
