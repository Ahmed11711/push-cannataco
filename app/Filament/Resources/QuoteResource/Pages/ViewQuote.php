<?php

namespace App\Filament\Resources\QuoteResource\Pages;

use App\Filament\Resources\QuoteResource;
use Filament\Resources\Pages\ViewRecord;

class ViewQuote extends ViewRecord
{
    protected static string $resource = QuoteResource::class;

    protected function mutateFormDataBeforeFill(array $data): array
    {
        if (!$this->record->is_read) {
            $this->record->update(['is_read' => true]);
        }

        return $data;
    }
}
