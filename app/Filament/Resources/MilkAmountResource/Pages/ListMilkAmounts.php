<?php

namespace App\Filament\Resources\MilkAmountResource\Pages;

use App\Filament\Resources\MilkAmountResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMilkAmounts extends ListRecords
{
    protected static string $resource = MilkAmountResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
