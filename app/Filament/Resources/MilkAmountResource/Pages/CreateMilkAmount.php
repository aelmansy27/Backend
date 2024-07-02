<?php

namespace App\Filament\Resources\MilkAmountResource\Pages;

use App\Filament\Resources\MilkAmountResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMilkAmount extends CreateRecord
{
    protected static string $resource = MilkAmountResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
