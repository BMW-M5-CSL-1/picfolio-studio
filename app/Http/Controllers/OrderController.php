<?php

namespace App\Http\Controllers;

use App\DataTables\OrderDataTable;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Stripe\Checkout\Session;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(OrderDataTable $dataTable)
    {
        return $dataTable->render('app.orders.index');
        return view('app.orders.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('app.orders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'delivery_address' => 'required|string',
        ]);

        $product = Product::find($request->product_id);

        if ($request->quantity > $product->stock) {
            return response()->json([
                'success' => false,
                'message' => 'Requested quantity exceeds available stock.',
            ]);
        }

        try {
            return DB::transaction(function () use ($request, $product) {
                $orderNumber = 'ORD-' . strtoupper(Str::random(8));

                $order = Order::create([
                    'order_no' => $orderNumber,
                    'product_id' => $product->id,
                    'quantity' => $request->quantity,
                    'delivery_address' => $request->delivery_address,
                    'user_id' => auth()->id(),
                    'price' => $product->price,
                    'total_price' => $product->price * $request->quantity,
                    'status' => 'pending',
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Order placed successfully !',
                    'route' => route('stripe.test', ['order_id' => $order->id]),
                ]);

                // return redirect()->route('stripe.test', ['order_id' => $order->id]);
            });
            // return response()->json(['success' => true, 'redirect_url' => $session->url]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function cancel($id)
    {
        // write code for order cancellation
        $order = Order::find($id);
        if (!$order) {
            return response()->json(['error' => 'Order not found'], 404);
        }
        return DB::transaction(function () use ($order) {
            $order->update([
                'status' => 'cancelled',
            ]);

            return response()->json(['success' => true, 'message' => 'Order cancelled successfully !']);
        });
    }

    public function stripe($order_id)
    {
        $order = Order::find($order_id);
        $amount = $order->price;

        Stripe::setApiKey(config('services.stripe.secret'));
        try {
            // Convert amount in PKR to paisa
            // $amountInRupee = $amount ?? 10; // default amount in PKR if not provided
            // $amountInPaisa = $amountInRupee * 100; // convert to paisa

            // $paymentIntent = PaymentIntent::create([
            //     'amount' => $amountInPaisa, // amount in paisa
            //     'currency' => 'pkr', // PKR currency
            // ]);

            // return response()->json([
            //     'clientSecret' => $paymentIntent->client_secret
            // ]);

            $session = Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'pkr',
                        'product_data' => [
                            'name' => $order->product->name ?? '-',
                            'description' => $order->product->description ?? '-',
                        ],
                        'unit_amount' => $amount * 100, // Amount in paisa for PKR
                    ],
                    'quantity' => $order->quantity,
                ]],
                'mode' => 'payment',
                'success_url' => route('payment.success', ['order_id' => $order->id]),
                'cancel_url' => route('payment.cancel', ['order_id' => $order->id]),
            ]);

            // Redirect the user to Stripe Checkout
            return redirect($session->url);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function stripeSuccess($order_id)
    {
        $order = Order::find($order_id);

        DB::transaction(function () use ($order) {
            $order->update([
                'status' => 'paid',
            ]);
            $order->product->decrement('stock', $order->quantity);
        });

        return redirect()->route('order.index')->with('success', 'Payment Successful !');
    }

    public function stripeCancel($order_id)
    {
        $order = Order::find($order_id);

        DB::transaction(function () use ($order) {
            $order->update([
                'status' => 'pending',
            ]);
        });

        return redirect()->route('order.index')->with('Error', 'Payment Denied !');
    }
}
