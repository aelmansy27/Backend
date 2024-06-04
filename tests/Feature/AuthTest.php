<?php

namespace Tests\Feature;

use App\Models\Cow;
use App\Models\Treatment;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;
    public function test_unauthenticated_user_cannot_login_to_system(): void
    {
        $response = $this->getJson('/api/cows');

        $response->assertStatus(401);
    }

    public function test_authenticated_user_cannot_access_treatments(): void
    {
        $user = User::factory()->create(['is_doctor' => 0]);
        $this->actingAs($user);


        $cow = Cow::factory()->create();
        Treatment::factory()->create();
        $response = $this->getJson("/api/cow/{$cow->id}/treatments/all");

        $response->assertStatus(403);
    }

    public function test_authenticated_doctor_can_login_to_doctor_view(): void
    {
        $user = User::factory()->create(['is_doctor' => 1]);
        $this->actingAs($user);

        $cow = Cow::factory()->create();
        Treatment::factory()->create();
        $response = $this->getJson("/api/cow/{$cow->id}/treatments/all");

        $response->assertStatus(200);
    }
}
