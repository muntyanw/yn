<header class="navbar fixed-top header">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center" style="width: 100%;">
            <a href="/" class="navbar-brand">
                <img src="/storage/common/Os1U2BnGzy4nxtgiuLRlXiutEmz1JClchoKtx2UG.png" alt="logo" class="d-none d-lg-block">
            </a>
            <nav class="d-none d-lg-block">
                <ul class="nav">
                    <li class="nav-item">
                        <a href="{{ route('guest_home') }}" class="nav-link {{ request()->routeIs('guest_home') ? 'active' : '' }}">Головна</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('guest_aboutus') }}" class="nav-link {{ request()->routeIs('guest_aboutus') ? 'active' : '' }}">Про нас</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('guest_team') }}" class="nav-link {{ request()->routeIs('guest_team') ? 'active' : '' }}">Команда</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('guest_volunteers') }}" class="nav-link {{ request()->routeIs('guest_volunteers') ? 'active' : '' }}">Волонтери</a>
                    </li>
                    <li class="nav-item">
                        <a href="tenders.php" class="nav-link {{ request()->is('tenders') ? 'active' : '' }}">Тендери</a>
                    </li>
                    <li class="nav-item">
                        <a href="reports.php" class="nav-link {{ request()->is('reports') ? 'active' : '' }}">Звіти</a>
                    </li>
                    <li class="nav-item">
                        <a href="blog.php" class="nav-link {{ request()->is('blog') ? 'active' : '' }}">Підтримати Нас</a>
                    </li>
                </ul>
            </nav>
            <nav class="d-none d-lg-block ms-auto">
                <ul class="nav">
                    <li class="nav-item">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>
                    </li>
                    <li class="nav-item">
                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="d-lg-none">
            <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileMenu"
                aria-controls="mobileMenu">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </div>
</header>

<!-- Offcanvas меню для мобильных устройств -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="mobileMenu" aria-labelledby="mobileMenuLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="mobileMenuLabel">Меню</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a href="{{ route('guest_home') }}" class="nav-link {{ request()->routeIs('guest_home') ? 'active' : '' }}">Головна</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('guest_aboutus') }}" class="nav-link {{ request()->routeIs('guest_aboutus') ? 'active' : '' }}">Про нас</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('guest_team') }}" class="nav-link {{ request()->routeIs('guest_team') ? 'active' : '' }}">Команда</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('guest_volunteers') }}" class="nav-link {{ request()->routeIs('guest_volunteers') ? 'active' : '' }}">Волонтери</a>
            </li>
            <li class="nav-item">
                <a href="tenders.php" class="nav-link {{ request()->is('tenders') ? 'active' : '' }}">Тендери</a>
            </li>
            <li class="nav-item">
                <a href="reports.php" class="nav-link {{ request()->is('reports') ? 'active' : '' }}">Звіти</a>
            </li>
            <li class="nav-item">
                <a href="blog.php" class="nav-link {{ request()->is('blog') ? 'active' : '' }}">Підтримати Нас</a>
            </li>
            <li class="nav-item ms-auto">
                @auth
                    <a href="{{ url('/dashboard') }}" class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
                        {{ __('Dashboard') }}
                    </a>
                @else
                    <a href="{{ route('login') }}"
                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                        Log in
                    </a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                            Register
                        </a>
                    @endif
                @endauth


                <x-dropdown-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-dropdown-link>
            </li>
            <li class="nav-item">
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-dropdown-link :href="route('logout')"
                        onclick="event.preventDefault();
                                    this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-dropdown-link>
                </form>
            </li>
        </ul>
    </div>
</div>
