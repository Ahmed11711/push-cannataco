<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SettingResource\Pages;
use App\Filament\Resources\SettingResource\RelationManagers;
use App\Models\Setting;
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
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Actions;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;

class SettingResource extends Resource
{
    protected static ?string $model = Setting::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Actions::make([
                    Action::make('delete_logo')
                        ->icon('heroicon-o-trash')
                        ->color('danger')
                        ->iconButton()
                        ->action(fn(callable $set) => $set('logo', null)),
                ]),
                FileUpload::make('logo')
                    ->label('logo')
                    ->image()
                    ->required()
                    ->imageEditor()
                    ->preserveFilenames()
                    ->directory('logo')
                    ->visibility('public')
                    ->enableOpen()
                    ->enableDownload()
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('phone')
                    ->tel()
                    ->maxLength(255),
                Forms\Components\TextInput::make('phone_two')
                    ->tel()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email_two')
                    ->email()
                    ->maxLength(255),
                Forms\Components\TextInput::make('address')
                    ->maxLength(255)
                    ->columnSpanFull(),

                Forms\Components\TextInput::make('facebook')
                    ->maxLength(255),
                Forms\Components\TextInput::make('twitter')
                    ->maxLength(255),
                Forms\Components\TextInput::make('instagram')
                    ->maxLength(255),
                Forms\Components\TextInput::make('youtube')
                    ->maxLength(255),
                Forms\Components\TextInput::make('location')->columnSpanFull(),
                Tabs::make('Content Tabs')
                    ->tabs([
                        Tab::make('English')->schema([
                            Forms\Components\TextInput::make('working_hours.en')
                                ->label('Working Hours')
                                ->required(),
                        ]),
                        Tab::make('العربية')->schema([
                            Forms\Components\TextInput::make('working_hours.ar')
                                ->label('ساعات العمل')
                                ->required(),
                        ]),
                    ])
                    ->columnSpanFull(),
                Repeater::make('locations')
                    ->label('Locations')
                    ->relationship('locations')
                    ->schema([
                        Tabs::make('Location Tabs')
                            ->tabs([
                                Tab::make('English')
                                    ->schema([
                                        TextInput::make('name.en')->label('Name'),
                                    ]),
                                Tab::make('العربية')
                                    ->schema([
                                        TextInput::make('name.ar')->label('الاسم'),
                                    ]),
                            ])
                            ->columnSpanFull(),
                            TextInput::make('latitude')->label('Latitude'),
                            TextInput::make('longitude')->label('Longitude'),
                    ])
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('logo')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone_two')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email_two')
                    ->searchable(),
                Tables\Columns\TextColumn::make('address')
                    ->searchable(),
                Tables\Columns\TextColumn::make('facebook')
                    ->searchable(),
                Tables\Columns\TextColumn::make('twitter')
                    ->searchable(),
                Tables\Columns\TextColumn::make('instagram')
                    ->searchable(),
                Tables\Columns\TextColumn::make('youtube')
                    ->searchable(),
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
            'index' => Pages\ListSettings::route('/'),
            'create' => Pages\CreateSetting::route('/create'),
            'edit' => Pages\EditSetting::route('/{record}/edit'),
        ];
    }
}
