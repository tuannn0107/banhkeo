@extends('admin.layouts.app')

@section('title', __('Order'))

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-5">@lang('All Orders')</h4>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered display js-datatable w-100">
                            <thead>
                            <tr>
                                <th></th>
                                <th>@lang('Order Code')</th>
                                <th>@lang('Customer')</th>
                                <th>@lang('Ship To')</th>
                                <th>@lang('Amount')</th>
                                <th>@lang('Order Date')</th>
                                <th>@lang('Status')</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($orderList as $order)
                            <tr>
                                <td>{{$order->id}}</td>
                                <td>{{$order->name}}</td>
                                <td>{{$order->contact?->name}}</td>
                                <td>{{$order->contact?->address}}</td>
                                <td>{{price($order->amount)}}</td>
                                <td>{{$order->created_at}}</td>
                                <td><x-badge class="mb-1 {{$order->status_class}}" :label="$order->status_label" /></td>
                                <td><x-action route="order" id="{{$order->id}}" enabled-show :enabled-edit="false" /></td>
                            </tr>
                            @empty
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
