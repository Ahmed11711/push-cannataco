<?php

namespace App\Services;

use App\Models\Order;
use App\Models\ShippingMethod;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderService
{
    public function create(array $data)
    {
        return DB::transaction(function () use ($data) {
            $serial = 'CANN-' . strtoupper(uniqid());
            $order = Order::create([
                'merchant_id' => Auth::guard('merchant')->id(),
                'track_id' => $data['track_id'],
                'total_amount' => 0,
                'serial_number' => $serial,
                'status' => $data['status'] ?? 'pending',
                'name_sender' => $data['name_sender'] ?? null,
                'phone_sender' => $data['phone_sender'] ?? null,
                'address_sender' => $data['address_sender'] ?? null,
                'email_sender' => $data['email_sender'] ?? null,
                'name_received' => $data['name_received'] ?? null,
                'phone_received' => $data['phone_received'] ?? null,
                'email_received' => $data['email_received'] ?? null,
                'delivered_at' => $data['delivered_at'] ?? null,
            ]);

            $total = 0;

            foreach ($data['items'] as $item) {
                $shippingMethod = ShippingMethod::find($item['shipping_method_id']);
                $pricePerKg = $shippingMethod?->price ?? 0;
                $itemTotal = $item['weight'] * $pricePerKg;

                $order->items()->create([
                    'name' => $item['name'] ?? null,
                    'weight' => $item['weight'],
                    'shipping_method_id' => $item['shipping_method_id'],
                    'note' => $item['note'] ?? null,
                ]);

                $total += $itemTotal;
            }

            $order->update(['total_amount' => $total]);

            return $order->load('items.shippingMethod');
        });
    }

    public function getWithItems($id)
    {
        return Order::with('items.shippingMethod')->findOrFail($id);
    }
}
