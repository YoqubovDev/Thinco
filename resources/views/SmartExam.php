<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Topshiriqlar - Aqliy O'yinlar</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .smart-card {
            transition: all 0.3s ease;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        }
        .smart-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }
        .header-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .category-badge {
            background: linear-gradient(135deg, #ff6b6b, #ee5a24);
        }
        .difficulty-easy { background: linear-gradient(135deg, #26de81, #20bf6b); }
        .difficulty-medium { background: linear-gradient(135deg, #fed330, #f7b731); }
        .difficulty-hard { background: linear-gradient(135deg, #fd79a8, #e84393); }
        .smart-btn {
            background: linear-gradient(135deg, #667eea, #764ba2);
            transition: all 0.3s ease;
        }
        .smart-btn:hover {
            background: linear-gradient(135deg, #764ba2, #667eea);
            transform: translateY(-2px);
        }
        .brain-icon {
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">
<!-- Header -->
<header class="header-gradient text-white py-8 shadow-2xl">
    <div class="container mx-auto px-4">
        <div class="text-center">
            <div class="brain-icon text-6xl mb-4">🧠</div>
            <h1 class="text-4xl md:text-5xl font-bold mb-3">Smart Topshiriqlar</h1>
            <p class="text-xl opacity-90">Aqliy qobiliyatlaringizni rivojlantiring</p>
            <div class="mt-6 flex justify-center space-x-6">
                    <span class="bg-white bg-opacity-20 px-4 py-2 rounded-full text-sm font-medium">
                        🎯 Mantiq
                    </span>
                <span class="bg-white bg-opacity-20 px-4 py-2 rounded-full text-sm font-medium">
                        🧮 Matematika
                    </span>
                <span class="bg-white bg-opacity-20 px-4 py-2 rounded-full text-sm font-medium">
                        🔍 Tahlil
                    </span>
            </div>
        </div>
    </div>
</header>

<!-- Main Content -->
<main class="container mx-auto px-4 py-12">

    <!-- Categories Section -->
    <div class="mb-12">
        <h2 class="text-3xl font-bold text-gray-800 text-center mb-8">Smart O'yinlar Kategoriyalari</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

            <!-- Logic Puzzles -->
            <div class="smart-card rounded-2xl p-6 border border-gray-200">
                <div class="text-center">
                    <div class="text-5xl mb-4">🧩</div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-3">Mantiq Jumboqlari</h3>
                    <p class="text-gray-600 mb-4">Mantiqiy fikrlashni rivojlantiruvchi murakkab masalalar</p>
                    <div class="flex justify-center mb-4">
                        <span class="difficulty-medium text-white px-3 py-1 rounded-full text-sm font-medium">O'rta</span>
                    </div>
                    <button class="smart-btn w-full py-3 px-6 text-white font-semibold rounded-lg" onclick="startCategory('logic')">
                        Boshlash
                    </button>
                </div>
            </div>

            <!-- Mathematical Challenges -->
            <div class="smart-card rounded-2xl p-6 border border-gray-200">
                <div class="text-center">
                    <div class="text-5xl mb-4">🔢</div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-3">Matematik Sinovlar</h3>
                    <p class="text-gray-600 mb-4">Raqamlar bilan ishlash va hisoblash qobiliyatini oshirish</p>
                    <div class="flex justify-center mb-4">
                        <span class="difficulty-easy text-white px-3 py-1 rounded-full text-sm font-medium">Oson</span>
                    </div>
                    <button class="smart-btn w-full py-3 px-6 text-white font-semibold rounded-lg" onclick="startCategory('math')">
                        Boshlash
                    </button>
                </div>
            </div>

            <!-- Pattern Recognition -->
            <div class="smart-card rounded-2xl p-6 border border-gray-200">
                <div class="text-center">
                    <div class="text-5xl mb-4">🎨</div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-3">Naqsh Tanish</h3>
                    <p class="text-gray-600 mb-4">Vizual naqshlarni tanish va davom ettirish</p>
                    <div class="flex justify-center mb-4">
                        <span class="difficulty-medium text-white px-3 py-1 rounded-full text-sm font-medium">O'rta</span>
                    </div>
                    <button class="smart-btn w-full py-3 px-6 text-white font-semibold rounded-lg" onclick="startCategory('pattern')">
                        Boshlash
                    </button>
                </div>
            </div>

            <!-- Memory Games -->
            <div class="smart-card rounded-2xl p-6 border border-gray-200">
                <div class="text-center">
                    <div class="text-5xl mb-4">🧠</div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-3">Xotira Sinovlari</h3>
                    <p class="text-gray-600 mb-4">Qisqa va uzoq muddatli xotirani mustahkamlash</p>
                    <div class="flex justify-center mb-4">
                        <span class="difficulty-easy text-white px-3 py-1 rounded-full text-sm font-medium">Oson</span>
                    </div>
                    <button class="smart-btn w-full py-3 px-6 text-white font-semibold rounded-lg" onclick="startCategory('memory')">
                        Boshlash
                    </button>
                </div>
            </div>

            <!-- Strategic Thinking -->
            <div class="smart-card rounded-2xl p-6 border border-gray-200">
                <div class="text-center">
                    <div class="text-5xl mb-4">♟️</div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-3">Strategik Fikrlash</h3>
                    <p class="text-gray-600 mb-4">Uzoq muddatli rejalashtirish va strategiya tuzish</p>
                    <div class="flex justify-center mb-4">
                        <span class="difficulty-hard text-white px-3 py-1 rounded-full text-sm font-medium">Qiyin</span>
                    </div>
                    <button class="smart-btn w-full py-3 px-6 text-white font-semibold rounded-lg" onclick="startCategory('strategy')">
                        Boshlash
                    </button>
                </div>
            </div>

            <!-- Critical Thinking -->
            <div class="smart-card rounded-2xl p-6 border border-gray-200">
                <div class="text-center">
                    <div class="text-5xl mb-4">🔍</div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-3">Tanqidiy Tahlil</h3>
                    <p class="text-gray-600 mb-4">Ma'lumotlarni tahlil qilish va xulosa chiqarish</p>
                    <div class="flex justify-center mb-4">
                        <span class="difficulty-hard text-white px-3 py-1 rounded-full text-sm font-medium">Qiyin</span>
                    </div>
                    <button class="smart-btn w-full py-3 px-6 text-white font-semibold rounded-lg" onclick="startCategory('critical')">
                        Boshlash
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Popular Smart Tasks -->
    <div class="mb-12">
        <h2 class="text-3xl font-bold text-gray-800 text-center mb-8">Mashhur Smart Topshiriqlar</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

            <!-- Sudoku -->
            <div class="bg-white rounded-xl p-4 shadow-lg hover:shadow-xl transition-all duration-300">
                <div class="text-center">
                    <div class="text-3xl mb-2">🔢</div>
                    <h4 class="font-bold text-gray-800 mb-2">Sudoku</h4>
                    <p class="text-sm text-gray-600 mb-3">9x9 katakchani raqamlar bilan to'ldiring</p>
                    <button class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg text-sm transition-colors" onclick="startGame('sudoku')">
                        O'ynash
                    </button>
                </div>
            </div>

            <!-- Chess Puzzles -->
            <div class="bg-white rounded-xl p-4 shadow-lg hover:shadow-xl transition-all duration-300">
                <div class="text-center">
                    <div class="text-3xl mb-2">♛</div>
                    <h4 class="font-bold text-gray-800 mb-2">Shaxmat Jumboqlari</h4>
                    <p class="text-sm text-gray-600 mb-3">Shaxmat pozitsiyalarini yeching</p>
                    <button class="bg-purple-500 hover:bg-purple-600 text-white px-4 py-2 rounded-lg text-sm transition-colors" onclick="startGame('chess')">
                        O'ynash
                    </button>
                </div>
            </div>

            <!-- Word Puzzles -->
            <div class="bg-white rounded-xl p-4 shadow-lg hover:shadow-xl transition-all duration-300">
                <div class="text-center">
                    <div class="text-3xl mb-2">📝</div>
                    <h4 class="font-bold text-gray-800 mb-2">So'z Jumboqlari</h4>
                    <p class="text-sm text-gray-600 mb-3">Harflardan so'zlar toping</p>
                    <button class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg text-sm transition-colors" onclick="startGame('word')">
                        O'ynash
                    </button>
                </div>
            </div>

            <!-- IQ Tests -->
            <div class="bg-white rounded-xl p-4 shadow-lg hover:shadow-xl transition-all duration-300">
                <div class="text-center">
                    <div class="text-3xl mb-2">🎓</div>
                    <h4 class="font-bold text-gray-800 mb-2">IQ Testlari</h4>
                    <p class="text-sm text-gray-600 mb-3">Aqliy qobiliyatingizni o'lchang</p>
                    <button class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm transition-colors" onclick="startGame('iq')">
                        O'ynash
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Section -->
    <div class="bg-white rounded-2xl p-8 shadow-lg">
        <h2 class="text-2xl font-bold text-gray-800 text-center mb-6">Sizning Statistikangiz</h2>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <div class="text-center">
                <div class="text-3xl font-bold text-blue-600 mb-2">0</div>
                <div class="text-gray-600">Yechilgan Masalalar</div>
            </div>
            <div class="text-center">
                <div class="text-3xl font-bold text-green-600 mb-2">0</div>
                <div class="text-gray-600">To'plangan Ballar</div>
            </div>
            <div class="text-center">
                <div class="text-3xl font-bold text-purple-600 mb-2">0</div>
                <div class="text-gray-600">Kunlik Rekord</div>
            </div>
            <div class="text-center">
                <div class="text-3xl font-bold text-orange-600 mb-2">-</div>
                <div class="text-gray-600">IQ Darajasi</div>
            </div>
        </div>
    </div>
</main>

<!-- Game Modal -->
<div id="gameModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-2xl p-8 max-w-lg mx-4 text-center">
        <div class="text-5xl mb-4" id="modalIcon">🧠</div>
        <h3 id="modalTitle" class="text-2xl font-bold text-gray-800 mb-4"></h3>
        <p id="modalDescription" class="text-gray-600 mb-6"></p>
        <div class="flex space-x-4">
            <button
                class="flex-1 smart-btn text-white py-3 px-6 rounded-lg font-semibold"
                onclick="playGame()"
            >
                Boshlash
            </button>
            <button
                class="flex-1 bg-gray-500 hover:bg-gray-600 text-white py-3 px-6 rounded-lg font-semibold transition-colors"
                onclick="closeModal()"
            >
                Bekor qilish
            </button>
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="bg-gray-800 text-white py-8 mt-16">
    <div class="container mx-auto px-4 text-center">
        <div class="text-2xl mb-4">🧠 Smart Topshiriqlar</div>
        <p class="text-gray-300 mb-4">Har kuni aqliy qobiliyatlaringizni rivojlantiring</p>
        <div class="flex justify-center space-x-6 mb-4">
            <a href="#" class="text-gray-400 hover:text-white transition-colors">Bosh sahifa</a>
            <a href="#" class="text-gray-400 hover:text-white transition-colors">O'yinlar</a>
            <a href="#" class="text-gray-400 hover:text-white transition-colors">Statistika</a>
            <a href="#" class="text-gray-400 hover:text-white transition-colors">Aloqa</a>
        </div>
        <p class="text-gray-400 text-sm">© 2025 Smart Topshiriqlar. Barcha huquqlar himoyalangan.</p>
    </div>
</footer>

<script>
    let currentCategory = '';
    let currentGame = '';

    const categoryData = {
        logic: {
            title: "Mantiq Jumboqlari",
            description: "Mantiqiy fikrlashni rivojlantiruvchi murakkab masalalar bilan tanishing. Bu o'yinlar sizning analitik qobiliyatlaringizni oshiradi.",
            icon: "🧩"
        },
        math: {
            title: "Matematik Sinovlar",
            description: "Raqamlar bilan ishlash va hisoblash qobiliyatini oshiring. Turli xil matematik masalalar sizni kutmoqda.",
            icon: "🔢"
        },
        pattern: {
            title: "Naqsh Tanish",
            description: "Vizual naqshlarni tanish va davom ettirish orqali kuzatuvchanligingizni rivojlantiring.",
            icon: "🎨"
        },
        memory: {
            title: "Xotira Sinovlari",
            description: "Qisqa va uzoq muddatli xotirani mustahkamlash uchun maxsus mashqlar.",
            icon: "🧠"
        },
        strategy: {
            title: "Strategik Fikrlash",
            description: "Uzoq muddatli rejalashtirish va strategiya tuzish qobiliyatlarini rivojlantiring.",
            icon: "♟️"
        },
        critical: {
            title: "Tanqidiy Tahlil",
            description: "Ma'lumotlarni tahlil qilish va to'g'ri xulosa chiqarish ko'nikmalarini oshiring.",
            icon: "🔍"
        }
    };

    const gameData = {
        sudoku: {
            title: "Sudoku",
            description: "9x9 katakchani 1-9 raqamlari bilan to'ldiring. Har bir qator, ustun va 3x3 kvadratda barcha raqamlar bo'lishi kerak.",
            icon: "🔢"
        },
        chess: {
            title: "Shaxmat Jumboqlari",
            description: "Turli xil shaxmat pozitsiyalarini yeching va strategik fikrlashni rivojlantiring.",
            icon: "♛"
        },
        word: {
            title: "So'z Jumboqlari",
            description: "Berilgan harflardan eng ko'p so'z tuzing va lug'at boyligingizni oshiring.",
            icon: "📝"
        },
        iq: {
            title: "IQ Testlari",
            description: "Aqliy qobiliyatingizni o'lchang va IQ darajangizni aniqlang.",
            icon: "🎓"
        }
    };

    function startCategory(category) {
        currentCategory = category;
        const data = categoryData[category];

        document.getElementById('modalIcon').textContent = data.icon;
        document.getElementById('modalTitle').textContent = data.title;
        document.getElementById('modalDescription').textContent = data.description;
        document.getElementById('gameModal').classList.remove('hidden');
        document.getElementById('gameModal').classList.add('flex');
    }

    function startGame(game) {
        currentGame = game;
        const data = gameData[game];

        document.getElementById('modalIcon').textContent = data.icon;
        document.getElementById('modalTitle').textContent = data.title;
        document.getElementById('modalDescription').textContent = data.description;
        document.getElementById('gameModal').classList.remove('hidden');
        document.getElementById('gameModal').classList.add('flex');
    }

    function closeModal() {
        document.getElementById('gameModal').classList.add('hidden');
        document.getElementById('gameModal').classList.remove('flex');
    }

    function playGame() {
        closeModal();

        const title = currentCategory ? categoryData[currentCategory].title : gameData[currentGame].title;
        showNotification(`${title} yuklanmoqda...`, 'info');

        setTimeout(() => {
            showNotification(`${title} muvaffaqiyatli boshlandi! Omad tilaymiz!`, 'success');
            updateStats();
        }, 1500);
    }

    function updateStats() {
        // Simulate stats update
        const solvedElement = document.querySelector('.text-blue-600');
        const pointsElement = document.querySelector('.text-green-600');

        if (solvedElement && pointsElement) {
            const currentSolved = parseInt(solvedElement.textContent) || 0;
            const currentPoints = parseInt(pointsElement.textContent) || 0;

            solvedElement.textContent = currentSolved + 1;
            pointsElement.textContent = currentPoints + Math.floor(Math.random() * 50) + 10;
        }
    }

    function showNotification(message, type = 'info') {
        const notification = document.createElement('div');
        const bgColor = type === 'success' ? 'bg-green-500' : type === 'error' ? 'bg-red-500' : 'bg-blue-500';

        notification.className = `fixed top-4 right-4 ${bgColor} text-white px-6 py-3 rounded-lg shadow-lg z-50 transform transition-all duration-300 translate-x-full`;
        notification.textContent = message;

        document.body.appendChild(notification);

        setTimeout(() => {
            notification.classList.remove('translate-x-full');
        }, 100);

        setTimeout(() => {
            notification.classList.add('translate-x-full');
            setTimeout(() => {
                if (document.body.contains(notification)) {
                    document.body.removeChild(notification);
                }
            }, 300);
        }, 3000);
    }

    // Close modal when clicking outside
    document.getElementById('gameModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeModal();
        }
    });

    // Keyboard support
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeModal();
        }
    });

    // Add some interactive animations
    document.addEventListener('DOMContentLoaded', function() {
        const cards = document.querySelectorAll('.smart-card');
        cards.forEach((card, index) => {
            card.style.animationDelay = `${index * 0.1}s`;
            card.classList.add('animate-fade-in');
        });
    });
</script>

<style>
    @keyframes fade-in {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    .animate-fade-in {
        animation: fade-in 0.6s ease-out forwards;
    }
</style>
</body>
</html>
