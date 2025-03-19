<?php

namespace App\Filament\Resources\MoneyRequestResource\Pages;

use App\Filament\Resources\MoneyRequestResource;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ManageRecords;
use Illuminate\Database\Eloquent\Builder;

class ManageMoneyRequests extends ManageRecords
{
    protected static string $resource = MoneyRequestResource::class;

    public function getTabs(): array
    {
        return [
            'reported' => Tab::make('Reported')
                ->modifyQueryUsing(fn(Builder $query) => $query->where(function (Builder $builder) {
                    $builder->whereNotNull('reported_at');
                })->where(function (Builder $builder) {
                    $builder->whereNull('cancelled_at');
                })),
            'all' => Tab::make('All'),
        ];
    }
    public function getDefaultActiveTab(): string | int | null
    {
        return 'reported';
    }


    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
