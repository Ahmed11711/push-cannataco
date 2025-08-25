<?php

namespace App\Filament\Resources\OrderResource\Widgets;

use App\Models\Order;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;
use Carbon\Carbon;

class OrdersOverview extends BaseWidget
{
   protected function getCards(): array
    {
        $today = Carbon::today();

        return [
            Card::make('Orders to Deliver Today', Order::whereDate('delivered_at', $today)->count()),

            Card::make('Pending Today', Order::whereDate('delivered_at', $today)->where('status', 'pending')->count())
                ->color('warning'),

            Card::make('Delivered Today', Order::whereDate('delivered_at', $today)->where('status', 'delivered')->count())
                ->color('success'),

            Card::make('Returned Today', Order::whereDate('delivered_at', $today)->where('status', 'returned')->count())
                ->color('danger'),
        ];
    }
}
