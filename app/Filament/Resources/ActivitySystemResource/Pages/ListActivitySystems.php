<?php

namespace App\Filament\Resources\ActivitySystemResource\Pages;

use App\Filament\Resources\ActivitySystemResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListActivitySystems extends ListRecords
{
    protected static string $resource = ActivitySystemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
