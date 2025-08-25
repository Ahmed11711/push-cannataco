<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HowResource\Pages;
use App\Filament\Resources\HowResource\RelationManagers;
use App\Models\How;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;

class HowResource extends Resource
{
    protected static ?string $model = How::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

public static function form(Form $form): Form
{
    return $form
        ->schema([
            Tabs::make('How Tabs')
                ->tabs([
                    Tab::make('English')->schema([
                        TextInput::make('title.en')
                            ->label('Title')
                            ->required(),
                        RichEditor::make('content.en')
                            ->label('Content'),
                    ]),
                    Tab::make('العربية')->schema([
                        TextInput::make('title.ar') // غيّرت الاسم من name.ar إلى title.ar للتناسق
                            ->label('العنوان')
                            ->required(),
                        RichEditor::make('content.ar') // غيّرت الاسم من description.ar إلى content.ar للتناسق
                            ->label('المحتوى'),
                    ]),
                ])
                ->columnSpanFull(),
        ]);
}


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                ->label('title'),
                Tables\Columns\TextColumn::make('content')
                ->label('content')
                ->limit(50)
                  ->html(),
            ])
            ->filters([
                //
            ])
            ->actions([
    Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
                Tables\Actions\DeleteAction::make(),               ])
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
            'index' => Pages\ListHows::route('/'),
            'create' => Pages\CreateHow::route('/create'),
            'edit' => Pages\EditHow::route('/{record}/edit'),
        ];
    }
}
