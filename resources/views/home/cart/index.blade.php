@extends('home.layouts.app')

@section('title', 'Giỏ Hàng')

@section('content')
    <div class="boxCart">
        <span id="js-large-cart">
            @include('home.cart.large')
        </span>
    </div>

    @include('home.checkout.index')
@endsection
