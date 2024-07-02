<?php

namespace App\Filament\Resources\BreadingSystemResource\Pages;

use App\Filament\Resources\BreadingSystemResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBreadingSystems extends ListRecords
{
    protected static string $resource = BreadingSystemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
