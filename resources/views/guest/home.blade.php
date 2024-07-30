@extends('layouts.guest')

@section('title', __('About Us'))

@section('content')
    
@include('guest.partials.hero', ['isButton' => true])

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
