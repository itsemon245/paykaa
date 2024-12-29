<?php

namespace App\Filament\Resources;

use App\Enum\MethodCategory;
use App\Enum\MethodMode;
use App\Filament\Resources\DepositMethodResource\Pages;
use App\Filament\Resources\DepositMethodResource\RelationManagers;
use App\Models\DepositMethod;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Support\Enums\ActionSize;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DepositMethodResource extends Resource
{
    protected static ?string $model = DepositMethod::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        $methodCateogries = collect(MethodCategory::cases())->mapWithKeys(fn ($item) => [$item->value => $item->name])->toArray();
        $methodModes = collect(MethodMode::cases())->mapWithKeys(fn ($item) => [$item->value => $item->name])->toArray();
        return $form
            ->schema([
                Forms\Components\Select::make('category')
                    ->options($methodCateogries)
                    ->live()
                    ->reactive()
                    ->required(),
                Forms\Components\Select::make('mode')
                    ->options($methodModes)
                    ->default('manual')
                    ->required(),
                Forms\Components\TextInput::make('label')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('number')
                    ->label(fn (Get $get) => $get('category') !== MethodCategory::CRYPTO->value ? 'Account Number' : 'Wallet Address')
                    ->placeholder(fn (Get $get) => $get('category') !== MethodCategory::CRYPTO->value ? 'Account Number' : '0x...')
                    ->required()
                    ->maxLength(255),
                Forms\Components\FileUpload::make('logo')
                    ->extraAttributes(['accept' => 'image/*' ])
                    ->columnSpanFull()
                    // ->columnSpan(fn (Get $get) => $get('category') !== MethodCategory::CRYPTO->value ? 2 : 1)
                    ->required(),
                // Forms\Components\FileUpload::make('metadata.qr_code')
                //     ->label('QR Code')
                //     ->hidden(fn (Get $get) => $get('category') !== MethodCategory::CRYPTO->value)
                //     ->extraAttributes(['accept' => 'image/*' ])
                //     ->required(),
                Forms\Components\Repeater::make('metadata')
                    ->label('QR Code')
                    ->hidden(fn (Get $get) => $get('category') !== MethodCategory::CRYPTO->value)
                    ->addable(false)
                    ->deletable(false)
                    ->reorderable(false)
                    ->collapsible(false)
                    ->columnSpanFull()
                    ->schema([
                        Forms\Components\FileUpload::make('qr_code')
                            ->label('')
                            ->extraAttributes(['accept' => 'image/*' ])
                            ->required(),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('logo'),
                Tables\Columns\TextColumn::make('label')
                    ->searchable(),
                Tables\Columns\TextColumn::make('category')
                    ->badge()
                    ->colors([
                        'bank' => 'success',
                        'crypto' => 'warning',
                        'mobile_banking' => 'info',
                    ])
                    ->extraAttributes(['class'=> 'capitalize'])
                    ->searchable(),
                Tables\Columns\TextColumn::make('number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('mode')
                    ->badge()
                    ->colors([
                        'manual' => 'success',
                        'auto' => 'warning',
                    ])
                    ->extraAttributes(['class'=> 'capitalize'])
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                    ActionGroup::make([
                                        Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                    ])
                    ->tooltip('Actions')
                    ->size(ActionSize::Large)

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageDepositMethods::route('/'),
        ];
    }
}
