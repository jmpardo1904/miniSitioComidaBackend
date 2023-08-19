<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function create(Request $request)
    {
        $orderData = $request->validate([
            'items' => 'required|array',
            'items.*.name' => 'required|string',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        $order = Order::create([
            'status' => 'pending', // Puedes ajustar los estados según tus necesidades
            // Otros campos relevantes del pedido
        ]);

        foreach ($orderData['items'] as $itemData) {
            $order->items()->create([
                'name' => $itemData['name'],
                'quantity' => $itemData['quantity'],
            ]);
        }

        return response()->json(['message' => 'Pedido creado con éxito']);
    }
}

