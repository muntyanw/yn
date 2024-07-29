<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Цей шаблон підходить для благодійних організацій, НПО, неприбуткових організацій, пожертвувань, церкви або сайтів для збору коштів.">
    <meta name="keywords" content="благодійність, причини, пожертвування, благодійний фонд, благодійний хаб, благодійна тема, пожертвування, неприбуткова організація, фандрейзер, соціальна, НПО, неприбуткова, волонтер">
    <meta name="author" content="initTheme">
    <title>Громадська організація "Єдина Нація"</title>
    <link rel="icon" type="image/x-icon" sizes="20x20" href="https://en.torushost.com/assets/images/icon/favicon.ico">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .navbar {
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .navbar-brand img {
            height: 40px;
        }
        .hero-section {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://en.torushost.com/assets/images/hero/hero-lider-2.jpg') center/cover no-repeat;
            color: white;
            padding: 100px 0;
        }
        .hero-section h1 {
            font-size: 3rem;
        }
        .hero-section p {
            font-size: 1.2rem;
        }
    </style>
</head>
<body>
    <header class="bg-light py-3 fixed-top">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <a href="index.html" class="navbar-brand">
                    <img src="https://en.torushost.com/assets/images/logo/dark.png" alt="logo" class="d-none d-lg-block">
                    <img src="https://en.torushost.com/assets/images/icon/favicon.png" alt="logo" class="d-lg-none">
                </a>
                <nav class="d-none d-lg-block">
                    <ul class="nav">
                        <li class="nav-item"><a href="index.php" class="nav-link active">Про нас</a></li>
                        <li class="nav-item"><a href="volunteers.php" class="nav-link">Команда</a></li>
                        <li class="nav-item"><a href="projects.php" class="nav-link">Проекти</a></li>
                        <li class="nav-item"><a href="tenders.php" class="nav-link">Тендери</a></li>
                        <li class="nav-item"><a href="reports.php" class="nav-link">Звіти</a></li>
                        <li class="nav-item"><a href="blog.php" class="nav-link">Блог</a></li>
                    </ul>
                </nav>
                <div class="d-lg-none">
                    <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileMenu" aria-controls="mobileMenu">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
            </div>
        </div>
    </header>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="mobileMenu" aria-labelledby="mobileMenuLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="mobileMenuLabel">Меню</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <ul class="nav flex-column">
                <li class="nav-item"><a href="index.php" class="nav-link active">Про нас</a></li>
                <li class="nav-item"><a href="volunteers.php" class="nav-link">Команда</a></li>
                <li class="nav-item"><a href="projects.php" class="nav-link">Проекти</a></li>
                <li class="nav-item"><a href="tenders.php" class="nav-link">Тендери</a></li>
                <li class="nav-item"><a href="reports.php" class="nav-link">Звіти</a></li>
                <li class="nav-item"><a href="blog.php" class="nav-link">Блог</a></li>
            </ul>
        </div>
    </div>
    <main>
        @yield('content')
    </main>
    <!-- Footer Start -->
    <footer class="bg-dark text-light py-4">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-3">
                    <h5>Розділи сайту</h5>
                    <ul class="nav flex-column">
                        <li class="nav-item"><a href="index.php" class="nav-link text-light">Про нас</a></li>
                        <li class="nav-item"><a href="projects.php" class="nav-link text-light">Проекти</a></li>
                        <li class="nav-item"><a href="blog.php" class="nav-link text-light">Блог</a></li>
                        <li class="nav-item"><a href="feedback.php" class="nav-link text-light">Відгуки</a></li>
                        <li class="nav-item"><a href="mission.php" class="nav-link text-light">Наша місія</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h5>Отримати підтримку</h5>
                    <ul class="nav flex-column">
                        <li class="nav-item"><a href="volunteer.php" class="nav-link text-light">Стати волонтером</a></li>
                        <li class="nav-item"><a href="how-it-works.php" class="nav-link text-light">Як це працює</а></li>
                        <li class="nav-item"><a href="knowledge-base.php" class="nav-link text-light">База знань</а></li>
                        <li class="nav-item"><a href="success-stories.php" class="nav-link text-light">Успішні історії</а></ли>
                        <ли класс="nav-item"><а href="contacts.php" class="nav-link text-light">Контакти</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h5>Контакти</h5>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <i class="bi bi-envelope"></i>
                            <a href="mailto:donation@gmail.com" class="nav-link text-light d-inline-block">donation@gmail.com</a>
                        </li>
                        <li class="nav-item">
                            <i class="bi bi-telephone"></i>
                            <a href="tel:+88111222333" class="nav-link text-light d-inline-block">(+88) 111-222-333</a>
                        </ли>
                        <ли класс="nav-item">
                            <i class="bi bi-geo-alt"></i>
                            <span class="nav-link text-light d-inline-block">Місцезнаходження, Харків</span>
                        </li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h5>Проекти</h5>
                    <ul class="nav flex-column">
                        <li class="nav-item d-flex align-items-center">
                            <img src="https://en.torushost.com/assets/images/gallery/project-1.png" class="img-fluid me-2" alt="project">
                            <a href="donation-details.html" class="nav-link text-light">Соціальні їдальні</a>
                        </li>
                        <li class="nav-item d-flex align-items-center">
                            <img src="https://en.torushost.com/assets/images/gallery/project-2.png" class="img-fluid me-2" alt="project">
                            <a href="donation-details.html" class="nav-link text-light">Збір вторсировини</a>
                        </ли>
                    </ul>
                </div>
            </div>
            <div class="text-center mt-4">
                <p class="mb-0">&copy; 2024 ГО "Єдина Нація". Всі права захищені.</p>
                <ul class="nav justify-content-center">
                    <li class="nav-item"><a href="#" class="nav-link text-light"><i class="bi bi-facebook"></i></a></li>
                    <li class="nav-item"><a href="#" class="nav-link text-light"><i class="bi bi-youtube"></i></a></ли>
                    <ли класс="nav-item"><а href="#" class="nav-link text-light"><i class="bi bi-instagram"></i></а></ли>
                    <ли класс="nav-item"><а href="#" class="nav-link text-light"><i class="bi bi-linkedin"></i></а></ли>
                </ul>
            </div>
        </div>
    </footer>
    <!-- End-of Footer -->

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>
