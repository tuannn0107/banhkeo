@extends('home.layouts.app')

@section('title', 'Trang Chủ')

@section('head')
    <link rel="stylesheet" type="text/css" href="/owl/owl.carousel.min.css"/>
    <link rel="stylesheet" type="text/css" href="/owl/owl.theme.default.min.css"/>
    <script src="/owl/owl.carousel.1.3.js" type="text/javascript"></script>

    <script>
        $(document).ready(function () {
            $("#news").owlCarousel({
                autoplay: true,
                autoplayTimeout: 5000,
                autoplayHoverPause: true,
                loop: true,
                items: 1,
                itemsDesktop: 1,
                itemsDesktopSmall: 1,
                itemsTablet: 1,
                itemsMobile: 1,
                dots: true,
                navigation: false,
            });

            $("#hotproduct1").owlCarousel({
                autoplay: true,
                autoplayTimeout: 3000,
                autoplayHoverPause: true,
                loop: true,
                responsiveClass: true,
                items: 4,
                itemsDesktop: [1199, 4],
                itemsDesktopSmall: [980, 3],
                itemsTablet: [768, 2],
                itemsTabletSmall: false,
                itemsMobile: [479, 2],

                dots: false,
                navigation: false,
            });

            $("#comment").owlCarousel({
                loop: true,
                autoplay: true,
                autoplayTimeout: 3000,
                responsiveBaseElement: "body",
                autoplayHoverPause: true,
                responsiveClass: true,
            });
        });
    </script>
    <link rel="stylesheet" type="text/css" href="/wow/animate.css"/>
    <script src="/wow/wow.min.js" type="text/javascript"></script>

    <script>
        new WOW().init();
    </script>
@endsection

