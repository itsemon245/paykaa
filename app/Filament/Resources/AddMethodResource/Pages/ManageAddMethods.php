<?php

namespace App\Filament\Resources\AddMethodResource\Pages;

use App\Filament\Resources\AddMethodResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageAddMethods extends ManageRecords
{
    protected static string $resource = AddMethodResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
