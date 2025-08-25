<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactResource\Pages;
use App\Models\Contact;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ContactResource extends Resource
{
    protected static ?string $model = Contact::class;

    protected static ?string $navigationIcon = 'heroicon-o-envelope';
    public static function getNavigationLabel(): string
    {
        return __('message.messages');
    }
    public static function getModelLabel(): string
    {
        return __('message.message');
    }
      public static function getNavigationGroup(): ?string
    {
        return __('Customer Service');
    }
    public static function getPluralModelLabel(): string
    {
        return __('message.messages');
    }
    public static function getNavigationBadge(): ?string
    {
        return \App\Models\Contact::where('is_read', false)->count();
    }

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
                Forms\Components\Textarea::make('subject')
                    ->readOnly()
                    ->disabled()

                    ->columnSpanFull(),
                Forms\Components\Textarea::make('message')
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
                   
                    ->label(__('message.name'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
           
                    ->label(__('message.email'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label(__('message.phone'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('subject')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label(__('message.subject'))
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_read')
              
                    ->label(__('message.read'))
                    ->boolean(),
                Tables\Columns\IconColumn::make('is_replied')
                  
                    ->label(__('message.replied'))
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('message.create'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label(__('message.update'))
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
            'index' => Pages\ListContacts::route('/'),
            'create' => Pages\CreateContact::route('/create'),
            'edit' => Pages\EditContact::route('/{record}/edit'),
            'view' => Pages\ViewContact::route('/{record}'),
        ];
    }
}
