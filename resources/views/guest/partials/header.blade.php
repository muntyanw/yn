<header class="navbar fixed-top header">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center w-100">
            <a href="/" class="navbar-brand">
                <img src="/storage/common/j4IQVqbmHuTecqRnCYtxY32xTIUNZ3LuScf7jryL.png" alt="logo"
                    class="d-none d-lg-block">
            </a>
            <nav class="d-none d-lg-block">
                <ul class="nav">
                    <li class="nav-item">
                        <a href="{{ route('guest_home') }}"
                            class="nav-link {{ request()->routeIs('guest_home') ? 'active' : '' }}">Головна</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('guest_team') }}"
                            class="nav-link {{ request()->routeIs('guest_team') ? 'active' : '' }}">Команда</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('guest_offers_index') }}"
                            class="nav-link {{ request()->routeIs('guest_offers_index') ? 'active' : '' }}">Волонтери</a>
                    </li>
                    {{-- <li class="nav-item">
                        <a href="tenders.php"
                            class="nav-link {{ request()->is('tenders') ? 'active' : '' }}">Тендери</a>
                    </li> --}}
                   {{-- Звіти с выпадающим подменю --}}
                   <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle {{ request()->is('reports', 'financial-reports') ? 'active' : '' }}" id="reportsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Звіти
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="reportsDropdown">
                        <li><a href="{{ route('guest_reports_last') }}" class="dropdown-item {{ request()->is('reports') ? 'active' : '' }}">Звіти по діяльності</a></li>
                        <li><a href="{{ route('guest_financial_reports_last') }}" class="dropdown-item {{ request()->is('financial-reports') ? 'active' : '' }}">Фінансові звіти</a></li>
                    </ul>
                </li>
                    {{-- <li class="nav-item">
                        <a href="blog.php" class="nav-link {{ request()->is('blog') ? 'active' : '' }}">Підтримати
                            Нас</a>
                    </li> --}}
                </ul>
            </nav>

            @include('guest.partials.login')

            <div class="d-lg-none">
                <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileMenu"
                    aria-controls="mobileMenu">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </div>
    </div>
</header>

<!-- Offcanvas меню для мобильных устройств -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="mobileMenu" aria-labelledby="mobileMenuLabel"
    style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('/storage/common/BgusTKIorv14R5WHlfXUy5FZYKwEbkauxbHsxIAP.jpg') center/cover no-repeat;">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="mobileMenuLabel">Меню</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a href="{{ route('guest_home') }}"
                    class="nav-link {{ request()->routeIs('guest_home') ? 'active' : '' }}">Головна</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('guest_team') }}"
                    class="nav-link {{ request()->routeIs('guest_team') ? 'active' : '' }}">Команда</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('guest_offers_index') }}"
                    class="nav-link {{ request()->routeIs('guest_offers_index') ? 'active' : '' }}">Волонтери</a>
            </li>
            {{-- <li class="nav-item">
                <a href="tenders.php" class="nav-link {{ request()->is('tenders') ? 'active' : '' }}">Тендери</a>
            </li> --}}
            {{-- Звіти с выпадающим подменю --}}
            <li class="nav-item">
                <a href="#reportsSubMenu"
                    class="nav-link {{ request()->is('reports', 'financial-reports') ? 'active' : '' }}"
                    data-bs-toggle="collapse" aria-expanded="false">Звіти</a>
                <ul class="nav collapse" id="reportsSubMenu">
                    <li class="nav-item">
                        <a href="{{ route('guest_reports_last') }}"
                            class="nav-link {{ request()->is('reports') ? 'active' : '' }}">Звіти по діяльності</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('guest_financial_reports_last') }}"
                            class="nav-link {{ request()->is('financial-reports') ? 'active' : '' }}">Фінансові
                            звіти</a>
                    </li>
                </ul>
            </li>
            {{-- <li class="nav-item">
                <a href="blog.php" class="nav-link {{ request()->is('blog') ? 'active' : '' }}">Підтримати Нас</a>
            </li> --}}
        </ul>

        @include('guest.partials.login')

    </div>
</div>

@section('scripts')
    <script>
        // Обеспечивает, что меню будет корректно открываться и закрываться на мобильных устройствах
        document.addEventListener('DOMContentLoaded', function() {
            var offcanvasElementList = [].slice.call(document.querySelectorAll('.offcanvas'))
            var offcanvasList = offcanvasElementList.map(function(offcanvasEl) {
                return new bootstrap.Offcanvas(offcanvasEl)
            })
        });
    </script>
@endsection
