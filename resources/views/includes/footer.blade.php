<div style="left: -50px;" id="coccoc-alo-phoneIcon" class="coccoc-alo-phone coccoc-alo-green coccoc-alo-show">
    <div class="coccoc-alo-ph-circle"></div>

    <div class="coccoc-alo-ph-circle-fill"></div>

    <div class="coccoc-alo-ph-img-circle">
        <a href="tel:{{$config->phone}}" rel="nofollow"><img alt="{{$config->title}}" src="/images/phone-bottom-right.png" /></a>
    </div>
</div>

<style>
    .coccoc-alo-phone.coccoc-alo-show {
        visibility: visible;
    }

    .coccoc-alo-phone {
        background-color: transparent;

        height: 200px;

        position: fixed;

        transition: visibility 0.5s ease 0s;

        visibility: hidden;

        width: 200px;

        z-index: 200000 !important;

        bottom: -50px;
    }

    .coccoc-alo-phone.coccoc-alo-green .coccoc-alo-ph-circle {
        border-color: #bfebfc;

        opacity: 0.5;
    }

    .coccoc-alo-ph-circle {
        animation: 1.2s ease-in-out 0s normal none infinite running coccoc-alo-circle-anim;

        background-color: transparent;

        border: 2px solid rgba(30, 30, 30, 0.4);

        border-radius: 100%;

        height: 160px;

        left: 20px;

        opacity: 0.1;

        position: absolute;

        top: 20px;

        transform-origin: 50% 50% 0;

        transition: all 0.5s ease 0s;

        width: 160px;
    }

    .coccoc-alo-phone.coccoc-alo-green .coccoc-alo-ph-circle-fill {
        background-color: rgba(0, 175, 242, 0.5);

        opacity: 0.75 !important;
    }

    .coccoc-alo-ph-circle-fill {
        animation: 2.3s ease-in-out 0s normal none infinite running coccoc-alo-circle-fill-anim;

        background-color: #000;

        border: 2px solid transparent;

        border-radius: 100%;

        height: 100px;

        left: 50px;

        opacity: 0.1;

        position: absolute;

        top: 50px;

        transform-origin: 50% 50% 0;

        transition: all 0.5s ease 0s;

        width: 100px;
    }

    .coccoc-alo-phone.coccoc-alo-green .coccoc-alo-ph-img-circle {
        background-color: #00aff2;
    }

    .coccoc-alo-ph-img-circle {
        animation: 1s ease-in-out 0s normal none infinite running coccoc-alo-circle-img-anim;

        border: 2px solid transparent;

        border-radius: 100%;

        height: 60px;

        left: 70px;

        opacity: 0.7;

        position: absolute;

        top: 70px;

        transform-origin: 50% 50% 0;

        width: 60px;
    }

    .coccoc-alo-ph-img-circle a img {
        padding: 4px 0 0 3px;
    }

    @keyframes coccoc-alo-circle-anim {
        0% {
            opacity: 0.1;

            transform: rotate(0deg) scale(0.5) skew(1deg);
        }

        30% {
            opacity: 0.5;

            transform: rotate(0deg) scale(0.7) skew(1deg);
        }

        100% {
            opacity: 0.6;

            transform: rotate(0deg) scale(1) skew(1deg);
        }
    }

    @keyframes coccoc-alo-circle-img-anim {
        0% {
            transform: rotate(0deg) scale(1) skew(1deg);
        }

        10% {
            transform: rotate(-25deg) scale(1) skew(1deg);
        }

        20% {
            transform: rotate(25deg) scale(1) skew(1deg);
        }

        30% {
            transform: rotate(-25deg) scale(1) skew(1deg);
        }

        40% {
            transform: rotate(25deg) scale(1) skew(1deg);
        }

        50% {
            transform: rotate(0deg) scale(1) skew(1deg);
        }

        100% {
            transform: rotate(0deg) scale(1) skew(1deg);
        }
    }

    @keyframes coccoc-alo-circle-fill-anim {
        0% {
            opacity: 0.2;

            transform: rotate(0deg) scale(0.7) skew(1deg);
        }

        50% {
            opacity: 0.2;

            transform: rotate(0deg) scale(1) skew(1deg);
        }

        100% {
            opacity: 0.2;

            transform: rotate(0deg) scale(0.7) skew(1deg);
        }
    }
