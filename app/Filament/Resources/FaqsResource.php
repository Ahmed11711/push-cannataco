<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FaqsResource\Pages;
use App\Filament\Resources\FaqsResource\RelationManagers;
use App\Models\Faqs;
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
class FaqsResource extends Resource
{
    protected static ?string $model = Faqs::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

public static function form(Form $form): Form
{
    return $form
        ->schema([
            Tabs::make('FAQ Tabs')
                ->tabs([
                    Tab::make('العربية')
                        ->schema([
                            TextInput::make('key.ar')->label('العنوان')->required(),
                            RichEditor::make('value.ar')->label('المحتوى'),
                        ]),
                    Tab::make('الإنجليزية')
                        ->schema([
                            TextInput::make('key.en')->label('ASK')->required(),
                            RichEditor::make('value.en')->label('Answer'),
                        ]),
                ])
                ->columnSpanFull(),
        ]);
}


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
            'index' => Pages\ListFaqs::route('/'),
            'create' => Pages\CreateFaqs::route('/create'),
            'edit' => Pages\EditFaqs::route('/{record}/edit'),
        ];
    }
}
