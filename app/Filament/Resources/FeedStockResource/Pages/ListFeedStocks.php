<?php

namespace App\Filament\Resources\FeedStockResource\Pages;

use App\Filament\Resources\FeedStockResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFeedStocks extends ListRecords
{
    protected static string $resource = FeedStockResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
