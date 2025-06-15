<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Thinko.uz</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <link href="img/favicon.ico" rel="icon">
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Inter:wght@600&family=Lobster+Two:wght@700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Heebo', 'Inter', 'Lobster Two', sans-serif; }
        .font-lobster { font-family: 'Lobster Two', cursive; }
        .carousel-fade { transition: opacity 0.7s; }
    </style>
</head>
<body class="bg-white">
<!-- Spinner -->
<div id="spinner" class="fixed inset-0 flex items-center justify-center bg-white z-50">
    <div class="w-12 h-12 border-4 border-blue-500 border-t-transparent rounded-full animate-spin"></div>
    <span class="sr-only">Yuklanmoqda...</span>
</div>

<!-- Navbar -->
<nav class="sticky top-0 w-full bg-white shadow z-30">
    <div class="container mx-auto flex items-center justify-between px-6 py-3">
        <a href="index.html" class="flex items-center gap-2">
            <i class="fa fa-book-reader text-2xl text-blue-600"></i>
            <span class="text-2xl text-blue-600 font-bold font-lobster">Thinko.uz</span>
        </a>
        <div class="hidden lg:flex items-center gap-6">
            <a href="index.html" class="text-blue-600 font-semibold border-b-2 border-blue-600 pb-1">Asosiy sahifa</a>
            <a href="about.html" class="text-gray-700 hover:text-blue-600 transition">Haqida</a>
            <a href="https://t.me/Baxriddinovich_Dev" class="text-gray-700 hover:text-blue-600 transition">Bog'lanish</a>
            <a href="#" class="ml-4 px-6 py-2 bg-blue-600 text-white rounded-full hover:bg-blue-700 transition items-center hidden lg:inline-flex">
                Saytga qo'shilish <i class="fa fa-arrow-right ml-2"></i>
            </a>
            @if (Route::has('login'))
                <nav class="flex items-center justify-end gap-4">
                    @auth
                        <a
                            href="{{ url('/dashboard') }}"
                            class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal"
                        >
                            Dashboard
                        </a>
                    @else
                        <a
                            href="{{ route('login') }}"
                            class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] text-[#1b1b18] border border-transparent hover:border-[#19140035] dark:hover:border-[#3E3E3A] rounded-sm text-sm leading-normal"
                        >
                            Log in
                        </a>

                        @if (Route::has('register'))
                            <a
                                href="{{ route('register') }}"
                                class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
                                Register
                            </a>
                        @endif
                    @endauth
                </nav>
            @endif
        </div>
    </div>
</nav>

<!-- Carousel -->
<div class="relative w-full h-[500px] overflow-hidden mb-12">
    <div class="absolute inset-0 w-full h-full z-0">
        <img src="img/carousel-1.jpg" id="carousel-img-1" class="w-full h-full object-cover absolute carousel-fade opacity-100" alt="">
        <img src="img/carousel-2.jpg" id="carousel-img-2" class="w-full h-full object-cover absolute carousel-fade opacity-0" alt="">
        <div class="absolute inset-0 bg-black bg-opacity-20"></div>
    </div>
    <div class="absolute inset-0 flex items-center z-10">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl">
                <h1 id="carousel-title" class="text-5xl text-white font-bold mb-6 drop-shadow">
                    Thinko.uz - biz doim siz bilanmiz !
                </h1>
                <p id="carousel-desc" class="text-xl text-white mb-6 font-medium drop-shadow">
                    Farzandingiz telefonni foydali ishlatishini xohlaysizmi? Unda Thinko.uz siz uchun! Bu yerda bolalar topshiriq bajaradi, coinlar yig‘adi, badge oladi va o‘z orzulari sari qadam tashlaydi! Biz bilan bilim olish — sarguzasht!
                </p>
            </div>
        </div>
    </div>
    <button class="absolute left-4 top-1/2 -translate-y-1/2 z-20 p-2 bg-white bg-opacity-60 rounded-full shadow" onclick="showPrevSlide()"><i class="bi bi-chevron-left text-xl text-blue-600"></i></button>
    <button class="absolute right-4 top-1/2 -translate-y-1/2 z-20 p-2 bg-white bg-opacity-60 rounded-full shadow" onclick="showNextSlide()"><i class="bi bi-chevron-right text-xl text-blue-600"></i></button>
</div>

<!-- Facilities -->
<section class="py-16">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="bg-white rounded-lg shadow-md p-6 flex flex-col items-center text-center">
                <div class="w-16 h-16 flex items-center justify-center rounded-full bg-blue-100 mb-4">
                    <i class="fas fa-brain text-3xl text-blue-600"></i>
                </div>
                <h3 class="text-blue-600 text-xl font-semibold mb-2">Smart Topshiriqlar</h3>
                <p class="text-gray-600">Har kuni yangilanuvchi aqliy, jismoniy va ijodiy topshiriqlar orqali bolangiz o‘z qiziqishlarini kashf etadi.</p>
            </div>
            <div class="bg-white rounded-lg shadow-md p-6 flex flex-col items-center text-center">
                <div class="w-16 h-16 flex items-center justify-center rounded-full bg-green-100 mb-4">
                    <i class="fa fa-futbol text-3xl text-green-600"></i>
                </div>
                <h3 class="text-green-600 text-xl font-semibold mb-2">Interaktiv O‘yinlar</h3>
                <p class="text-gray-600">Topshiriqlar o‘yin elementlari bilan boyitilgan — farzandingiz o‘rganar ekan, charchamaydi, aksincha zavqlanadi!</p>
            </div>
            <div class="bg-white rounded-lg shadow-md p-6 flex flex-col items-center text-center">
                <div class="w-16 h-16 flex items-center justify-center rounded-full bg-yellow-100 mb-4">
                    <i class="fa fa-home text-3xl text-yellow-600"></i>
                </div>
                <h3 class="text-yellow-600 text-xl font-semibold mb-2">Motivatsion Mukofotlar</h3>
                <p class="text-gray-600">Coin, badge va reyting orqali bolangiz muvaffaqiyat sari intiladi. Harakat — mukofot bilan taqdirlanadi!</p>
            </div>
            <div class="bg-white rounded-lg shadow-md p-6 flex flex-col items-center text-center">
                <div class="w-16 h-16 flex items-center justify-center rounded-full bg-cyan-100 mb-4">
                    <i class="fa fa-chalkboard-teacher text-3xl text-cyan-600"></i>
                </div>
                <h3 class="text-cyan-600 text-xl font-semibold mb-2">Ota-onalar Nazorati</h3>
                <p class="text-gray-600">Ota-onalar har bir topshiriqni, yutuqni va faoliyatni nazorat qila oladi. Bola o‘sadi, siz xotirjam bo‘lasiz.</p>
            </div>
        </div>
    </div>
</section>

<!-- About -->
<section class="py-16">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 items-center gap-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 mb-6">Sayt yaratuvchisi</h1>
                <p class="text-gray-700 mb-8">
                    Men Baymatov Bobur Baxriddin o'g'li, dasturlash va texnologiya sohasida keng tajribaga ega bo'lgan mutaxassisman. Men turli xil loyihalarda ishlashni yaxshi ko'raman va har doim yangi texnologiyalarni o'rganishga intilaman. Bugungi kunda PHP, MySQL, C++, JavaScript, HTML va CSS kabi texnologiyalar bilan ishlayman ))
                </p>
                <div class="flex items-center gap-4">
                    <img class="w-12 h-12 rounded-full" src="img/user.jpg" alt="">
                    <div>
                        <h6 class="text-blue-600 font-semibold">Bobur Baymatov</h6>
                        <small class="text-gray-500">Web developer</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="bg-gray-900 text-gray-400 pt-12 pb-2 w-full">
    <div class="container mx-auto px-4 pb-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <div>
                <h4 class="text-white text-lg mb-4">Aloqa</h4>
                <p class="mb-2 flex items-center"><i class="fa fa-map-marker-alt mr-2"></i>Jizzax, O'zbekiston</p>
                <p class="mb-2 flex items-center"><i class="fa fa-phone-alt mr-2"></i>+998 99 555 7106</p>
                <p class="mb-2 flex items-center"><i class="fa fa-envelope mr-2"></i>boymatovbobur6@gmail.com</p>
                <div class="flex space-x-3 pt-2">
                    <a class="w-9 h-9 flex items-center justify-center rounded-full border border-gray-400 hover:bg-blue-500 hover:text-white transition" href="#"><i class="fab fa-telegram-plane"></i></a>
                    <a class="w-9 h-9 flex items-center justify-center rounded-full border border-gray-400 hover:bg-gray-800 hover:text-white transition" href="#"><i class="fab fa-github"></i></a>
                    <a class="w-9 h-9 flex items-center justify-center rounded-full border border-gray-400 hover:bg-blue-700 hover:text-white transition" href="#"><i class="fab fa-linkedin-in"></i></a>
                    <a class="w-9 h-9 flex items-center justify-center rounded-full border border-gray-400 hover:bg-pink-600 hover:text-white transition" href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
            <div>
                <h4 class="text-white text-lg mb-4">Foydali Havolalar</h4>
                <a class="block text-gray-400 hover:text-white transition mb-2" href="#">Men haqimda</a>
                <a class="block text-gray-400 hover:text-white transition mb-2" href="#">Loyihalarim</a>
                <a class="block text-gray-400 hover:text-white transition mb-2" href="#">Xizmatlar</a>
                <a class="block text-gray-400 hover:text-white transition mb-2" href="#">Maxfiylik Siyosati</a>
                <a class="block text-gray-400 hover:text-white transition" href="#">Foydalanish shartlari</a>
            </div>
            <div>
                <h4 class="text-white text-lg mb-4">Men Haqimda</h4>
                <p>
                    Men web dasturchiman. PHP, MySQL, HTML, CSS va JavaScript bilan to‘liq funksional va zamonaviy web platformalar yaratishga ixtisoslashganman. Har bir loyiha – bu men uchun yangi tajriba va rivojlanish imkoniyati.
                </p>
            </div>
        </div>
    </div>
    <div class="bg-gray-800 text-center text-white py-3">
        &copy; 2025 Sizning Baxriddinovich. Barcha huquqlar himoyalangan.
    </div>
</footer>

<!-- Back to top -->
<a href="#" class="fixed bottom-4 right-4 w-12 h-12 flex items-center justify-center rounded-full bg-blue-600 text-white shadow-lg hover:bg-blue-700 transition z-50 back-to-top hidden">
    <i class="fas fa-arrow-up"></i>
</a>

<script>
    // Spinner
    window.addEventListener('DOMContentLoaded', () => {
        setTimeout(() => {
            document.getElementById('spinner').style.display = 'none';
        }, 600);
    });
    // Carousel logic
    let currentCarousel = 1;
    function showSlide(n) {
        const imgs = [document.getElementById('carousel-img-1'), document.getElementById('carousel-img-2')];
        const titles = [
            "Thinko.uz - biz doim siz bilanmiz !",
            "Thinko.uz - biz doim siz bilanmiz !"
        ];
        const descs = [
            "Farzandingiz telefonni foydali ishlatishini xohlaysizmi? Unda Thinko.uz siz uchun! Bu yerda bolalar topshiriq bajaradi, coinlar yig‘adi, badge oladi va o‘z orzulari sari qadam tashlaydi! Biz bilan bilim olish — sarguzasht!",
            "Thinko.uz — bu bolalar uchun yaratilgan innovatsion platforma bo‘lib, ularni bilim olish, sog‘lom hayot tarziga o‘rgatish va real hayotdagi faoliyatga jalb etishga xizmat qiladi. Har bir topshiriq – yangi imkoniyat. Har bir harakat – mukofot bilan rag‘batlantiriladi. Bu yerda bolalar o‘rganadi, harakat qiladi va rivojlanadi."
        ];
        for (let i = 0; i < imgs.length; i++) {
            imgs[i].style.opacity = i + 1 === n ? "1" : "0";
        }
        document.getElementById('carousel-title').textContent = titles[n - 1];
        document.getElementById('carousel-desc').textContent = descs[n - 1];
        currentCarousel = n;
    }
    function showNextSlide() {
        showSlide(currentCarousel === 1 ? 2 : 1);
    }
    function showPrevSlide() {
        showSlide(currentCarousel === 1 ? 2 : 1);
    }
    setInterval(showNextSlide, 7000);

    // Back to top
    const backToTopBtn = document.querySelector('.back-to-top');
    window.addEventListener('scroll', function () {
        if (window.scrollY > 300) {
            backToTopBtn.classList.remove('hidden');
        } else {
            backToTopBtn.classList.add('hidden');
        }
    });
    backToTopBtn.addEventListener('click', function (e) {
        e.preventDefault();
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
</script>
</body>
</html>
