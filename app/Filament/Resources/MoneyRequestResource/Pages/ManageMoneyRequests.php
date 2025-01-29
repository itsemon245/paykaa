<?php

namespace App\Filament\Resources\MoneyRequestResource\Pages;

use App\Filament\Resources\MoneyRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageMoneyRequests extends ManageRecords
{
    protected static string $resource = MoneyRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
