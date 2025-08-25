<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceResource\Pages;
use App\Filament\Resources\ServiceResource\RelationManagers;
use App\Models\Service;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Actions;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Textarea;

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;

 protected static ?string $navigationIcon = 'heroicon-o-sparkles';
    public static function getNavigationLabel(): string
    {
        return __('service.services');
    }
    public static function getModelLabel(): string
    {
        return __('service.service');
    }
    public static function getPluralModelLabel(): string
    {
        return __('service.services');
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Service Tabs')
                    ->tabs([
                        Tab::make('العربية')
                            ->schema([
                                TextInput::make('title.ar')->label('العنوان')->required(),
                                RichEditor::make('description.ar')->label('المحتوى'),
                            ]),
                        Tab::make('الإنجليزية')
                            ->schema([
                                TextInput::make('title.en')->label('Title')

                                    ->required(),
                                RichEditor::make('description.en')->label('Content'),
                            ]),
                    ])->columnSpanFull(),
                      Group::make([
                              Actions::make([
                Action::make('delete_icon')
                    ->icon('heroicon-o-trash')
                    ->color('danger')
                    ->iconButton()
                    ->action(fn (callable $set) => $set('icon', null)),
            ]),
            FileUpload::make('icon')
                ->label('Icon')
                ->image()
                ->required()
                ->imageEditor()
                ->enableOpen()
                ->enableDownload()
                ->preserveFilenames()
                ->directory('Service')
                ->visibility('public')
                ->columnSpanFull(),

        
        ]),

        Group::make([
                Actions::make([
                Action::make('delete_image')
                    ->icon('heroicon-o-trash')
                    ->color('danger')
                    ->iconButton()
                    ->action(fn (callable $set) => $set('image', null)),
            ]),
            FileUpload::make('image')
                ->label('Image')
                ->image()
                ->required()
                ->imageEditor()
                 ->enableOpen()
                ->enableDownload()
                ->preserveFilenames()
                ->directory('Service')
                ->visibility('public')
                ->columnSpanFull(),
        ]),
            Forms\Components\TextInput::make('image_alt')
            ->columnSpanFull(),
              Group::make()
                    ->relationship('seo')
                    ->schema([
                        Card::make()
                            ->schema([
                                TextInput::make('meta_title')
                                    ->label('meta title'),
                                TextInput::make('meta_keywords')
                                    ->label('meta keywords'),
                                TextInput::make('canonical_url')
                                    ->label('canonical url'),
                                TextInput::make('meta_robots')
                                    ->label('meta robots')
                                    ->default('index, follow'),
                                Textarea::make('meta_description')
                                    ->label('meta description')
                                    ->columnSpanFull(),
                                FileUpload::make('og_image')
                                    ->label('og image')
                                    ->columnSpanFull()
                                    ->image()
                                    ->enableOpen()
                                    ->enableDownload()
                                    ->enableOpen()
                                    ->directory('seo/og_images')
                                    ->preserveFilenames()
                                    ->imageEditor()
                                    ->visibility('public'),
                            ])
                            ->columns(2),
                    ])
                    ->columnSpanFull()
                    ->label('SEO'),
            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                    Tables\Columns\TextColumn::make('title')
                    ->searchable(),
             Tables\Columns\ImageColumn::make('image')
    ->label('Image')
    ->getStateUsing(fn($record) => asset('storage/' . $record->image))
    ->circular()
    ->disk('public')
    ->size(50),

Tables\Columns\ImageColumn::make('icon')
    ->label('Icon')
    ->getStateUsing(fn($record) => asset('storage/' . $record->icon))
    ->circular()
    ->disk('public')
    ->size(50),
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
                Tables\Actions\EditAction::make(),
                
                Tables\Actions\ViewAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListServices::route('/'),
            'create' => Pages\CreateService::route('/create'),
            'edit' => Pages\EditService::route('/{record}/edit'),
        ];
    }
}
