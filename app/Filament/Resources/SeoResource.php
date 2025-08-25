<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SeoResource\Pages;
use App\Models\Seo;
use Filament\Forms;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SeoResource extends Resource
{
    protected static ?string $model = Seo::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrow-trending-up';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Content Tabs')
                    ->tabs([
                        Tab::make('العربية')
                            ->schema([
                                Forms\Components\TextInput::make('meta_title.ar')->label('العنوان')
                                    ->label('عنوان الميتا'),
                            ]),
                        Tab::make('الإنجليزية')
                            ->schema([
                                Forms\Components\TextInput::make('meta_title.en')->label('Title')
                                    ->label('meta_title')
                            ]),
                    ])->columnSpanFull(),

                Forms\Components\TextInput::make('meta_description')
                    ->label('Meta Description')
                    ->columnSpanFull(),

                Forms\Components\TextInput::make('meta_keywords')
                    ->label('Meta Keywords')
                    ->maxLength(255)
                    ->columnSpanFull(),

                Forms\Components\TextInput::make('canonical_url')
                    ->label('Canonical URL')
                    ->maxLength(255),

                Forms\Components\TextInput::make('meta_robots')
                    ->label('Meta Robots')
                    ->required()
                    ->default('index, follow')
                    ->maxLength(255),

                Forms\Components\FileUpload::make('og_image')
                    ->label('OG Image')
                    ->image()
                    ->directory('seo/og_images')
                    ->preserveFilenames()
                    ->imageEditor()
                    ->visibility('public')
                    ->enableOpen()
                    ->enableDownload()
                    ->columnSpanFull(),

                Forms\Components\Hidden::make('model_type'),
                Forms\Components\Hidden::make('model_id'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('model_type')
                    ->label('Model Type')
                    ->formatStateUsing(fn($state) => class_basename($state))
                    ->searchable(),

                Tables\Columns\TextColumn::make('meta_title')
                    ->label('Meta Title')
                    ->searchable(),

                Tables\Columns\TextColumn::make('model.name')
                    ->label('Model')
                    ->searchable(),

                Tables\Columns\TextColumn::make('meta_description')
                    ->label('Meta Description')
                    ->searchable(),

                Tables\Columns\TextColumn::make('meta_keywords')
                    ->label('Meta Keywords')
                    ->searchable(),

                Tables\Columns\TextColumn::make('meta_robots')
                    ->label('Meta Robots')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),

                Tables\Columns\ImageColumn::make('og_image')
                    ->label('OG Image')
                    ->disk('public')
                    ->circular()
                    ->size(50)
                    ->getStateUsing(fn($record) => $record->og_image ? asset('storage/' . $record->og_image) : null)
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Updated At')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListSeos::route('/'),
            'create' => Pages\CreateSeo::route('/create'),
            'edit'   => Pages\EditSeo::route('/{record}/edit'),
        ];
    }
}
