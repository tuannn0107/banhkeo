<div class="product">
    <a title="{{$data->name}}" href="{{$data->href}}">
        <figure class="productpic">
            <img class="img" alt="{{$data->name}}" @src="{{$data->image}}"/>
            @if($data->product_type?->name == 'featured')
                <div class="hot_stick"></div>
            @endif
        </figure>

        <div class="infoproduct">
            <h3 class="title">
                {{$data->name}}
                {!! salePercent($data->price, $data->sale_price) !!}
            </h3>
            <div class="des">
                {{$data->excerpt}}
            </div>
            <div class="price">
                <strong>Giá: </strong>
                <span class="old_price">{{price($data->sale_price ? $data->price : '')}} </span>
                <span> {{$data->price_corrected ? price($data->price_corrected) : 'Liên hệ' }} </span>
            </div>
            <div class="dathang">Xem chi tiết</div>
        </div>
    </a>
</div>
