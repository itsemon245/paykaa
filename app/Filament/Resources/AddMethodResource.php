<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AddMethodResource\Pages;
use App\Filament\Resources\AddMethodResource\RelationManagers;
use App\Models\AddMethod;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\ActionSize;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AddMethodResource extends Resource
{
    protected static ?string $model = AddMethod::class;

    protected static ?string $navigationLabel = 'Ad Wallets';
    protected static ?string $modelLabel = 'Ad Wallet';
    protected static ?string $pluralModelLabel = 'Ad Wallets';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->columnSpanFull()
                    ->unique()
                    ->required()
                    ->maxLength(255),
                // Forms\Components\TextInput::make('logo')
                //     ->maxLength(255)
                //     ->default(null),
                // Forms\Components\TextInput::make('color')
                //     ->maxLength(255)
                //     ->default(null),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                // Tables\Columns\TextColumn::make('logo')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('color')
                //     ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
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
            'index' => Pages\ManageAddMethods::route('/'),
        ];
    }
}
