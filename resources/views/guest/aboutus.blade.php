@extends('layouts.guest')

@section('title', __('About Us'))

@section('content')

    @include('guest.partials.hero', ['isButton' => false])
    <!-- Content Start -->

    <section class="content-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <p>Ми працюємо в різних напрямках, але <strong>наша основна місія &#8211; це допомога людям, які
                            опинилися в складних життєвих умовах</strong>. Ми надаємо допомогу дитячим будинкам,
                        багатодітним родинам, одиноким пенсіонерам, безпритульним тваринам. Ми також підтримуємо постраждале
                        населення з деокупованих територій. Ми не лише забезпечуємо їх матеріальними ресурсами, але й
                        надаємо їм комфорт та надію.</p>
                </div>
                <div class="col-md-4">
                    <img src="https://www.edinaianatsiia.org.ua/wp-content/uploads/2023/08/photo_2023-08-22_16-27-36-3-768x1024.jpg"
                        alt="Допомога" style="margin-left: 4em;">
                </div>
            </div>
        </div>
    </section>

    <section class="content-section bg-light">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-4">
                    <img src="https://www.edinaianatsiia.org.ua/wp-content/uploads/2023/08/photo_2023-08-22_16-27-27-1024x768.jpg"
                        alt="Проект" style="margin-left: -4em;">
                </div>
                <div class="col-md-8">
                    <p>Ми віримо, що кожна людина має право на гідне життя, а кожна тварина &#8211; на любов та догляд. Ми
                        віримо, що разом ми можемо створити світ, де панує мир, рівність та співчуття. Ми віримо, що наша
                        діяльність &#8211; це не піар-хід, а наша місія.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="content-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8" style="margin-left: -4em;">
                    <p>Якщо ви поділяєте наші цінності та бажаєте долучитися до нашої справи, ви можете зробити пожертву на
                        наш сайт або зв’язатися з нами за телефоном або електронною поштою. Ваша підтримка дуже важлива для
                        нас та для тих, кому ми допомагаємо. Дякуємо за вашу щедрість та доброту!</p>
                </div>
                <div class="col-md-4" style="margin-left: 4em;">
                    <img src="https://www.edinaianatsiia.org.ua/wp-content/uploads/2023/08/photo_2023-08-22_16-27-31-1024x768.jpg"
                        alt="Подяка" >
                </div>
            </div>
        </div>
    </section>

    <section class="content-section bg-light">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-4">
                    <img src="https://www.edinaianatsiia.org.ua/wp-content/uploads/2023/08/photo_2023-08-22_16-26-41-1024x682.jpg"
                        alt="Команда" style="margin-left: -4em;">
                </div>
                <div class="col-md-8" >
                    <p>Для отримання більш детальної інформації про нашу організацію та наші проекти, ви можете переглянути
                        наші розділи на сайті або слідкувати за нами в соціальних мережах. Ми будемо раді почути ваші думки
                        та пропозиції.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="content-section">
        <div class="container">
            <p class="text-center h5 font-weight-bold">Єдина Нація &#8211; це не просто назва, а наша філософія. Ми &#8211;
                одна нація, одна родина, одна команда. Давайте допомагати один одному та робити світ кращим!</p>
            <p class="text-center h5 font-weight-bold">Наша організація була заснована у 2019 році і з того часу ми
                допомогли тисячам людей та тварин.</p>
        </div>
    </section>
@endsection
