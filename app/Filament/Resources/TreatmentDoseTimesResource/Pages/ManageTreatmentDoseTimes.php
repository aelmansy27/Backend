<?php

namespace App\Filament\Resources\TreatmentDoseTimesResource\Pages;

use App\Filament\Resources\TreatmentDoseTimesResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageTreatmentDoseTimes extends ManageRecords
{
    protected static string $resource = TreatmentDoseTimesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
