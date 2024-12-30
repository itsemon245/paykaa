<?php

namespace App\Filament\Resources\WithdrawMethodResource\Pages;

use App\Filament\Resources\WithdrawMethodResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageWithdrawMethods extends ManageRecords
{
    protected static string $resource = WithdrawMethodResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
