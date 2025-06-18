<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thinko.uz - O'yinlar</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .game-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .game-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }
        .start-btn {
            background: linear-gradient(135deg, #10b981, #059669);
            transition: all 0.3s ease;
        }
        .start-btn:hover {
            background: linear-gradient(135deg, #059669, #047857);
            transform: translateY(-1px);
        }
        .header-bg {
            background: linear-gradient(135deg, #10b981, #059669);
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen">
<!-- Header -->
<header class="header-bg text-white py-6 shadow-lg">
    <div class="container mx-auto px-4">
        <div class="text-center">
            <h1 class="text-3xl md:text-4xl font-bold mb-2">Thinko.uz - O'yinlar</h1>
            <nav class="flex justify-center space-x-6">
                <a href="#" class="text-white hover:text-green-200 transition-colors duration-200 font-medium">
                    Bosh sahifa
                </a>
                <a href="#" class="text-white hover:text-green-200 transition-colors duration-200 font-medium">
                    O'yinlar
                </a>
            </nav>
        </div>
    </div>
</header>

<!-- Main Content -->
<main class="container mx-auto px-4 py-12">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-6xl mx-auto">

        <!-- Yes/No Savollari Game Card -->
        <div class="game-card bg-white rounded-xl shadow-md p-6 border border-gray-200">
            <div class="text-center">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Yes/No Savollari</h2>
                <p class="text-gray-600 mb-6 leading-relaxed">
                    Oddiy Yes/No savollari bilan o'ynang va ballarni yutib oling!
                </p>
                <button
                    class="start-btn w-full py-3 px-6 text-white font-semibold rounded-lg shadow-md"
                    onclick="startGame('yesno')"
                >
                    Boshlash
                </button>
            </div>
        </div>

        <!-- Puzzle Game Card -->
        <div class="game-card bg-white rounded-xl shadow-md p-6 border border-gray-200">
            <div class="text-center">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Puzzle</h2>
                <p class="text-gray-600 mb-6 leading-relaxed">
                    Puzzle o'yinini yeching va mukofotlarni qo'lga kiritish imkoniyatiga ega bo'ling!
                </p>
                <button
                    class="start-btn w-full py-3 px-6 text-white font-semibold rounded-lg shadow-md"
                    onclick="startGame('puzzle')"
                >
                    Boshlash
                </button>
            </div>
        </div>

        <!-- Crossword Game Card -->
        <div class="game-card bg-white rounded-xl shadow-md p-6 border border-gray-200">
            <div class="text-center">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Crossword</h2>
                <p class="text-gray-600 mb-6 leading-relaxed">
                    Crossword o'yinini yeching, ko'proq ball to'plang!
                </p>
                <button
                    class="start-btn w-full py-3 px-6 text-white font-semibold rounded-lg shadow-md"
                    onclick="startGame('crossword')"
                >
                    Boshlash
                </button>
            </div>
        </div>
    </div>

    <!-- Additional Games Section -->
    <div class="mt-16">
        <h3 class="text-2xl font-bold text-gray-800 text-center mb-8">Boshqa O'yinlar</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 max-w-6xl mx-auto">

            <!-- Memory Game -->
            <div class="game-card bg-white rounded-lg shadow-md p-4 border border-gray-200">
                <div class="text-center">
                    <h4 class="text-lg font-semibold text-gray-800 mb-2">Xotira O'yini</h4>
                    <p class="text-sm text-gray-600 mb-4">Kartalarni eslang va juftlarini toping</p>
                    <button
                        class="start-btn w-full py-2 px-4 text-white font-medium rounded-md text-sm"
                        onclick="startGame('memory')"
                    >
                        Boshlash
                    </button>
                </div>
            </div>

            <!-- Math Quiz -->
            <div class="game-card bg-white rounded-lg shadow-md p-4 border border-gray-200">
                <div class="text-center">
                    <h4 class="text-lg font-semibold text-gray-800 mb-2">Matematik Test</h4>
                    <p class="text-sm text-gray-600 mb-4">Matematik masalalarni yeching</p>
                    <button
                        class="start-btn w-full py-2 px-4 text-white font-medium rounded-md text-sm"
                        onclick="startGame('math')"
                    >
                        Boshlash
                    </button>
                </div>
            </div>

            <!-- Word Game -->
            <div class="game-card bg-white rounded-lg shadow-md p-4 border border-gray-200">
                <div class="text-center">
                    <h4 class="text-lg font-semibold text-gray-800 mb-2">So'z O'yini</h4>
                    <p class="text-sm text-gray-600 mb-4">Harflardan so'zlar tuzing</p>
                    <button
                        class="start-btn w-full py-2 px-4 text-white font-medium rounded-md text-sm"
                        onclick="startGame('word')"
                    >
                        Boshlash
                    </button>
                </div>
            </div>

            <!-- Quiz Game -->
            <div class="game-card bg-white rounded-lg shadow-md p-4 border border-gray-200">
                <div class="text-center">
                    <h4 class="text-lg font-semibold text-gray-800 mb-2">Umumiy Test</h4>
                    <p class="text-sm text-gray-600 mb-4">Turli mavzularda test ishlang</p>
                    <button
                        class="start-btn w-full py-2 px-4 text-white font-medium rounded-md text-sm"
                        onclick="startGame('quiz')"
                    >
                        Boshlash
                    </button>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Footer -->
<footer class="bg-gray-800 text-white py-6 mt-16">
    <div class="container mx-auto px-4 text-center">
        <p class="text-gray-300">© 2025 Thinko.uz - Barcha huquqlar himoyalangan</p>
        <div class="mt-4 flex justify-center space-x-6">
            <a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">Biz haqimizda</a>
            <a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">Aloqa</a>
            <a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">Maxfiylik</a>
        </div>
    </div>
</footer>

<!-- Game Modal -->
<div id="gameModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-xl p-8 max-w-md mx-4 text-center">
        <h3 id="modalTitle" class="text-2xl font-bold text-gray-800 mb-4"></h3>
        <p id="modalDescription" class="text-gray-600 mb-6"></p>
        <div class="flex space-x-4">
            <button
                class="flex-1 bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded-lg transition-colors duration-200"
                onclick="playGame()"
            >
                O'ynash
            </button>
            <button
                class="flex-1 bg-gray-500 hover:bg-gray-600 text-white py-2 px-4 rounded-lg transition-colors duration-200"
                onclick="closeModal()"
            >
                Bekor qilish
            </button>
        </div>
    </div>
</div>

<script>
    let currentGame = '';

    const gameData = {
        yesno: {
            title: "Yes/No Savollari",
            description: "Oddiy savollarga ha yoki yo'q deb javob bering va ball to'plang!"
        },
        puzzle: {
            title: "Puzzle O'yini",
            description: "Rasmni to'g'ri tartibda joylashtiring va mukofot qo'lga kiriting!"
        },
        crossword: {
            title: "Crossword",
            description: "So'zlarni topib, krossvordni to'ldiring!"
        },
        memory: {
            title: "Xotira O'yini",
            description: "Kartalarni eslab qoling va juftlarini toping!"
        },
        math: {
            title: "Matematik Test",
            description: "Matematik masalalarni yeching va natijangizni yaxshilang!"
        },
        word: {
            title: "So'z O'yini",
            description: "Berilgan harflardan eng ko'p so'z tuzing!"
        },
        quiz: {
            title: "Umumiy Test",
            description: "Turli mavzularda bilimingizni sinab ko'ring!"
        }
    };

    function startGame(gameType) {
        currentGame = gameType;
        const game = gameData[gameType];

        document.getElementById('modalTitle').textContent = game.title;
        document.getElementById('modalDescription').textContent = game.description;
        document.getElementById('gameModal').classList.remove('hidden');
        document.getElementById('gameModal').classList.add('flex');
    }

    function closeModal() {
        document.getElementById('gameModal').classList.add('hidden');
        document.getElementById('gameModal').classList.remove('flex');
    }

    function playGame() {
        closeModal();

        // Simulate game loading
        showNotification(`${gameData[currentGame].title} yuklanmoqda...`, 'info');

        setTimeout(() => {
            showNotification(`${gameData[currentGame].title} muvaffaqiyatli boshlandi!`, 'success');
        }, 1500);
    }

    function showNotification(message, type = 'info') {
        const notification = document.createElement('div');
        const bgColor = type === 'success' ? 'bg-green-500' : type === 'error' ? 'bg-red-500' : 'bg-blue-500';

        notification.className = `fixed top-4 right-4 ${bgColor} text-white px-6 py-3 rounded-lg shadow-lg z-50 transform transition-all duration-300 translate-x-full`;
        notification.textContent = message;

        document.body.appendChild(notification);

        // Animate in
        setTimeout(() => {
            notification.classList.remove('translate-x-full');
        }, 100);

        // Remove after 3 seconds
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

    // Add keyboard support
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeModal();
        }
    });

    // Add loading animation to buttons
    document.querySelectorAll('.start-btn').forEach(button => {
        button.addEventListener('click', function() {
            const originalText = this.textContent;
            this.textContent = 'Yuklanmoqda...';
            this.disabled = true;

            setTimeout(() => {
                this.textContent = originalText;
                this.disabled = false;
            }, 1000);
        });
    });
</script>
</body>
</html>
