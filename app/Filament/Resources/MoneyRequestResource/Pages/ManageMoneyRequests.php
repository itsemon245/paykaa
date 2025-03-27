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
                    $builder->whereNotNull('reported_at')
                        ->whereNull('cancelled_at')
                        ->whereNull('released_at')
                        ->whereNull('rejected_at');
                })->where(function (Builder $builder) {
                    $builder->whereNull('cancelled_at');
                })),
            'pending' => Tab::make('Pending')
                ->modifyQueryUsing(fn(Builder $query) => $query->where(function (Builder $builder) {
                    $builder->whereNull('cancelled_at')
                        ->whereNull('released_at')
                        ->whereNull('rejected_at')
                        ->whereNotNull('reported_at');
                })),
            'completed' => Tab::make('Completed')
                ->modifyQueryUsing(fn(Builder $query) => $query->where(function (Builder $builder) {
                    $builder->whereNull('cancelled_at')
                        ->whereNotNull('released_at')
                        ->whereNull('rejected_at');
                })),
            'cancelled' => Tab::make('Cancelled')
                ->modifyQueryUsing(fn(Builder $query) => $query->where(function (Builder $builder) {
                    $builder->whereNotNull('cancelled_at')
                        ->whereNull('released_at')
                        ->whereNull('rejected_at');
                })),
            'rejected' => Tab::make('Rejected')
                ->modifyQueryUsing(fn(Builder $query) => $query->where(function (Builder $builder) {
                    $builder->whereNotNull('rejected_at')
                        ->whereNull('released_at')
                        ->whereNull('cancelled_at');
                })),
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
