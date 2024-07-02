<?php

namespace App\Filament\Resources\TreatmentStockResource\Pages;

use App\Filament\Resources\TreatmentStockResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTreatmentStock extends CreateRecord
{
    protected static string $resource = TreatmentStockResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
