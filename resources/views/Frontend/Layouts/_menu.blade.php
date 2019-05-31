<style>
    .affix-top.navbar-custom .nav li a {
        color: #222;
    }
    .affix.navbar-custom .nav li a {
        color: #fff;
    }
</style>
<nav id="mainNav" class="navbar navbar-default navbar-custom navbar-fixed-top">
    <div class="container">
        <div class="navbar-header page-scroll">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand page-scroll link-position" href="{{ route('home.index') }}">
                <img src="{{ url('frontend') }}/images/img/" alt=""><br>
            </a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li class="hidden">
                    <a href="#page-top"></a>
                </li>
                <li>
                    <a href="{{ route('home.index') }}">Trang Chủ</a>
                </li>
                <li>
                    <a href="{{ route('home.service') }}">Dịch Vụ</a>
                </li>
                <li>
                    <a href="{{ route('home.introduction') }}">Giới Thiệu</a>
                </li>
                <li>
                    <a href="{{ route('home.faq') }}">FAQ</a>
                </li>
                <li>
                    <a href="{{ route('home.contact') }}">Phản hồi</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<section class="section-top"></section>