<?php

namespace App\Filament\Resources\TestResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            $this->getCancelFormAction()->label('Go Back')->color('primary'),
        ];
    }
    /**
     * @return array<Action | ActionGroup>
     */
    protected function getFormActions(): array
    {
        return [
            $this->getCancelFormAction(),
        ];
    }
}
