<?php

namespace Tests\Feature;

use App\Http\Controllers\DoctorView2\CowController;
use App\Models\Cow;
use App\Models\Treatment;
use App\Models\TreatmentStock;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TreatmentTest extends TestCase
{
    private User $user;
    private User $doctor;
    protected function setUp(): void
    {
        parent::setUp();

        $this->user=$this->createUser();
        $this->doctor=$this->createUser(isDoctor: true);
    }

    public function test_doctor_can_create_new_treatment(): void
    {
        $treatmentStock = TreatmentStock::factory()->create();

         $treatment =Treatment::factory()->create();
        $cow = Cow::factory()->create();
        $treatmentData = [
            'name' => $treatment->name, // Add required fields
            'search_term' => $treatmentStock->name .' '. $treatmentStock->type,
            'disease' => 'Disease being treated',
            'doses'=>$treatment->doses,
            'diagnose'=>$treatment->diagnose
        ];

        $response = $this->actingAs($this->doctor)
            ->postJson('/api/cow/'. $cow->id . '/treatment/create', $treatmentData);

        $response->assertStatus(201);

    }


    private function createUser(bool $isDoctor= false): User
    {
        return User::factory()->create([
            'is_doctor'=>$isDoctor
        ]);

    }
}
