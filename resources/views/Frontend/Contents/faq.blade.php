@extends('Frontend.Layouts.default')
@section('content')
    <section class="section-link">
        <div class="container">
            <div class="row row-link-edit">
                <a href="../index-2.html">Trang Chủ</a>
                <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                <a href="../partials/fap.html">FAQ</a>
            </div>
        </div>
    </section>

    <section class="section-faq">
        <div class="container">
            <div class="row col-md-12 col-sm-12">
                <div class="col-md-4 col-sm-4 tab-left-border-faq"> <!-- required for floating -->
                    <!-- Nav tabs -->
                    <h4 class="ul-title">
                        <span><b>Chuyên Mục Hỏi Đáp</b></span>
                    </h4>
                    <ul class="nav nav-tabs tabs-left nav-tabs-faq">
                        <li class="active"><a href="#cod" data-toggle="tab">Dịch vụ thu tiền hộ (COD)</a></li>
                        <li><a href="#goods-rule" data-toggle="tab">Quy định về giá cước</a></li>
                    </ul>
                </div>

                <div class="col-md-8 col-sm-8 panel-faq">
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane active" id="cod">
                            <div class="text-justify text-font-modify">
                                <h4>Dịch vụ thu tiền hộ là gì?</h4>
                                <p class="text-muted">
                                    Là dịch vụ mà người mua hàng thanh toán tiền hàng khi nhận được hàng hóa cho nhân viên giao nhận.
                                </p>
                                <h4>Thanh toán tiền thu hộ như thế nào?</h4>
                                <p class="text-muted">
                                    Transfast sẽ chuyển phần tiền thu hộ thông qua tài khoản ngân hàng khách hàng đã đăng ký trước 12:00 ngày tiếp theo (trừ thứ 7 và chủ nhật)
                                    Miễn phí Phí Chuyển Khoản đối với tất cả các ngân hàng.
                                </p>
                                <h4>Có thu phí dịch vụ COD không?</h4>
                                <p class="text-muted">
                                    Dịch vụ COD hoàn toàn miễn phí, khách hàng tránh được rủi ro phát sinh như tiền giả, hư hỏng, mất mát…
                                </p>
                            </div>
                        </div>
                        <div class="tab-pane" id="goods-rule">
                            <div class="text-justify text-font-modify">
                                <h4>Giá cước được xác định trong hệ thống</h4>
                                <p class="text-muted">
                                    Hệ thống sẽ tính phí theo khoảng cách vận chuyển:
                                    <br>- Với đơn hàng khoảng cách dưới 5km sẽ đồng giá 25.000đ.
                                    <br>- Với đơn hàng trên 5km, tính thêm cước vận đơn 5.000đ/km.
                                </p>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection