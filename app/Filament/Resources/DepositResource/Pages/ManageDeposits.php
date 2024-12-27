<?php

namespace App\Filament\Resources\DepositResource\Pages;

use App\Filament\Resources\DepositResource;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ManageRecords;
use Illuminate\Database\Eloquent\Builder;

class ManageDeposits extends ManageRecords
{
    protected static string $resource = DepositResource::class;

    // public function getTabs(): array
    // {
    //     return [
    //         'all' => Tab::make(),
    //         'pending' => Tab::make()
    //             ->modifyQueryUsing(fn (Builder $query) => $query->whereNull('approved_at')),
    //         'approved' => Tab::make()
    //             ->modifyQueryUsing(fn (Builder $query) => $query->whereNotNull('approved_at')),
    //    ];
    // }

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
