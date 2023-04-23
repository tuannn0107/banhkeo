@forelse(cartArray() as $cart)
    <ul data-item="{{$cart['id']}}" style="display: inline-block">
        <li><a href="{{$cart['href']}}">{{$cart['name']}}</a></li>
        <li>
            <button class="js-minus-quantity">-</button>
            <input name="quantity" class="js-input-quantity" value="{{$cart['quantity']}}" style="width: 3em">
            <button class="js-plus-quantity">+</button>
            {{price($cart['price'])}}
        </li>
        <button class="js-clear-cart">X</button>
    </ul>
@empty
@endforelse
