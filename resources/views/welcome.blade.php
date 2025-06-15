<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Thinko.uz</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <link rel="icon" href="{{ asset('img/favicon.ico') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Inter:wght@600&family=Lobster+Two:wght@700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <style>
        html, body {
            height: 100%;
            background: #fff;
        }
        body {
            font-family: 'Heebo', 'Inter', 'Lobster Two', sans-serif;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            width: 100vw;
            overflow-x: hidden;
        }
        .main-wrapper {
            min-width: 100vw;
            background: #fff;
        }
        /* To remove container max-width limitation on large screens */
        .container-xxl, .container-fluid {
            max-width: 100vw !important;
            padding-left: 0 !important;
            padding-right: 0 !important;
        }
    </style>
</head>
<body>
<div class="main-wrapper">
    <!-- Spinner -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Yuklanmoqda...</span>
        </div>
    </div>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top px-4 px-lg-5 py-lg-0">
        <a href="index.html" class="navbar-brand">
            <h1 class="m-0 text-primary"><i class="fa fa-book-reader me-3"></i>Thinko.uz</h1>
        </a>
        <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav mx-auto">
                <a href="index.html" class="nav-item nav-link active">Asosiy sahifa</a>
                <a href="about.html" class="nav-item nav-link">Haqida</a>
                <a href="https://t.me/Baxriddinovich_Dev" class="nav-item nav-link">Bog'lanish</a>
            </div>
            <a href="" class="btn btn-primary rounded-pill px-3 d-none d-lg-block">Saytga qo'shilish<i class="fa fa-arrow-right ms-3"></i></a>
            @if (Route::has('login'))
                <div class="d-flex align-items-center gap-2 ms-3">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn btn-outline-dark">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline-dark">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-outline-dark">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>
    </nav>

    <!-- Carousel -->
    <div class="container-fluid p-0 mb-5">
        <div class="owl-carousel header-carousel position-relative">
            <div class="owl-carousel-item position-relative">
                <img class="img-fluid w-100" src="{{ asset('img/carousel-1.jpg') }}" alt="">
                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center" style="background: rgba(0, 0, 0, .2);">
                    <div class="container">
                        <div class="row justify-content-start">
                            <div class="col-10 col-lg-8">
                                <h1 class="display-2 text-white animated slideInDown mb-4">Thinko.uz - biz doim siz bilanmiz !</h1>
                                <p class="fs-5 fw-medium text-white mb-4 pb-2">
                                    Farzandingiz telefonni foydali ishlatishini xohlaysizmi? Unda Thinko.uz siz uchun! Bu yerda bolalar topshiriq bajaradi, coinlar yig‘adi, badge oladi va o‘z orzulari sari qadam tashlaydi! Biz bilan bilim olish — sarguzasht!
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="owl-carousel-item position-relative">
                <img class="img-fluid w-100" src="{{ asset('img/carousel-2.jpg') }}" alt="">
                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center" style="background: rgba(0, 0, 0, .2);">
                    <div class="container">
                        <div class="row justify-content-start">
                            <div class="col-10 col-lg-8">
                                <h1 class="display-2 text-white animated slideInDown mb-4">Thinko.uz - biz doim siz bilanmiz !</h1>
                                <p class="fs-5 fw-medium text-white mb-4 pb-2">
                                    Thinko.uz — bu bolalar uchun yaratilgan innovatsion platforma bo‘lib, ularni bilim olish, sog‘lom hayot tarziga o‘rgatish va real hayotdagi faoliyatga jalb etishga xizmat qiladi. Har bir topshiriq – yangi imkoniyat. Har bir harakat – mukofot bilan rag‘batlantiriladi. Bu yerda bolalar o‘rganadi, harakat qiladi va rivojlanadi.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Facilities -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="facility-item">
                        <div class="facility-icon bg-primary">
                            <span class="bg-primary"></span>
                            <i class="fas fa-brain fa-3x text-primary"></i>
                            <span class="bg-primary"></span>
                        </div>
                        <div class="facility-text bg-primary">
                            <h3 class="text-primary mb-3">Smart Topshiriqlar</h3>
                            <p class="mb-0">Har kuni yangilanuvchi aqliy, jismoniy va ijodiy topshiriqlar orqali bolangiz o‘z qiziqishlarini kashf etadi.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="facility-item">
                        <div class="facility-icon bg-success">
                            <span class="bg-success"></span>
                            <i class="fa fa-futbol fa-3x text-success"></i>
                            <span class="bg-success"></span>
                        </div>
                        <div class="facility-text bg-success">
                            <h3 class="text-success mb-3">Interaktiv O‘yinlar</h3>
                            <p class="mb-0">Topshiriqlar o‘yin elementlari bilan boyitilgan — farzandingiz o‘rganar ekan, charchamaydi, aksincha zavqlanadi!</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="facility-item">
                        <div class="facility-icon bg-warning">
                            <span class="bg-warning"></span>
                            <i class="fa fa-home fa-3x text-warning"></i>
                            <span class="bg-warning"></span>
                        </div>
                        <div class="facility-text bg-warning">
                            <h3 class="text-warning mb-3">Motivatsion Mukofotlar</h3>
                            <p class="mb-0">Coin, badge va reyting orqali bolangiz muvaffaqiyat sari intiladi. Harakat — mukofot bilan taqdirlanadi!</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="facility-item">
                        <div class="facility-icon bg-info">
                            <span class="bg-info"></span>
                            <i class="fa fa-chalkboard-teacher fa-3x text-info"></i>
                            <span class="bg-info"></span>
                        </div>
                        <div class="facility-text bg-info">
                            <h3 class="text-info mb-3">Ota-onalar Nazorati</h3>
                            <p class="mb-0">Ota-onalar har bir topshiriqni, yutuqni va faoliyatni nazorat qila oladi. Bola o‘sadi, siz xotirjam bo‘lasiz</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- About -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <h1 class="mb-4">Sayt yaratuvchisi</h1>
                    <p>
                        Men Baymatov Bobur Baxriddin o'g'li, dasturlash va texnologiya sohasida keng tajribaga ega bo'lgan mutaxassisman. Men turli xil loyihalarda ishlashni yaxshi ko'raman va har doim yangi texnologiyalarni o'rganishga intilaman. Bugungi kunda PHP, MySQL, C++, JavaScript, HTML va CSS kabi texnologiyalar bilan ishlayman ))
                    </p>
                    <div class="row g-4 align-items-center">
                        <div class="col-sm-6"></div>
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center">
                                <img class="rounded-circle flex-shrink-0" src="{{ asset('img/user.jpg') }}" alt="" style="width: 45px; height: 45px;">
                                <div class="ms-3">
                                    <h6 class="text-primary mb-1">Bobur Baymatov</h6>
                                    <small>Web developer</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- You can add an image or illustration here if you want -->
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="container-fluid bg-dark text-white-50 footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-4 col-md-6">
                    <h4 class="text-white mb-4">Aloqa</h4>
                    <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>Jizzax, O'zbekiston</p>
                    <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+998 99 555 7106</p>
                    <p class="mb-2"><i class="fa fa-envelope me-3"></i>boymatovbobur6@gmail.com</p>
                    <div class="d-flex pt-2">
                        <a class="btn btn-outline-light btn-social" href="#"><i class="fab fa-telegram-plane"></i></a>
                        <a class="btn btn-outline-light btn-social" href="#"><i class="fab fa-github"></i></a>
                        <a class="btn btn-outline-light btn-social" href="#"><i class="fab fa-linkedin-in"></i></a>
                        <a class="btn btn-outline-light btn-social" href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <h4 class="text-white mb-4">Foydali Havolalar</h4>
                    <a class="btn btn-link text-white-50" href="#">Men haqimda</a>
                    <a class="btn btn-link text-white-50" href="#">Loyihalarim</a>
                    <a class="btn btn-link text-white-50" href="#">Xizmatlar</a>
                    <a class="btn btn-link text-white-50" href="#">Maxfiylik Siyosati</a>
                    <a class="btn btn-link text-white-50" href="#">Foydalanish shartlari</a>
                </div>
                <div class="col-lg-4 col-md-12">
                    <h4 class="text-white mb-4">Men Haqimda</h4>
                    <p class="mb-0">
                        Men web dasturchiman. PHP, MySQL, HTML, CSS va JavaScript bilan to‘liq funksional va zamonaviy web platformalar yaratishga ixtisoslashganman. Har bir loyiha – bu men uchun yangi tajriba va rivojlanish imkoniyati.
                    </p>
                </div>
            </div>
        </div>
        <div class="container-fluid bg-secondary text-white text-center py-4">
            <p class="mb-0">&copy; 2025 Sizning Baxriddinovich. Barcha huquqlar himoyalangan.</p>
        </div>
    </div>

    <!-- Back to top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('lib/wow/wow.min.js') }}"></script>
<script src="{{ asset('lib/easing/easing.min.js') }}"></script>
<script src="{{ asset('lib/waypoints/waypoints.min.js') }}"></script>
<script src="{{ asset('lib/owlcarousel/owl.carousel.min.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>
<script>
    // Spinner
    window.addEventListener('DOMContentLoaded', () => {
        setTimeout(() => {
            document.getElementById('spinner').style.display = 'none';
        }, 600);
    });
</script>
</body>
</html>
