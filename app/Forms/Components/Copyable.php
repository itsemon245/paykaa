<?php

namespace App\Forms\Components;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Actions\Action;
use Filament\Notifications\Notification;

class Copyable extends TextInput
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->readOnly()
            ->suffixAction(
                Action::make('copy')
                    ->color('secondary')
                    ->icon('heroicon-o-clipboard')
                    ->action(function ($livewire, $state) {
                        $livewire->dispatch('copy-to-clipboard', text: $state);

                        // Show Filament toast notification
                        Notification::make()
                            ->title('Copied to clipboard!')
                            ->success()
                            ->send();
                    })
            )
            ->extraAttributes([
                'x-data' => '{
                    copyToClipboard(text) {
                        if (navigator.clipboard && navigator.clipboard.writeText) {
                            navigator.clipboard.writeText(text).catch(() => {
                                $dispatch("notify-failed");
                            });
                        } else {
                            const textArea = document.createElement("textarea");
                            textArea.value = text;
                            textArea.style.position = "fixed";
                            textArea.style.opacity = "0";
                            document.body.appendChild(textArea);
                            textArea.select();
                            try {
                                document.execCommand("copy");
                            } catch (err) {
                                $dispatch("notify-failed");
                            }
                            document.body.removeChild(textArea);
                        }
                    }
                }',
                'x-on:copy-to-clipboard.window' => 'copyToClipboard($event.detail.text)',
            ]);
    }
}
