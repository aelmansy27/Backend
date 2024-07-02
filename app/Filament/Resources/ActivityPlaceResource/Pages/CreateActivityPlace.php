<?php

namespace App\Filament\Resources\ActivityPlaceResource\Pages;

use App\Filament\Resources\ActivityPlaceResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateActivityPlace extends CreateRecord
{
    protected static string $resource = ActivityPlaceResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
