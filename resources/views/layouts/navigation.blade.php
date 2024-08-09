<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand" href="{{ route('dashboard') }}">
            <img src="/storage/common/oovpKJMyh4leT8NYjk3JRxd1g5MRMn7C3texDBqP.png" alt="logo"
                    class="d-none d-lg-block">
        </a>

        <!-- Hamburger (for mobile) -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navigation Links and Settings -->
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link @if (request()->routeIs('dashboard')) active @endif" href="{{ route('dashboard') }}">
                        {{ __('Dashboard') }}
                    </a>
                </li>

                @role('volunteer')
                    <li class="nav-item">
                        <a class="nav-link @if (request()->routeIs('offer_volunteer_index')) active @endif" href="{{ route('offer_volunteer_index') }}">
                            {{ __('Offers') }}
                        </a>
                    </li>
                @endrole

                @role('admin')
                    <li class="nav-item">
                        <a class="nav-link @if (request()->routeIs('admin_panel')) active @endif" href="{{ route('admin_panel') }}">
                            {{ __('Admin panel') }}
                        </a>
                    </li>
                @endrole
            </ul>

            <!-- User Dropdown -->
            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <li>
                            <a class="dropdown-item" href="{{ route('profile.edit') }}">{{ __('Profile') }}</a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <!-- Logout Form -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </a>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Responsive Navigation Menu (for mobile) -->
<div class="d-lg-none">
    <div class="bg-light border-top">
        <a class="nav-link @if (request()->routeIs('dashboard')) active @endif" href="{{ route('dashboard') }}">
            {{ __('Dashboard') }}
        </a>
    </div>

    <div class="bg-light border-top">
        <div class="p-3">
            <div class="font-weight-bold">{{ Auth::user()->name }}</div>
            <div class="text-muted">{{ Auth::user()->email }}</div>
        </div>
        <div class="bg-light">
            <a class="nav-link" href="{{ route('profile.edit') }}">{{ __('Profile') }}</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                    {{ __('Log Out') }}
                </a>
            </form>
        </div>
    </div>
</div>
