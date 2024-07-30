@extends('layouts.guest')

@section('title', __('About Us'))

@section('content')

    <!-- Hero area Start -->
    <section class="hero-section text-center d-flex align-items-center justify-content-center">
        <div class="container" style="position: relative; z-index: 1;">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <h1 class="text-white">Ми – команда однодумців, які об’єдналися з метою змінити життя людей на краще</h1>
                    <p class="lead text-white" style="text-align: justify;margin-top:1em;">
                        Наш засновник і лідер – <strong>Цвєтков Борис Віталійович</strong>
                        <img src="/storage/common/hero-lider.jpg" alt="Цвєтков Борис Віталійович"
                            class="img-fluid rounded shadow float-lg-start ms-lg-3 mb-3" style="max-width: 200px;margin-right:1em;">
                        – з дитинства мав бажання допомагати тим, хто потребує підтримки. Він народився 31 травня 1996 року
                        в м. Харкові в родині інженерів. Він закінчив УІПА (енергетичний факультет) в 2021 році, зараз
                        навчається в НЮУ ім. Я. Мудрого на III курсі (факультет адвокатури). Він почав свою діяльність з
                        невеликих справ: купував продукти, ліки, доставляв хворих до лікарні, допомагав зробити ремонт. З
                        часом він знайшов однодумців, які поділяли його цінності та бачення. Він також має досвід роботи на
                        будівництві, в мережі супермаркетів «Клас» та підприємницької діяльності.
                    </p>
                </div>
            </div>
            <div class="row align-items-center justify-content-center">
                <a href="donation.html" class="btn btn-primary" style="width: 16em">Детальніше</a>
            </div>

        </div>
    </section>
    <!-- End-of Hero -->

    <!-- Blog Start -->
    <section class="py-5" style="background-color:beige;">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="display-5 text-primary">Новини</h2>
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

@endsection
