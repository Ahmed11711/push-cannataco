<?php

namespace App\Filament\Resources\ContactResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Contact;

class ContactStats extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('كل الرسائل', Contact::count())
                ->description('إجمالي عدد الرسائل')
                ->color('primary')
                ->icon('heroicon-o-chat-bubble-left-right'),

            Stat::make('غير مقروءة', Contact::where('is_read', false)->count())
                ->description('لم يتم قراءتها بعد')
                ->color('danger')
                ->icon('heroicon-o-eye-slash'),

            Stat::make('تم الرد عليها', Contact::where('is_replied', true)->count())
                ->description('الرسائل التي تم الرد عليها')
                ->color('success')
                ->icon('heroicon-o-check-circle'),
        ];
    }
}
