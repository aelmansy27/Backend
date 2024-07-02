<?php

namespace App\Filament\Resources\CowFeedResource\Pages;

use App\Filament\Resources\CowFeedResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCowFeed extends EditRecord
{
    protected static string $resource = CowFeedResource::class;

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
