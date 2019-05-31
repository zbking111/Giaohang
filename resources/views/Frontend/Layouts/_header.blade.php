<header>
    <div class="container">
        <div class="intro-text">
            <div class="intro-heading">Dịch Vụ Giao Hàng Hà Nội Tốt Nhất</div>
            <div class="intro-lead-in">
                <span>Tiết Kiệm - An Toàn - Nhanh chóng</span>
            </div>
            <div>
                <i class="fa fa-2x fa-motorcycle" aria-hidden="true"></i>
                <i class="fa fa-2x fa-car" aria-hidden="true"></i>
                <i class="fa fa-2x fa-truck" aria-hidden="true"></i>
            </div>
            <form method="POST" action="{{ route('login') }}" id="login_form" class="login">
                @if (Session::has('status'))
                    <p class="text-success">{{ Session::get('messages') }}</p>
                @endif
                @csrf
                <input type="text" class="user-name" placeholder="Tên đăng nhập" value="{{ old('email') }}" name="email" />
                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
                <input type="password" class="input-password" placeholder="Mật khẩu" name="password"/>
                @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
                <input type="submit" value="Đăng Nhập" class="btn btn-success btn-sm home-page-input-submit"/>
                <div class="remember-forgot">
                    <div class="row">
                        <div class="col-md-6 forgot-pass-content text-right">

                        </div>
                        <div class="col-md-6 sign-up text-center">
                            <a href="{{ route('home.signup') }}" class="text-size">Đăng ký</a>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
</header>