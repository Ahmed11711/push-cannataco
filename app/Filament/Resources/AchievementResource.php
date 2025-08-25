<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AchievementResource\Pages;
use App\Filament\Resources\AchievementResource\RelationManagers;
use App\Models\Achievement;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AchievementResource extends Resource
{
    protected static ?string $model = Achievement::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Content Tabs')
                    ->tabs([
                        Tab::make('English')
                            ->schema([
                                Forms\Components\TextInput::make('name.en')
                                    ->required()
                                    ->label('Name (English)'),
                            ])
                            ->columnSpanFull(),

                        Tab::make('العربية')
                            ->schema([
                                Forms\Components\TextInput::make('name.ar')
                                    ->required()
                                    ->label('Name (Arabic)'),
                            ])
                            ->columnSpanFull(),
                    ])->columnSpanFull(),


                FileUpload::make('icon')
                    ->label('Icon')
                    ->columnSpanFull()
                    ->image()
                    ->enableOpen()
                    ->enableDownload()
                    ->enableOpen()
                    ->directory('achievements/icons')
                    ->preserveFilenames()
                    ->imageEditor()
                    ->visibility('public'),

                Forms\Components\TextInput::make('count')
                    ->required()
                    ->numeric()
                    ->label('Count')
                    ->columnSpanFull()
                    ->default(0),
            ]);
    }
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('icon')
                    ->label('icon')
                    ->getStateUsing(fn($record) => asset('storage/' . $record->image))
                    ->circular()
                    ->disk('public')
                    ->size(50),
                Tables\Columns\TextColumn::make('count')
                    ->numeric()
                    ->sortable(),
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
            'index' => Pages\ListAchievements::route('/'),
            'create' => Pages\CreateAchievement::route('/create'),
            'edit' => Pages\EditAchievement::route('/{record}/edit'),
        ];
    }
}
