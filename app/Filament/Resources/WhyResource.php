<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WhyResource\Pages;
use App\Models\Why;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Actions;
use Filament\Forms\Components\Actions\Action;
class WhyResource extends Resource
{
    protected static ?string $model = Why::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

public static function form(Form $form): Form
{
    return $form
        ->schema([
            Tabs::make('Content Tabs')
                ->tabs([
                    Tab::make('English')->schema([
                        TextInput::make('name.en')
                        ->label('why')
                        ->required(),
                        RichEditor::make('description.en')
                        ->label('description'),
                    ]),
                    Tab::make('العربية')->schema([
                        TextInput::make('name.ar')
                        ->label('عنوان'
                        )->required(),
                        RichEditor::make('description.ar')
                        ->label('description'),
                    ])
                ])->columnSpanFull(),
   Actions::make([
                Action::make('delete_image')
                    ->icon('heroicon-o-trash')
                    ->color('danger')
                    ->iconButton()
                    ->action(fn (callable $set) => $set('image', null)),
            ]),
            FileUpload::make('image')
                ->label('image')
                ->image()
                ->imageEditor()
                  ->enableOpen()
                    ->enableDownload()
                ->preserveFilenames()
                ->directory('testimonials')
                ->visibility('public')
                ->disk('public')
                ->columnSpanFull(),
        ]);
}

public static function table(Table $table): Table
{
    return $table
        ->columns([
            Tables\Columns\TextColumn::make('name')
                ->label(__('name')),
                
            Tables\Columns\ImageColumn::make('image')
                ->label('image')
                ->disk('public')
                ->circular()
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
                Tables\Actions\DeleteAction::make(),            ])
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
            'index' => Pages\ListWhies::route('/'),
            'create' => Pages\CreateWhy::route('/create'),
            'edit' => Pages\EditWhy::route('/{record}/edit'),
        ];
    }
}
