<?php

namespace App\Filament\Resources;

use App\Enum\Status;
use App\Enum\Wallet\WalletType;
use App\Filament\Resources\MoneyRequestResource\Pages;
use App\Models\MoneyRequest;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\ActionSize;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Table;

class MoneyRequestResource extends Resource
{
    protected static ?string $model = MoneyRequest::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->disabled()
            ->schema([
                Forms\Components\TextInput::make('sender_id')
                    ->label('Receiver')
                    ->required(),
                Forms\Components\TextInput::make('receiver_id')
                    ->label('Sender')
                    ->required(),
                Forms\Components\TextInput::make('amount')
                    ->required()
                    ->numeric(),
                // Forms\Components\Textarea::make('note')
                //     ->maxLength(255)
                //     ->columnSpan(2)
                //     ->default(null),
            ]);
    }
    public static function getCustomActions(): array
    {
        return [
            Tables\Actions\Action::make('Sender')
                ->icon('heroicon-o-user')
                ->color('success')
                ->url(fn(MoneyRequest $record) => url('/admin/login-as/' . $record->sender->uuid))
                ->size(ActionSize::Large),
            Tables\Actions\Action::make('Receiver')
                ->icon('heroicon-o-user')
                ->color('warning')
                ->url(fn(MoneyRequest $record) => url('/admin/login-as/' . $record->receiver->uuid))
                ->size(ActionSize::Large),
        ];
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Date')
                    ->datetime("d M, Y h:i A")
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),
                Tables\Columns\TextColumn::make('status')
                    ->toggleable(isToggledHiddenByDefault: false)
                    ->badge()
                    ->extraAttributes(['class' => 'capitalize'])
                    ->color(fn(string $state): string => match ($state) {
                        Status::PENDING->value => 'warning',
                        Status::APPROVED->value => 'success',
                        Status::REJECTED->value => 'danger',
                        Status::RELEASED->value => 'success',
                        Status::WAITING_FOR_RELEASE->value => 'warning',
                        default => 'info',
                    })
                    ->label('Status'),
                Tables\Columns\TextColumn::make('sender_id')
                    ->label('Receiver')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('receiver_id')
                    ->label('Sender')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('amount')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                ...self::getCustomActions(),
                // ActionGroup::make([
                //     Tables\Actions\ViewAction::make(),
                //     Tables\Actions\EditAction::make(),
                //     Tables\Actions\DeleteAction::make(),
                // ])
                //     ->tooltip('Actions')
                //     ->size(ActionSize::Large)

            ])
            ->bulkActions([
                // Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageMoneyRequests::route('/'),
        ];
    }
}
