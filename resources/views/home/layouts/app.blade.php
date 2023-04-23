<html lang="vi">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes"/>
    <link rel="shortcut icon" href="{{$config->favicon}}"/>
    @cms
    <!--Css-->
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet"/>
    <link href="/css/bootstrap3.min.css" rel="stylesheet" type="text/css"/>
    <link href="/css/font-awesome.css" rel="stylesheet" type="text/css"/>
    <link href="/css/cart.css" rel="stylesheet" type="text/css"/>
    <link href="/css/style.css" rel="stylesheet" type="text/css"/>
    <link href="/lightslider/css/lightslider.css" rel="stylesheet" type="text/css"/>
    <!--Javascipt-->
    <script type="text/javascript">
        var base_url = "/";
    </script>

    <script src="/js/jquery.min.js"></script>
    <script src="/js/jquery-ui.js"></script>
    <script src="/js/jquery.ellipsis.js" type="text/javascript"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/function.js"></script>
    <script src="/js/jquery.lazyload.js"></script>
    <script src="/js/jquery.validate.min.js" type="text/javascript"></script>
    <script src="/lightslider/js/lightslider.js" type="text/javascript"></script>
    <script src="/js/jquery.vticker.min.js" type="text/javascript"></script>

    <!--- Jcarousel --->
    <link rel="stylesheet" type="text/css" href="/css/jcarousel.responsive.css"/>
    <script src="/js/jquery.jcarousel.min.js" type="text/javascript"></script>
    <script src="/js/jcarousel.responsive.js" type="text/javascript"></script>
    <script>
        $(document).ready(function () {
            $('[class^="tourslide"]').jcarouselAutoscroll({
                interval: 2000,
            });
        });
    </script>

    @yield('head')
</head>

<body>
{{--no home--}}
<div class="qc_top"></div>
<!--slide to right-->

<script>
    $(document).ready(function () {
        $(".open_btn").click(function () {
            $(".menu_mobile").addClass("show");
        });

        $(".close_btn").click(function () {
            $(".menu_mobile").removeClass("show");
        });

        // ---------------------submenu mobile----------------------
        $(".menu_mobile .open").click(function () {
            $(this).parent().find(".open").hide();
            $(this).parent().find(".exit").show();
            $(this).parent().find(".menu_mobile_con").slideDown();
        });

        $(".menu_mobile .exit").click(function () {
            $(this).parent().find(".exit").hide();
            $(this).parent().find(".open").show();
            $(this).parent().find(".menu_mobile_con").slideUp();
        });
    });
</script>
<header>
    <div class="infotop">
        <div class="main">
            <span class="email1"><b>Email:</b> <a class="info-link" href="mailto:{{$config->email}}" rel="nofollow">{{$config->email}}</a></span>
            <span><b>Hotline:</b> <a class="info-link" href="tel:{{$config->phone}}" rel="nofollow">{{$config->phone}}</a></span>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="main wow fadeInRight">
        <div class="logo">
            <a href="/"><img alt="{{$config->title}}" src="{{$config->logo}}"/></a>
        </div>

        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-4 floatright giohang">
            <div class="service">
                <div class="divlogo">
                    <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                </div>
                <div class="divtext">
                    <a href="/gio-hang"><h5>Giỏ hàng</h5></a>
                    <p id="js-navigation-cart">
                        @include('home.cart.navigation')
                    </p>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-4 floatright">
            <div class="service">
                <div class="divlogo">
                    <i class="fa fa-plane"></i>
                </div>
                <div class="divtext">
                    <h5>Giao hàng tại nhà</h5>
                    <p>Thanh toán tại nhà</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-4 floatright">
            <div class="service">
                <div class="divlogo">
                    <i class="fa fa-truck"></i>
                </div>
                <div class="divtext">
                    <h5>Ship toàn quốc</h5>
                    <p>Thuận tiện và nhanh chóng</p>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div id="menu_container" class="wow fadeInLeft">
        <div class="main">
            <ul class="menu">
                <li><a class="{{active('/')}}" href="/">Trang chủ</a></li>
                <li>
                    <a class="{{active($productCategoryList->pluck('slug'))}}" href="javascript:void(0)">Sản phẩm</a>
                    <ul class="menucon">
                        @forelse($productCategoryList as $productCategory)
                        <li><a class="{{active(ltrim($productCategory->href, '/'))}}" href="{{$productCategory->href}}"> {{$productCategory->name}} </a></li>
                        @empty
                        @endforelse
                    </ul>
                </li>

                <li><a class="{{active('gioi-thieu')}}" href="/gioi-thieu" rel="nofollow">Giới thiệu</a></li>
                <li>
                    <a class="{{active($postCategoryList->pluck('slug'))}}" href="javascript:void(0)">Tin tức</a>
                    <ul class="menucon">
                        @forelse($postCategoryList as $postCategory)
                            <li><a class="{{active(ltrim($postCategory->href, '/'))}}" href="{{$postCategory->href}}"> {{$postCategory->name}} </a></li>
                        @empty
                        @endforelse
                    </ul>
                </li>

                <li><a class="{{active('lien-he')}}" href="/lien-he" rel="nofollow">Liên hệ</a></li>
            </ul>
            <div class="open_btn">
                <i class="fa fa-bars fa-2x"></i>
            </div>
        </div>
    </div>
