<?php

namespace App\Filament\Resources\TreatmentStockResource\Pages;

use App\Filament\Resources\TreatmentStockResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTreatmentStock extends EditRecord
{
    protected static string $resource = TreatmentStockResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
