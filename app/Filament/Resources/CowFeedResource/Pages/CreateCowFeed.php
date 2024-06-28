<?php

namespace App\Filament\Resources\CowFeedResource\Pages;

use App\Filament\Resources\CowFeedResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCowFeed extends CreateRecord
{
    protected static string $resource = CowFeedResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
