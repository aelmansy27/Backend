<?php

namespace App\Filament\Resources\ActivityPlaceResource\Pages;

use App\Filament\Resources\ActivityPlaceResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListActivityPlaces extends ListRecords
{
    protected static string $resource = ActivityPlaceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
