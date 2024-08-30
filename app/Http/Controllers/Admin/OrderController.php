<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Response;

class OrderController extends Controller
{
    public function index() {
        $orders = Order::latest();

        if(request()->has('type') && !empty(request()->type)) {
            $orders = $orders->whereOrderType(request()->type);
        }

        if(request()->has('status') && !empty(request()->status)) {
            $orders = $orders->whereStatus(request()->status);
        }
        
        $orders = $orders->paginate(10);
        
        return view('orders.index', compact('orders'));
    }
    
    public function update(Request $request, $id) {
        $request->validate([
            'status' => 'required',
        ]);

        Order::whereId($id)->update(['status' => $request->status]);

        return Response::json(['status' => true]);
    }

    public function show(Order $order) {
        return view('orders.show', compact('order'));
    }
    
}
