<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SettingResource\Pages;
use App\Filament\Resources\SettingResource\RelationManagers;
use App\Models\Setting;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\ActionSize;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SettingResource extends Resource
{
    protected static ?string $model = Setting::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog-8-tooth';
    protected static ?string $navigationLabel = 'Settings';

    public static function getNavigationUrl(): string
    {
        return '/admin/settings/1/edit';
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Fieldset::make('Transactions')
                    ->statePath('transactions')
                    ->schema([
                        TextInput::make('min_deposit_amount')
                            ->label('Min Deposit Amount')
                            ->step(0.01)
                            ->type('number')
                            ->suffixIcon('heroicon-o-currency-bangladeshi')
                            ->numeric(),
                        TextInput::make('min_withdraw_amount')
                            ->label('Min Withdraw Amount')
                            ->step(0.01)
                            ->type('number')
                            ->suffixIcon('heroicon-o-currency-bangladeshi')
                            ->numeric(),
                        TextInput::make('base_commission')
                            ->type('number')
                            ->step(0.01)
                            ->label('Base Commission')
                            ->suffixIcon('phosphor-percent')
                            ->numeric(),
                        TextInput::make('referral_commission')
                            ->type('number')
                            ->step(0.01)
                            ->label('Referral Commission')
                            ->suffixIcon('heroicon-o-currency-bangladeshi')
                            ->numeric(),
                        TextInput::make('min_earnable_amount')
                            ->type('number')
                            ->step(0.01)
                            ->label('Max Earnable Amount')
                            ->suffixIcon('heroicon-o-currency-bangladeshi')
                            ->numeric(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                ])
                    ->tooltip('Actions')
                    ->size(ActionSize::Large)

            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSettings::route('/'),
            'create' => Pages\CreateSetting::route('/create'),
            'edit' => Pages\EditSetting::route('/{record}/edit'),
        ];
    }
}
