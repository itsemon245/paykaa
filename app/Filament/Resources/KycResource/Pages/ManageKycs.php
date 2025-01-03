<?php

namespace App\Filament\Resources\KycResource\Pages;

use App\Filament\Resources\KycResource;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ManageRecords;
use Illuminate\Database\Eloquent\Builder;

class ManageKycs extends ManageRecords
{
    protected static string $resource = KycResource::class;

    public function getTabs(): array
    {
        return [
            'pending' => Tab::make('Pending')
                ->modifyQueryUsing(fn (Builder $query) => $query->whereNull('approved_at')),
            'approved' => Tab::make('Approved')
                ->modifyQueryUsing(fn (Builder $query) => $query->whereNotNull('approved_at')),
            'all' => Tab::make('All')
        ];
    }
    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
