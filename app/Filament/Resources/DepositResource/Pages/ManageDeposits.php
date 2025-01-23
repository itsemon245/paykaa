<?php

namespace App\Filament\Resources\DepositResource\Pages;

use App\Enum\Wallet\WalletTransactionType;
use App\Filament\Resources\DepositResource;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ManageRecords;
use Illuminate\Database\Eloquent\Builder;

class ManageDeposits extends ManageRecords
{
    protected static string $resource = DepositResource::class;

    public function getTabs(): array
    {
        return [
            'pending' => Tab::make('Pending')
                ->modifyQueryUsing(fn(Builder $query) => $query->where(function (Builder $builder) {
                    $builder->whereNull('approved_at')->where('transaction_type', WalletTransactionType::DEPOSIT->value);
                })->where(function (Builder $builder) {
                    $builder->whereNull('cancelled_at')->orWhereNull('failed_at');
                })),
            'approved' => Tab::make('Approved')
                ->modifyQueryUsing(fn(Builder $query) => $query->whereNotNull('approved_at')->where('transaction_type', WalletTransactionType::DEPOSIT->value)),
            'rejected' => Tab::make('Rejected')
                ->modifyQueryUsing(fn(Builder $query) => $query->whereNotNull('cancelled_at')->where('transaction_type', WalletTransactionType::DEPOSIT->value))
        ];
    }
    public function getDefaultActiveTab(): string | int | null
    {
        return 'pending';
    }

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
