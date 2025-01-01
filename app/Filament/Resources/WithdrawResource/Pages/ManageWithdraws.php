<?php

namespace App\Filament\Resources\WithdrawResource\Pages;

use App\Enum\Wallet\WalletTransactionType;
use App\Filament\Resources\DepositResource;
use App\Filament\Resources\WithdrawResource;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ManageRecords;
use Illuminate\Database\Eloquent\Builder;

class ManageWithdraws extends ManageRecords
{
    protected static string $resource = WithdrawResource::class;

    public function getTabs(): array
    {
        return [
            'pending' => Tab::make('Pending')
                ->modifyQueryUsing(fn (Builder $query) => $query->whereNull('approved_at')->where('transaction_type', WalletTransactionType::WITHDRAW->value)),
            'approved' => Tab::make('Approved')
                ->modifyQueryUsing(fn (Builder $query) => $query->whereNotNull('approved_at')->where('transaction_type', WalletTransactionType::WITHDRAW->value)),
            'all' => Tab::make('All')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('transaction_type', WalletTransactionType::WITHDRAW->value)),
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
