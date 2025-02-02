<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KycResource\Pages;
use App\Filament\Resources\KycResource\RelationManagers;
use App\Models\Kyc;
use App\Models\Model;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\ActionSize;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class KycResource extends Resource
{
    protected static ?string $model = Kyc::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?int $navigationSort = 4;
    protected static ?string $navigationLabel = 'Verification Requests';
    protected static ?string $modelLabel =  'Verification Request';
    protected static ?string $pluralModelLabel = 'Verification Requests';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Fieldset::make('User')
                    ->relationship('user')
                    ->schema([
                        Forms\Components\TextInput::make('email')
                            ->disabled()
                            ->required(),
                        Forms\Components\TextInput::make('name')
                            ->disabled()
                            ->required(),
                        Forms\Components\TextInput::make('phone')
                            ->disabled(),
                        Forms\Components\TextInput::make('country')
                            ->disabled(),
                    ]),
                Forms\Components\TextInput::make('doc_type')
                    ->label('Document Type')
                    ->required()
                    ->columnSpanFull()
                    ->maxLength(255),
                Forms\Components\FileUpload::make('front_image')
                    ->downloadable()
                    ->openable(true)
                    ->image()
                    ->required(),
                Forms\Components\FileUpload::make('back_image')
                    ->downloadable()
                    ->openable(true)
                    ->image()
                    ->required(),
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.email')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('doc_type')
                    ->label('Document Type')
                    ->badge()
                    ->searchable()
                    ->sortable(),
                Tables\Columns\ImageColumn::make('front_image'),
                Tables\Columns\ImageColumn::make('back_image'),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->colors([
                        'approved' => 'success',
                        'pending' => 'warning',
                        'rejected' => 'danger',
                    ])
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('approved_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('approved_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Action::make('Approve')
                    ->requiresConfirmation()
                    ->hidden(fn(Model $record) => $record->approved_at)
                    ->tooltip('Approve')
                    ->action(fn(Model $record) => $record->update(['approved_at' => now(), 'rejected_at' => null]))
                    ->size(ActionSize::Large)
                    ->color('success')
                    ->icon('heroicon-o-check-circle'),
                Action::make('Reject')
                    ->requiresConfirmation()
                    ->hidden(fn(Model $record) => $record->rejected_at)
                    ->tooltip('Reject')
                    ->action(fn(Model $record) => $record->update(['rejected_at' => now(), 'approved_at' => null]))
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
            'index' => Pages\ManageKycs::route('/'),
        ];
    }
}
