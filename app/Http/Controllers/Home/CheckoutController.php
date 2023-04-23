<?php

namespace App\Http\Controllers\Home;

use App\Enums\ProcessType;
use App\Http\Controllers\Controller;
use App\Http\Requests\OrderContactRequest;
use App\Jobs\OrderJob;
use App\Models\Contact;
use App\Models\Order;
use App\Models\OrderProduct;

class CheckoutController extends Controller
{
    public function index()
    {
        if (!count(cartArray())) {
            return redirect('/');
        }

        return view('home.checkout.index');
    }

    public function store(OrderContactRequest $request)
    {
        if (!cartArray()) {
            return redirect('/');
        }

        $contact = Contact::create($request->validated());

        $order = $contact->order()->create([
            'name' => $this->orderCode(),
            'status' => ProcessType::PENDING->value,
            'content' => $request->input('content')
        ]);

        foreach (cartArray() as $productId => $cart) {
            OrderProduct::create([
                'order_id' => $order->id,
                'post_id' => $productId,
                'quantity' => $cart['quantity'],
                'price' => $cart['price']
            ]);
        }
        dispatch(new OrderJob($order));
        resetCart();
        $thank = trans('message.received');
        return view('home.thank.index', compact('thank'));
    }

    private function orderCode()
    {
        do {
            $orderCode = str()->random(5);
        } while (Order::whereName($orderCode)->exists());

        return str($orderCode)->upper();
    }
}
