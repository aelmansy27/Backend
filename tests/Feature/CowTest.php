<?php

namespace Tests\Feature;

use App\Models\ActivityPlace;
use App\Models\ActivitySystem;
use App\Models\BreadingSystem;
use App\Models\Cow;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class CowTest extends TestCase
{
    use RefreshDatabase;

    private User $user;
    private User $doctor;
    protected function setUp(): void
    {
        parent::setUp();

        $this->user=$this->createUser();
        $this->doctor=$this->createUser(isDoctor: true);
    }

    public function test_cow_page_contains_data_of_cow()
    {
        // Create test data for a single cow with associated activity place, activity system, and breading system
        $activityPlace = ActivityPlace::factory()->create();
        $activitySystem = ActivitySystem::factory()->create();
        $breadingSystem = BreadingSystem::factory()->create();

        $cow = Cow::factory()->create([
            'activityplace_id' => $activityPlace->id,
            'activitysystem_id' => $activitySystem->id,
            'breadingsystem_id' => $breadingSystem->id,
        ]);

        // Send a request to the /api/cows endpoint
        $response = $this->actingAs($this->user)->getJson('/api/cows');

        $response->assertStatus(200);

        $responseData = json_decode($response->content(), true); // Decode JSON response
        $response->assertJsonFragment($responseData); // Assert specific data fragments
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
     */
   private function createUser(bool $isDoctor= false): User
    {
        return User::factory()->create([
            'is_doctor'=>$isDoctor
        ]);

    }
}
