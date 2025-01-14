<?php

namespace App\Filament\Resources;

use App\Enum\InputType;
use App\Enum\MethodCategory;
use App\Filament\Resources\WithdrawMethodResource\Pages;
use App\Filament\Resources\WithdrawMethodResource\RelationManagers;
use App\Models\Model;
use App\Models\WithdrawMethod;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Support\Enums\ActionSize;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class WithdrawMethodResource extends Resource
{
    protected static ?string $model = WithdrawMethod::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?int $navigationSort = 7;

    public static function form(Form $form): Form
    {
        $methodCateogries = collect(MethodCategory::cases())->mapWithKeys(fn ($item) => [$item->value => $item->name])->toArray();
        return $form
            ->schema([
                Forms\Components\TextInput::make('label')
                    ->required()
                    ->label(fn(Get $get)=> $get('catgeory') ? $get('catgeory'). ' Name' : 'Name')
                    ->placeholder(fn(Get $get)=> $get('catgeory') ? $get('catgeory'). ' Name' : 'Name')
                    ->helperText('This is a visual name for the withdraw method')
                    ->maxLength(255),
                Forms\Components\Select::make('category')
                    ->options($methodCateogries)
                    ->live()
                    ->reactive()
                    ->required(),
                Forms\Components\FileUpload::make('logo')
                    ->extraAttributes(['accept' => 'image/*' ])
                    ->columnSpanFull()
                    ->required(),
                Forms\Components\Repeater::make('fields')
                    ->hidden(fn (Get $get) => !$get('category'))
                    ->label('Additional Fields')
                    ->columnSpanFull()
                    ->schema([
                        Forms\Components\TextInput::make('label')
                            ->label('Name')
                            ->placeholder('Field Name')
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (Set $set, ?string $state) => $set('name', Str::snake($state)))
                            ->required()
                            ->maxLength(255)
                            ->columnSpan(2),
                        Forms\Components\TextInput::make('name')
                            ->visible(false)
                            ->maxLength(255),
                        Forms\Components\Select::make('type')
                            ->options(collect(InputType::cases())->mapWithKeys(fn($item)=>[$item->value => $item->name])->toArray())
                            ->required()
                            ->default('text'),
                        Forms\Components\Select::make('required')
                            ->options([true => 'Yes', false => 'No'])
                            ->required()
                            ->default(false),
                        Forms\Components\TextInput::make('placeholder')
                            ->columnSpanFull()
                            ->placeholder('Field Placeholder (optional)')
                            ->maxLength(255),
                    ])
                    ->columns(4)
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
                Tables\Columns\TextColumn::make('fields')
                    ->formatStateUsing(function(string $state): string {
                        $fields = json_decode("[".$state."]");
                        $count = count($fields);
                        if($count > 0) {
                            return $count. " Additional Field".($count > 1 ? 's' : '');
                        }
                        return 'No Additional Fields';
                    }),
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
            'index' => Pages\ManageWithdrawMethods::route('/'),
        ];
    }
}