</style>
<style>
    footer {
        position: relative;
        color: #ccc;
        margin-top: 30px;
        line-height: 25px;
        letter-spacing: 1px;
        width: 100%;
        float: left;
        background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url(templates/images/bc.jpg);
        background-attachment: fixed;
        background-size: cover;

        position: relative;
        z-index: 1;
    }
    footer .logo2 {
        height: 100px;
        float: left;
        margin: 10px 0 20px 0;
    }

    footer a {
        color: var(--yellow);
    }
    footer a:hover {
        color: var(--green);
    }
    #back-top {
        bottom: 32px;
        cursor: pointer;
        height: 39px;
        position: fixed;
        right: 14px;
        width: 41px;
    }
    footer .dichvu1 {
        float: left;
        width: 100%;
        margin-bottom: 20px;
        background: #eee;
    }
    footer .dichvu {
        float: left;
        font-size: 17px;
        padding: 15px 0;
        color: #333;
    }
    footer .dichvu1 > .dichvu:last-child {
        border-right: none;
    }
    footer .dichvu i {
        padding-right: 10px;
        color: var(--green);
    }
    footer .main > .col-lg-3 {
        padding-left: 40px;
    }

    /*footer .facebook {float:left; font-size:30px; margin:10px 0 0 10px}*/
    footer .social {
        margin-top: 10px;
        float: left;
        display: block;
        padding: 9px;
        font-size: 25px;
        text-align: center;
        width: 40px;
        height: 40px;
        border-radius: 10px;
        color: white;
        text-decoration: none;
        transition: all 0.3s;
        margin-right: 10px;
    }

    footer .facebook {
        background: #4b81d2;
    }
    footer .youtube {
        background: crimson;
    }
    footer .instagram {
        background: pink;
    }
    footer .zalo {
        border-radius: 10px;
        float: left;
        margin-top: 10px;
    }

    /*footer ul {float:left; width:100%; padding-right:20px}
footer ul li {float:left; list-style:circle; width:100%; margin:5px 0}
footer ul li a {color:#333}
footer ul li a:hover {text-decoration:none; color:#08a85a}*/
    .bantin {
        float: left;
        width: 100%;
        padding-right: 70px;
        margin-top: 10px;
        overflow: hidden;
        position: relative;
    }
    .heading-footer {
        float: left;
        font-family: roboto;
        font-weight: bold;
        width: 100%;
        font-size: 18px !important;
        text-transform: uppercase;
        margin-top: 0px;
    }
    #copyright1 {
        float: left;
        margin-top: 10px;
        width: 100%;
        padding: 10px 0;
        text-align: center;
        color: black;
        background: #eee;
    }
    #copyright1 a {
        color: black;
        font-weight: bold;
    }

    .chiase {
        float: left;
        width: 100%;
        padding: 20px 0px;
    }
    .chiase i {
        font-size: 25px;
        margin-right: 20px;
    }
    /*-----Media 767px-----*/
    @media screen and (max-width: 767px) {
        footer > .main > div {
            padding-left: 30px;
            padding-right: 30px;
        }
    }
</style>
<footer>
    <div class="dichvu1">
        <div class="main">
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 dichvu"><i class="fa fa-truck"></i> Cam kết sản phẩm</div>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 dichvu"><i class="fa fa-leaf"></i> Chất lượng cao cấp</div>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 dichvu"><i class="fa fa-globe"></i> Thương hiệu uy tín</div>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 dichvu"><i class="fa fa-thumbs-o-up"></i> An toàn sức khỏe</div>
        </div>
        <div class="clearfix"></div>
    </div>

    <div class="main">
        <div class="col-lg-3 col-md-3 col-sm-3">
            <h3 class="heading-footer">Thông tin liên hệ</h3>
            <!--boxItem-->
            <div class="module">
                <div class="module-body">
                    <p><strong>Hotline:</strong> <a class="info-link-dark" href="tel:{{$config->phone}}" rel="nofollow">{{$config->phone}}</a></p>

                    <p><strong>Email:</strong> <a class="info-link-dark" href="mailto:{{$config->email}}" rel="nofollow">{{$config->email}}</a></p>

                    <p><strong>Địa chỉ:</strong> {{$config->address}}</p>
                </div>
            </div>
            <!--End boxItem-->
        </div>

        <div class="col-lg-3 col-md-3 col-sm-3">
            <h3 class="heading-footer">Về chúng tôi</h3>
            <!--boxItem-->
            <div class="module">
                <div class="module-body">
                    <p>
                        <a href="/chinh-sach-bao-mat" rel="nofollow">- Chính sách bảo mật</a><br />
                        <a href="/chinh-sach-doi-tra" rel="nofollow">- Chính sách đổi trả</a><br />
                        <a href="/chinh-sach-hang-nhap-khau" rel="nofollow">- Chính sách hàng nhập khẩu</a><br />
                        <a href="/giao-hang-va-nhan-hang" rel="nofollow">- Giao hàng và nhận hàng</a><br />
                        <a href="/gioi-thieu" rel="nofollow">- Giới thiệu</a>
                    </p>

                    <p></p>

                    <p></p>
                </div>
            </div>
            <!--End boxItem-->
        </div>

        <div class="col-lg-3 col-md-3 col-sm-3">
            <h3 class="heading-footer">Chăm sóc khách hàng</h3>
            <!--boxItem-->
            <div class="module">
                <div class="module-body">
                    <p>
                        <a href="/huong-dan-dat-hang" rel="nofollow">- Hướng dẫn đặt hàng</a><br />
                        <a href="/huong-dan-thanh-toan" rel="nofollow">- Hướng dẫn thanh toán</a><br />
                        <a href="/lien-he" rel="nofollow">- Thông tin liên hệ</a>
                    </p>
                </div>
            </div>
            <!--End boxItem-->
        </div>
        <div class="col-lg-3 col-md-3 col-sm-3">
            <h3 class="heading-footer">{{$config->phone}}</h3>
            <a rel="nofollow" href="{{$config->facebook}}" target="_blank"><i class="social facebook fa fa-facebook"></i></a>
            <a rel="nofollow" href="{{$config->youtube}}" target="_blank"><i class="social youtube fa fa-youtube"></i></a>
            <a rel="nofollow" href="{{$config->zalo}}" target="_blank"><img class="zalo" src="/images/zalo.png" /></a>
            <!--boxItem-->
            <div class="module">
                <div class="module-body">
                    <p><img src="/images/dathongbao.png" style="opacity: 0.9; width: 150px;" /></p>
                </div>
            </div>
            <!--End boxItem-->
        </div>
    </div>
    <div class="clearfix"></div>
</footer>
<!--End Footer-->
<div id="backtotop"></div>
