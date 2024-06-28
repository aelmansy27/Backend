<?php

namespace App\Filament\Resources\BreadingSystemResource\Pages;

use App\Filament\Resources\BreadingSystemResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBreadingSystem extends EditRecord
{
    protected static string $resource = BreadingSystemResource::class;

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

