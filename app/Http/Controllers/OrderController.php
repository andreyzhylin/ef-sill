<?php

namespace EFSill\Http\Controllers;

use EFSill\Order;
use EFSill\Product;
use Illuminate\Http\Request;
use EFSill\Http\Controllers\Controller;

class OrderController extends Controller {

    // GET /orders
    public function showList()
    {
        return view('orders', ['orders' => Order::orderBy('created_at', 'desc')->paginate(10)]);
    }

    // GET /order/{id}
    public function showProducts($id)
    {
        return view('products', ['order' => Order::find($id)]);
    }

    // DELETE /order/{id}
    public function delete($id)
    {
        $order = Order::find($id);
        $order->delete();
    }

    // POST /import/order
    public function import(Request $request)
    {
        $orderFile = $request->file('order_file');
        if ($orderFile->isValid()) {
            $name = uniqid();
            $orderFile->move('uploads/', $name . '.xlsx');
            Order::import(base_path() . '/public/uploads/' . $name . '.xlsx');
        }
    }
}
