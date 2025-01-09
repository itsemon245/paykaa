<?php

namespace App\Filament\Widgets;

use App\Enum\UserType;
use App\Models\User;
use App\Models\Kyc;
use App\Models\Wallet;
use App\Enum\Wallet\WalletTransactionType;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Number;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Users This Month', $this->format(User::where('type', UserType::Customer->value)->where('created_at', '>=', now()->subMonth())->count()))
                ->color('success')
                ->icon('heroicon-o-users'),
            Stat::make('Users This Year', $this->format(User::where('type', UserType::Customer->value)->where('created_at', '>=', now()->subYear())->count()))
                ->color('success')
                ->icon('heroicon-o-users'),
            Stat::make('Total Users', $this->getTotalUsers())
                ->color('success')
                ->icon('heroicon-o-user-group'),
            Stat::make('Pending Verifications', $this->format(Kyc::where([
                'approved_at' => null,
                'rejected_at' => null,
            ])->count()))
                ->color('warning')
                ->icon('heroicon-o-shield-check'),
            Stat::make('Pending Deposits', $this->format(Wallet::where([
                'transaction_type' => WalletTransactionType::DEPOSIT->value,
                'approved_at' => null,
                'cancelled_at' => null,
            ])->count()))
                ->color('warning')
                ->icon('heroicon-o-document-currency-bangladeshi')
                ->url(url('/admin/deposits'))
                ->extraAttributes(['class' => 'cursor-pointer']),

        ];
    }

    protected function format(float|int $int):string{
        return Number::forHumans($int, abbreviate: true);
    }
    protected function getTotalUsers(): string
    {
        return Number::forHumans(User::where('type', UserType::Customer->value)->count(), abbreviate: true);
    }
}
