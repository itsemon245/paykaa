<?php

namespace App\Filament\Resources;

use App\Enum\Status;
use App\Enum\Wallet\WalletType;
use App\Filament\Resources\MoneyRequestResource\Pages;
use App\Models\MoneyRequest;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\ActionSize;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Table;
use Illuminate\Support\Facades\DB;

class MoneyRequestResource extends Resource
{
    protected static ?string $model = MoneyRequest::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Money Transfers';

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
            Tables\Actions\Action::make('Return Money')
                ->requiresConfirmation()
                ->hidden(fn(MoneyRequest $record) => !$record->reported_at || ($record->released_at || $record->cancelled_at || $record->rejected_at))
                ->action(function (MoneyRequest $record) {
                    DB::transaction(function () use ($record) {
                        $record->transaction()->update([
                            'approved_at' => null,
                            'cancelled_at' => now(),
                            'failed_at' => null,
                        ]);
                        $record->update([
                            'cancelled_at' => now(),
                            'rejected_at' => null,
                            'reported_at' => null,
                            'reported_by' => null,
                            'admin_note' => "Money returned by PayKaa Team",
                        ]);
                        event(new \App\Events\MessageCreated(moneyRequestMessage($record, $record->reportMessage)));
                    });
                })
                ->icon('heroicon-o-check')
                ->color('danger')
                ->size(ActionSize::Large),
            Tables\Actions\Action::make('Release')
                ->requiresConfirmation()
                ->hidden(fn(MoneyRequest $record) => !$record->reported_at || ($record->released_at || $record->cancelled_at || $record->rejected_at))
                ->action(function (MoneyRequest $record) {
                    DB::transaction(function () use ($record) {
                        $record->transaction()->update([
                            'approved_at' => now(),
                            'cancelled_at' => null,
                            'failed_at' => null,
                        ]);
                        $record->update([
                            'released_at' => now(),
                            'admin_note' => "Money released by PayKaa Team",
                            'cancelled_at' => null,
                            'rejected_at' => null,
                            'reported_at' => null,
                            'reported_by' => null,
                        ]);
                        event(new \App\Events\MessageCreated(moneyRequestMessage($record, $record->reportMessage)));
                    });
                })
                ->icon('heroicon-o-check')
                ->color('success')
                ->size(ActionSize::Large),
            Tables\Actions\Action::make('Buyer')
                ->requiresConfirmation()
                ->icon('heroicon-o-user')
                ->color('danger')
                ->url(fn(MoneyRequest $record) => self::getLoginUrl($record->receiver, ['redirect' => route('chat.show', $record->message->chat)]))
                ->size(ActionSize::Large),

            Tables\Actions\Action::make('Seller')
                ->requiresConfirmation()
                ->icon('heroicon-o-user')
                ->color('success')
                ->url(fn(MoneyRequest $record) => self::getLoginUrl($record->sender, ['redirect' => route('chat.show', $record->message->chat)]))
                ->size(ActionSize::Large),
        ];
    }
    public static function getLoginUrl(User $user, array $params = []): string
    {
        $url = url('/admin/login-as/' . $user->uuid);
        if ($params) {
            $url .= '?' . http_build_query($params);
        }
        return $url;
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
                Tables\Columns\TextColumn::make('reported_by')
                    ->label('Reported By')
                    ->formatStateUsing(fn(MoneyRequest $record) => $record->reported_by != null ? ($record->sender_id == $record->reported_by ? 'Seller' : 'Buyer') : 'none')
                    ->badge()
                    ->color(fn(MoneyRequest $record) => $record->reported_by != null ? ($record->sender_id == $record->reported_by ? 'success' : 'danger') : 'info')
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->toggleable(isToggledHiddenByDefault: false)
                    ->badge()
                    ->extraAttributes(['class' => 'capitalize'])
                    ->color(fn(string $state): string => match ($state) {
                        Status::PENDING->value => 'warning',
                        Status::ACCEPTED->value => 'info',
                        Status::REJECTED->value => 'danger',
                        Status::RELEASED->value => 'success',
                        Status::WAITING_FOR_RELEASE->value => 'success',
                        Status::REPORTED->value => 'danger',
                        Status::LOCKED->value => 'danger',
                        default => 'info',
                    })
                    ->label('Status'),
                Tables\Columns\TextColumn::make('sender_id')
                    ->label('Seller')
                    ->copyable()
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('receiver_id')
                    ->label('Buyer')
                    ->copyable()
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
