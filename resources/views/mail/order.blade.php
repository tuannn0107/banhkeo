@component('mail::message')

@component('mail::table')
                         |                         |                       |
                         |-------------------------|-----------------------|
@isset($contact->name)   | @lang('Name')           | {{$contact->name}}    |
@endisset
@isset($contact->phone)  | @lang('Phone number')   | {{$contact->phone}}   |
@endisset
@isset($contact->email)  | @lang('E-Mail Address') | {{$contact->email}}   |
@endisset
@isset($contact->address)| @lang('Address')        | {{str($contact->address)->squish()}} |
@endisset
@endcomponent

@component('mail::table')
| @lang('Serial')     | @lang('Product')  | @lang('Price') | @lang('Quantity') | @lang('Total') |
|:-------------------:|:------------------:|:--------------:|:-----------------:|:--------------:|
@forelse($order->productList as $product)
| {{$loop->index + 1}} | <div style="text-align: left">{{$product->name}}</div> | {{tightPrice($product->pivot->price)}} | {{$product->pivot->quantity}} | {{tightPrice($product->amount)}} |
@empty
@endforelse
||<td colspan="2"> <h2 style="text-align: center">@lang('Total Price')</h2> | <h2>{{tightPrice($order->productList->sum('amount'))}}</h2> |
@endcomponent

@isset($order->content) <small><b>@lang('Note')</b>: {{$order->content}}</small>@endisset

@endcomponent
