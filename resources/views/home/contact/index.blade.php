@extends('home.layouts.app')

@section('title', 'Liên Hệ')

@section('content')
<div class="contact">
    <div class="col-lg-12 map">
        <div class="mapouter">
            <div class="gmap_canvas">
                <iframe width="100%" height="500" id="gmap_canvas" src="{{$config->map}}" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
                <style>
                    .mapouter {
                        position: relative;
                        text-align: right;
                        height: 500px;
                        width: 100%;
                    }
                    .gmap_canvas {
                        overflow: hidden;
                        background: none !important;
                        height: 500px;
                        width: 100%;
                    }
                </style>
            </div>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="row_contact">
        <div class="col-lg-5">
            <h2 class="heading">{{$config->long_company}}</h2>
            <ul>
                <li><i class="fa fa-map-marker"></i><span>{{$config->address}}</span></li>
                <li><i class="fa fa-phone"></i><span>{{$config->phone}}</span></li>
                <li><i class="fa fa-envelope-o"></i><span>{{$config->email}}</span></li>
            </ul>
        </div>

        <div class="col-lg-7 info_form">
            <form accept-charset="utf-8" class="form_contact js-form" id="form_contact">
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <input type="text" name="name" id="name" class="form-control" required placeholder="Họ tên *" />
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <input type="tel" name="phone" id="phone" placeholder="Số điện thoại *" required class="form-control" />
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <textarea name="content" id="content" cols="30" rows="6" class="form-control" placeholder="Nội dung"></textarea>
                </div>

                <div class="form-group text-center">
                    <button type="submit" class="btnSubmit">Gửi thông tin</button>
                </div>
            </form>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
@endsection
