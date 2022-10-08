<?php

namespace App\Http\Controllers;

use App\Events\OrderCreated;
use App\Http\Requests\CreateOrderRequest;
use App\Http\Requests\EditOrderRequest;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('orders.index')->with('orders', auth()->user()->orders()->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('orders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateOrderRequest $request)
    {
        $total = 0;
        $total_tax = 0;

        foreach ($request->validated('products') as $id) {
            $product = Product::find($id);
            $total += $product->price;
            $total_tax += $product->tax_amount;
        }

        $order = Order::create([
            'user_id'   => auth()->user()->id,
            'total'     => $total,
            'total_tax' => $total_tax,
            'comments'  => $request->validated('comments')
        ]);

        $order->products()->attach($request->validated('products'));

        OrderCreated::dispatch($order);

        $request->session()->flash('message', 'Orden creada correctamente.');

        return redirect()->route('orders.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return view('orders.show')->with('order', $order);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        return view('orders.edit')->with('order', $order);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditOrderRequest $request, Order $order)
    {
        $total = 0;
        $total_tax = 0;

        foreach ($request->validated('products') as $id) {
            $product = Product::find($id);
            $total += $product->price;
            $total_tax += $product->tax_amount;
        }

        $order->update([
            'total' => $total,
            'total_tax' => $total_tax,
            'status' => $request->validated('status'),
            'comments' => $request->validated('comments')
        ]);

        $order->products()->sync($request->validated('products'));

        $request->session()->flash('message', 'Orden actualizada correctamente.');

        return redirect()->route('orders.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Order $order)
    {
        $order->delete();

        $request->session()->flash('message', 'Orden eliminada correctamente.');

        return redirect()->route('orders.index');
    }
}
