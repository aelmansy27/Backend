<?php

namespace App\Filament\Resources\ActivitySystemResource\Pages;

use App\Filament\Resources\ActivitySystemResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditActivitySystem extends EditRecord
{
    protected static string $resource = ActivitySystemResource::class;

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
