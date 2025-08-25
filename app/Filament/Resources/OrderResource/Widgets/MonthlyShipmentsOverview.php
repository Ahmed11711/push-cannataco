<?php

namespace App\Filament\Resources\OrderResource\Widgets;

use App\Models\Order;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;
use Carbon\Carbon;

class MonthlyShipmentsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth   = Carbon::now()->endOfMonth();

        return [
            Card::make('Total Shipments This Month', Order::whereBetween('created_at', [$startOfMonth, $endOfMonth])->count()),

            Card::make('Delivered', Order::whereBetween('created_at', [$startOfMonth, $endOfMonth])
                ->where('status', 'delivered')
                ->count())
                ->color('success'),

            Card::make('Pending', Order::whereBetween('created_at', [$startOfMonth, $endOfMonth])
                ->where('status', 'pending')
                ->count())
                ->color('warning'),

            Card::make('Returned', Order::whereBetween('created_at', [$startOfMonth, $endOfMonth])
                ->where('status', 'returned')
                ->count())
                ->color('danger'),
        ];
    }
}
