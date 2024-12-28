<?php

namespace App\Filament\Resources\DepositMethodResource\Pages;

use App\Filament\Resources\DepositMethodResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageDepositMethods extends ManageRecords
{
    protected static string $resource = DepositMethodResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
