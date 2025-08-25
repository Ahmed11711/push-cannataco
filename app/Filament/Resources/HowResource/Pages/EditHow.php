<?php

namespace App\Filament\Resources\HowResource\Pages;

use App\Filament\Resources\HowResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHow extends EditRecord
{
    protected static string $resource = HowResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
