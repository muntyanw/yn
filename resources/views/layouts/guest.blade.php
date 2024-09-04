<!DOCTYPE html>
<html lang="uk">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
        content="Благодійна організація Єдина">
    <meta name="keywords"
        content="благодійність, причини, пожертвування, благодійний фонд, благодійний хаб, благодійна тема, пожертвування, неприбуткова організація, фандрейзер, соціальна, НПО, неприбуткова, волонтер">
    <meta name="author" content="initTheme">
    <title>Громадська організація "Єдина Нація"</title>
    <link rel="icon" type="image/x-icon" sizes="20x20"
        href="/storage/common/oovpKJMyh4leT8NYjk3JRxd1g5MRMn7C3texDBqP.png">

    {!! $headerAdditions ?? '' !!}

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .btn {
            margin: 2px 4px;
        }

        .carousel-control-prev,
        .carousel-control-next {
            position: relative !important;
            text-align: center;
        }

        /***********************************************************************/

        /* Стили для экранов меньше 768px */
        .zasnov {
            text-align: center;
        }

        .reportimgwith {
            width: 280px;
        }

        .reportcontwith {
            width: 340px;
        }

        .carousel-control-next {
            margin-top: -2em;
            margin-left: 94%;
        }

        /* Стили для экранов от 768px до 991px */
        @media (min-width: 767px) and (max-width: 991px) {
            .reportimgwith {
                width: 560px;
            }

            .reportcontwith {
                width: 700px;
            }

            .carousel-control-next {
                margin-top: -2em;
                margin-left: 94%;
            }

        }

        /* Стили для экранов от 768px до 991px */
        @media (min-width: 992px) and (max-width: 1024px) {

            .carousel-control-prev,
            .carousel-control-next {
                position: absolute !important;
            }

            .zasnov {
                text-align: justify;
            }

            .reportimgwith {
                width: 600px;
            }

            .reportcontwith {
                width: 960px;
            }

            .carousel-control-next {
                margin-top: -2em;
                margin-left: 94%;
            }


        }

        /* Стили для экранов от 992px и выше */
        @media (min-width: 1025px) {

            .carousel-control-prev,
            .carousel-control-next {
                position: absolute !important;
            }

            .zasnov {
                text-align: justify;
            }

            .reportimgwith {
                width: 600px;
            }

            .reportcontwith {
                width: 1100px;
            }

            .carousel-control-next {
                margin-top: 0;
                margin-left: 0;
            }
            

        }




        .content-section {
            padding: 3rem 1rem;
            background-color: #f5f5dc;
            /* светлый бежевый */
        }

        .content-section.bg-dark {
            background-color: #d2b48c;
            /* темный бежевый */
        }

        .content-section h2 {
            margin-bottom: 2rem;
            font-size: 2.5rem;
            /* еще крупнее */
        }

        .content-section img {
            max-width: 100%;
            height: auto;
            border-radius: 0.5rem;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 1.5rem;
        }

        .content-section p {
            font-size: 1.3rem;
            text-align: justify;
        }

        .section-heading {
            font-weight: bold;
            margin-bottom: 2rem;
        }

        .header {
            transition: background-color 0.3s ease;
        }

        .header.scrolled {
            background-color: #343a40;
            /* Темный цвет */
            opacity: 1;
        }

        .navbar {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand img {
            height: 80px;
            margin-right: 1em;
        }

        .nav-link {
            color: #fffbe4 !important;
            /* желтый цвет */
        }

        .nav-link.active {
            font-weight: bold;
            color: #FFD700 !important;
            /* желтый цвет */
        }

        .hero-section {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('/storage/news_photos/k2rNcgk64YDy06dAdXB4LN3nbv7mLeTg0T5TjUWL.jpg') center/cover no-repeat;
            color: white;
            padding: 100px 0;
        }

        .hero-section h1 {
            font-size: 3rem;
        }

        .hero-section p {
            font-size: 1.5rem;
        }

        .btn-primary {
            background-color: #FFD700;
            border-color: #FFD700;
            color: #000;
        }

        .btn-primary:hover {
            background-color: #FFC107;
            border-color: #FFC107;
            color: #000;
        }

        .bg-dark {
            background-color: #1D1D1D !important;
        }

        footer a {
            color: #FFD700;
        }

        footer a:hover {
            color: #FFC107;
        }

        .bg-light-beige {
            background-color: #f5f5dc;
        }
    </style>

    @yield('style')
</head>

<body class="bg-light-beige">
    {!! $bodyAdditions ?? '' !!}
    @include('guest.partials.header')
    <main>
        @yield('content')
    </main>
    @include('guest.partials.footer')

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>
    <script>
        window.addEventListener('scroll', function() {
            const header = document.querySelector('.header');
            if (window.scrollY > 50) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });
    </script>
    @yield('scripts')
    {!! $scriptAdditions ?? '' !!}

</body>

</html>
