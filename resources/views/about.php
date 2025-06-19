<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thinko - Kelajakni O'rganing</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }

        body {
            overflow-x: hidden;
        }

        /* Gradient Backgrounds */
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .gradient-bg-2 {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        }

        .gradient-bg-3 {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        }

        .gradient-bg-4 {
            background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
        }

        /* Glass Morphism */
        .glass {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .glass-dark {
            background: rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        /* Animations */
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }

        @keyframes pulse-glow {
            0%, 100% { box-shadow: 0 0 20px rgba(102, 126, 234, 0.4); }
            50% { box-shadow: 0 0 40px rgba(102, 126, 234, 0.8); }
        }

        @keyframes slide-in-left {
            0% { transform: translateX(-100px); opacity: 0; }
            100% { transform: translateX(0); opacity: 1; }
        }

        @keyframes slide-in-right {
            0% { transform: translateX(100px); opacity: 0; }
            100% { transform: translateX(0); opacity: 1; }
        }

        @keyframes fade-in-up {
            0% { transform: translateY(50px); opacity: 0; }
            100% { transform: translateY(0); opacity: 1; }
        }

        @keyframes rotate-360 {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .float-animation {
            animation: float 6s ease-in-out infinite;
        }

        .pulse-glow {
            animation: pulse-glow 2s ease-in-out infinite;
        }

        .slide-in-left {
            animation: slide-in-left 1s ease-out;
        }

        .slide-in-right {
            animation: slide-in-right 1s ease-out;
        }

        .fade-in-up {
            animation: fade-in-up 1s ease-out;
        }

        .rotate-slow {
            animation: rotate-360 20s linear infinite;
        }

        /* Custom Buttons */
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.4);
        }

        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }

        .btn-primary:hover::before {
            left: 100%;
        }

        .btn-secondary {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
        }

        /* Card Hover Effects */
        .card-hover {
            transition: all 0.3s ease;
            position: relative;
        }

        .card-hover:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .card-hover::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.1), rgba(118, 75, 162, 0.1));
            opacity: 0;
            transition: opacity 0.3s ease;
            border-radius: inherit;
        }

        .card-hover:hover::before {
            opacity: 1;
        }

        /* Parallax Effect */
        .parallax {
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, #764ba2, #667eea);
        }

        /* Particle Background */
        .particles {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: -1;
        }

        .particle {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: float 8s ease-in-out infinite;
        }

        /* Text Gradient */
        .text-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .text-gradient-2 {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Loading Animation */
        .loading-dots {
            display: inline-block;
        }

        .loading-dots::after {
            content: '';
            animation: loading-dots 1.5s infinite;
        }

        @keyframes loading-dots {
            0%, 20% { content: '.'; }
            40% { content: '..'; }
            60%, 100% { content: '...'; }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem !important;
            }

            .hero-subtitle {
                font-size: 1.1rem !important;
            }
        }

        /* Interactive Elements */
        .interactive-card {
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .interactive-card:hover {
            transform: scale(1.05);
        }

        .interactive-card:active {
            transform: scale(0.95);
        }

        /* Neon Effect */
        .neon-text {
            text-shadow: 0 0 10px rgba(102, 126, 234, 0.8),
            0 0 20px rgba(102, 126, 234, 0.6),
            0 0 30px rgba(102, 126, 234, 0.4);
        }

        /* Progress Bar */
        .progress-bar {
            background: linear-gradient(90deg, #667eea, #764ba2);
            height: 4px;
            border-radius: 2px;
            transition: width 0.3s ease;
        }

        /* Typing Animation */
        .typing-animation {
            border-right: 2px solid #667eea;
            animation: typing 3s steps(40, end), blink-caret 0.75s step-end infinite;
        }

        @keyframes typing {
            from { width: 0; }
            to { width: 100%; }
        }

        @keyframes blink-caret {
            from, to { border-color: transparent; }
            50% { border-color: #667eea; }
        }
    </style>
</head>
<body class="bg-gray-50">

<!-- Navigation -->
<nav class="fixed top-0 left-0 right-0 z-50 glass">
    <div class="container mx-auto px-6 py-4">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-2">
                <div class="w-10 h-10 gradient-bg rounded-xl flex items-center justify-center">
                    <i class="fas fa-brain text-white text-xl"></i>
                </div>
                <span class="text-2xl font-bold text-gradient">Thinko</span>
            </div>

            <div class="hidden md:flex items-center space-x-8">
                <a href="#home" class="text-gray-700 hover:text-purple-600 transition-colors">Bosh sahifa</a>
                <a href="#features" class="text-gray-700 hover:text-purple-600 transition-colors">Xususiyatlar</a>
                <a href="#games" class="text-gray-700 hover:text-purple-600 transition-colors">O'yinlar</a>
                <a href="#about" class="text-gray-700 hover:text-purple-600 transition-colors">Biz haqimizda</a>
                <a href="#contact" class="text-gray-700 hover:text-purple-600 transition-colors">Aloqa</a>
            </div>

            <div class="flex items-center space-x-4">
                <button class="btn-secondary px-4 py-2 rounded-lg text-gray-700">Kirish</button>
                <button class="btn-primary px-6 py-2 rounded-lg text-white font-semibold">Ro'yxatdan o'tish</button>
            </div>

            <button class="md:hidden text-gray-700" onclick="toggleMobileMenu()">
                <i class="fas fa-bars text-xl"></i>
            </button>
        </div>
    </div>
</nav>

<!-- Mobile Menu -->
<div id="mobileMenu" class="fixed top-0 left-0 right-0 bottom-0 bg-white z-40 transform -translate-x-full transition-transform duration-300 md:hidden">
    <div class="p-6">
        <div class="flex justify-between items-center mb-8">
            <span class="text-2xl font-bold text-gradient">Thinko</span>
            <button onclick="toggleMobileMenu()">
                <i class="fas fa-times text-xl text-gray-700"></i>
            </button>
        </div>

        <div class="space-y-6">
            <a href="/" class="block text-xl text-gray-700">Bosh sahifa</a>
            <a href="#features" class="block text-xl text-gray-700">Xususiyatlar</a>
            <a href="#games" class="block text-xl text-gray-700">O'yinlar</a>
            <a href="#contact" class="block text-xl text-gray-700">Aloqa</a>
        </div>

        <div class="mt-8 space-y-4">
            <button class="w-full btn-secondary px-4 py-3 rounded-lg text-gray-700">Kirish</button>
            <button class="w-full btn-primary px-6 py-3 rounded-lg text-white font-semibold">Ro'yxatdan o'tish</button>
        </div>
    </div>
</div>

<!-- Hero Section -->
<section id="home" class="min-h-screen gradient-bg flex items-center justify-center relative overflow-hidden">
    <!-- Particles Background -->
    <div class="particles">
        <div class="particle" style="left: 10%; top: 20%; width: 4px; height: 4px; animation-delay: 0s;"></div>
        <div class="particle" style="left: 20%; top: 80%; width: 6px; height: 6px; animation-delay: 1s;"></div>
        <div class="particle" style="left: 60%; top: 30%; width: 3px; height: 3px; animation-delay: 2s;"></div>
        <div class="particle" style="left: 80%; top: 70%; width: 5px; height: 5px; animation-delay: 3s;"></div>
        <div class="particle" style="left: 30%; top: 10%; width: 4px; height: 4px; animation-delay: 4s;"></div>
        <div class="particle" style="left: 70%; top: 90%; width: 6px; height: 6px; animation-delay: 5s;"></div>
    </div>

    <div class="container mx-auto px-6 text-center relative z-10">
        <div class="slide-in-left">
            <h1 class="hero-title text-6xl md:text-7xl font-black text-white mb-6 neon-text">
                Kelajakni <span class="text-yellow-300">O'rganing</span>
            </h1>
            <p class="hero-subtitle text-xl md:text-2xl text-white opacity-90 mb-8 max-w-3xl mx-auto">
                Thinko bilan bolalaringiz uchun eng zamonaviy ta'lim platformasini kashf eting.
                Interaktiv o'yinlar, AI yordamchisi va individual yondashuv.
            </p>
        </div>

        <div class="slide-in-right flex flex-col sm:flex-row gap-4 justify-center items-center mb-12">
            <button class="btn-primary px-8 py-4 rounded-xl text-white font-bold text-lg pulse-glow">
                <i class="fas fa-rocket mr-2"></i>Hoziroq Boshlash
            </button>
            <button class="btn-secondary px-8 py-4 rounded-xl text-white font-semibold text-lg">
                <i class="fas fa-play mr-2"></i>Demo Ko'rish
            </button>
        </div>

        <div class="fade-in-up">
            <div class="glass rounded-2xl p-8 max-w-4xl mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="text-center">
                        <div class="text-4xl font-bold text-white mb-2">10,000+</div>
                        <div class="text-white opacity-80">Faol Foydalanuvchi</div>
                    </div>
                    <div class="text-center">
                        <div class="text-4xl font-bold text-white mb-2">50+</div>
                        <div class="text-white opacity-80">Interaktiv O'yin</div>
                    </div>
                    <div class="text-center">
                        <div class="text-4xl font-bold text-white mb-2">98%</div>
                        <div class="text-white opacity-80">Mamnunlik Darajasi</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Floating Elements -->
    <div class="absolute top-20 left-10 float-animation">
        <div class="w-20 h-20 gradient-bg-2 rounded-full flex items-center justify-center">
            <i class="fas fa-gamepad text-white text-2xl"></i>
        </div>
    </div>

    <div class="absolute bottom-20 right-10 float-animation" style="animation-delay: 2s;">
        <div class="w-16 h-16 gradient-bg-3 rounded-full flex items-center justify-center">
            <i class="fas fa-brain text-white text-xl"></i>
        </div>
    </div>
</section>

<!-- Features Section -->
<section id="features" class="py-20 bg-white">
    <div class="container mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-5xl font-bold text-gradient mb-6">Nima uchun Thinko?</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Zamonaviy texnologiyalar va pedagogik yondashuvlarni birlashtirgan holda,
                bolalaringiz uchun eng yaxshi ta'lim tajribasini taqdim etamiz.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Feature 1 -->
            <div class="card-hover bg-white rounded-2xl p-8 shadow-lg border border-gray-100">
                <div class="w-16 h-16 gradient-bg rounded-xl flex items-center justify-center mb-6">
                    <i class="fas fa-robot text-white text-2xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-800 mb-4">AI Yordamchisi</h3>
                <p class="text-gray-600 mb-6">
                    Sun'iy intellekt yordamida har bir bolaning individual ehtiyojlariga moslashgan ta'lim rejasi.
                </p>
                <div class="flex items-center text-purple-600 font-semibold">
                    <span>Batafsil</span>
                    <i class="fas fa-arrow-right ml-2"></i>
                </div>
            </div>

            <!-- Feature 2 -->
            <div class="card-hover bg-white rounded-2xl p-8 shadow-lg border border-gray-100">
                <div class="w-16 h-16 gradient-bg-2 rounded-xl flex items-center justify-center mb-6">
                    <i class="fas fa-gamepad text-white text-2xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-800 mb-4">Interaktiv O'yinlar</h3>
                <p class="text-gray-600 mb-6">
                    50+ dan ortiq qiziqarli va ta'limiy o'yinlar orqali bilimlarni mustahkamlash.
                </p>
                <div class="flex items-center text-purple-600 font-semibold">
                    <span>Batafsil</span>
                    <i class="fas fa-arrow-right ml-2"></i>
                </div>
            </div>

            <!-- Feature 3 -->
            <div class="card-hover bg-white rounded-2xl p-8 shadow-lg border border-gray-100">
                <div class="w-16 h-16 gradient-bg-3 rounded-xl flex items-center justify-center mb-6">
                    <i class="fas fa-chart-line text-white text-2xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-800 mb-4">Progress Tracking</h3>
                <p class="text-gray-600 mb-6">
                    Bolangizning rivojlanish jarayonini real vaqtda kuzatib boring va tahlil qiling.
                </p>
                <div class="flex items-center text-purple-600 font-semibold">
                    <span>Batafsil</span>
                    <i class="fas fa-arrow-right ml-2"></i>
                </div>
            </div>

            <!-- Feature 4 -->
            <div class="card-hover bg-white rounded-2xl p-8 shadow-lg border border-gray-100">
                <div class="w-16 h-16 gradient-bg-4 rounded-xl flex items-center justify-center mb-6">
                    <i class="fas fa-users text-white text-2xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-800 mb-4">Oilaviy Nazorat</h3>
                <p class="text-gray-600 mb-6">
                    Ota-onalar uchun maxsus panel orqali bolaning faoliyatini nazorat qilish.
                </p>
                <div class="flex items-center text-purple-600 font-semibold">
                    <span>Batafsil</span>
                    <i class="fas fa-arrow-right ml-2"></i>
                </div>
            </div>

            <!-- Feature 5 -->
            <div class="card-hover bg-white rounded-2xl p-8 shadow-lg border border-gray-100">
                <div class="w-16 h-16 gradient-bg rounded-xl flex items-center justify-center mb-6">
                    <i class="fas fa-trophy text-white text-2xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-800 mb-4">Mukofotlar Tizimi</h3>
                <p class="text-gray-600 mb-6">
                    Motivatsiya uchun virtual mukofotlar, yulduzchalar va yutuqlar tizimi.
                </p>
                <div class="flex items-center text-purple-600 font-semibold">
                    <span>Batafsil</span>
                    <i class="fas fa-arrow-right ml-2"></i>
                </div>
            </div>

            <!-- Feature 6 -->
            <div class="card-hover bg-white rounded-2xl p-8 shadow-lg border border-gray-100">
                <div class="w-16 h-16 gradient-bg-2 rounded-xl flex items-center justify-center mb-6">
                    <i class="fas fa-mobile-alt text-white text-2xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-800 mb-4">Mobil Ilovalar</h3>
                <p class="text-gray-600 mb-6">
                    Android va iOS uchun optimallashtirilgan mobil ilovalar orqali har joyda o'rganing.
                </p>
                <div class="flex items-center text-purple-600 font-semibold">
                    <span>Batafsil</span>
                    <i class="fas fa-arrow-right ml-2"></i>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Games Section -->
<section id="games" class="py-20 gradient-bg-3">
    <div class="container mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-5xl font-bold text-white mb-6">Mashhur O'yinlar</h2>
            <p class="text-xl text-white opacity-90 max-w-3xl mx-auto">
                Bolalar uchun maxsus ishlab chiqilgan ta'limiy o'yinlar to'plami
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Game 1 -->
            <div class="interactive-card glass rounded-2xl p-6 text-center">
                <div class="text-6xl mb-4">🧮</div>
                <h3 class="text-2xl font-bold text-white mb-3">Matematik Sinovlar</h3>
                <p class="text-white opacity-80 mb-4">Matematik ko'nikmalarni rivojlantirish uchun qiziqarli sinovlar</p>
                <div class="flex justify-center items-center space-x-4 mb-4">
                    <div class="flex items-center">
                        <i class="fas fa-star text-yellow-400"></i>
                        <span class="text-white ml-1">4.9</span>
                    </div>
                    <div class="text-white opacity-60">|</div>
                    <div class="text-white opacity-80">5000+ o'yin</div>
                </div>
                <button class="btn-secondary w-full py-3 rounded-lg text-white font-semibold">
                    O'ynash
                </button>
            </div>

            <!-- Game 2 -->
            <div class="interactive-card glass rounded-2xl p-6 text-center">
                <div class="text-6xl mb-4">🌈</div>
                <h3 class="text-2xl font-bold text-white mb-3">Ranglar O'yini</h3>
                <p class="text-white opacity-80 mb-4">Ranglarni o'rganish va tanib olish uchun interaktiv o'yin</p>
                <div class="flex justify-center items-center space-x-4 mb-4">
                    <div class="flex items-center">
                        <i class="fas fa-star text-yellow-400"></i>
                        <span class="text-white ml-1">4.8</span>
                    </div>
                    <div class="text-white opacity-60">|</div>
                    <div class="text-white opacity-80">3200+ o'yin</div>
                </div>
                <button class="btn-secondary w-full py-3 rounded-lg text-white font-semibold">
                    O'ynash
                </button>
            </div>

            <!-- Game 3 -->
            <div class="interactive-card glass rounded-2xl p-6 text-center">
                <div class="text-6xl mb-4">🔤</div>
                <h3 class="text-2xl font-bold text-white mb-3">Alifbo O'yini</h3>
                <p class="text-white opacity-80 mb-4">Harflarni o'rganish va so'z tuzish ko'nikmalarini rivojlantirish</p>
                <div class="flex justify-center items-center space-x-4 mb-4">
                    <div class="flex items-center">
                        <i class="fas fa-star text-yellow-400"></i>
                        <span class="text-white ml-1">4.7</span>
                    </div>
                    <div class="text-white opacity-60">|</div>
                    <div class="text-white opacity-80">4100+ o'yin</div>
                </div>
                <button class="btn-secondary w-full py-3 rounded-lg text-white font-semibold">
                    O'ynash
                </button>
            </div>

            <!-- Game 4 -->
            <div class="interactive-card glass rounded-2xl p-6 text-center">
                <div class="text-6xl mb-4">🧩</div>
                <h3 class="text-2xl font-bold text-white mb-3">Mantiq Jumboqlari</h3>
                <p class="text-white opacity-80 mb-4">Mantiqiy fikrlashni rivojlantirish uchun qiziqarli jumboqlar</p>
                <div class="flex justify-center items-center space-x-4 mb-4">
                    <div class="flex items-center">
                        <i class="fas fa-star text-yellow-400"></i>
                        <span class="text-white ml-1">4.9</span>
                    </div>
                    <div class="text-white opacity-60">|</div>
                    <div class="text-white opacity-80">2800+ o'yin</div>
                </div>
                <button class="btn-secondary w-full py-3 rounded-lg text-white font-semibold">
                    O'ynash
                </button>
            </div>

            <!-- Game 5 -->
            <div class="interactive-card glass rounded-2xl p-6 text-center">
                <div class="text-6xl mb-4">🧠</div>
                <h3 class="text-2xl font-bold text-white mb-3">Xotira Sinovlari</h3>
                <p class="text-white opacity-80 mb-4">Xotira va diqqat markazlashtirish qobiliyatini oshirish</p>
                <div class="flex justify-center items-center space-x-4 mb-4">
                    <div class="flex items-center">
                        <i class="fas fa-star text-yellow-400"></i>
                        <span class="text-white ml-1">4.6</span>
                    </div>
                    <div class="text-white opacity-60">|</div>
                    <div class="text-white opacity-80">3600+ o'yin</div>
                </div>
                <button class="btn-secondary w-full py-3 rounded-lg text-white font-semibold">
                    O'ynash
                </button>
            </div>

            <!-- Game 6 -->
            <div class="interactive-card glass rounded-2xl p-6 text-center">
                <div class="text-6xl mb-4">🎵</div>
                <h3 class="text-2xl font-bold text-white mb-3">Musiqa O'yini</h3>
                <p class="text-white opacity-80 mb-4">Musiqiy qobiliyatlarni rivojlantirish va ritm hissi</p>
                <div class="flex justify-center items-center space-x-4 mb-4">
                    <div class="flex items-center">
                        <i class="fas fa-star text-yellow-400"></i>
                        <span class="text-white ml-1">4.8</span>
                    </div>
                    <div class="text-white opacity-60">|</div>
                    <div class="text-white opacity-80">2400+ o'yin</div>
                </div>
                <button class="btn-secondary w-full py-3 rounded-lg text-white font-semibold">
                    O'ynash
                </button>
            </div>
        </div>

        <div class="text-center mt-12">
            <button class="btn-primary px-8 py-4 rounded-xl text-white font-bold text-lg">
                <i class="fas fa-plus mr-2"></i>Barcha O'yinlarni Ko'rish
            </button>
        </div>
    </div>
</section>

<!-- Statistics Section -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-5xl font-bold text-gradient mb-6">Bizning Yutuqlarimiz</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Thinko platformasi orqali minglab bolalar o'z bilimlarini oshirmoqda
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="text-center">
                <div class="w-24 h-24 gradient-bg rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-users text-white text-3xl"></i>
                </div>
                <div class="text-4xl font-bold text-gradient mb-2" data-count="10000">0</div>
                <div class="text-gray-600">Faol Foydalanuvchi</div>
            </div>

            <div class="text-center">
                <div class="w-24 h-24 gradient-bg-2 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-gamepad text-white text-3xl"></i>
                </div>
                <div class="text-4xl font-bold text-gradient-2 mb-2" data-count="50">0</div>
                <div class="text-gray-600">Interaktiv O'yin</div>
            </div>

            <div class="text-center">
                <div class="w-24 h-24 gradient-bg-3 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-trophy text-white text-3xl"></i>
                </div>
                <div class="text-4xl font-bold text-gradient mb-2" data-count="25000">0</div>
                <div class="text-gray-600">Mukofot Berildi</div>
            </div>

            <div class="text-center">
                <div class="w-24 h-24 gradient-bg-4 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-star text-white text-3xl"></i>
                </div>
                <div class="text-4xl font-bold text-gradient-2 mb-2" data-count="98">0</div>
                <div class="text-gray-600">Mamnunlik %</div>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="py-20 gradient-bg-2">
    <div class="container mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-5xl font-bold text-white mb-6">Ota-onalar Fikri</h2>
            <p class="text-xl text-white opacity-90 max-w-3xl mx-auto">
                Bizning platformamizdan foydalanayotgan oilalarning fikrlari
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Testimonial 1 -->
            <div class="glass rounded-2xl p-8">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center mr-4">
                        <i class="fas fa-user text-purple-600"></i>
                    </div>
                    <div>
                        <div class="font-bold text-white">Aziza Karimova</div>
                        <div class="text-white opacity-70">Ona, 2 farzand</div>
                    </div>
                </div>
                <div class="flex mb-4">
                    <i class="fas fa-star text-yellow-400"></i>
                    <i class="fas fa-star text-yellow-400"></i>
                    <i class="fas fa-star text-yellow-400"></i>
                    <i class="fas fa-star text-yellow-400"></i>
                    <i class="fas fa-star text-yellow-400"></i>
                </div>
                <p class="text-white opacity-90">
                    "Thinko platformasi orqali farzandlarim matematik ko'nikmalarini sezilarli darajada oshirdi.
                    O'yinlar juda qiziqarli va ta'limiy!"
                </p>
            </div>

            <!-- Testimonial 2 -->
            <div class="glass rounded-2xl p-8">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center mr-4">
                        <i class="fas fa-user text-purple-600"></i>
                    </div>
                    <div>
                        <div class="font-bold text-white">Bobur Rahimov</div>
                        <div class="text-white opacity-70">Ota, 1 farzand</div>
                    </div>
                </div>
                <div class="flex mb-4">
                    <i class="fas fa-star text-yellow-400"></i>
                    <i class="fas fa-star text-yellow-400"></i>
                    <i class="fas fa-star text-yellow-400"></i>
                    <i class="fas fa-star text-yellow-400"></i>
                    <i class="fas fa-star text-yellow-400"></i>
                </div>
                <p class="text-white opacity-90">
                    "AI yordamchisi juda foydali! Bolam uchun individual ta'lim rejasi tuzib berdi.
                    Progress tracking ham ajoyib ishlaydi."
                </p>
            </div>

            <!-- Testimonial 3 -->
            <div class="glass rounded-2xl p-8">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center mr-4">
                        <i class="fas fa-user text-purple-600"></i>
                    </div>
                    <div>
                        <div class="font-bold text-white">Malika Tosheva</div>
                        <div class="text-white opacity-70">Ona, 3 farzand</div>
                    </div>
                </div>
                <div class="flex mb-4">
                    <i class="fas fa-star text-yellow-400"></i>
                    <i class="fas fa-star text-yellow-400"></i>
                    <i class="fas fa-star text-yellow-400"></i>
                    <i class="fas fa-star text-yellow-400"></i>
                    <i class="fas fa-star text-yellow-400"></i>
                </div>
                <p class="text-white opacity-90">
                    "Barcha bolalarim Thinko o'yinlarini yaxshi ko'radi. Ular o'ynab-o'ynab o'rganmoqda.
                    Bu eng yaxshi ta'lim usuli!"
                </p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-20 gradient-bg">
    <div class="container mx-auto px-6 text-center">
        <h2 class="text-5xl font-bold text-white mb-6">Bugun Boshlang!</h2>
        <p class="text-xl text-white opacity-90 mb-8 max-w-3xl mx-auto">
            Farzandingizning kelajagini bugun boshlab quring. Thinko bilan ta'lim yanada qiziqarli!
        </p>

        <div class="flex flex-col sm:flex-row gap-4 justify-center items-center mb-12">
            <button class="btn-primary px-8 py-4 rounded-xl text-white font-bold text-lg pulse-glow">
                <i class="fas fa-rocket mr-2"></i>Bepul Sinab Ko'ring
            </button>
            <button class="btn-secondary px-8 py-4 rounded-xl text-white font-semibold text-lg">
                <i class="fas fa-phone mr-2"></i>Aloqa Qiling
            </button>
        </div>

        <div class="glass rounded-2xl p-8 max-w-2xl mx-auto">
            <h3 class="text-2xl font-bold text-white mb-4">Bepul Sinov Muddati</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-white">
                <div>
                    <div class="text-3xl font-bold">7</div>
                    <div class="opacity-80">Kun Bepul</div>
                </div>
                <div>
                    <div class="text-3xl font-bold">∞</div>
                    <div class="opacity-80">Cheksiz O'yin</div>
                </div>
                <div>
                    <div class="text-3xl font-bold">24/7</div>
                    <div class="opacity-80">Yordam</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="bg-gray-900 text-white py-16">
    <div class="container mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Company Info -->
            <div>
                <div class="flex items-center space-x-2 mb-6">
                    <div class="w-10 h-10 gradient-bg rounded-xl flex items-center justify-center">
                        <i class="fas fa-brain text-white text-xl"></i>
                    </div>
                    <span class="text-2xl font-bold text-gradient">Thinko</span>
                </div>
                <p class="text-gray-400 mb-6">
                    Bolalar uchun eng zamonaviy ta'lim platformasi.
                    Kelajakni bugun o'rganing!
                </p>
                <div class="flex space-x-4">
                    <a href="#" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-purple-600 transition-colors">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-purple-600 transition-colors">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-purple-600 transition-colors">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-purple-600 transition-colors">
                        <i class="fab fa-telegram"></i>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <h3 class="text-xl font-bold mb-6">Tezkor Havolalar</h3>
                <ul class="space-y-3">
                    <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Bosh sahifa</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white transition-colors">O'yinlar</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Xususiyatlar</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Narxlar</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Biz haqimizda</a></li>
                </ul>
            </div>

            <!-- Support -->
            <div>
                <h3 class="text-xl font-bold mb-6">Yordam</h3>
                <ul class="space-y-3">
                    <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Yordam markazi</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white transition-colors">FAQ</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Aloqa</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Maxfiylik</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Shartlar</a></li>
                </ul>
            </div>

            <!-- Contact -->
            <div>
                <h3 class="text-xl font-bold mb-6">Aloqa</h3>
                <div class="space-y-4">
                    <div class="flex items-center">
                        <i class="fas fa-envelope text-purple-400 mr-3"></i>
                        <span class="text-gray-400">info@thinko.uz</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-phone text-purple-400 mr-3"></i>
                        <span class="text-gray-400">+998 90 123 45 67</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-map-marker-alt text-purple-400 mr-3"></i>
                        <span class="text-gray-400">Toshkent, O'zbekiston</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="border-t border-gray-800 mt-12 pt-8 text-center">
            <p class="text-gray-400">
                © 2024 Thinko. Barcha huquqlar himoyalangan.
                <span class="text-purple-400">❤️</span> bilan ishlab chiqildi.
            </p>
        </div>
    </div>
</footer>

<!-- Scroll to Top Button -->
<button id="scrollToTop" class="fixed bottom-8 right-8 w-12 h-12 gradient-bg rounded-full flex items-center justify-center text-white shadow-lg opacity-0 transition-all duration-300 hover:scale-110">
    <i class="fas fa-arrow-up"></i>
</button>

<!-- Loading Screen -->
<div id="loadingScreen" class="fixed inset-0 gradient-bg flex items-center justify-center z-50">
    <div class="text-center">
        <div class="w-20 h-20 border-4 border-white border-t-transparent rounded-full animate-spin mb-4"></div>
        <div class="text-white text-xl font-semibold">Yuklanmoqda<span class="loading-dots"></span></div>
    </div>
</div>

<script>
    // Loading Screen
    window.addEventListener('load', function() {
        setTimeout(() => {
            document.getElementById('loadingScreen').style.opacity = '0';
            setTimeout(() => {
                document.getElementById('loadingScreen').style.display = 'none';
            }, 500);
        }, 1500);
    });

    // Mobile Menu Toggle
    function toggleMobileMenu() {
        const mobileMenu = document.getElementById('mobileMenu');
        mobileMenu.classList.toggle('-translate-x-full');
    }

    // Smooth Scrolling
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Scroll to Top Button
    const scrollToTopBtn = document.getElementById('scrollToTop');

    window.addEventListener('scroll', function() {
        if (window.pageYOffset > 300) {
            scrollToTopBtn.style.opacity = '1';
            scrollToTopBtn.style.transform = 'translateY(0)';
        } else {
            scrollToTopBtn.style.opacity = '0';
            scrollToTopBtn.style.transform = 'translateY(20px)';
        }
    });

    scrollToTopBtn.addEventListener('click', function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });

    // Counter Animation
    function animateCounters() {
        const counters = document.querySelectorAll('[data-count]');

        counters.forEach(counter => {
            const target = parseInt(counter.getAttribute('data-count'));
            const duration = 2000;
            const step = target / (duration / 16);
            let current = 0;

            const timer = setInterval(() => {
                current += step;
                if (current >= target) {
                    counter.textContent = target.toLocaleString();
                    clearInterval(timer);
                } else {
                    counter.textContent = Math.floor(current).toLocaleString();
                }
            }, 16);
        });
    }

    // Intersection Observer for Animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                if (entry.target.querySelector('[data-count]')) {
                    animateCounters();
                }

                // Add animation classes
                entry.target.classList.add('fade-in-up');
            }
        });
    }, observerOptions);

    // Observe sections
    document.querySelectorAll('section').forEach(section => {
        observer.observe(section);
    });

    // Parallax Effect
    window.addEventListener('scroll', function() {
        const scrolled = window.pageYOffset;
        const parallaxElements = document.querySelectorAll('.parallax');

        parallaxElements.forEach(element => {
            const speed = 0.5;
            element.style.transform = `translateY(${scrolled * speed}px)`;
        });
    });

    // Interactive Cards
    document.querySelectorAll('.interactive-card').forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.05) translateY(-5px)';
        });

        card.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1) translateY(0)';
        });
    });

    // Typing Animation
    function typeWriter(element, text, speed = 100) {
        let i = 0;
        element.innerHTML = '';

        function type() {
            if (i < text.length) {
                element.innerHTML += text.charAt(i);
                i++;
                setTimeout(type, speed);
            }
        }

        type();
    }

    // Initialize typing animation when page loads
    window.addEventListener('load', function() {
        const heroTitle = document.querySelector('.hero-title');
        if (heroTitle) {
            const originalText = heroTitle.textContent;
            setTimeout(() => {
                typeWriter(heroTitle, originalText, 50);
            }, 2000);
        }
    });

    // Add floating particles dynamically
    function createParticle() {
        const particle = document.createElement('div');
        particle.className = 'particle';
        particle.style.left = Math.random() * 100 + '%';
        particle.style.top = Math.random() * 100 + '%';
        particle.style.width = Math.random() * 6 + 2 + 'px';
        particle.style.height = particle.style.width;
        particle.style.animationDelay = Math.random() * 8 + 's';
        particle.style.animationDuration = Math.random() * 10 + 8 + 's';

        document.querySelector('.particles').appendChild(particle);

        // Remove particle after animation
        setTimeout(() => {
            particle.remove();
        }, 18000);
    }

    // Create particles periodically
    setInterval(createParticle, 2000);

    // Add click effects
    document.addEventListener('click', function(e) {
        const ripple = document.createElement('div');
        ripple.style.position = 'absolute';
        ripple.style.borderRadius = '50%';
        ripple.style.background = 'rgba(102, 126, 234, 0.3)';
        ripple.style.transform = 'scale(0)';
        ripple.style.animation = 'ripple 0.6s linear';
        ripple.style.left = (e.clientX - 25) + 'px';
        ripple.style.top = (e.clientY - 25) + 'px';
        ripple.style.width = '50px';
        ripple.style.height = '50px';
        ripple.style.pointerEvents = 'none';
        ripple.style.zIndex = '9999';

        document.body.appendChild(ripple);

        setTimeout(() => {
            ripple.remove();
        }, 600);
    });

    // Add ripple animation
    const style = document.createElement('style');
    style.textContent = `
        @keyframes ripple {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }
    `;
    document.head.appendChild(style);

    // Performance optimization
    let ticking = false;

    function updateAnimations() {
        // Update scroll-based animations here
        ticking = false;
    }

    window.addEventListener('scroll', function() {
        if (!ticking) {
            requestAnimationFrame(updateAnimations);
            ticking = true;
        }
    });
</script>

</body>
</html>
