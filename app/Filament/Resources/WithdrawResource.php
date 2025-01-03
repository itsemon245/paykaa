<?php

namespace App\Filament\Resources;

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
    protected static ?string $modelLabel = 'Withdraw Request';
    protected static ?string $pluralModelLabel = 'Withdraw Requests';
    protected static ?string $navigationIcon = 'heroicon-o-arrow-up-on-square';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('payment_number')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('method')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('amount')
                    ->required()
                    ->numeric()
                    ->default(0.00),
                Forms\Components\TextInput::make('commission')
                    ->required()
                    ->numeric()
                    ->default(0.00),
                    Forms\Components\TextInput::make('currency')
                        ->required()
                        ->maxLength(255)
                        ->default('bdt'),
                    Forms\Components\TextInput::make('transaction_id')
                        ->maxLength(255)
                        ->default(null),

                Forms\Components\Repeater::make('additional_fields')
                    ->hidden(fn(Model $record)=> count($record?->additional_fields) == 0 )
                    ->columnSpanFull()
                    ->schema([

                    ]),
                Forms\Components\Textarea::make('note')
                    ->maxLength(255)
                    ->columnSpanFull()
                    ->default(null),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function (Builder $query) {
                $query->where('transaction_type', WalletTransactionType::WITHDRAW->value);
            })
            ->columns([
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Date')
                    ->date()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->toggleable(isToggledHiddenByDefault: false)
                    ->badge()
                    ->extraAttributes(['class' => 'capitalize'])
                    ->color(fn (string $state): string => match ($state) {
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
                    ->toggleable(isToggledHiddenByDefault: false)
                    ->searchable(),
                Tables\Columns\TextColumn::make('amount')
                    ->toggleable(isToggledHiddenByDefault: false)
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('commission')
                    ->toggleable(isToggledHiddenByDefault: false)
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('method')
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
                Action::make('Approve')
                    ->requiresConfirmation()
                    ->hidden(fn (Model $record) => $record->status === WalletStatus::APPROVED->value || $record->status === WalletStatus::FAILED->value)
                    ->tooltip('Approve')
                    ->action(fn (Model $record) => $record->update(['approved_at' => now(), 'failed_at' => null, 'cancelled_at' => null]))
                    ->size(ActionSize::Large)
                    ->color('success')
                    ->icon('heroicon-o-check-circle'),
                Action::make('Reject')
                    ->requiresConfirmation()
                    ->hidden(fn (Model $record) => $record->status === WalletStatus::CANCELLED->value || $record->status === WalletStatus::FAILED->value)
                    ->tooltip('Reject')
                    ->action(fn (Model $record) => $record->update(['cancelled_at' => now(), 'approved_at' => null, 'failed_at' => null]))
                    ->size(ActionSize::Large)
                    ->color('danger')
                    ->icon('heroicon-o-x-circle'),


                ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ])
                    ->tooltip('Actions')
                    ->size(ActionSize::Large)
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageWithdraws::route('/'),
        ];
    }
}
