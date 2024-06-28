<?php

namespace App\Filament\Resources\FeedStockResource\Pages;

use App\Filament\Resources\FeedStockResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateFeedStock extends CreateRecord
{
    protected static string $resource = FeedStockResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
