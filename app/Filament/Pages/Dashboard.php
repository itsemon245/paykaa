<?php

namespace App\Filament\Pages;

use Filament\Actions\Action;
use Filament\Forms\Components\DatePicker;
use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Pages\Dashboard\Actions\FilterAction;
use Filament\Pages\Dashboard\Concerns\HasFiltersAction;
use Filament\Pages\Dashboard\Concerns\HasFiltersForm;
use Livewire\Component;

class Dashboard extends BaseDashboard
{
    use HasFiltersAction;

    protected function getActionColor(string $query): string
    {
        $color = 'gray';
        if (array_key_exists('date', $this->filters) && $this->filters['date'] === $query) {
            $color = 'primary';
        }
        if (!array_key_exists('date', $this->filters) && $query === 'all') {
            $color = 'primary';
        }
        return $color;
    }
    protected function getFilterAction($name): Action
    {
        $query = str($name)->snake()->toString();
        return Action::make($name)
            ->action(function (Component $livewire) use ($query) {
                $this->filters = ['date' => $query];
                $livewire->dispatch('refresh'); // Refresh UI
            })
            ->color(fn() => $this->getActionColor($query));
    }
    protected function getHeaderActions(): array
    {
        return [
            $this->getFilterAction('All'),
            $this->getFilterAction('Today'),
            $this->getFilterAction('This Week'),
            $this->getFilterAction('This Month'),
            $this->getFilterAction('This Year'),
            FilterAction::make()
                ->label('Custom Date')
                ->form([
                    DatePicker::make('startDate'),
                    DatePicker::make('endDate'),
                    // ...
                ]),
        ];
    }
}
