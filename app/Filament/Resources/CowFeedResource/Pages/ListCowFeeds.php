<?php

namespace App\Filament\Resources\CowFeedResource\Pages;

use App\Filament\Resources\CowFeedResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCowFeeds extends ListRecords
{
    protected static string $resource = CowFeedResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
