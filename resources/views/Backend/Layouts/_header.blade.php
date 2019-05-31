<nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row {{ Auth::user()->is_customer == 1 ? 'navbar-dark' : '' }}">
    <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
        <a class="navbar-brand brand-logo" href="{{ route('home.index') }}" style="color: #000">
            Transfast
        </a>
        <a class="navbar-brand brand-logo-mini" href="{{ route('home.index') }}" style="color: #000">
            Transfast
        </a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center">
        <button class="navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
        </button>
        <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item dropdown d-none d-xl-inline-block">
                <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                    <span class="profile-text">{{ Auth::check() ? @Auth::user()->name : '' }}</span>
                    <img class="img-xs rounded-circle" src="{{ Auth::check() ? url('').'/'.@Auth::user()->avatar : ''}}" alt="Profile image"> </a>
                    <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                    <a class="dropdown-item p-0">
                        <div class="d-flex border-bottom">
                            <div class="py-3 px-4 d-flex align-items-center justify-content-center">
                                <i class="mdi mdi-bookmark-plus-outline mr-0 text-gray"></i>
                            </div>
                            <div class="py-3 px-4 d-flex align-items-center justify-content-center border-left border-right">
                                <i class="mdi mdi-account-outline mr-0 text-gray"></i>
                            </div>
                            <div class="py-3 px-4 d-flex align-items-center justify-content-center">
                                <i class="mdi mdi-alarm-check mr-0 text-gray"></i>
                            </div>
                        </div>
                    </a>
                    <a href="{{ route('users.profile') }}" class="dropdown-item mt-2"> {{ __('backend.user.manager') }} </a>
                    <a href="{{ route('users.change') }}" class="dropdown-item"> {{ __('backend.user.change_password') }} </a>
                    <a href="{{ route('logout') }}" class="dropdown-item">{{ __('backend.user.logout') }} </a>
                </div>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="icon-menu"></span>
        </button>
    </div>
</nav>


