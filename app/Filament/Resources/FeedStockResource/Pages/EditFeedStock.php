<?php

namespace App\Filament\Resources\FeedStockResource\Pages;

use App\Filament\Resources\FeedStockResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFeedStock extends EditRecord
{
    protected static string $resource = FeedStockResource::class;

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