</header>
<div class="menu_mobile">
    <div class="close_btn">
        <i class="fa fa-times fa-2x"></i>
    </div>

    <ul>
        <li><a class="{{active('/')}}" href="/">Trang chủ</a></li>
        <li><a class="{{active('gioi-thieu')}}" href="/gioi-thieu" rel="nofollow">Giới thiệu</a></li>

        @forelse($productCategoryList as $productCategory)
        <li><a class="{{active(ltrim($productCategory->href, '/'))}}" href="{{$productCategory->href}}" rel="nofollow">{{$productCategory->name}} </a></li>
        @empty
        @endforelse

        @forelse($postCategoryList as $postCategory)
            <li><a class="{{active(ltrim($postCategory->href, '/'))}}" href="{{$postCategory->href}}">{{$postCategory->name}} </a></li>
        @empty
        @endforelse

        <li><a class="{{active('lien-he')}}" href="/lien-he">Liên hệ</a></li>
    </ul>
</div>

<style>
    .infotop {
        float: left;
        width: 100%;
        text-align: right;
        height: 40px;
        padding: 10px;
        color: white;
        background: var(--green);
    }

    .info-link-black, .info-link-black:hover {
        color: #455a64;
    }

    .info-link-dark, .info-link-dark:hover {
        color: #ccc;
    }

    .info-link, .info-link:hover {
        color: white;
    }

    .info-link:hover, .info-link-black:hover, .info-link-dark:hover {
        opacity: 0.9;
    }

    .menutop {
        float: right;
        list-style: none;
        margin-bottom: 0;
    }

    .menutop > li {
        float: left;
    }

    .menutop > li > a {
        float: left;
        padding: 0 15px;
        font-size: 14px;
        color: white;
        border-right: 1px solid #ccc;
    }

    .menutop > li > a:hover {
        text-decoration: none;
        transition: all 0.5s;
        color: #22ac4a;
    }

    .menutop > li > a:hover i {
        transform: rotate(360deg);
        transition: all 0.3s;
    }

    header {
        float: left;
        width: 100%;
        position: relative;
        z-index: 99;
    }

    .caret {
        color: #666;
        margin-left: 0px;
    }

    .email1 {
        padding-right: 50px;
    }

    .searchbox {
        position: absolute;
        top: 10px;
        right: 300px;
        width: 300px;
    }

    .searchbox input[type="text"] {
        float: left;
        width: 100%;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 5px;
        padding: 0px 10px;
        height: 35px;
        border: 1px solid #666;
        border-right: none;
    }

    .btn_search {
        float: left;
        margin-left: -35px;
        color: white;
        height: 35px;
        width: 35px;
        background: #8f5444;
        border: none;
        border-top-right-radius: 5px;
        border-bottom-right-radius: 5px;
    }

    /*---Hotline---*/
    #menu_container {
        float: left;
        width: 100%;
        height: 40px;
        background: var(--gray);
    }

    .logo {
        float: left;
        margin: 10px 0;
    }

    .logo img {
        height: 80px;
    }

    .menu {
        margin-bottom: 0;
        height: 40px;
        float: right;
        width: 100%;
        text-align: center;
    }

    .menu > li {
        font-size: 14px;
        text-transform: uppercase;
        display: inline-block;
    }

    .menu > li i {
        margin-right: 5px;
        padding: 8px;
        line-height: 14px;
        text-align: center;
        height: 28px;
        width: 28px;
        font-size: 12px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
    }

    .menu > li > a {
        padding: 6px 20px;
        font-weight: bold;
        display: block;
        overflow: hidden;
        line-height: 30px;
        height: 40px;
        color: white;
        text-decoration: none;
    }

    .menu .active,
    .menu > li > a:hover {
        background: var(--green);
        color: white;
    }

    .menu > li:hover .menucon {
        display: block;
    }

    .menucon {
        min-width: 100px;
        position: absolute;
        z-index: 99999999;
        display: none;
        background: white;
        box-shadow: 0 2px 5px #666;
        margin-top: 0;
    }

    .menucon > li > a {
        display: block;
        width: 100%;
        color: #333;
        text-transform: none;
        float: left;
        padding: 10px 15px;
        border-bottom: 1px solid #ccc;
    }

    .menucon > li:last-child > a {
        border-bottom: none;
    }

    .menucon > li > a:hover {
        color: #8f5444;
    }

    .open_btn {
        float: right;
        width: 50px;
        display: none;
        margin-top: 2px;
    }

    .open_btn i {
        font-size: 30px;
        padding: 3px;
        border-radius: 5px;
        color: white;
        cursor: pointer;
    }

    .open_btn:hover i {
        color: #8f5444;
    }

    .close_btn {
        margin: 10px;
        cursor: pointer;
        color: white;
    }

    .close_btn:hover {
        color: #8f5444;
    }

    /*-----Menu mobile-----*/
    .menu_mobile {
        transition: all 0.5s;
        font-weight: bold;
        right: -240px;
        width: 240px;
        height: 100%;
        background: #333;
        position: fixed;
        z-index: 99999999;
    }

    .show {
        right: 0;
        transition: all 0.5s;
    }

    .menu_mobile .active,
    .menu_mobile a:hover {
        background: var(--green);
    }

    .menu_mobile a {
        color: white;
    }

    .menu_mobile > ul {
        width: 100%;
        float: left;
        font-size: 15px;
    }

    .menu_mobile > ul > li {
        border-bottom: 1px solid #444;
    }

    .menu_mobile > ul > li:last-child {
        border-bottom: none;
    }

    .menu_mobile > ul > li > a {
        width: 100%;
        display: block;
        padding: 10px 0;
        text-indent: 5px;
    }

    .menu_mobile > ul > li > a:hover {
        background: #eee;
        color: #8f5444;
    }

    .menu_mobile > ul > li:hover .open,
    .menu_mobile > ul > li:hover .exit {
        color: #666;
    }

    .menu_mobile_con {
        display: none;
        background: white;
        float: left;
        padding: 0 10px;
        width: 100%;
    }

    .menu_mobile_con > li {
        float: left;
        width: 100%;
    }

    .menu_mobile_con > li > a {
        display: block;
        float: left;
        color: #666;
        width: 100%;
        padding: 10px 5px;
        border-bottom: 1px solid #ccc;
    }

    .exit {
        display: none;
        margin-right: 12px !important;
        font-size: 30px !important;
        margin-top: -45px !important;
    }

    .open,
    .exit {
        color: black;
        font-style: normal;
        cursor: pointer;
        font-size: 20px;
        position: relative;
        float: right;
        margin-right: 10px;
        margin-top: -35px;
    }

    .open:hover,
    .exit:hover {
        color: yellow;
    }

    @media screen and (max-width: 1200px) {
        .logo {
            margin-left: 10px;
        }
    }

    @media screen and (max-width: 991px) {
        .searchbox {
            top: 70px;
            right: auto;
            padding-left: 10px;
            padding-right: 100px;
            width: 100%;
            max-width: 100%;
        }

        .menu,
        .menu2 {
            display: none;
        }

        .open_btn {
            display: block;
        }

        .logo {
            float: left;
            margin-top: 10px;
            width: 100%;
            text-align: center;
        }

        .logo img {
            float: none;
            margin: auto;
        }

        .hotline,
        .cart {
            margin-top: 10px;
            margin-right: 20px;
        }

        .searchbox {
            margin-top: 70px;
            padding-right: 10px;
        }

        .cart {
            float: left;
            margin: -60px 10px 10px 10px;
        }
    }

    @media screen and (max-width: 767px) {
        .giohang {
            width: auto !important;
            padding: 0;
        }

        .logo {
            text-align: left;
            width: auto;
        }
    }

    @media screen and (max-width: 600px) {
        .email1 {
            display: none;
        }
    }
