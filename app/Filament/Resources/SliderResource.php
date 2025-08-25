<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SliderResource\Pages;
use App\Filament\Resources\SliderResource\RelationManagers;
use App\Models\Slider;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Actions;
use Filament\Forms\Components\Actions\Action;

class SliderResource extends Resource
{
    protected static ?string $model = Slider::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

  public static function form(Form $form): Form
{
    return $form
        ->schema([
            Tabs::make('Slider Tabs')
                ->tabs([
                    Tab::make('English')
                        ->schema([
                            TextInput::make('title.en')->label('Title'),
                            TextInput::make('desc.en')->label('Description'),
                            TextInput::make('btn_text.en')->label('Button'),
                        ]),
                    Tab::make('العربية')
                        ->schema([
                            TextInput::make('title.ar')->label('عنوان'),
                            TextInput::make('desc.ar')->label('وصف'),
                            TextInput::make('btn_text.ar')->label('زرار'),
                        ]),
                ])
                ->columnSpanFull(),

            TextInput::make('btn_link')->maxLength(255),
            TextInput::make('image_alt')->maxLength(255),
   Actions::make([
                Action::make('delete_image')
                    ->icon('heroicon-o-trash')
                    ->color('danger')
                    ->iconButton()
                    ->action(fn (callable $set) => $set('image', null)),
            ]),
            FileUpload::make('image')
                ->label(__('blog.image'))
                ->image()
                ->imageEditor()
                ->preserveFilenames()
                ->directory('slider')
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
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('desc')
                    ->searchable(),
                Tables\Columns\TextColumn::make('btn_link')
                    ->searchable(),
                Tables\Columns\TextColumn::make('btn_link')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('image'),
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
            'index' => Pages\ListSliders::route('/'),
            'create' => Pages\CreateSlider::route('/create'),
            'edit' => Pages\EditSlider::route('/{record}/edit'),
        ];
    }
}
