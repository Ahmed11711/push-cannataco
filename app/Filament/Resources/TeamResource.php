<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TeamResource\Pages;
use App\Filament\Resources\TeamResource\RelationManagers;
use App\Models\Team;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
class TeamResource extends Resource
{
    protected static ?string $model = Team::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

public static function form(Form $form): Form
{
    return $form
        ->schema([
            // التبويبات الخاصة باللغات
            Tabs::make('Content Tabs')
                ->tabs([
                    Tab::make('العربية')
                        ->schema([
                            TextInput::make('name.ar')
                            ->label('الاسم')
                            ->required(),
                            TextInput::make('position.ar')->label('الوظيفه'),
                        ]),
                    Tab::make('الإنجليزية')
                        ->schema([
                            TextInput::make('name.en')->label('Name')->required(),
                            TextInput::make('position.en')->label('Position'),
                        ]),
                ])
                ->columnSpanFull(),

            // زر لحذف الصورة
            Forms\Components\Actions::make([
                Forms\Components\Actions\Action::make('delete_image')
                    ->icon('heroicon-o-trash')
                    ->color('danger')
                    ->iconButton()
                    ->action(fn(callable $set) => $set('image', null)),
            ]),

            // رفع الصورة
            FileUpload::make('image')
                ->label('image')
                ->image()
                ->required()
                ->imageEditor()
                ->preserveFilenames()
                ->directory('blog')
                ->visibility('public')
                ->enableOpen()
                ->enableDownload()
                ->columnSpanFull(),
        ]);
}


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
    Tables\Columns\TextColumn::make('name')
                ->label('title'),
                Tables\Columns\TextColumn::make('position')
                ->label('position')            ])
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
            'index' => Pages\ListTeams::route('/'),
            'create' => Pages\CreateTeam::route('/create'),
            'edit' => Pages\EditTeam::route('/{record}/edit'),
        ];
    }
}
