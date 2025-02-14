<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LandingPageResource\Pages;
use App\Models\LandingPage;
use App\Models\Model;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\ActionSize;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Table;

class LandingPageResource extends Resource
{
    protected static ?string $model = LandingPage::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Landing Page';

    public static function getNavigationUrl(): string
    {
        return '/admin/landing-pages/1/edit';
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Fieldset::make('hero')
                    ->label('Hero Section')
                    ->schema([
                        TextInput::make('hero.title')
                            ->required()
                            ->columnSpanFull()
                            ->default('Protecting your money is our responsibility'),
                        Textarea::make('hero.description')
                            ->required()
                            ->columnSpanFull()
                            ->default('We are here to help you protect your money. We will help you to make sure that you are making the right choices and that you are not being scammed.'),
                        FileUpload::make('hero.image_mobile')
                            ->required(),
                        FileUpload::make('hero.image_desktop')
                            ->required()

                    ])->columns(2),
                Fieldset::make('about')
                    ->label('About Us')
                    ->schema([
                        TextInput::make('about.title')
                            ->default('About us')
                            ->required(),
                        TextInput::make('about.email')
                            ->email()
                            ->default('info@paykaa.com')
                            ->required(),
                        TextInput::make('about.phone')
                            ->default('+8801643428395')
                            ->required(),
                        TextInput::make('about.address')
                            ->default('Dhaka, Bangladesh')
                            ->required(),
                        Textarea::make('about.description')
                            ->default('We are a team of developers, designers, and product managers who are passionate about making the world a better place. We believe that everyone deserves access to financial services and we are committed to making that a reality.')
                            ->required(),
                        // FileUpload::make('image')
                        //     ->required()
                    ])->columns(1),

                Fieldset::make('how_it_works')
                    ->label('How it works')
                    ->schema([
                        Repeater::make('how_it_works')
                            ->label('Sections')
                            ->itemLabel(fn(array $state): ?string => $state['name'] ?? null)
                            ->reorderable(false)
                            ->deletable(false)
                            ->addable(false)
                            ->schema([
                                TextInput::make('name')
                                    ->visible(false)
                                    ->required(),
                                TextInput::make('title')
                                    ->required(),
                                Textarea::make('description')
                                    ->required(),
                                FileUpload::make('image')
                            ]),
                    ])->columns(1),
                Repeater::make('socials')
                    ->label('Social Media')
                    ->itemLabel(fn(array $state): ?string => $state['title'] ?? null)
                    ->reorderable(false)
                    ->deletable(false)
                    ->addable(false)
                    ->schema([
                        TextInput::make('title')
                            ->visible(false)
                            ->required(),
                        TextInput::make('url')
                            ->hiddenLabel(true)
                            ->url(true)
                            ->required(),
                    ])
                    ->grid(2)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([])
            ->filters([
                //
            ])
            ->actions([]);
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
            'index' => Pages\EditLandingPage::route('/'),
            'edit' => Pages\EditLandingPage::route('/{record}/edit'),
        ];
    }
}
