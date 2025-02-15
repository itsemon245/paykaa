<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\Model;
use App\Models\User;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\ActionSize;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use stdClass;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?int $navigationSort = 9;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('avatar')
                    ->alignCenter()
                    ->avatar()
                    ->disabled()
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('email')
                    ->disabled(),
                \App\Forms\Components\Copyable::make('id')
                    ->label('UID'),
                Forms\Components\TextInput::make('name')
                    ->disabled()
                    ->required(),
                Forms\Components\TextInput::make('phone')
                    ->disabled(),
                Forms\Components\TextInput::make('gender')
                    ->readOnly(),
                Forms\Components\DatePicker::make('date_of_birth')
                    ->format('d M, Y')
                    ->disabled(),
                Forms\Components\TextInput::make('country')
                    ->disabled(),
                Forms\Components\TextInput::make('address')
                    ->disabled(),
                Forms\Components\TextInput::make('referral_id')
                    ->readOnly()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(
                fn(Builder $query) => $query->with('kyc')->whereNot('id', auth()->user()->id)->orderBy('id', 'asc')
            )->columns([
                Tables\Columns\TextColumn::make('#')->state(
                    static function (HasTable $livewire, stdClass $rowLoop): string {
                        return (string) (
                            $rowLoop->iteration +
                            ($livewire->getTableRecordsPerPage() * (
                                $livewire->getTablePage() - 1
                            ))
                        );
                    }
                ),
                Tables\Columns\ImageColumn::make('avatar'),
                Tables\Columns\TextColumn::make('id')
                    ->label('UID')
                    ->copyable(true),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                Tables\Columns\TextColumn::make('date_of_birth')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('gender')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                Tables\Columns\TextColumn::make('country')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('kyc.status')
                    ->label('Verifed')
                    ->icon(fn($state) => match ($state) {
                        'Approved' => 'heroicon-o-check-circle',
                        'Rejected' => 'heroicon-o-x-circle',
                        default => 'heroicon-o-clock',
                    })
                    ->badge()
                    ->color(fn($state) => match ($state) {
                        'Approved' => 'success',
                        'Rejected' => 'danger',
                        default => 'warning',
                    })
                    ->placeholder('Not submitted Yet')
                    ->sortable(),
                Tables\Columns\TextColumn::make('referral_id')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\Action::make('Action')
                    ->icon('heroicon-o-user')
                    ->color('warning')
                    ->url(fn(User $record) => url('/admin/login-as/' . $record->uuid))
                    ->size(ActionSize::Large),
                Tables\Actions\ViewAction::make()->modalFooterActions([
                    Tables\Actions\Action::make('Action')
                        ->icon('heroicon-o-user')
                        ->color('warning')
                        ->url(fn(User $record) => url('/admin/login-as/' . $record->uuid))
                        ->size(ActionSize::Large),
                    Tables\Actions\DeleteAction::make(),
                ]),
                // ActionGroup::make([
                //     // Tables\Actions\EditAction::make(),
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
            'index' => Pages\ManageUsers::route('/'),
        ];
    }
}
