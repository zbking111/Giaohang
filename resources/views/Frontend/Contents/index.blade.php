@extends('Frontend.Layouts.default')
@section('content')
    @includeif ('Frontend.Layouts._header')
    <section id="service" class="operation-home-page">
        <div class="container">
            <div class="row row-edit">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading heading-edit">Cách Thức Hoạt Động</h2>
                </div>
            </div>
            <div class="row text-center">
                <div class="col-md-4 ">
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
                <div class="col-md-4" hidden>
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
                            <a href="{{ route('home.index') }}">
                                <img src="{{ url('frontend') }}/images/img/multi-order.png" class="img-edit img-mana-order" alt="">
                            </a>
                        </div>
                        <a href="{{ route('home.index') }}" style="color: #333333 !important;">
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
                            <a href="{{ route('home.index') }}">
                                <img src="{{ url('frontend') }}/images/img/multi-order.png" class="img-edit img-mana-order" alt="">
                            </a>
                        </div>
                        <a href="{{ route('home.index') }}" style="color: #333333 !important;">
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