<?php

namespace App\Filament\Resources;

use App\Enum\MethodCategory;
use App\Enum\Wallet\WalletTransactionType;
use App\Enum\Wallet\WalletType;
use App\Filament\Resources\TransactionResource\Pages;
use App\Filament\Resources\TransactionResource\RelationManagers;
use App\Models\Model;
use App\Models\Transaction;
use App\Models\Wallet;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\ActionSize;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TransactionResource extends Resource
{
    protected static ?string $model = Wallet::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Transactions';
    protected static ?string $modelLabel = 'Transaction';
    protected static ?string $pluralModelLabel = 'Transactions';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Fieldset::make('Sender')
                    ->relationship('sender')
                    ->hidden(fn(?Model $record) => !$record?->sender)
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->disabled()
                            ->readOnly(),
                        \App\Forms\Components\Copyable::make('id')
                            ->label('UID')
                            ->readOnly()
                    ]),
                Forms\Components\Fieldset::make('Receiver')
                    ->relationship('receiver')
                    ->hidden(fn(?Model $record) => !$record?->receiver)
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->disabled()
                            ->readOnly(),
                        \App\Forms\Components\Copyable::make('id')
                            ->label('UID')
                            ->readOnly()
                    ]),
                Forms\Components\TextInput::make('payment_number')
                    ->label(function (?Model $record) {
                        $category = $record?->depositMethod?->category;
                        if ($category === MethodCategory::BANK->value) {
                            return 'A/c Number';
                        }
                        return $category === MethodCategory::MOBILE_BANKING->value ? 'Phone Number' : 'Wallet Adress';
                    })
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('account_holder')->label('A/c Name')->hidden(fn(?Model $record) => $record?->depositMethod?->category !== MethodCategory::BANK->value),
                Forms\Components\TextInput::make('amount')
                    ->required()
                    ->numeric()
                    ->default(0.00),
                Forms\Components\TextInput::make('commission')
                    ->hidden(fn(?Model $record) => $record?->transactionType !== WalletTransactionType::DEPOSIT->value)
                    ->required()
                    ->numeric()
                    ->default(0.00),
                Forms\Components\TextInput::make('transaction_id')
                    ->hidden(fn(?Model $record) => $record?->depositMethod?->category !== MethodCategory::MOBILE_BANKING->value)
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('branch_name')->label('Branch')->hidden(fn(?Model $record) => $record?->depositMethod?->category !== MethodCategory::BANK->value),
                Forms\Components\Textarea::make('note')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\FileUpload::make('receipt')
                    ->hidden(function (?Model $record) {
                        if (!$record?->receipt) {
                            return true;
                        }
                        return $record?->depositMethod?->category !== MethodCategory::BANK->value;
                    })
                    ->deletable(false)
                    ->openable(true)
                    ->columnSpanFull()
                    ->downloadable()
                    ->image()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Date')
                    ->datetime("d M, Y h:i A")
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
                Tables\Columns\TextColumn::make('transaction_type')
                    ->badge()
                    ->extraAttributes(['class' => 'capitalize'])
                    ->color(fn(string $state): string => match ($state) {
                        WalletTransactionType::DEPOSIT->value => 'success',
                        WalletTransactionType::WITHDRAW->value => 'warning',
                        WalletTransactionType::TRANSFER->value => 'info',
                        WalletTransactionType::EARN->value => 'success'
                    })
                    ->label('Type'),

                Tables\Columns\TextColumn::make('sender.id')
                    ->label('Sender')
                    ->numeric()
                    ->copyable()
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('receiver.id')
                    ->label('Receiver')
                    ->numeric()
                    ->copyable()
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('amount')
                    ->toggleable(isToggledHiddenByDefault: false)
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('payment_number')
                    ->toggleable(isToggledHiddenByDefault: false)
                    ->searchable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('transaction_type')
                    ->options([
                        WalletTransactionType::DEPOSIT->value => 'Deposit',
                        WalletTransactionType::WITHDRAW->value => 'Withdraw',
                        WalletTransactionType::TRANSFER->value => 'Transfer',
                        WalletTransactionType::EARN->value => 'Earn',
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageTransactions::route('/'),
        ];
    }
}

