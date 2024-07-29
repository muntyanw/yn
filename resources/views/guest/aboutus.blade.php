@extends('layouts.guest_layout')

@section('title', __('About Us'))

@section('content')

    <!-- Hero area Start -->
    <section class="hero-section text-center d-flex align-items-center justify-content-center">
        <div class="container">
            <h1>Ми – команда однодумців, які об’єдналися з метою змінити життя людей на краще</h1>
            <p class="lead">Наш засновник і лідер – Цвєтков Борис Віталійович – з дитинства мав бажання допомагати тим, хто
                потребує підтримки. Він народився 31 травня 1996 року в м. Харкові в родині інженерів. Він закінчив УІПА
                (енергетичний факультет) в 2021 році, зараз навчається в НЮУ ім. Я. Мудрого на III курсі (факультет
                адвокатури). Він почав свою діяльність з невеликих справ: купував продукти, ліки, доставляв хворих до
                лікарні, допомагав зробити ремонт. З часом він знайшов однодумців, які поділяли його цінності та бачення.
                Він також має досвід роботи на будівництві, в мережі супермаркетів «Клас» та підприємницької діяльності.</p>
            <a href="donation.html" class="btn btn-primary">Приєднатися</a>
        </div>
    </section>
    <!-- End-of Hero -->

    <!-- Blog Start -->
    <section class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="display-5">Нове у блозі</h2>
                <p class="lead">Нещодавні події</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card">
                        <img src="https://en.torushost.com/assets/images/gallery/blog-1.png" class="card-img-top"
                            alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Реалізовано проект “Продовольчі подарунки”</h5>
                            <p class="card-text">За 2023 рік нашої роботи ми роздали 470 000 продовольчих пакунків різного
                                призначення.</p>
                            <a href="blog-details.html" class="btn btn-outline-primary">Детальніше</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <img src="https://en.torushost.com/assets/images/gallery/blog-2.png" class="card-img-top"
                            alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Реалізовано проект “Продовольчі подарунки”</h5>
                            <p class="card-text">За 2023 рік нашої роботи ми роздали 470 000 продовольчих пакунків різного
                                призначення.</p>
                            <a href="blog-details.html" class="btn btn-outline-primary">Детальніше</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <img src="https://en.torushost.com/assets/images/gallery/blog-3.png" class="card-img-top"
                            alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Реалізовано проект “Продовольчі подарунки”</h5>
                            <p class="card-text">За 2023 рік нашої роботи ми роздали 470 000 продовольчих пакунків різного
                                призначення.</p>
                            <a href="blog-details.html" class="btn btn-outline-primary">Детальніше</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End-of Blog -->

    <!-- About us Area Start -->
    <section class="bg-light py-5">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6">
                    <h2 class="display-5">“Фудшерінг” – національний центр спасіння їжі та турботи про екологію</h2>
                    <p class="lead">ГО “Єдина Нація” представляє програму “Фудшерінг” – національний центр спасіння їжі та
                        турботи про екологію та закликає всі підприємства, кафе, пекарні, та магазини долучитися до програми
                        “Фудшерінг”. Ваша участь може зробити реальну різницю в житті тих, хто постраждав від війни.</p>
                    <h3 class="h5 mt-4">Як ви можете допомогти?</h3>
                    <ul class="list-unstyled">
                        <li class="mb-3">
                            <h5 class="h6">Передайте продукти</h5>
                            <p>Ваші непродані, але якісні продукти можуть стати цінним ресурсом для тих, хто потребує.</p>
                        </li>
                        <li class="mb-3">
                            <h5 class="h6">Станьте партнером</h5>
                            <p>Підпишіть договір пожертвування з ГО “Єдина Нація” по програмі “Фудшериінг” і допомагайте
                                регулярно.</p>
                        </li>
                        <li class="mb-3">
                            <h5 class="h6">Підтримайте спільноту</h5>
                            <p>Ваша участь допоможе забезпечити їжею малозабезпечені сім’ї, пенсіонерів, та інших, хто
                                зазнає потреби.</p>
                        </li>
                    </ul>
                    <a href="about.html" class="btn btn-primary">Стати партнером</a>
                </div>
                <div class="col-lg-6">
                    <div class="row g-3">
                        <div class="col-6">
                            <img src="https://en.torushost.com/assets/images/gallery/foodshering-4.jpg"
                                class="img-fluid rounded shadow" alt="...">
                        </div>
                        <div class="col-6">
                            <img src="https://en.torushost.com/assets/images/gallery/foodshering-3.jpg"
                                class="img-fluid rounded shadow" alt="...">
                        </div>
                        <div class="col-12">
                            <img src="https://en.torushost.com/assets/images/gallery/foodshering.jpg"
                                class="img-fluid rounded shadow" alt="...">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End-of About us Area -->

    <!-- Our event Start-->
    <section class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="display-5">Звіти</h2>
                <p class="lead">Підсумки діяльності</p>
            </div>
            <div class="row g-4">
                <div class="col-lg-7">
                    <div class="card">
                        <img src="https://en.torushost.com/assets/images/gallery/event-5.png" class="card-img-top"
                            alt="...">
                        <div class="card-body">
                            <h5 class="card-title">ГО “Єдина Нація” передала генератор дитячій спортивній школі для
                                забезпечення електроенергією спортивних тренувань.</h5>
                            <p class="card-text"><i class="bi bi-calendar"></i> Червень 2024</p>
                            <a href="event-details.html" class="btn btn-outline-primary">Детальніше</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="card">
                        <img src="https://en.torushost.com/assets/images/gallery/event-4.png" class="card-img-top"
                            alt="...">
                        <div class="card-body">
                            <h5 class="card-title">6 травня 2024 року передали обладнання для хірургічного відділення 25-ї
                                лікарні міста Харкова.</h5>
                            <p class="card-text"><i class="bi bi-calendar"></i> Травень 2024</p>
                            <a href="event-details.html" class="btn btn-outline-primary">Детальніше</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End-of All Product -->

    <!-- Popular brand Start -->
    <section class="bg-light py-5">
        <div class="container">
            <div class="row g-4 text-center">
                <div class="col">
                    <img src="https://en.torushost.com/assets/images/gallery/brand-1.png" alt="brand"
                        class="img-fluid">
                </div>
                <div class="col">
                    <img src="https://en.torushost.com/assets/images/gallery/brand-2.png" alt="brand"
                        class="img-fluid">
                </div>
                <div class="col">
                    <img src="https://en.torushost.com/assets/images/gallery/brand-3.png" alt="brand"
                        class="img-fluid">
                </div>
                <div class="col">
                    <img src="https://en.torushost.com/assets/images/gallery/brand-4.png" alt="brand"
                        class="img-fluid">
                </div>
            </div>
        </div>
    </section>
    <!-- End-of Popular brand -->

@endsection
