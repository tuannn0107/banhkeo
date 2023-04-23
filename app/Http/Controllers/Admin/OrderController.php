<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ProcessType;
use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Models\Order;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Order::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $orderList = Order::all();
        return view('admin.order.index', compact('orderList'));
    }

    /**
     * Display the specified resource.
     *
     * @param Order $order
     * @return View
     */
    public function show(Order $order): View
    {
        $contact = $order->contact;
        $productList = $order->productList;
        $amount = $productList->sum('amount');
        $processTypeList = ProcessType::COMPLETED->processList();

        return view('admin.order.show', compact('contact', 'order', 'productList', 'amount', 'processTypeList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param OrderRequest $orderRequest
     * @param Order $order
     * @return RedirectResponse
     */
    public function update(OrderRequest $orderRequest, Order $order): RedirectResponse
    {
        $order->update($orderRequest->all());
        return back()->withSuccess(trans('message.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Order $order
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Order $order): RedirectResponse
    {
        $order->delete();
        return back()->withSuccess(trans('message.deleted'));
    }
}
