<?php

namespace App\Filament\Resources;

use App\Filament\Resources\QuoteResource\Pages;
use App\Models\Quote;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class QuoteResource extends Resource
{
    public static function getNavigationBadge(): ?string
    {
        return \App\Models\Quote::where('is_read', false)->count();
    }
    public static function getNavigationGroup(): ?string
    {
        return __('Customer Service');
    }
    protected static ?string $model = Quote::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->readOnly()
                    ->disabled()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->readOnly()
                    ->disabled()

                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('phone')
                    ->tel()
                    ->readOnly()
                    ->disabled()

                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
                    ->readOnly()
                    ->disabled()
                    ->columnSpanFull(),

                Forms\Components\Hidden::make('is_read')
                    ->required(),
                Forms\Components\Hidden::make('is_replied')
                    ->required(),
                Forms\Components\Textarea::make('reply')
                    ->label('reply')
                    ->maxLength(255)
                    ->columnSpanFull()
                    ->afterStateUpdated(function ($state, callable $set) {
                        if (! empty($state)) {
                            $set('is_replied', true);
                        }
                    }),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_read')

                    ->label(__('message.read'))
                    ->boolean(),
                Tables\Columns\IconColumn::make('is_replied')

                    ->label(__('message.replied'))
                    ->boolean(),
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
                Tables\Actions\EditAction::make()->label('replay'),
                Tables\Actions\ViewAction::make(),
                Tables\Actions\DeleteAction::make()
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
            'index' => Pages\ListQuotes::route('/'),
            'create' => Pages\CreateQuote::route('/create'),
            'view' => Pages\ViewQuote::route('/{record}'),
            'edit' => Pages\EditQuote::route('/{record}/edit'),
        ];
    }
}
