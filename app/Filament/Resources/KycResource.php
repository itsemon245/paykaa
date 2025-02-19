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
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use stdClass;

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
            ->disabled()
            ->schema([
                Forms\Components\Fieldset::make('User')
                    ->relationship('user')
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
            ->modifyQueryUsing(function (Builder $builder) {
                $builder->with('user');
            })
            ->columns([
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
                Tables\Columns\ImageColumn::make('user.avatar')->label('Avatar'),
                Tables\Columns\TextColumn::make('user.id')->label('UID')->copyable(),
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
                    ->color(fn(Kyc $kyc) => match ($kyc->status) {
                        'Approved' => 'success',
                        'Pending' => 'warning',
                        'Rejected' => 'danger',
                    })
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
                // ...self::getActions(),
                Tables\Actions\ViewAction::make()->modalFooterActions(self::getActions()),
            ])
            ->bulkActions([]);
    }
    public static function getActions(): array
    {
        return [
            Action::make('Approve')
                ->requiresConfirmation()
                ->hidden(fn(Model $record) => $record->approved_at || $record->rejected_at)
                ->tooltip('Approve')
                ->action(fn(Model $record) => $record->update(['approved_at' => now(), 'rejected_at' => null]))
                ->size(ActionSize::Large)
                ->after(function () {
                    $indexUrl = self::getUrl();
                    if (url()->current() !== $indexUrl) {
                        redirect($indexUrl);
                    }
                })
                ->color('success')
                ->icon('heroicon-o-check-circle'),
            Action::make('Reject')
                ->requiresConfirmation()
                ->after(function () {
                    $indexUrl = self::getUrl();
                    if (url()->current() !== $indexUrl) {
                        redirect($indexUrl);
                    }
                })
                ->hidden(fn(Model $record) => $record->rejected_at)
                ->tooltip('Reject')
                ->action(fn(Model $record) => $record->update(['rejected_at' => now(), 'approved_at' => null]))
                ->size(ActionSize::Large)
                ->color('danger')
                ->icon('heroicon-o-x-circle'),
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageKycs::route('/'),
        ];
    }
}
