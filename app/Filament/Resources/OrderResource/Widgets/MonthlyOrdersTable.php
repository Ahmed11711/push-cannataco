<?php

namespace App\Filament\Resources\OrderResource\Widgets;

use App\Models\Order;
use Filament\Tables;
use Filament\Widgets\TableWidget as BaseWidget;
use Carbon\Carbon;

class MonthlyOrdersTable extends BaseWidget
{
    protected static ?string $heading = 'Orders This Month';

    protected int | string | array $columnSpan = 'full';

    public function table(Tables\Table $table): Tables\Table
    {
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth   = Carbon::now()->endOfMonth();

        return $table
            ->query(
                Order::query()
                    ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
                    ->latest()
            )
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('ID'),
                Tables\Columns\TextColumn::make('serial_number')->label('Serial'),
                Tables\Columns\TextColumn::make('status')->label('Status'),
                Tables\Columns\TextColumn::make('total_amount')->money('usd'),
                Tables\Columns\TextColumn::make('delivered_at')->date(),
                Tables\Columns\TextColumn::make('created_at')->dateTime(),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
