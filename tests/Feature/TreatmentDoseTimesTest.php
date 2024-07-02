<?php

namespace Tests\Feature;

use App\Models\Treatment;
use App\Models\TreatmentDoseTimes;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\CreatesApplication;
use Tests\TestCase;

class TreatmentDoseTimesTest extends TestCase
{
    use RefreshDatabase;
    use CreatesApplication;
    private User $user;
    private User $doctor;
    protected function setUp(): void
    {
        parent::setUp();

        $this->user=$this->createUser();
        $this->doctor=$this->createUser(isDoctor: true);
    }

    public function test_doctor_can_create_treatment_dose_times(): void
    {
        $treatment = Treatment::factory()->create();
        $treatmentdoses = TreatmentDoseTimes::factory()->make()->toArray();

        $doseTimesData = [
            'dose_times' => [$treatmentdoses]
        ];

        $response = $this->actingAs($this->doctor)
            ->postJson('/api/treatments/' . $treatment->id . '/create-dose-times',$doseTimesData);

        $response->assertStatus(200);
    }



    private function createUser(bool $isDoctor= false): User
    {
        return User::factory()->create([
            'is_doctor'=>$isDoctor
        ]);

    }
}
