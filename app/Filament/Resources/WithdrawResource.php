<?php

namespace App\Filament\Resources;

use App\Enum\MethodCategory;
use App\Enum\Wallet\WalletStatus;
use App\Enum\Wallet\WalletTransactionType;
use App\Filament\Resources\WithdrawResource\Pages\ManageWithdraws;
use App\Models\Model;
use App\Models\Wallet;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\ActionSize;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class WithdrawResource extends Resource
{
    protected static ?string $model = Wallet::class;

    protected static ?string $navigationLabel = 'Withdraw Requests';
    protected static ?int $navigationSort = 3;
    protected static ?string $modelLabel = 'Withdraw Request';
    protected static ?string $pluralModelLabel = 'Withdraw Requests';
    protected static ?string $navigationIcon = 'heroicon-o-arrow-up-on-square';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Fieldset::make('User')
                    ->relationship('owner')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->disabled()
                            ->readOnly(),
                        Forms\Components\TextInput::make('id')
                            ->label('UID')
                            ->readOnly()
                            ->suffixAction(
                                \Filament\Forms\Components\Actions\Action::make('copy')
                                    ->color('secondary')
                                    ->icon('heroicon-o-clipboard')
                                    ->action(function ($livewire, $state) {
                                        $livewire->dispatch('copy-to-clipboard', text: $state);
                                    })
                            )
                            ->extraAttributes([
                                'x-data' => '{
                                copyToClipboard(text) {
                                if (navigator.clipboard && navigator.clipboard.writeText) {
                                navigator.clipboard.writeText(text).then(() => {
                                $tooltip("Copied to clipboard", { timeout: 1500 });
                                }).catch(() => {
                                $tooltip("Failed to copy", { timeout: 1500 });
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
                                $tooltip("Copied to clipboard", { timeout: 1500 });
                                } catch (err) {
                                $tooltip("Failed to copy", { timeout: 1500 });
                                }
                                document.body.removeChild(textArea);
                                }
                                }
                                }',
                                'x-on:copy-to-clipboard.window' => 'copyToClipboard($event.detail.text)',
                            ]),
                    ]),
                Forms\Components\TextInput::make('amount')
                    ->required()
                    ->numeric()
                    ->default(0.00),
                Forms\Components\TextInput::make('payment_number')
                    ->label(function (Model $record) {
                        $category = $record->withdrawMethod?->category;
                        if ($category === MethodCategory::BANK->value) {
                            return 'A/C. Number';
                        }
                        return $category === MethodCategory::MOBILE_BANKING->value ? 'Personal Number' : 'Wallet Adress';
                    })
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('transaction_id')
                    ->hidden(fn(Model $record) => $record->depositMethod?->category !== MethodCategory::MOBILE_BANKING->value)
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\ViewField::make('additional_fields')
                    ->filled()
                    ->hidden(fn(Model $record) => count($record?->additional_fields) == 0)
                    ->view('filament.forms.components.additional-fields')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('note')
                    ->maxLength(255)
                    ->default(null),
            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function (Builder $query) {})
            ->columns([
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Date')
                    ->datetime("d M, Y H:i a")
                    ->toggleable(isToggledHiddenByDefault: false)
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->toggleable(isToggledHiddenByDefault: false)
                    ->badge()
                    ->extraAttributes(['class' => 'capitalize'])
                    ->color(fn(string $state): string => match ($state) {
                        'pending' => 'warning',
                        'approved' => 'success',
                        'cancelled' => 'danger',
                        'failed' => 'danger',
                    })
                    ->label('Status'),
                Tables\Columns\TextColumn::make('owner.name')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('Reqeusted By')
                    ->numeric()
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('transaction_id')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                Tables\Columns\TextColumn::make('amount')
                    ->toggleable(isToggledHiddenByDefault: false)
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('commission')
                    ->toggleable(isToggledHiddenByDefault: false)
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('withdrawMethod.label')
                    ->toggleable(isToggledHiddenByDefault: false)
                    ->searchable(),
                Tables\Columns\TextColumn::make('payment_number')
                    ->toggleable(isToggledHiddenByDefault: false)
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\Action::make('Action')
                    ->icon('heroicon-o-user')
                    ->color('warning')
                    ->url(fn(Wallet $record) => url('/admin/login-as/' . $record->owner->uuid))
                    ->size(ActionSize::Large),

                Action::make('Approve')
                    ->requiresConfirmation()
                    ->hidden(fn(Model $record) => $record->status === WalletStatus::APPROVED->value || $record->status === WalletStatus::FAILED->value || $record->status === WalletStatus::CANCELLED->value)
                    ->tooltip('Approve')
                    ->action(fn(Model $record) => $record->update(['approved_at' => now(), 'failed_at' => null, 'cancelled_at' => null]))
                    ->size(ActionSize::Large)
                    ->color('success')
                    ->icon('heroicon-o-check-circle'),
                Action::make('Reject')
                    ->requiresConfirmation()
                    ->hidden(fn(Model $record) => $record->status === WalletStatus::CANCELLED->value || $record->status === WalletStatus::FAILED->value || $record->status === WalletStatus::APPROVED->value)
                    ->tooltip('Reject')
                    ->action(fn(Model $record) => $record->update(['cancelled_at' => now(), 'approved_at' => null, 'failed_at' => null]))
                    ->size(ActionSize::Large)
                    ->color('danger')
                    ->icon('heroicon-o-x-circle'),
                Tables\Actions\ViewAction::make()->modalHeading(fn(Wallet $record) => "Withdraw Reqeust for " . ($record->withdrawMethod?->category === 'Bank' ? 'Bank' : $record->withdrawMethod?->label)),
            ])
            ->bulkActions([
                // Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageWithdraws::route('/'),
        ];
    }
}
