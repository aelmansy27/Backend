<?php

namespace App\Filament\Resources\MilkAmountResource\Pages;

use App\Filament\Resources\MilkAmountResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMilkAmount extends EditRecord
{
    protected static string $resource = MilkAmountResource::class;

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