@section('home')
    <!--Container-->
    <div class="width100">
        <div class="_blank" style="margin-bottom: 0px;">
            <script type="text/javascript" src="/mod-slide/asset/jssor.js"></script>
            <script type="text/javascript" src="/mod-slide/asset/jssor.slider.js"></script>
            <script>
                jQuery(document).ready(function ($) {
                    var _CaptionTransitions = [];

                    var _SlideshowTransitions = [
                        {
                            $Duration: 1500,
                            x: 0.2,
                            y: -0.1,
                            $Delay: 20,
                            $Cols: 8,
                            $Rows: 4,
                            $Clip: 15,
                            $During: {$Left: [0.3, 0.7], $Top: [0.3, 0.7]},
                            $SlideOut: true,
                            $Formation: $JssorSlideshowFormations$.$FormationZigZag,
                            $Assembly: 260,
                            $Easing: {$Left: $JssorEasing$.$EaseInWave, $Top: $JssorEasing$.$EaseInWave, $Clip: $JssorEasing$.$EaseOutQuad},
                            $Outside: true,
                            $Round: {$Left: 0.8, $Top: 2.5},
                        },

                        {
                            $Duration: 600,
                            x: -1,
                            y: 1,
                            $Delay: 50,
                            $Cols: 8,
                            $Rows: 4,
                            $ChessMode: {$Column: 3, $Row: 12},
                            $Easing: {$Left: $JssorEasing$.$EaseInCubic, $Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseOutQuad},
                            $Opacity: 2,
                        },

                        {$Duration: 1000, $Delay: 80, $Cols: 8, $Rows: 4, $Clip: 15, $Easing: $JssorEasing$.$EaseInQuad},
                    ];

                    var options = {
                        $FillMode: 2, //[Optional] The way to fill image in slide, 0 stretch, 1 contain (keep aspect ratio and put all inside slide), 2 cover (keep aspect ratio and cover whole slide), 4 actual size, 5 contain for large image, actual size for small image, default value is 0

                        $AutoPlay: true, //[Optional] Whether to auto play, to enable slideshow, this option must be set to true, default value is false

                        $AutoPlayInterval: 4000, //[Optional] Interval (in milliseconds) to go for next slide since the previous stopped if the slider is auto playing, default value is 3000

                        $PauseOnHover: 1, //[Optional] Whether to pause when mouse over if a slider is auto playing, 0 no pause, 1 pause for desktop, 2 pause for touch device, 3 pause for desktop and touch device, 4 freeze for desktop, 8 freeze for touch device, 12 freeze for desktop and touch device, default value is 1

                        $ArrowKeyNavigation: true, //[Optional] Allows keyboard (arrow key) navigation or not, default value is false

                        $SlideEasing: $JssorEasing$.$EaseOutQuint, //[Optional] Specifies easing for right to left animation, default value is $JssorEasing$.$EaseOutQuad

                        $SlideDuration: 800, //[Optional] Specifies default duration (swipe) for slide in milliseconds, default value is 500

                        $MinDragOffsetToSlide: 20, //[Optional] Minimum drag offset to trigger slide , default value is 20

                        //$SlideWidth: 100%,                                 //[Optional] Width of every slide in pixels, default value is width of 'slides' container

                        // $SlideHeight: 350,                                //[Optional] Height of every slide in pixels, default value is height of 'slides' container

                        $SlideSpacing: 0, //[Optional] Space between each slide in pixels, default value is 0

                        $DisplayPieces: 1, //[Optional] Number of pieces to display (the slideshow would be disabled if the value is set to greater than 1), the default value is 1

                        $ParkingPosition: 0, //[Optional] The offset position to park slide (this options applys only when slideshow disabled), default value is 0.

                        $UISearchMode: 1, //[Optional] The way (0 parellel, 1 recursive, default value is 1) to search UI components (slides container, loading screen, navigator container, arrow navigator container, thumbnail navigator container etc).

                        $PlayOrientation: 1, //[Optional] Orientation to play slide (for auto play, navigation), 1 horizental, 2 vertical, 5 horizental reverse, 6 vertical reverse, default value is 1

                        $DragOrientation: 1, //[Optional] Orientation to drag slide, 0 no drag, 1 horizental, 2 vertical, 3 either, default value is 1 (Note that the $DragOrientation should be the same as $PlayOrientation when $DisplayPieces is greater than 1, or parking position is not 0)

                        $CaptionSliderOptions: {
                            //[Optional] Options which specifies how to animate caption

                            $Class: $JssorCaptionSlider$, //[Required] Class to create instance to animate caption

                            $CaptionTransitions: _CaptionTransitions, //[Required] An array of caption transitions to play caption, see caption transition section at jssor slideshow transition builder

                            $PlayInMode: 1, //[Optional] 0 None (no play), 1 Chain (goes after main slide), 3 Chain Flatten (goes after main slide and flatten all caption animations), default value is 1

                            $PlayOutMode: 3, //[Optional] 0 None (no play), 1 Chain (goes before main slide), 3 Chain Flatten (goes before main slide and flatten all caption animations), default value is 1
                        },

                        $BulletNavigatorOptions: {
                            //[Optional] Options to specify and enable navigator or not

                            $Class: $JssorBulletNavigator$, //[Required] Class to create navigator instance

                            $ChanceToShow: 2, //[Required] 0 Never, 1 Mouse Over, 2 Always

                            $AutoCenter: 1, //[Optional] Auto center navigator in parent container, 0 None, 1 Horizontal, 2 Vertical, 3 Both, default value is 0

                            $Steps: 1, //[Optional] Steps to go for each navigation request, default value is 1

                            $Lanes: 1, //[Optional] Specify lanes to arrange items, default value is 1

                            $SpacingX: 8, //[Optional] Horizontal space between each item in pixel, default value is 0

                            $SpacingY: 8, //[Optional] Vertical space between each item in pixel, default value is 0

                            $Orientation: 1, //[Optional] The orientation of the navigator, 1 horizontal, 2 vertical, default value is 1
                        },

                        $ArrowNavigatorOptions: {
                            //[Optional] Options to specify and enable arrow navigator or not

                            $Class: $JssorArrowNavigator$, //[Requried] Class to create arrow navigator instance

                            $ChanceToShow: 1, //[Required] 0 Never, 1 Mouse Over, 2 Always

                            $AutoCenter: 2, //[Optional] Auto center arrows in parent container, 0 No, 1 Horizontal, 2 Vertical, 3 Both, default value is 0

                            $Steps: 1, //[Optional] Steps to go for each navigation request, default value is 1
                        },

                        $SlideshowOptions: {
                            $Class: $JssorSlideshowRunner$,

                            $Transitions: _SlideshowTransitions,

                            $TransitionsOrder: 3,

                            $ShowLink: true,
                        },
                    };

                    var jssor_slider1 = new $JssorSlider$("slider1_container", options);

                    //responsive code begin

                    //you can remove responsive code if you don't want the slider scales while window resizes

                    function ScaleSlider() {
                        var bodyWidth = document.body.clientWidth;

                        if (bodyWidth) jssor_slider1.$ScaleWidth(Math.min(bodyWidth, 1920));
                        else window.setTimeout(ScaleSlider, 30);
                    }

                    ScaleSlider();

                    $(window).bind("load", ScaleSlider);

                    $(window).bind("resize", ScaleSlider);

                    $(window).bind("orientationchange", ScaleSlider);

                    //responsive code end
                });
            </script>
            <!-- Jssor Slider Begin -->
            <!-- To move inline styles to css file/block, please specify a class name for each element. -->
            <div id="slider1_container" style="position: relative; margin: 0 auto; top: 0px; left: 0px; width: 1920px; height: 600px; overflow: hidden;">
                <!-- Loading Screen -->
                <div u="loading" style="position: absolute; top: 0px; left: 0px;">
                    <div
                        style="filter: alpha(opacity=70); opacity: 0.7; position: absolute; display: block; top: 0px; left: 0px; width: 100%; height: 100%;"></div>
                    <div
                        style="position: absolute; display: block; background: url(/mod-slide/asset/img/loading.gif) no-repeat center center; top: 0px; left: 0px; width: 100%; height: 100%;"></div>
                </div>
                <!-- Slides Container -->
                <div u="slides" style="cursor: move; position: absolute; left: 0px; top: 0px; width: 1920px; height: 600px; overflow: hidden;">
                    @forelse($slideList as $slide)
                        <div>
                            <div><img u="image" alt="{{$slide->name ?? config('app.name')}}" width="100%" src="{{$slide->image}}"/></div>
                        </div>
                    @empty
                    @endforelse
                </div>

                <style>
                    .jssorb21 {
                        position: absolute;
                    }

                    .jssorb21 div,
                    .jssorb21 div:hover,
                    .jssorb21 .av {
                        position: absolute;
                        /* size of bullet elment */
                        width: 19px;
                        height: 19px;
                        text-align: center;
                        line-height: 19px;
                        color: white;
                        font-size: 12px;
                        background: url(/mod-slide/asset/img/b21.png) no-repeat;
                        overflow: hidden;
                        cursor: pointer;
                    }

                    .jssorb21 div {
                        background-position: -5px -5px;
                    }

                    .jssorb21 div:hover,
                    .jssorb21 .av:hover {
                        background-position: -35px -5px;
                    }

                    .jssorb21 .av {
                        background-position: -65px -5px;
                    }

                    .jssorb21 .dn,
                    .jssorb21 .dn:hover {
                        background-position: -95px -5px;
                    }
                </style>
                <!-- bullet navigator container -->
                <div u="navigator" class="jssorb21" style="bottom: 26px; right: 6px;">
                    <!-- bullet navigator item prototype -->
                    <div u="prototype"></div>
                </div>
                <style>
                    .jssora21l,
                    .jssora21r {
                        display: block;
                        position: absolute;
                        /* size of arrow element */
                        width: 55px;
                        height: 55px;
                        cursor: pointer;
                        background: url(/mod-slide/asset/img/a21.png) center center no-repeat;
                        overflow: hidden;
                    }

                    .jssora21l {
                        background-position: -3px -33px;
                    }

                    .jssora21r {
                        background-position: -63px -33px;
                    }

                    .jssora21l:hover {
                        background-position: -123px -33px;
                    }

                    .jssora21r:hover {
                        background-position: -183px -33px;
                    }

                    .jssora21l.jssora21ldn {
                        background-position: -243px -33px;
                    }

                    .jssora21r.jssora21rdn {
                        background-position: -303px -33px;
                    }
                </style>
                <!-- Arrow Left -->
                <span u="arrowleft" class="jssora21l" style="top: 123px; left: 8px;"> </span>
                <!-- Arrow Right -->
                <span u="arrowright" class="jssora21r" style="top: 123px; right: 8px;"> </span>
            </div>
        </div>

        <!-- popup quảng cáo -->
        <div class="popup_qc"></div>
        <style>
            #introduction {
                max-height: 300px;
                overflow: hidden;
            }

            #introduction.is-active {
                max-height: none;
            }

            #introduction.is-active .box-more {
                display: none;
            }

            #introduction .box-more {
                position: absolute;
                top: 150px;
                left: 0;
                right: 0;
                text-align: center;
                padding-top: 100px;
                padding-bottom: 50px;
                background: -webkit-linear-gradient(bottom,#fff 40%,rgba(0,0,0,0) 0%);
                background: -moz-linear-gradient(bottom,#fff 40%,rgba(0,0,0,0) 0%);
                background: linear-gradient(0deg,#fff 40%,rgba(0,0,0,0) 100%);
            }

            .button {
                background-color: #fff;
                border-color: #dbdbdb;
                border-width: 1px;
                color: #363636;
                cursor: pointer;
                justify-content: center;
                padding: calc(.5em - 1px) 1em;
                text-align: center;
                white-space: nowrap;
            }

            .button.is-more {
                border-radius: 0;
                border: 1px solid var(--gray);
                color: var(--gray);
            }
        </style>
        <div id="introduction" class="main">
            <div class="col-lg-12">
                <h1 class="heading-home">{{$config->home_company}}</h1>
                {!! $post->content !!}
                <div class="box-more">
                    <a class="button is-more" onclick="expandIntroduction()">
                        <span>Xem thêm</span>
                    </a>
                </div>
            </div>
        </div>
        <script>
            function expandIntroduction() {
                document.getElementById('introduction').classList.toggle('is-active');
            }
        </script>
        <div class="clearfix"></div>

        @forelse($categoryList as $category)
            <div class="width100 productcat_home">
                <div class="main">
                    <h2 class="heading-home">
                        <a href="{{$category->href}}"> {{$category->name}} </a>
                    </h2>
                    <div class="des-home"></div>

                    <div class="col-lg-12">
                        @forelse($category->descendantPostList()->published()->latest()->get() as $data)
                            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-6">
                                @include('home.product.item')
                            </div>
                        @empty
                        @endforelse
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        @empty
        @endforelse

        <div class="width100">
            <div class="main">
                <div class="col-lg-12">
                    <div class="width100">
                        <h2 class="heading-home heading-black">Tin tức</h2>

                        @forelse($postList as $data)
                            <div class="col-md-6 col-sm-6">
                                <div class="news_small">
                                    <div class="img">
                                        <a title="{{$data->name}}" href="{{$data->href}}">
                                            <img alt="{{$data->name}}" src="{{$data->image}}"/>
                                        </a>
                                    </div>
                                    <div class="info">
                                        <a title="{{$data->name}}" href="{{$data->href}}">
                                            <h3 class="title">{{$data->name}}</h3>
                                        </a>
                                        <div class="des">
                                            {{$data->excerpt}}
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        @empty
                        @endforelse
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="clearfix"></div>
    @include('includes.footer')
@endsection
