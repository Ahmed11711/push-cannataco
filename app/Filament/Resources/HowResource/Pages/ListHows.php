<?php

namespace App\Filament\Resources\HowResource\Pages;

use App\Filament\Resources\HowResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListHows extends ListRecords
{
    protected static string $resource = HowResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
