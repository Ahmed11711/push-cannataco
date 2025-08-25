<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Services\OrderService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    use ApiResponseTrait;
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function store(OrderRequest $request)
    {
        $order = $this->orderService->create($request->validated());
        return $this->successResponse(new OrderResource($order), 'تم إنشاء الطلب بنجاح');
    }

    public function show($id)
    {
        try {
            $order = $this->orderService->getWithItems($id);
            return $this->successResponse(new OrderResource($order));
        } catch (\Exception $e) {
            return $this->errorResponse('لم يتم العثور على الطلب', 404);
        }
    }
    public function findBySerial(string $serial_number)
    {
        $order = Order::with('items.shippingMethod')->where('serial_number', $serial_number)->first();

        if (!$order) {
            return response()->json([
                'message' => 'الطلب غير موجود',
            ], 404);
        }

        return response()->json([
            'message' => 'تم العثور على الطلب',
            'status' => $order->status,
        ]);
    }
}
