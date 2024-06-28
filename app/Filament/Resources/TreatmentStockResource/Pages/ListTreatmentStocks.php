<?php

namespace App\Filament\Resources\TreatmentStockResource\Pages;

use App\Filament\Resources\TreatmentStockResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTreatmentStocks extends ListRecords
{
    protected static string $resource = TreatmentStockResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
