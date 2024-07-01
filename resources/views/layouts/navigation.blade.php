<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
    <div class="container-fluid">
        <!-- Logo -->
        <a class="navbar-brand" href="{{ route('dashboard') }}">
           <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSNnYo_hDciK3v7zibLg4GlIz16uBsH1gb4Jg&s">
        </a>
        <!-- Hamburger -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Primary Navigation Menu -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('alumnis.index') ? 'active' : '' }}" href="{{ route('alumnis.index') }}">{{ __('Alumni') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('under.index') }}">{{ __('Undergraduate') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('employ.index') }}">{{ __('Employed') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('unemploy.index') }}">{{ __('Unemployed') }}</a>
                </li>
            </ul>
            <!-- Settings Dropdown -->
            <ul class="navbar-nav ms-auto">
                <!-- Bell Icon -->
                <li class="nav-item">
                    <style>
                        .bell-icon {
                            display: inline-block;
                            width: 25px;
                            height: 25px;
                            background-color: #f0f0f0;
                            border-radius: 50%;
                            position: relative;
                            cursor: pointer;
                        }
                        .bell-icon:before {
                            content: "\1F514"; /* Unicode character for bell */
                            font-size: 20px;
                            line-height: 30px;
                            text-align: center;
                            position: absolute;
                            top: 50%;
                            left: 50%;
                            transform: translate(-50%, -50%);
                        }
                    </style>
                    <div class="bell-icon"></div>
                </li>
                <!-- User Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <li><a class="dropdown-item" href="{{ route('profile.edit') }}">{{ __('Profile') }}</a></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="dropdown-item" type="submit">{{ __('Log Out') }}</button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
