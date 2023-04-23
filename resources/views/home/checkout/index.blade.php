<form method="POST" action="@lang('slug.checkout')" class="js-disabled-form" accept-charset="utf-8" id="payment">
    @csrf
    <p style="margin: 10px 0; text-align: right;">
        <button class="btnDathang">Thanh toán đơn hàng</button>
    </p>

    <div class="clearfix"></div>

    <div class="boxDetail khachhangthanhtoan">
        <h3 class="title">Thông tin thanh toán</h3>
        <div class="contact">
            <div class="col-lg-6 col-md-6" style="float: left;">
                <div class="form-group">
                    <label>Họ và tên *</label>
                    <input type="text" class="form-control" name="name" required placeholder="Họ tên" />
                </div>

                <div class="form-group">
                    <label>Số điện thoại *</label>
                    <input type="text" class="form-control" name="phone" placeholder="Số điện thoại" />
                </div>
                <div class="form-group">
                    <label>Địa chỉ *</label>
                    <input type="text" class="form-control" name="address" required placeholder="Địa chỉ" />
                </div>
            </div>
            <div class="col-lg-6 col-md-6" style="float: left;">
                <div class="form-group">
                    <label>Ghi chú</label>
                    <textarea class="form-control" rows="5" type="text" name="content" placeholder="Nội dung"></textarea>
                </div>
                <button type="submit" class="btnSubmit">Thanh toán</button>
            </div>
        </div>
    </div>
</form>
<style>
    #chuyenkhoan,
    #thanhtoan {
        display: none;
    }
</style>
