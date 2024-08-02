<nav class="d-none d-lg-block ms-auto">
    <ul class="nav">
        @auth
            <li class="nav-item">
                <a href="{{ url('/dashboard') }}" class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
                    {{ __('Dashboard') }}
                </a>
            </li>
            <li class="nav-item">
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-dropdown-link>
                </form>
            </li>
        @else
            <li class="nav-item">
                <a href="{{ route('login') }}" class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
                    {{ __('Log in') }}
                </a>
            </li>
            @if (Route::has('register'))
                <li class="nav-item">
                    <a href="{{ route('register') }}" class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
                        {{ __('Register') }}
                    </a>
                </li>
            @endif
        @endauth
    </ul>
</nav>
