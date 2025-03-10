<?php

namespace App\Filament\Widgets;

use App\Enum\UserType;
use App\Models\User;
use App\Models\Kyc;
use App\Models\Wallet;
use App\Enum\Wallet\WalletTransactionType;
use App\Filament\Resources\DepositResource;
use App\Filament\Resources\KycResource;
use App\Filament\Resources\UserResource;
use App\Filament\Resources\WithdrawResource;
use App\Models\Chat;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Number;
use NumberFormatter;

class StatsOverview extends BaseWidget
{
    use InteractsWithPageFilters;
    protected static bool $isLazy = false;
    protected float $paykaaBalance;
    protected float $depositAmount;
    protected float $withdrawAmount;
    protected float $earnings;

    protected function getColumns(): int
    {
        return 3;
    }

    protected function getStats(): array
    {
        $this->getDepositAmounts();
        $this->getWithdrawAmounts();
        $this->getEarnings();
        $this->paykaaBalance = $this->depositAmount - $this->withdrawAmount;
        $comissions = $this->getCommissionAmount();
        $revenue = $comissions - $this->earnings;

        return [
            Stat::make(
                'Helpline',
                $this->format(Chat::where(['receiver_id' => 1])->whereHas('lastMessage', function ($q) {
                    $q->where('is_read', false);
                })->count())
            )
                ->icon('heroicon-o-chat-bubble-left-right')
                ->url(url('/helpline'))
                ->extraAttributes(['class' => 'cursor-pointer']),

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
            Stat::make('Service Charge', $this->format($comissions, true))
                ->color('success')
                ->icon('heroicon-o-document-currency-bangladeshi'),
            Stat::make('Revenue', $this->format($revenue, true))
                ->color('success')
                ->icon('heroicon-o-document-currency-bangladeshi'),

            Stat::make(
                'Deposit Amount',
                $this->format($this->depositAmount, true),
            )
                ->color('success')
                ->url(DepositResource::getUrl())
                ->icon('heroicon-o-document-currency-bangladeshi'),
            Stat::make('Withdraw Amount', $this->format($this->withdrawAmount, true))
                ->url(WithdrawResource::getUrl())
                ->color('success')
                ->icon('heroicon-o-document-currency-bangladeshi'),
            Stat::make('PayKaa Balance', $this->format($this->paykaaBalance, true))
                ->color('success')
                ->icon('heroicon-o-document-currency-bangladeshi'),
            Stat::make('Users', $this->getTotalUsers())
                ->color('success')
                ->url(UserResource::getUrl())
                ->icon('heroicon-o-user-group'),


        ];
    }

    protected function getEarnings(): float
    {
        $earnings = Wallet::where([
            'transaction_type' => WalletTransactionType::EARN->value,
            'cancelled_at' => null
        ])
            ->whereNotNull('approved_at')
            ->where(fn(Builder $query) => $this->getQuery($query))
            ->sum('amount');
        $this->earnings = $earnings;
        return $earnings;
    }

    protected function getCommissionAmount(): float
    {
        return Wallet::where([
            'transaction_type' => WalletTransactionType::DEPOSIT->value,
            'cancelled_at' => null
        ])
            ->whereNotNull('approved_at')
            ->where(fn(Builder $query) => $this->getQuery($query))
            ->sum('commission');
    }

    protected function getDepositAmounts(): float
    {
        $deposits = Wallet::where([
            'transaction_type' => WalletTransactionType::DEPOSIT->value,
            'cancelled_at' => null
        ])
            ->whereNotNull('approved_at')
            ->where(fn(Builder $query) => $this->getQuery($query))
            ->sum('amount');
        $this->depositAmount = $deposits;
        return $deposits;
    }
    protected function getWithdrawAmounts(): float
    {
        $withdraws = Wallet::where([
            'transaction_type' => WalletTransactionType::WITHDRAW->value,
            'cancelled_at' => null
        ])
            ->whereNotNull('approved_at')
            ->where(fn(Builder $query) => $this->getQuery($query))
            ->sum('amount');
        $this->withdrawAmount = $withdraws;
        return $withdraws;
    }

    protected function format(float|int $int, bool $currency = false): string
    {
        $style = $currency ? NumberFormatter::CURRENCY : NumberFormatter::DEFAULT_STYLE;
        $number = new NumberFormatter('en_IN', $style);
        if ($currency) {
            return $number->formatCurrency($int, 'BDT');
        }
        return $number->format($int);
    }
    protected function getTotalUsers(): string
    {
        return Number::forHumans(User::where('type', UserType::Customer->value)->where(fn(Builder $query) => $this->getQuery($query))->count(), abbreviate: false);
    }
    protected function getQuery(Builder $query): Builder
    {
        $dateFrom = null;
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
        if (!$dateFrom) {
            return $query;
        }
        return $query->where('created_at', '>=', $dateFrom)->where('created_at', '<=', $dateTo);
    }
}
