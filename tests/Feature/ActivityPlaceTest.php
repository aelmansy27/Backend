<?php

namespace Tests\Feature;

use App\Models\ActivityPlace;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ActivityPlaceTest extends TestCase
{
    use RefreshDatabase;
    private User $user;
    protected function setUp(): void
    {
        parent::setUp();

        $this->user=$this->createUser();
        $this->doctor=$this->createUser(isDoctor: true);
    }

    public function test_user_can_see_all_activity_places(): void
    {
        $activityPlaces=ActivityPlace::factory()->create();

        $response = $this->actingAs($this->user)->getJson('/api/activity_places');

        $response->assertStatus(200);
    }

    private function createUser(bool $isDoctor= false): User
    {
        return User::factory()->create([
            'is_doctor'=>$isDoctor
        ]);

    }
}
