    <!-- Меню для больших экранов -->
    <ul class="nav d-none d-lg-flex">
        @auth
            <li class="nav-item">
                <a href="{{ url('/dashboard') }}" class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
                    {{ __('Dashboard') }}
                </a>
            </li>
            <li class="nav-item">
                <!-- Authentication -->
                <a href="{{ route('logout') }}" class="nav-link"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    {{ __('Log Out') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        @else
            <li class="nav-item">
                <a href="{{ route('login') }}" class="nav-link {{ request()->is('login') ? 'active' : '' }}">
                    {{ __('Log in') }}
                </a>
            </li>
            @if (Route::has('register'))
                <li class="nav-item">
                    <a href="{{ route('register') }}" class="nav-link {{ request()->is('register') ? 'active' : '' }}">
                        {{ __('Register') }}
                    </a>
                </li>
            @endif
        @endauth
    </ul>
