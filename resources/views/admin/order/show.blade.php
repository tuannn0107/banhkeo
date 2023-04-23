@extends('admin.layouts.app')

@section('title', __('Order'))

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-info">
                <h5 class="mb-0 text-white float-left">@lang('Order') #{{$order->name}}</h5>
                <h5 class="mb-0 text-white float-right">
                    <x-badge class="mb-1 {{$order->status_class}}" :label="$order->status_label" />
                </h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table product-overview mb-0">
                        <thead>
                        <tr>
                            <th class="text-center">@lang('Image')</th>
                            <th class="text-center">@lang('Product')</th>
                            <th class="text-center">@lang('Price')</th>
                            <th class="text-center">@lang('Quantity')</th>
                            <th class="text-center">@lang('Amount')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($productList as $product)
                        <tr>
                            <td><a href="{{$product->href}}" target="_blank"><img @src="{{$product->image}}" width="80" /></a></td>
                            <td>{{$product->name}}</td>
                            <td class="text-right">{{price($product->pivot->price)}}</td>
                            <td class="text-center">{{$product->pivot->quantity}}</td>
                            <td class="text-right">{{price($product->amount)}}</td>
                        </tr>
                        @empty
                        @endforelse
                        <tr class="pt-3">
                            <td class="text-right h6 pt-4" colspan="3">@lang('Amount')</td>
                            <td class="text-right h4 pt-4" colspan="2">{{price($amount)}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">@lang('Customer')
                    <a href="{{route('contact.edit', ['contact' => $contact->id, 'back' => request()->getRequestUri()])}}" title="@lang('Edit')"
                       class="text-inverse pr-2 float-right" data-toggle="tooltip"><i class="ti-marker-alt"></i>
                    </a>
                </h5>
                <hr>
                <h5>{{$contact->name}}</h5>
                <small><i class="ti-mobile"></i><a href="tel:{{$contact->phone}}">{{$contact->phone}}</a></small>
                @if($contact->email)<br><small><i class="ti-email"></i>
                    <a href="mailto:{{$contact->email}}">{{$contact->email}}</a></small>@endif
                <hr>
                <h4>@lang('Shipping Address')</h4>
                <small>{{$contact->address}}</small>
                <hr>
                <form method="POST" action="{{route('order.update', $order->id)}}" class="floating-labels mt-5">
                    @csrf
                    @method('PUT')
                    <x-textarea name="content" value="{{$order->content}}" label="Note" input-class="form-control-sm" />
                    <div class="row">
                        <div class="col-lg-8">
                            <x-select name="status" value="{{$order->status}}" label="Status" :option-list="$processTypeList" />
                        </div>
                        <div class="col-lg-4 text-right"><x-button /></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
