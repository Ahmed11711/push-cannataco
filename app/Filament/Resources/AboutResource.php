<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AboutResource\Pages;
use App\Models\About;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Repeater;

class AboutResource extends Resource
{
    protected static ?string $model = About::class;

    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

public static function form(Form $form): Form
{
    return $form
        ->schema([
            Tabs::make('Content Tabs')
                ->tabs([
                    Tab::make('English')
                        ->schema([
                            RichEditor::make('about.en')->label('About'),
                            RichEditor::make('vision.en')->label('Vision'),
                            RichEditor::make('mission.en')->label('Mission'),
                        ]),
                    Tab::make('العربية')
                        ->schema([
                            RichEditor::make('about.ar')->label('من نحن'),
                            RichEditor::make('vision.ar')->label('رؤيتنا'),
                            RichEditor::make('mission.ar')->label('مهمتنا'),
                        ]),
                ])
                ->columnSpanFull(),

            Repeater::make('histories')
                ->label('history')
                ->relationship('histories')
                ->schema([
                    Tabs::make('Content Tabs')
                        ->tabs([
                            Tab::make('English')
                                ->schema([
                                    TextInput::make('title.en')->label('Title'),
                                    RichEditor::make('content.en')->label('Content'),
                                ]),
                            Tab::make('العربية')
                                ->schema([
                                    TextInput::make('title.ar')->label('العنوان'),
                                    RichEditor::make('content.ar')->label('المحتوى'),
                                ]),
                        ])
                        ->columnSpanFull(),

                    FileUpload::make('image')
                        ->label('Image')
                        ->image()
                        ->required()
                        ->imageEditor()
                        ->preserveFilenames()
                        ->directory('history')
                        ->visibility('public')
                        ->enableOpen()
                        ->enableDownload()
                        ->columnSpanFull(),

                    TextInput::make('date')->label('history'),
                ])
                ->columnSpanFull(),
        ]);
}


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
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
            'index' => Pages\ListAbouts::route('/'),
            'create' => Pages\CreateAbout::route('/create'),
            'edit' => Pages\EditAbout::route('/{record}/edit'),
        ];
    }
}
