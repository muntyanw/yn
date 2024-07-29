<header class="navbar fixed-top header">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center" style="width: 100%;">
            <a href="index.html" class="navbar-brand">
                <img src="https://en.torushost.com/assets/images/logo/dark.png" alt="logo" class="d-none d-lg-block">
                <img src="https://en.torushost.com/assets/images/icon/favicon.png" alt="logo" class="d-lg-none">
            </a>
            <nav class="d-none d-lg-block">
                <ul class="nav">
                    <li class="nav-item"><a href="index.php" class="nav-link active">Головна</a></li>
                    <li class="nav-item"><a href="index.php" class="nav-link">Про нас</a></li>
                    <li class="nav-item"><a href="volunteers.php" class="nav-link">Команда</a></li>
                    <li class="nav-item"><a href="projects.php" class="nav-link">Проекти</a></li>
                    <li class="nav-item"><a href="tenders.php" class="nav-link">Тендери</a></li>
                    <li class="nav-item"><a href="reports.php" class="nav-link">Звіти</a></li>
                    <li class="nav-item"><a href="blog.php" class="nav-link">Блог</a></li>
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
            <li class="nav-item"><a href="index.php" class="nav-link active">Головна</a></li>
            <li class="nav-item"><a href="index.php" class="nav-link">Про нас</a></li>
            <li class="nav-item"><a href="volunteers.php" class="nav-link">Команда</a></li>
            <li class="nav-item"><a href="projects.php" class="nav-link">Проекти</a></li>
            <li class="nav-item"><a href="tenders.php" class="nav-link">Тендери</a></li>
            <li class="nav-item"><a href="reports.php" class="nav-link">Звіти</a></li>
            <li class="nav-item"><a href="blog.php" class="nav-link">Блог</a></li>
            <li class="nav-item ms-auto">
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
