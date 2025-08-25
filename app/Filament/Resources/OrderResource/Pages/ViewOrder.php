<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use Filament\Resources\Pages\Page;

class ViewOrder extends Page
{
    // protected static string $resource = OrderResource::class;
    protected static string $view = 'filament.resources.order-resource.pages.view-order';
    protected static string $resource = OrderResource::class;
    public function getTitle(): string
    {
        return "تفاصيل الطلب";
    }
}
