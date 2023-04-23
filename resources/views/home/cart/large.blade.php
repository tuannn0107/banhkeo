<table class="table table-bordered">
    <thead>
    <tr>
        <th class="td_hide">Hình ảnh</th>
        <th>Tên sản phẩm</th>
        <th>Số lượng</th>
        <th>Giá bán (₫)</th>
        <th>Thành tiền (₫)</th>
        <th>Xóa</th>
    </tr>
    </thead>
    <tbody>
    @forelse(cartArray() as $cart)
    <tr class="p71" data-item="{{$cart['id']}}">
        <td align="center" class="td_hide">
            <img style="width: 80px;" src="{{$cart['image']}}" alt="{{$cart['name']}}" />
        </td>
        <td>{{$cart['name']}}</td>
        <td class="soluong">
            <input name="quantity" type="number" style="width: 50px; text-align: center;" class="js-input-quantity qty-sl qty" value="{{$cart['quantity']}}" />
        </td>
        <td>
            <span id="price_71">{{price($cart['price'])}}</span>
            <input type="hidden" value="350000" id="priceItem_71" />
        </td>
        <td>
            <span id="sub_71">{{price($cart['price'] * $cart['quantity'])}}</span>
        </td>
        <td class="align-center" style="text-align: center;">
            <a class="delcart" title="Xóa sản phẩm"> <i class="fa fa-close js-clear-cart"></i> </a>
        </td>
    </tr>
    <tr>
        <td colspan="4" align="right">Tổng tiền đơn hàng (<i>* Đã bao gồm VAT </i>)</td>
        <td><strong id="total">{{price(cartAmount())}}</strong></td>
        <td></td>
    </tr>
    @empty
        <tr>
            <td colspan="6" align="center" style="color: red; font-weight: bold;">Giỏ hàng trống</td>
        </tr>
    @endforelse
    </tbody>
</table>
@if(!count(cartArray()))
<style>
    #payment {
        display: none;
    }
</style>
@endif
