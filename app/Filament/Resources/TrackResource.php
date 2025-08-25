<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TrackResource\Pages;
use App\Models\Track;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;

class TrackResource extends Resource
{
    protected static ?string $model = Track::class;
    public static function getNavigationGroup(): ?string
    {
        return __('Orders');
    }
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        Forms\Components\Select::make('country_sender_id')
                            ->relationship('countrySender', 'name')
                            ->searchable()
                            ->preload()
                            ->live()
                            ->label('Country Sender')
                            ->columnSpanFull()
                            ->required(),

                        Forms\Components\Select::make('state_sender_id')
                            ->options(function (Get $get): \Illuminate\Support\Collection {
                                $countryId = $get('country_sender_id');
                                if (!$countryId) return collect();
                                return \App\Models\State::where('country_id', $countryId)->pluck('name', 'id');
                            })
                            ->searchable()
                            ->preload()
                            ->live()
                            ->label('State Sender')
                            ->required(),

                        Forms\Components\Select::make('city_sender_id')
                            ->options(function (Get $get): \Illuminate\Support\Collection {
                                $stateId = $get('state_sender_id');
                                if (!$stateId) return collect();
                                return \App\Models\City::where('state_id', $stateId)->pluck('name', 'id');
                            })
                            ->searchable()
                            ->label('City Sender')
                            ->preload()
                            ->required(),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),
                Card::make()
                    ->schema([
                        Forms\Components\Select::make('country_reseved_id')
                            ->relationship('countryReceived', 'name')
                            ->searchable()
                            ->columnSpanFull()
                            ->preload()
                            ->live()
                            ->label('Country Received')
                            ->required(),

                        Forms\Components\Select::make('state_reseved_id')
                            ->options(function (Get $get): \Illuminate\Support\Collection {
                                $countryId = $get('country_reseved_id');
                                if (!$countryId) return collect();
                                return \App\Models\State::where('country_id', $countryId)->pluck('name', 'id');
                            })
                            ->searchable()
                            ->preload()
                            ->live()
                            ->label('State Received')
                            ->required(),

                        Forms\Components\Select::make('city_reseved_id')
                            ->options(function (Get $get): \Illuminate\Support\Collection {
                                $stateId = $get('state_reseved_id');
                                if (!$stateId) return collect();
                                return \App\Models\City::where('state_id', $stateId)->pluck('name', 'id');
                            })
                            ->searchable()
                            ->preload()
                            ->label('City Received')
                            ->required(),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),
                Repeater::make('shippingMethods')
                    ->relationship('shippingMethods')
                    ->schema([
                        Select::make('type')
                            ->options([
                                'air' => 'Air',
                                'sea' => 'Sea',
                                'land' => 'Land',
                            ])
                            ->required(),

                        TextInput::make('price')
                            ->numeric()
                            ->required()
                            ->label('Price'),
                    ])
                    ->columns(1)
                    ->columnSpanFull()
                    ->collapsible()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('countrySender.name')
                    ->label('Country Sender')
                    ->sortable(),

                Tables\Columns\TextColumn::make('stateSender.name')
                    ->label('State Sender')
                    ->sortable(),

                Tables\Columns\TextColumn::make('citySender.name')
                    ->label('City Sender')
                    ->sortable(),

                Tables\Columns\TextColumn::make('countryReceived.name')
                    ->label('Country Received')
                    ->sortable(),

                Tables\Columns\TextColumn::make('stateReceived.name')
                    ->label('State Received')
                    ->sortable(),

                Tables\Columns\TextColumn::make('cityReceived.name')
                    ->label('City Received')
                    ->sortable(),

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
            'index' => Pages\ListTracks::route('/'),
            'create' => Pages\CreateTrack::route('/create'),
            'edit' => Pages\EditTrack::route('/{record}/edit'),
        ];
    }
}
