<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TestimonialResource\Pages;
use App\Models\Testimonial;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Actions;
use Filament\Forms\Components\Actions\Action;
class TestimonialResource extends Resource
{
    protected static ?string $model = Testimonial::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

public static function form(Form $form): Form
{
    return $form
        ->schema([
            Tabs::make('Content Tabs')
                ->tabs([
                    Tab::make('English')
                        ->schema([
                            TextInput::make('title.en')->label('About'),
                            TextInput::make('description.en')->label('Vision'),
                        ]),
                    Tab::make('العربية')
                        ->schema([
                            TextInput::make('title.ar')->label('عنوان'),
                            TextInput::make('description.ar')->label('وصف'),
                        ]),
                ])
                ->columnSpanFull(),
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
                ->preserveFilenames()
                ->directory('testimonials')
                  ->enableOpen()
                    ->enableDownload()
                ->visibility('public')
                ->columnSpanFull(),
                  
        ]);
}


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                    Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                       Tables\Columns\TextColumn::make('description')
                    ->searchable(),
                    Tables\Columns\ImageColumn::make('image')
                    ->label('image')
                    ->getStateUsing(fn($record) => asset('storage/' . $record->image))
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
            'index' => Pages\ListTestimonials::route('/'),
            'create' => Pages\CreateTestimonial::route('/create'),
            'edit' => Pages\EditTestimonial::route('/{record}/edit'),
        ];
    }
}