</style>

@yield('home')

@hasSection('content')
    <div id="wrapper">
        <div id="breadcrumbs" itemscope="" itemtype="http://schema.org/BreadcrumbList"
             @if(isset($category) && $category->image) style="background-image: url({{$category->image}})"
             @elseif(isset($post) && $post->image) style="background-image: url({{$post->image}})" @endif>
            <div class="main">
                @hasSection('h2')
                    <h2 class="heading">@yield('h2')</h2>
                @else
                    <h1 class="heading">@yield('title')</h1>
                @endif
                <ul class="breadcrumb">
                    <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                        <a itemprop="item" href="/" title="{{$config->title}}">
                            <span itemprop="name"> Trang chủ</span>
                            <meta itemprop="position" content="1"/>
                        </a>
                    </li>
                    <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                        @hasSection('child')
                        <a itemprop="item" href="@yield('childSlug')" title="@yield('child')" class="active end">
                            <span itemprop="name">@yield('child')</span>
                            <meta itemprop="position" content="2"/>
                        </a>
                        @else
                        <a itemprop="item" href="{{request()->url()}}" title="@yield('title')" class="active end">
                            <span itemprop="name">@yield('title')</span>
                            <meta itemprop="position" content="2"/>
                        </a>
                        @endif
                    </li>
                </ul>
            </div>
        </div>
        <div class="main">
            <div class="col-lg-9 col-md-9">
                @yield('content')
            </div>
            <div class="col-lg-3 col-md-3">
                <!--boxItem-->
                <div class="module">
                    <h3 class="heading-small">
                        <span> Danh mục bài viết </span>
                    </h3>
                    <div class="module-body">
                        <div class="category">
                            <ul>
                                <li><a class="{{active('tin-tuc')}}" href="/tin-tuc"> Tin tức</a></li>
                                <li><a class="{{active('ve-chung-toi')}}" href="/ve-chung-toi"> Về chúng tôi</a></li>
                                <li><a class="{{active('cham-soc-khach-hang')}}" href="/cham-soc-khach-hang"> Chăm sóc khách hàng</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!--End boxItem-->
                <!--boxItem-->
                <div class="module">
                    <h3 class="heading-small">
                        <span> Danh mục sản phẩm </span>
                    </h3>
                    <div class="module-body">
                        <div class="category">
                            <ul>
                                @forelse($productCategoryList as $productCategory)
                                    <li><a class="{{active(ltrim($productCategory->href, '/'))}}" href="{{$productCategory->href}}">{{$productCategory->name}} </a></li>
                                @empty
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
                <!--End boxItem-->
                <!--boxItem-->
                <div class="module">
                    <h3 class="heading-small">
                        <span> Sản phẩm đang có tại </span>
                    </h3>
                    <div class="module-body _border">
                        <p>
                            <span style="font-size: 20px;"><strong>{{$config->short_company}}</strong></span>
                        </p>

                        <p>Địa chỉ: {{$config->address}}</p>

                        <p>Hotline: <a href="tel:{{$config->phone}}" class="info-link-black" rel="nofollow">{{$config->phone}}</a></p>
                    </div>
                </div>
                <!--End boxItem-->
            </div>
        </div>
        <!--End Container-->
        <!--Footer-->
        @include('includes.footer')
    </div>
@endif
</body>
</html>

