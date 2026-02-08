<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
   public function placeOrder(Request $request)
    {
        // Validate input
        $request->validate([
            'name'=>'required|string|max:255',
            'phone'=>'required|string|max:20',
            'address'=>'required|string',
            'product_id'=>'required|integer',
            'quantity'=>'required|integer|min:1',
            'delivery_charge'=>'required|numeric',
            'total'=>'required|numeric',
        ]);

        // Save order
        $order = Order::create([
            'order_id' => uniqid('ORD-'),
            'customer_name' => $request->name,
            'customer_phone' => $request->phone,
            'address' => $request->address,
            'discount' => $request->discount ?? 0,
            'delivery_charge' => $request->delivery_charge,
            'coupon_discount' => $request->coupon_discount ?? 0,
        ]);

        // Attach product(s) if you have pivot table (order_counts)
        $order->products()->attach($request->product_id, ['quantity' => $request->quantity]);

        // Redirect to success page with order id
        return redirect()->route('User.orderSuccess', ['orderId' => $order->id])
                         ->with('success','Order placed successfully!');
    }

    public function orderSuccess($orderId)
    {
        // Get order with products
        $order = Order::with('products')->findOrFail($orderId);

        return view('User.orderSuccess', [
            'order' => $order
        ]);
    }

}
