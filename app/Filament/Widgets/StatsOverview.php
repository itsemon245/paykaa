<?php

namespace App\Filament\Widgets;

use App\Enum\UserType;
use App\Models\User;
use App\Models\Kyc;
use App\Models\Wallet;
use App\Enum\Wallet\WalletTransactionType;
use App\Filament\Resources\KycResource;
use App\Filament\Resources\WithdrawResource;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Number;

class StatsOverview extends BaseWidget
{
    use InteractsWithPageFilters;
    protected static bool $isLazy = false;

    protected function getStats(): array
    {
        return [
            Stat::make(
                'Pending Deposits',
                $this->format(
                    Wallet::where([
                        'transaction_type' => WalletTransactionType::DEPOSIT->value,
                        'approved_at' => null,
                        'cancelled_at' => null
                    ])
                        ->where(fn(Builder $query) => $this->getQuery($query))
                        ->count()
                )
            )
                ->color('warning')
                ->icon('heroicon-o-document-currency-bangladeshi')
                ->url(url('/admin/deposits'))
                ->extraAttributes(['class' => 'cursor-pointer']),

            Stat::make(
                'Pending Withdrawals',
                $this->format(
                    Wallet::where([
                        'transaction_type' => WalletTransactionType::WITHDRAW->value,
                        'approved_at' => null,
                        'cancelled_at' => null
                    ])
                        ->where(fn(Builder $query) => $this->getQuery($query))
                        ->count()
                )
            )
                ->color('warning')
                ->icon('heroicon-o-document-currency-bangladeshi')
                ->url(WithdrawResource::getUrl())
                ->extraAttributes(['class' => 'cursor-pointer']),

            Stat::make('Pending Verifications', $this->format(Kyc::where([
                'approved_at' => null,
                'rejected_at' => null,
            ])
                ->where(fn(Builder $query) => $this->getQuery($query))
                ->count()))
                ->url(KycResource::getUrl())
                ->color('warning')
                ->icon('heroicon-o-shield-check'),

            Stat::make('Users', $this->getTotalUsers())
                ->color('success')
                ->icon('heroicon-o-user-group'),
        ];
    }

    protected function format(float|int $int): string
    {
        return Number::forHumans($int, abbreviate: true);
    }
    protected function getTotalUsers(): string
    {
        return Number::forHumans(User::where('type', UserType::Customer->value)->where(fn(Builder $query) => $this->getQuery($query))->count(), abbreviate: true);
    }
    protected function getQuery(Builder $query): Builder
    {
        $dateFrom = '';
        $dateTo = today();
        if (array_key_exists('startDate', $this->filters ?? []) && array_key_exists('endDate', $this->filters ?? [])) {
            $dateFrom = $this->filters['startDate'];
            $dateTo = $this->filters['endDate'];
        } elseif (array_key_exists('date', $this->filters ?? [])) {
            switch ($this->filters['date']) {
                case 'today':
                    $dateFrom = today();
                    break;
                case 'this_week':
                    $dateFrom = today()->subWeek();
                    break;
                case 'this_month':
                    $dateFrom = today()->subMonth();
                    break;
                case 'this_year':
                    $dateFrom = today()->subYear();
                    break;
                default:
                    $dateFrom = null;
                    $dateTo = null;
                    break;
            }
        }
        if ($dateFrom === null && $dateTo === null) {
            return $query;
        }
        return $query->where('created_at', '>=', $dateFrom)->where('created_at', '<=', $dateTo);
    }
}
