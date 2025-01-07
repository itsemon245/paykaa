<?php

namespace App\Filament\Resources\AddResource\Pages;

use App\Filament\Resources\AddResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageAdds extends ManageRecords
{
    protected static string $resource = AddResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
