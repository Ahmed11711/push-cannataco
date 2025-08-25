<?php

namespace App\Filament\Resources\OrderResource\Widgets;

use App\Models\Order;
use Illuminate\Database\Eloquent\Model;
use Saade\FilamentFullCalendar\Widgets\FullCalendarWidget;

class OrdersCalendar extends FullCalendarWidget
{
    public Model|string|null $model = Order::class;
    public static function canCreate(): bool
    {
        return false;
    }
    protected function headerActions(): array
    {
        return [];
    }
    public function fetchEvents(array $fetchInfo): array
    {
        return Order::query()
            ->whereBetween('delivered_at', [$fetchInfo['start'], $fetchInfo['end']])
            ->get()
            ->map(function (Order $order) {
                return [
                    'id'    => $order->id,
                    'title' => "Order #{$order->id} ({$order->status})",
                    'start' => $order->delivered_at,
                ];
            })
            ->toArray();
    }
}
