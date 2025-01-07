<?php

namespace App\Filament\Resources;

use App\Enum\MethodCategory;
use App\Enum\MethodMode;
use App\Filament\Resources\DepositMethodResource\Pages;
use App\Filament\Resources\DepositMethodResource\RelationManagers;
use App\Models\DepositMethod;
use Filament\Forms;
use Filament\Forms\Components\KeyValue;
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
                    ->placeholder('Choose a category')
                    ->live()
                    ->reactive()
                    ->required(),
                Forms\Components\Select::make('mode')
                    ->live()
                    ->placeholder('Choose a mode')
                    ->hidden(fn (Get $get) => $get('category') !== MethodCategory::MOBILE_BANKING->value)
                    ->options($methodModes)
                    ->required(),
                Forms\Components\TextInput::make('label')
                    ->label('Name')
                    ->placeholder('Name')
                    ->columnSpan(fn(Get $get)=> $get('mode') === MethodMode::PAYMENT->value ? 'full' : 1)
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('number')
                    ->label(fn (Get $get) => $get('category') !== MethodCategory::CRYPTO->value ? 'Account Number' : 'Wallet Address')
                    ->hidden(fn (Get $get) => !$get('category') || $get('mode') === MethodMode::PAYMENT->value || $get('category') === MethodCategory::CRYPTO->value)
                    ->placeholder(fn (Get $get) => $get('category') !== MethodCategory::CRYPTO->value ? 'Account Number' : '0x...')
                    ->columnSpan(fn(Get $get)=> $get('category') !== MethodCategory::MOBILE_BANKING->value ? 'full' : 1)
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('charge')
                    ->label('Service Charge')
                    ->placeholder('0')
                    ->numeric()
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('is_fixed_amount')
                    ->label('Charge Type')
                    ->options([
                        true => 'Fixed Amount',
                        false => 'Percentage',
                    ])
                    ->required(),
                Forms\Components\KeyValue::make('additional_fields')
                    ->label('Wallet Details')
                    ->required()
                    ->hidden(fn (Get $get) => $get('category') !== MethodCategory::CRYPTO->value)
                    ->keyLabel('Name')
                    ->keyPlaceholder('Name')
                    ->valuePlaceholder('Value')
                    ->reorderable()
                    ->addActionLabel('Add New')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('branch_name')
                    ->hidden(fn (Get $get) => $get('category') !== MethodCategory::BANK->value)
                    ->placeholder('Branch Name')
                    ->label('Branch Name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('account_holder')
                    ->hidden(fn (Get $get) => $get('category') !== MethodCategory::BANK->value)
                    ->placeholder('Account Holder Name')
                    ->label('Account Holder Name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('swift_code')
                    ->hidden(fn (Get $get) => $get('category') !== MethodCategory::BANK->value)
                    ->placeholder('Swift Code')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('routing_number')
                    ->hidden(fn (Get $get) => $get('category') !== MethodCategory::BANK->value)
                    ->placeholder('Routing Number')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Repeater::make('secrets')
                    ->hidden(fn (Get $get) => $get('mode') !== MethodMode::PAYMENT->value)
                    ->label('Secrets')
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('username')
                            ->placeholder('Username')
                            ->required(),
                        Forms\Components\TextInput::make('password')
                            ->password()
                            ->revealable()
                            ->placeholder('Password')
                            ->required(),
                        Forms\Components\TextInput::make('app_id')
                            ->label('App ID')
                            ->placeholder('App ID')
                            ->required(),
                        Forms\Components\TextInput::make('app_secret')
                            ->password()
                            ->revealable()
                            ->placeholder('App Secret')
                            ->required(),
                    ])
                    ->addable(false)
                    ->deletable(false)
                    ->reorderable(false)
                    ->collapsible(false)
                    ->columnSpanFull(),
                Forms\Components\FileUpload::make('logo')
                    ->image()
                    ->extraAttributes(['accept' => 'image/*' ])
                    ->columnSpanFull()
                    ->required(),
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
                            ->maxWidth('300px')
                            ->maxSize(1024)
                            ->image()
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
                    ->label('Name')
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
                    ->placeholder('Not applicable')
                    ->searchable(),
                Tables\Columns\TextColumn::make('mode')
                    ->badge()
                    ->placeholder('Not applicable')
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
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageDepositMethods::route('/'),
        ];
    }
}
