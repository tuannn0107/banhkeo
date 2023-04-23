@extends('home.layouts.app')

@section('title', $post->name)

@section('child', 'Sản phẩm')

@section('childSlug', $category->href)

@section('content')
<div class="width100" style="margin-top: 10px;">
    <div class="row">
        <div class="slide_img_product col-lg-8 col-md-8 col-sm-6" id="big_image">
            <div class="clearfix" style="">
                <ul id="image-gallery" class="gallery list-unstyled cS-hidden">
                    @forelse($post->imageList as $image)
                    <li data-thumb="{{$image->image}}">
                        <img alt="{{$post->name}}" src="{{$image->image}}" />
                    </li>
                    @empty
                    @endforelse
                </ul>
            </div>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-6">
            <h2 class="heading">{{$post->name}}</h2>
            <h3 class="price">
                Giá:
                <span class="old_price">{{price($post->sale_price ? $post->price : '')}} </span>
                <span> {{$post->price_corrected ? price($post->price_corrected) : 'Liên hệ' }} </span>
            </h3>

            <div class="orderItem" data-item="{{$post->id}}" data-area="local">
                <div class="quantity">
                    <input name="quantity" type="number" id="number" class="qty-sl" value="1" min="1" />
                    <div class="quantity-nav">
                        <div class="quantity-button quantity-up js-plus-quantity">+</div>
                        <div class="quantity-button quantity-down js-minus-quantity">-</div>
                    </div>
                </div>
                <a class="add-to-card" title="Đặt mua">
                    <button class="btnSubmit js-add-cart"><i class="fa fa-cart-plus"></i> Đặt hàng nhanh</button>
                </a>
            </div>
            <p>Mời quý khách bấm vào giỏ hàng để đặt hàng.</p>
        </div>

        <div class="col-lg-12">
            <ul class="nav nav-tabs" id="product-tab">
                <li class="active">
                    <a data-toggle="tab" href="#mota"><i class="fa fa-info-circle"></i> Thông tin chi tiết</a>
                </li>
            </ul>

            <div class="box">
                <div class="tab-content" style="padding-top: 10px;">
                    <div id="mota" class="tab-pane fade in active">
                        <div class="fulltext">
                            {!! $post->content !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="width100">
            <div class="col-lg-12">
                <h3 class="heading">
                    <span><i class="fa fa-volume-up"> </i> Sản phẩm liên quan</span>
                </h3>
            </div>
            @forelse($postList as $data)
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                @include('home.product.item')
            </div>
            @empty
            @endforelse
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $("#content-slider").lightSlider({
            loop: true,
            keyPress: true,
        });
        $("#image-gallery").lightSlider({
            gallery: true,
            item: 1,
            thumbItem: 9,
            slideMargin: 0,
            speed: 500,
            auto: true,
            loop: true,
            onSliderLoad: function () {
                $("#image-gallery").removeClass("cS-hidden");
            },
        });
    });
</script>
@endsection
