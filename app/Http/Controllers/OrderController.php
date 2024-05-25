<?php

namespace App\Http\Controllers;

use PDF;
use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Client;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\Department;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //
    public function index()
    {
        if(auth()->user()->userType == 'super-admin'){
           $orders = Order::whereNotNull('status')->orderBy('id', 'desc')->get();
           $allOrders = Order::whereNotNull('status')->get()->count();
            $activeOrders = Order::where('status', 'Active')->get()->count();
            $pendingOrders = Order::where('status', 'Pending')->get()->count();
            $completedOrders = Order::where('status', 'Completed')->get()->count();
            $canceledOrders = Order::where('status', 'Canceled')->get()->count();
            $todayOrders = Order::whereNotNull('status')->whereDate('created_at', Carbon::today())->count();
        }else{
           $orders = Order::where('added_by', auth()->user()->id)->whereNotNull('status')->orderBy('id', 'desc')->get();
           $allOrders = Order::where('added_by', auth()->user()->id)->whereNotNull('status')->get()->count();
           $activeOrders = Order::where('added_by', auth()->user()->id)->where('status', 'Active')->get()->count();
           $pendingOrders = Order::where('added_by', auth()->user()->id)->where('status', 'Pending')->get()->count();
           $completedOrders = Order::where('added_by', auth()->user()->id)->where('status', 'Completed')->get()->count();
           $canceledOrders = Order::where('added_by', auth()->user()->id)->where('status', 'Canceled')->get()->count();
           $todayOrders = Order::where('added_by', auth()->user()->id)->whereNotNull('status')->whereDate('created_at', Carbon::today())->count();
        }
        return view('app.orders.index', compact('orders', 'allOrders', 'activeOrders', 'pendingOrders', 'completedOrders', 'canceledOrders', 'todayOrders'));
    }

    public function newOrder(Request $request)
    {
        $data = $request->validate([
            'department' => 'required',
            'client_name' => 'required',
            'client_address' => 'required',
            'client_phone' => 'nullable',
            'order_code' => 'required',
            'order_type' => 'required',
            'discount' => 'required|numeric',
            'finalQuantity' => 'required|integer',
            'finalSubtotal' => 'required|numeric',
            'finalTotal' => 'required|numeric',
            'deposited_amount' => 'required|numeric',
            'balance' => 'required|numeric',
            'payment_method' => 'required',
            'payment_status' => 'required',
            'collected_at' => 'nullable',
            'sell_at' => 'required',
        ]);

        // dd($data);

        $data['added_by'] = auth()->user()->id;
        $data['business_id'] = auth()->user()->business->id;
        $data['status'] = 'Active';
        
        // order status
        if($request->deposited_amount)
        // insert order
        $order = Order::create([
            'added_by' => auth()->user()->id,
            'business_id' => auth()->user()->business->id,
            'order_code' => $request->order_code,
            'order_type' => $request->order_type,
            'department' => $request->department,
            'client_name' => $request->client_name,
            'client_address' => $request->client_address,
            'client_phone' => $request->client_phone,
            'subtotal' => $request->finalSubtotal,
            'quantity' => $request->finalQuantity,
            'discount' => $request->discount,
            'total' => $request->finalTotal,
            'deposit' => $request->deposited_amount,
            'balance' => $request->balance,
            'payment_status' => $request->payment_status,
            'payment_method' => $request->payment_method,
            'collected_at' => $request->collected_at,
            'sell_at' => $request->sell_at,
            'status' => 'Active',
        ]);
        // update cart
        $orderItems = Cart::where('order_code', $order->order_code)
        ->update([
            'order_id' => $order->id,
            'status' => 'Processed'
        ]);

        // Fetch the product_id from the updated order items
        $productIds = Cart::where('order_code', $order->order_code)
            ->pluck('item_id');

        // Increment 'order_counting' for each product
        foreach ($productIds as $productId) {
            $product = Product::find($productId);
            if ($product) {
                $product->increment('order_counting');
            }
        }

        if ($order && ($request->payment_status == 'Paid' || $request->payment_status == 'Paid_portion')) 
        {
            $transaction = Transaction::create([
                'added_by' => auth()->user()->id,
                'business_id' => auth()->user()->business->id,
                'type' => 'Credit',
                'category' => 'Order',
                'order_id' => $order->id,
                'amount' => $order->deposit,
                'method' => $request->payment_method,
                'note' => 'Order Payment',
                'status' => 'Paid',
            ]);
            
            return redirect()->route('orders.showView', [$order->id])->with('message', 'You successfully add order');
        }else{
            return redirect()->route('orders.showView', [$order->id])->with('message', 'You successfully add order');
        }
        return redirect()->back()->with('message', 'There is error. Try again');
    }

    public function completed(Order $order)
    {
        if ($order && $order->payment_status == 'Paid' && $order->total == $order->deposit) {
            
            $order->update([
                'status' => 'completed'
            ]);

            return redirect()->route('orders.showView', [$order->id])->with('message', 'You change the order to complete');
        }
        return redirect()->back()->with('message', 'check the order and payment status');
    }

    public function cancel(Request $request, Order $order)
    {
        $data = $request->validate([
            'reason' => 'required'
        ]);
        // update order
        $updateOrder = $order->update([
            'status' => 'Canceled',
            'cancel_reason' => $request->reason
        ]);
        // update transaction
        $transaction = Transaction::where('order_id',$order->id)->update([
            'status' => 'Canceled',
            'cancel_reason' => 'Order has been canceled'
        ]);
        // Fetch the product_id from the updated order items
        $productIds = Cart::where('order_code', $order->order_code)
            ->pluck('item_id');

        // Increment 'order_counting' for each product
        foreach ($productIds as $productId) {
            $product = Product::find($productId);
            if ($product) {
                $product->decrement('order_counting');
            }
        }
        
        $client= Client::find($order->client_id);
        if($updateOrder && $transaction)
        {
            // decrement payment counting for client
            $client->decrement('payment_counting');
            return redirect()->route('orders.showView', [$order->id])->with('message', 'You canceled the order successfully');
        }
        return redirect()->back()->with('message', 'There is an error, Try again');
    }

    public function delete(Request $request, Order $order)
    {
        // update order
        $updateOrder = $order->update([
            'status' => null
        ]);
        // update transaction
        $transaction = Transaction::where('order_id',$order->id)->update([
            'status' => null,
            'cancel_reason' => 'Order has been deleted'
        ]);
        // Fetch the product_id from the updated order items
        $productIds = Cart::where('order_code', $order->order_code)
            ->pluck('item_id');

        // Increment 'order_counting' for each product
        foreach ($productIds as $productId) {
            $product = Product::find($productId);
            if ($product) {
                $product->decrement('order_counting');
            }
        }
        
        $client= Client::find($order->client_id);
        if($updateOrder && $transaction)
        {
            // decrement payment counting for client
            $client->decrement('payment_counting');
            return redirect()->route('orders')->with('message', 'You deleted the order successfully');
        }
        return redirect()->back()->with('message', 'There is an error, Try again');
    }

    public function transaction(Request $request, Order $order)
    {
        $data = $request->validate([
            'amount' => 'required',
            'status' => 'required',
            'method' => 'required'
        ]);
        // update order
        $updateOrder = $order->update([
            'balance' => 0,
            'payment_status' => $request->status,
            'deposit' => $order->deposit + $request->amount
        ]);
        // update transaction
        $transaction = Transaction::create([
            'added_by' => auth()->user()->id,
            'business_id' => auth()->user()->business->id,
            'type' => 'Credit',
            'category' => 'Order',
            'order_id' => $order->id,
            'amount' => $request->amount,
            'method' => $request->method,
            'note' => 'Order Payment',
            'status' => 'Paid',
        ]);

        if($updateOrder && $transaction)
        {
            return redirect()->route('orders.showView', [$order->id])->with('message', 'You successfully add payment');
        }
        return redirect()->back()->with('message', 'There is an error, Try again');
    }

    public function receipt(Order $order)
    {
        $items = Cart::whereNotNull('status')->where('order_id', $order->id)->orderBy('id', 'desc')->get();
        $transactions = Transaction::whereNotNull('status')->where('order_id', $order->id)->orderBy('id', 'desc')->get();
        // $content = file_get_contents('output.php');
        $pdf = PDF::setOptions(['defaultFont' => 'dejavu serif'])->loadView('app.orders.receipt', [
            'order'=> $order, 
            'items'=> $items, 
            'transactions'=>$transactions
        ]);

        return $pdf->download('AUCO-Order-'.$order->order_code.'.pdf');
    }

    public function printAll()
    {
        if(auth()->user()->userType == 'super-admin'){
            $orders = Order::whereNotNull('status')->orderBy('id', 'desc')->get();
            $allOrders = Order::whereNotNull('status')->get()->count();
        }else{
            $orders = Order::where('added_by', auth()->user()->id)->whereNotNull('status')->orderBy('id', 'desc')->get();
            $allOrders = Order::where('added_by', auth()->user()->id)->whereNotNull('status')->get()->count();
        }
        $pdf = PDF::setOptions(['defaultFont' => 'dejavu serif'])->setPaper('A4', 'landscape')->loadView('app.orders.pdfAll', ['orders'=> $orders, 'allOrders'=> $allOrders]);

        return $pdf->download('AUCO-orders.pdf');
    }

    public function productAdd()
    {
        $departments = Department::whereNotNull('status')->get();
        $code = $this->generateOrderCode();
        $clients = Client::whereNotNull('status')->orderBy('id', 'desc')->get();
        return view('app.orders.productAdd', compact('clients', 'code', 'departments'));
    }

    public function serviceAdd()
    {
        $departments = Department::whereNotNull('status')->get();
        $code = $this->generateOrderCode();
        return view('app.orders.serviceAdd', compact('code', 'departments'));
    }

    public function viewOrder(Order $order)
    {
        $items = Cart::whereNotNull('status')->where('order_id', $order->id)->orderBy('id', 'desc')->get();
        // dd($items);
        $transactions = Transaction::whereNotNull('status')->where('order_id', $order->id)->orderBy('id', 'desc')->get();
        return view('app.orders.view', compact('order', 'items', 'transactions'));
    }

    public function generateOrderCode()
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $codeLength = 8;

        $orderCode = '';
        $charactersLength = strlen($characters);

        for ($i = 0; $i < $codeLength; $i++) {
            $orderCode .= $characters[rand(0, $charactersLength - 1)];
        }

        return $orderCode;
    }

    public function addProductToCart(Request $request)
    {
        $cart = Cart::create([
            'business_id' => auth()->user()->business->id,
            'added_by' => auth()->user()->id,
            'department' => auth()->user()->jurisdiction,
            'order_code' => $request->code,
            'item_type' => $request->item_type,
            'item_name' => $request->item_name,
            'item_id' => $request->product_id,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'total' => $request->total,
            'status' => 'Active'
        ]);
        return response()->json(['success' => true, 'message' => 'Product added to cart']);
    }

    public function addServiceToCart(Request $request)
    {
        $cart = Cart::create([
            'business_id' => auth()->user()->business->id,
            'added_by' => auth()->user()->id,
            'department' => auth()->user()->jurisdiction,
            'order_code' => $request->code,
            'item_type' => $request->item_type,
            'item_name' => $request->item_name,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'total' => $request->total,
            'status' => 'Active'
        ]);
        return response()->json(['success' => true, 'message' => 'Service added to cart']);
    }

    public function getCartItems(Request $request)
    {
        // Fetch cart items based on the provided order code
        $orderCode = $request->input('order_code');
        $cartItems = Cart::where('order_code', $orderCode)->get(); // Adjust this query based on your database structure

        return response()->json($cartItems);
    }

    public function decreaseQuantity($itemId)
    {
        $cartItem = Cart::findOrFail($itemId);
        
        if ($cartItem->quantity > 1) {
            $cartItem->decrement('quantity');
            $newTotal = $cartItem->price * $cartItem->quantity;
            $cartItem->update([
                'total' => $newTotal
            ]);
        }

        // You can return a response or redirect as needed
        return response()->json(['success' => true]);
    }

    public function increaseQuantity($itemId)
    {
        $cartItem = Cart::findOrFail($itemId);
        $cartItem->increment('quantity');
        $newTotal = $cartItem->price * $cartItem->quantity;
        $cartItem->update([
            'total' => $newTotal
        ]);

        // You can return a response or redirect as needed
        return response()->json(['success' => true]);
    }

    public function deleteItem($itemId)
    {
        $cartItem = Cart::findOrFail($itemId);
        $cartItem->delete();

        // You can return a response or redirect as needed
        return response()->json(['success' => true]);
    }

    public function generateReport(Request $request)
    {
        $validatedData = $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $startDate = $validatedData['start_date'];
        $endDate = $validatedData['end_date'];
        if(auth()->user()->userType == 'super-admin'){
            $orders = Order::where('created_at', '>=', $startDate)->where('created_at', '<=', $endDate)->whereNotNull('status')->get();
            $totalOrders = Order::where('created_at', '>=', $startDate)->where('created_at', '<=', $endDate)->whereNotNull('status')->count();
            $totalAmount = Order::where('created_at', '>=', $startDate)->where('created_at', '<=', $endDate)->whereNotNull('status')->sum('total');
            $balanceAmount = Order::where('created_at', '>=', $startDate)->where('created_at', '<=', $endDate)->whereNotNull('status')->sum('balance');
            $activeOrders = Order::where('created_at', '>=', $startDate)->where('created_at', '<=', $endDate)->where('status', 'Active')->count();
            $completedOrders = Order::where('created_at', '>=', $startDate)->where('created_at', '<=', $endDate)->where('status', 'Completed')->count();
            $canceledOrders = Order::where('created_at', '>=', $startDate)->where('created_at', '<=', $endDate)->where('status', 'Canceled')->count();
        }else
        {
            
            $orders = Order::where('added_by', auth()->user()->id)->where('created_at', '>=', $startDate)->where('created_at', '<=', $endDate)->whereNotNull('status')->get();
            $totalOrders = Order::where('added_by', auth()->user()->id)->where('created_at', '>=', $startDate)->where('created_at', '<=', $endDate)->whereNotNull('status')->count();
            $totalAmount = Order::where('added_by', auth()->user()->id)->where('created_at', '>=', $startDate)->where('created_at', '<=', $endDate)->whereNotNull('status')->sum('total');
            $balanceAmount = Order::where('added_by', auth()->user()->id)->where('created_at', '>=', $startDate)->where('created_at', '<=', $endDate)->whereNotNull('status')->sum('balance');
            $activeOrders = Order::where('added_by', auth()->user()->id)->where('created_at', '>=', $startDate)->where('created_at', '<=', $endDate)->where('status', 'Active')->count();
            $completedOrders = Order::where('added_by', auth()->user()->id)->where('created_at', '>=', $startDate)->where('created_at', '<=', $endDate)->where('status', 'Completed')->count();
            $canceledOrders = Order::where('added_by', auth()->user()->id)->where('created_at', '>=', $startDate)->where('created_at', '<=', $endDate)->where('status', 'Canceled')->count();
        }
        return view('app.orders.report', compact('orders', 'startDate', 'endDate', 'totalOrders', 'balanceAmount', 'totalAmount', 'completedOrders', 'activeOrders', 'canceledOrders'));
    }

    public function printReport(Request $request)
    {
        $startDate = $request->start_date;
        $endDate = $request->end_date;

        if(auth()->user()->userType == 'super-admin'){
            $orders = Order::where('created_at', '>=', $startDate)->where('created_at', '<=', $endDate)->whereNotNull('status')->get();
            $totalOrders = Order::where('created_at', '>=', $startDate)->where('created_at', '<=', $endDate)->whereNotNull('status')->count();
            $totalAmount = Order::where('created_at', '>=', $startDate)->where('created_at', '<=', $endDate)->whereNotNull('status')->sum('total');
            $balanceAmount = Order::where('created_at', '>=', $startDate)->where('created_at', '<=', $endDate)->whereNotNull('status')->sum('balance');
            $activeOrders = Order::where('created_at', '>=', $startDate)->where('created_at', '<=', $endDate)->where('status', 'Active')->count();
            $completedOrders = Order::where('created_at', '>=', $startDate)->where('created_at', '<=', $endDate)->where('status', 'Completed')->count();
            $canceledOrders = Order::where('created_at', '>=', $startDate)->where('created_at', '<=', $endDate)->where('status', 'Canceled')->count();
        }else
        {
            $orders = Order::where('added_by', auth()->user()->id)->where('created_at', '>=', $startDate)->where('created_at', '<=', $endDate)->whereNotNull('status')->get();
            $totalOrders = Order::where('added_by', auth()->user()->id)->where('created_at', '>=', $startDate)->where('created_at', '<=', $endDate)->whereNotNull('status')->count();
            $totalAmount = Order::where('added_by', auth()->user()->id)->where('created_at', '>=', $startDate)->where('created_at', '<=', $endDate)->whereNotNull('status')->sum('total');
            $balanceAmount = Order::where('added_by', auth()->user()->id)->where('created_at', '>=', $startDate)->where('created_at', '<=', $endDate)->whereNotNull('status')->sum('balance');
            $activeOrders = Order::where('added_by', auth()->user()->id)->where('created_at', '>=', $startDate)->where('created_at', '<=', $endDate)->where('status', 'Active')->count();
            $completedOrders = Order::where('added_by', auth()->user()->id)->where('created_at', '>=', $startDate)->where('created_at', '<=', $endDate)->where('status', 'Completed')->count();
            $canceledOrders = Order::where('added_by', auth()->user()->id)->where('created_at', '>=', $startDate)->where('created_at', '<=', $endDate)->where('status', 'Canceled')->count();
        }
        
        $pdf = PDF::setOptions(['defaultFont' => 'dejavu serif'])->setPaper('A4', 'landscape')->loadView('app.orders.pdfReport', 
        ['orders'=> $orders, 'startDate'=> $startDate, 
         'endDate'=>$endDate, 'totalOrders'=>$totalOrders, 
         'balanceAmount'=>$balanceAmount, 'totalAmount'=>$totalAmount, 
         'completedOrders'=>$completedOrders, 'activeOrders'=>$activeOrders, 
         'canceledOrders'=>$canceledOrders]);

        return $pdf->download('AUCO-order-reports.pdf');
    }

}
