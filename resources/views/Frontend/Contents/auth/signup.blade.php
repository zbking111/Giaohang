@extends('Frontend.Layouts.default')
@section('content')
    <section class="section-link">
        <div class="container">
            <div class="row row-link-edit">
                <a href="/site/index">Trang Chủ</a>
                <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                <a href="/site/signup">Đăng Ký</a>
            </div>
        </div>
    </section>
    <section id="sign-up-form" class="sign-up-step2" style="">
        <div class="container">
            <div class="row">
                <!-- <div class="col-lg-4 col-md-4 col-left-position">
                    <div class= "bg-side-img text-center bg-img-company" >
                        <div class="text-justify intro-text-sidebar-left">
                            <h4>Tại sao là GiaohangOngVang.vn?</h4>
                            <p>
                                GiaoHangOngVang.vn là đơn vị cung cấp dịch vụ giao hàng chuyên nghiệp đối với tiêu chí
                                "Tiết kiệm - An toàn - Đúng hẹn" với nhiều ưu điểm và tiện ích khi so sánh với các đơn
                                vị cung cấp tương tự trên thị trường.
                            </p>
                            <p>
                                Đặt mục tiêu trở thành đơn vị có chất lượng phục vụ tốt nhất trong lĩnh vực giao nhận hàng
                                hóa, GiaoHangOngVang.vn tập trung việc đào tạo phát triển, nâng cao chất lượng đội ngũ nhân viên
                                và công nghệ xử lý nhằm hiện thực hóa mục tiêu. Mong muốn trở thành đơn vị uy tín nhất trên thị trường
                                và trong lòng khách hàng.
                            </p>
                        </div>
                    </div>
                </div> -->
                <div class="col-lg-8 col-md-8 form-bg form-bg-company" style= "" >
                    <div class="row row-title">
                        <h4>TRỞ THÀNH THÀNH VIÊN</h4>
                    </div>
                    <form class="sign-up-form-personal" id="sign_up_personal" name="sign_up_personal" method="POST" action="{{ route('home.signup.post') }}">
                        @csrf
                        <div class="row col-md-12 col-sm-12">
                            <div class="form-group col-md-6 col-sm-6">
                                <label for="name">Tên khách hàng *</label>
                                <input type="text" class="form-control input-sm" id="name" placeholder="" value="{{ old('name') }}" name="name" required>
                                @if ($errors->has('name'))
                                    <p class="text-danger"> {{ $errors->first('name') }} </p>
                                @endif
                            </div>
                            <div class="form-group col-md-6 col-sm-6">
                                <label for="email">Email *</label>
                                <input type="email" class="form-control input-sm" id="email" value="{{ old('email') }}" name="email" placeholder="" required="true">
                                @if ($errors->has('email'))
                                    <p class="text-danger"> {{ $errors->first('email') }} </p>
                                @endif
                            </div>
                        </div>
                        <div class="row col-md-12 col-sm-12">
                            <div class="form-group col-md-6 col-sm-6">
                                <label for="mobile">Số Điện Thoại *</label>
                                <input type="text" class="form-control input-sm" id="mobile" placeholder="" value="{{ old('phone') }}" name="phone" required="true">
                                <div class="registrationFormAlert phone_valid" id="divCheckPhone"></div>
                                @if ($errors->has('phone'))
                                    <p class="text-danger"> {{ $errors->first('phone') }} </p>
                                @endif
                            </div>
                            <div class="form-group col-md-6 col-sm-6">
                                <label for="mobile">Lời nhắn</label>
                                <input type="text" class="form-control input-sm" id="mobile" placeholder="" value="{{ old('note') }}" name="note" required="true">
                                <div class="registrationFormAlert phone_valid" id="divCheckPhone"></div>
                            </div>
                        </div>
                        <div class="row col-md-12 col-sm-12">
                            <div class="form-group col-md-6 col-sm-6">
                                <label for="mobile">Mật khẩu *</label>
                                <input type="password" class="form-control input-sm" id="mobile" placeholder=""  name="password" required="true">
                                <div class="registrationFormAlert phone_valid" id="divCheckPhone"></div>
                                @if ($errors->has('password'))
                                    <p class="text-danger"> {{ $errors->first('password') }} </p>
                                @endif
                            </div>
                            <div class="form-group col-md-6 col-sm-6">
                                <label for="mobile">Nhập lại mật khẩu *</label>
                                <input type="password" class="form-control input-sm" id="mobile" placeholder=""  name="confirm_password" required="true">
                                <div class="registrationFormAlert phone_valid" id="divCheckPhone"></div>
                            </div>
                        </div>
                        <div class="row col-md-12 col-sm-12">
                            <div class="form-group col-md-6 col-sm-6">
                                <label for="address">Địa Chỉ *</label>
                                <input type="text" class="form-control input-sm" id="address" placeholder="" value="{{ old('address') }}" name="address" required="true">
                            </div>
                            <div class="form-group col-md-6 col-sm-6">
                                <label for="account-number">Số Tài Khoản* (vd: 152155151513 - VietCombank - Long Bien)</label>
                                <input type="text" class="form-control input-sm" id="account-number" placeholder="" value="{{ old('ATM') }}" name="ATM" required>
                            </div>
                        </div>

                       <!--  <div class="row col-md-12 col-sm-12">
                            <div class="form-group col-md-6 col-sm-6">
                                <label for="address">Tên công ty *</label>
                                <input type="text" class="form-control input-sm" id="address" placeholder="" value="{{ old('company_name') }}" name="company_name" required="true">
                            </div>
                            <div class="form-group col-md-6 col-sm-6">
                                <label for="account-number">Email công ty</label>
                                <input type="text" class="form-control input-sm" id="account-number" placeholder="" value="{{ old('company_email') }}" name="company_email" required>
                            </div>
                        </div>

                        <div class="row col-md-12 col-sm-12">
                            <div class="form-group col-md-6 col-sm-6">
                                <label for="address">Sô điện thoại công ty *</label>
                                <input type="text" class="form-control input-sm" id="address" placeholder="" value="{{ old('company_phone') }}" name="company_phone" required="true">
                            </div>
                            <div class="form-group col-md-6 col-sm-6">
                                <label for="account-number">Địa chỉ</label>
                                <input type="text" class="form-control input-sm" id="account-number" placeholder="" value="{{ old('company_address') }}" name="company_address" required>
                            </div>
                        </div> -->

                        <div class="row btn-bottom">
                            <div class="col-md-8 col-sm-8 text-left">
                            </div>
                            <div class="col-md-4 col-sm-4 ">
                                <button type="submit" id="btn_submit" class="btn btn-primary  text-right">Đăng Ký</button>
                            </div>
                    </form>


                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="service" class="operation-home-page">
        <div class="container">
            <div class="row row-edit">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading heading-edit">Cách Thức Hoạt Động</h2>
                </div>
            </div>
            <div class="row text-center">
                <div class="col-md-4 hidden">
                    <div class="row">
                        <div class="col-md-4 text-right icon-position">
                            <a href="">
                                <img src="{{ url('frontend') }}/images/img/create-order-icon.png" class="img-edit order-icon" alt="">
                            </a>
                        </div>
                        <a href="" style="color: #333333 !important;">
                            <div class="col-md-8 text-left">
                                <h4 class="service-heading" style="font-size: 18px !important;">Tạo Đơn Hàng</h4>
                                <p class="text-muted">
                                    Tạo đơn hành nhanh chóng, đơn giản chỉ vài click chuột.
                                </p>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-4 text-right icon-position">
                            <a href="site/login.html">
                                <img src="{{ url('frontend') }}/images/img/create-order-icon.png" class="img-edit order-icon" alt="">
                            </a>
                        </div>
                        <a href="site/login.html" style="color: #333333 !important;">
                            <div class="col-md-8 text-left">
                                <h4 class="service-heading" style="font-size: 18px !important;">Tạo Nhiều Đơn Hàng</h4>
                                <p class="text-muted">
                                    Tạo hàng trăm ngàn đơn hàng thật đơn giản bằng file Excel.
                                </p>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-4 text-right icon-position">
                            <a href="site/login.html">
                                <img src="{{ url('frontend') }}/images/img/multi-order.png" class="img-edit img-mana-order" alt="">
                            </a>
                        </div>
                        <a href="site/login.html" style="color: #333333 !important;">
                            <div class="col-md-8 text-left">
                                <h4 class="service-heading" style="font-size: 18px !important;">Quản Lý Đơn Hàng</h4>
                                <p class="text-muted">
                                    Theo dõi và quản lý đơn hàng đơn giản và dễ dàng.
                                </p>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-4 text-right icon-position">
                            <a href="site/login.html">
                                <img src="{{ url('frontend') }}/images/img/multi-order.png" class="img-edit img-mana-order" alt="">
                            </a>
                        </div>
                        <a href="site/login.html" style="color: #333333 !important;">
                            <div class="col-md-8 text-left">
                                <h4 class="service-heading" style="font-size: 18px !important;">Yêu cầu xử lý</h4>
                                <p class="text-muted">
                                    Tạo và quản lý yêu cầu phát sinh với đơn hàng
                                </p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section ('myCss')
    <link href="{{ url('frontend') }}/css/sign-up.min.css" rel="stylesheet">
@endsection