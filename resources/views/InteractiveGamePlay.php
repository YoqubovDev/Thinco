<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interaktiv O'yinlar - Bolalar uchun</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Fredoka+One:wght@400&family=Nunito:wght@400;600;700;800&display=swap');

        body {
            font-family: 'Nunito', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
            background-size: 400% 400%;
            animation: gradientShift 8s ease infinite;
        }

        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .fun-title {
            font-family: 'Fredoka One', cursive;
            text-shadow: 3px 3px 0px #ff6b6b, 6px 6px 0px #4ecdc4;
        }

        .game-card {
            background: linear-gradient(145deg, #ffffff, #f0f0f0);
            border-radius: 25px;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        .game-card:hover {
            transform: translateY(-15px) scale(1.05);
            box-shadow: 0 20px 40px rgba(0,0,0,0.2);
        }

        .bounce {
            animation: bounce 2s infinite;
        }

        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
            40% { transform: translateY(-10px); }
            60% { transform: translateY(-5px); }
        }

        .wiggle {
            animation: wiggle 1s ease-in-out infinite;
        }

        @keyframes wiggle {
            0%, 7% { transform: rotateZ(0); }
            15% { transform: rotateZ(-15deg); }
            20% { transform: rotateZ(10deg); }
            25% { transform: rotateZ(-10deg); }
            30% { transform: rotateZ(6deg); }
            35% { transform: rotateZ(-4deg); }
            40%, 100% { transform: rotateZ(0); }
        }

        .rainbow-btn {
            background: linear-gradient(45deg, #ff6b6b, #4ecdc4, #45b7d1, #96ceb4, #feca57, #ff9ff3);
            background-size: 300% 300%;
            animation: rainbow 3s ease infinite;
        }

        @keyframes rainbow {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .star {
            animation: twinkle 1.5s ease-in-out infinite alternate;
        }

        @keyframes twinkle {
            from { opacity: 0.3; transform: scale(0.8); }
            to { opacity: 1; transform: scale(1.2); }
        }

        .floating {
            animation: floating 3s ease-in-out infinite;
        }

        @keyframes floating {
            0% { transform: translate(0, 0px); }
            50% { transform: translate(0, -10px); }
            100% { transform: translate(0, 0px); }
        }

        .category-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 20px;
            transition: all 0.3s ease;
        }

        .category-card:hover {
            transform: scale(1.1) rotate(2deg);
        }
    </style>
</head>
<body class="min-h-screen overflow-x-hidden">

<!-- Floating Elements -->
<div class="fixed inset-0 pointer-events-none z-0">
    <div class="star absolute top-10 left-10 text-yellow-300 text-2xl">⭐</div>
    <div class="star absolute top-20 right-20 text-pink-300 text-3xl">🌟</div>
    <div class="star absolute bottom-20 left-20 text-blue-300 text-2xl">✨</div>
    <div class="star absolute bottom-10 right-10 text-purple-300 text-3xl">💫</div>
    <div class="floating absolute top-1/4 left-1/4 text-6xl">🎈</div>
    <div class="floating absolute top-1/3 right-1/3 text-5xl">🎪</div>
    <div class="floating absolute bottom-1/3 left-1/2 text-4xl">🎨</div>
</div>

<!-- Header -->
<header class="relative z-10 text-center py-8 px-4">
    <div class="bounce">
        <h1 class="fun-title text-6xl md:text-8xl text-white mb-4">
            Interaktiv O'yinlar
        </h1>
    </div>
    <p class="text-2xl text-white font-bold mb-6">🌈 Bolalar uchun qiziqarli o'yinlar! 🎮</p>

    <!-- Age Categories -->
    <div class="flex justify-center space-x-4 mb-8">
        <div class="category-card px-6 py-3 text-white font-bold cursor-pointer" onclick="filterByAge('3-5')">
            👶 3-5 yosh
        </div>
        <div class="category-card px-6 py-3 text-white font-bold cursor-pointer" onclick="filterByAge('6-8')">
            🧒 6-8 yosh
        </div>
        <div class="category-card px-6 py-3 text-white font-bold cursor-pointer" onclick="filterByAge('9-12')">
            👦 9-12 yosh
        </div>
    </div>
</header>

<!-- Main Content -->
<main class="relative z-10 container mx-auto px-4 pb-12">

    <!-- Featured Games -->
    <div class="mb-12">
        <h2 class="text-4xl font-bold text-white text-center mb-8 wiggle">🎯 Eng Sevimli O'yinlar</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

            <!-- Alphabet Game -->
            <div class="game-card p-6 text-center" data-age="6-8">
                <div class="text-6xl mb-4 bounce">📚</div>
                <h3 class="text-2xl font-bold text-gray-800 mb-3">Alifbo O'yini</h3>
                <p class="text-gray-600 mb-4">Harflarni o'rganing va so'zlar tuzing!</p>
                <div class="flex justify-center mb-4">
                    <span class="bg-red-400 text-white px-3 py-1 rounded-full text-sm font-bold">4-8 yosh</span>
                </div>
                <button id="alphabet" class="rainbow-btn w-full py-3 px-6 text-white font-bold rounded-full text-lg" onclick="startGame('alphabet')">
                    🔤 Harflarni O'rganish!
                </button>
            </div>

            <!-- Animal Sounds -->
            <div class="game-card p-6 text-center" data-age="3-5">
                <div class="text-6xl mb-4 wiggle">🐾</div>
                <h3 class="text-2xl font-bold text-gray-800 mb-3">Hayvonlar Ovozi</h3>
                <p class="text-gray-600 mb-4">Hayvonlarning ovozini eshiting va topishga harakat qiling!</p>
                <div class="flex justify-center mb-4">
                    <span class="bg-blue-400 text-white px-3 py-1 rounded-full text-sm font-bold">3-6 yosh</span>
                </div>
                <button id="startGameBtn"  class="rainbow-btn w-full py-3 px-6 text-white font-bold rounded-full text-lg" onclick="startGame('animals')">
                    🔊 Ovozlarni Eshitish!
                </button>
            </div>

            <!-- Memory Game -->
            <div class="game-card p-6 text-center" data-age="6-8">
                <div class="text-6xl mb-4 floating">🧠</div>
                <h3 class="text-2xl font-bold text-gray-800 mb-3">Xotira O'yini</h3>
                <p class="text-gray-600 mb-4">Kartalarni eslab qoling va juftlarini toping!</p>
                <div class="flex justify-center mb-4">
                    <span class="bg-purple-400 text-white px-3 py-1 rounded-full text-sm font-bold">5-10 yosh</span>
                </div>
                <button id="MemoryGameBtn" class="rainbow-btn w-full py-3 px-6 text-white font-bold rounded-full text-lg" onclick="startGame('memory')">
                    🃏 Xotirani Sinash!
                </button>
            </div>

            <!-- Drawing Game -->
            <div class="game-card p-6 text-center" data-age="3-5">
                <div class="text-6xl mb-4 bounce">🎨</div>
                <h3 class="text-2xl font-bold text-gray-800 mb-3">Rasm Chizish</h3>
                <p class="text-gray-600 mb-4">Rangbarang bo'yoqlar bilan chiroyli rasmlar chizing!</p>
                <div class="flex justify-center mb-4">
                    <span class="bg-green-400 text-white px-3 py-1 rounded-full text-sm font-bold">3-8 yosh</span>
                </div>
                <button id="colors" class="rainbow-btn w-full py-3 px-6 text-white font-bold rounded-full text-lg" onclick="startGame('drawing')">
                    🖌️ Chizishni Boshlash!
                </button>
            </div>


            <!-- Math Game -->
            <div class="game-card p-6 text-center" data-age="6-8">
                <div class="text-6xl mb-4 wiggle">🔢</div>
                <h3 class="text-2xl font-bold text-gray-800 mb-3">Matematik O'yin</h3>
                <p class="text-gray-600 mb-4">Raqamlar bilan o'ynang va hisoblashni o'rganing!</p>
                <div class="flex justify-center mb-4">
                    <span class="bg-yellow-400 text-white px-3 py-1 rounded-full text-sm font-bold">5-9 yosh</span>
                </div>
                <button class="rainbow-btn w-full py-3 px-6 text-white font-bold rounded-full text-lg" onclick="startGame('math')">
                    ➕ Hisoblashni Boshlash!
                </button>
            </div>

            <!-- Music Game -->
            <div class="game-card p-6 text-center" data-age="3-5">
                <div class="text-6xl mb-4 floating">🎵</div>
                <h3 class="text-2xl font-bold text-gray-800 mb-3">Musiqa O'yini</h3>
                <p class="text-gray-600 mb-4">Turli xil asboblar bilan musiqa yarating!</p>
                <div class="flex justify-center mb-4">
                    <span class="bg-pink-400 text-white px-3 py-1 rounded-full text-sm font-bold">3-10 yosh</span>
                </div>
                <button class="rainbow-btn w-full py-3 px-6 text-white font-bold rounded-full text-lg" onclick="startGame('music')">
                    🎹 Musiqa Yaratish!
                </button>
            </div>
        </div>
    </div>

    <!-- Educational Games -->
    <div class="mb-12">
        <h2 class="text-4xl font-bold text-white text-center mb-8 bounce">📖 Ta'limiy O'yinlar</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

            <!-- Colors -->
            <div class="game-card p-4 text-center" data-age="3-5">
                <div class="text-4xl mb-3 wiggle">🌈</div>
                <h4 class="text-lg font-bold text-gray-800 mb-2">Ranglar</h4>
                <p class="text-sm text-gray-600 mb-3">Ranglarni o'rganing</p>
                <button class="bg-gradient-to-r from-red-400 to-pink-400 text-white px-4 py-2 rounded-full text-sm font-bold w-full" onclick="startGame('colors')">
                    O'ynash
                </button>
            </div>

            <!-- Shapes -->
            <div class="game-card p-4 text-center" data-age="3-5">
                <div class="text-4xl mb-3 bounce">⭕</div>
                <h4 class="text-lg font-bold text-gray-800 mb-2">Shakllar</h4>
                <p class="text-sm text-gray-600 mb-3">Geometrik shakllar</p>
                <button class="bg-gradient-to-r from-blue-400 to-purple-400 text-white px-4 py-2 rounded-full text-sm font-bold w-full" onclick="startGame('shapes')">
                    O'ynash
                </button>
            </div>

            <!-- Numbers -->
            <div class="game-card p-4 text-center" data-age="6-8">
                <div class="text-4xl mb-3 floating">🔢</div>
                <h4 class="text-lg font-bold text-gray-800 mb-2">Raqamlar</h4>
                <p class="text-sm text-gray-600 mb-3">1 dan 10 gacha</p>
                <button class="bg-gradient-to-r from-green-400 to-blue-400 text-white px-4 py-2 rounded-full text-sm font-bold w-full" onclick="startGame('numbers')">
                    O'ynash
                </button>
            </div>

            <!-- Puzzles -->
            <div class="game-card p-4 text-center" data-age="6-8">
                <div class="text-4xl mb-3 wiggle">🧩</div>
                <h4 class="text-lg font-bold text-gray-800 mb-2">Jumboqlar</h4>
                <p class="text-sm text-gray-600 mb-3">Oddiy jumboqlar</p>
                <button class="bg-gradient-to-r from-yellow-400 to-orange-400 text-white px-4 py-2 rounded-full text-sm font-bold w-full" onclick="startGame('puzzles')">
                    O'ynash
                </button>
            </div>
        </div>
    </div>

    <!-- Fun Zone -->
    <div class="bg-white bg-opacity-20 rounded-3xl p-8 backdrop-blur-sm">
        <h2 class="text-4xl font-bold text-white text-center mb-8 wiggle">🎪 Qiziqarli Zona</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <!-- Sticker Collection -->
            <div class="text-center">
                <div class="text-6xl mb-4 bounce">🏆</div>
                <h3 class="text-2xl font-bold text-white mb-2">Mukofotlar</h3>
                <p class="text-white mb-4">O'yin o'ynab mukofotlar yig'ing!</p>
                <button class="bg-yellow-400 hover:bg-yellow-500 text-gray-800 px-6 py-3 rounded-full font-bold" onclick="showRewards()">
                    Mukofotlarimni Ko'rish
                </button>
            </div>

            <!-- Progress -->
            <div class="text-center">
                <div class="text-6xl mb-4 floating">📊</div>
                <h3 class="text-2xl font-bold text-white mb-2">Mening Natijam</h3>
                <p class="text-white mb-4">Qancha o'yin o'ynagansiz?</p>
                <button class="bg-green-400 hover:bg-green-500 text-white px-6 py-3 rounded-full font-bold" onclick="showProgress()">
                    Natijalarni Ko'rish
                </button>
            </div>

            <!-- Parents Zone -->
            <div class="text-center">
                <div class="text-6xl mb-4 wiggle">👨‍👩‍👧‍👦</div>
                <h3 class="text-2xl font-bold text-white mb-2">Ota-onalar uchun</h3>
                <p class="text-white mb-4">Bolangizning rivojlanishini kuzating</p>
                <button class="bg-purple-400 hover:bg-purple-500 text-white px-6 py-3 rounded-full font-bold" onclick="showParentZone()">
                    Ota-onalar Zonasi
                </button>
            </div>
        </div>
    </div>
</main>

<!-- Game Modal -->
<div id="gameModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-3xl p-8 max-w-lg mx-4 text-center relative">
        <div class="absolute -top-4 -right-4 bg-red-400 text-white rounded-full w-8 h-8 flex items-center justify-center cursor-pointer" onclick="closeModal()">
            ✕
        </div>
        <div class="text-6xl mb-4 bounce" id="modalIcon">🎮</div>
        <h3 id="modalTitle" class="text-3xl font-bold text-gray-800 mb-4"></h3>
        <p id="modalDescription" class="text-gray-600 mb-6 text-lg"></p>
        <div class="flex space-x-4">
            <button
                class="flex-1 rainbow-btn text-white py-3 px-6 rounded-full font-bold text-lg"
                onclick="playGame()"
            >
                🚀 Boshlash!
            </button>
            <button
                class="flex-1 bg-gray-400 hover:bg-gray-500 text-white py-3 px-6 rounded-full font-bold text-lg"
                onclick="closeModal()"
            >
                Keyinroq
            </button>
        </div>
    </div>
</div>

<!-- Success Modal -->
<div id="successModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-3xl p-8 max-w-md mx-4 text-center">
        <div class="text-8xl mb-4 bounce">🎉</div>
        <h3 class="text-3xl font-bold text-gray-800 mb-4">Ajoyib!</h3>
        <p class="text-gray-600 mb-6 text-lg">Siz mukofot oldingiz!</p>
        <div class="text-6xl mb-4">🏆</div>
        <button
            class="rainbow-btn text-white py-3 px-8 rounded-full font-bold text-lg"
            onclick="closeSuccessModal()"
        >
            Davom etish!
        </button>
    </div>
</div>

<script>
    let currentGame = '';
    let gamesPlayed = 0;
    let rewards = [];

    const gameData = {
        drawing: {
            title: "Rasm Chizish O'yini",
            description: "Rangbarang bo'yoqlar bilan o'z tasavvuringizni qog'ozga tushiring! Turli xil cho'tkalar va ranglar mavjud.",
            icon: "🎨"
        },
        animals: {
            title: "Hayvonlar Ovozi",
            description: "Turli hayvonlarning ovozini eshiting va qaysi hayvon ekanligini topishga harakat qiling!",
            icon: "🐾"
        },
        memory: {
            title: "Xotira O'yini",
            description: "Kartalarni bir necha soniya ko'ring, keyin ularni eslab qoling va juftlarini toping!",
            icon: "🧠"
        },
        alphabet: {
            title: "Alifbo O'yini",
            description: "Harflarni o'rganing, so'zlar tuzing va o'qishni boshlang! Qiziqarli animatsiyalar bilan.",
            icon: "📚"
        },
        math: {
            title: "Matematik O'yin",
            description: "Oddiy qo'shish va ayirish amallarini o'rganing. Raqamlar bilan do'stlashing!",
            icon: "🔢"
        },
        music: {
            title: "Musiqa O'yini",
            description: "Piano, baraban va boshqa asboblar bilan o'z musiqangizni yarating!",
            icon: "🎵"
        },
        colors: {
            title: "Ranglar O'yini",
            description: "Turli ranglarni o'rganing va ularni ajratishni o'rganing!",
            icon: "🌈"
        },
        shapes: {
            title: "Shakllar O'yini",
            description: "Doira, kvadrat, uchburchak va boshqa shakllarni tanib oling!",
            icon: "⭕"
        },
        numbers: {
            title: "Raqamlar O'yini",
            description: "1 dan 10 gacha raqamlarni o'rganing va sanashni boshlang!",
            icon: "🔢"
        },
        puzzles: {
            title: "Jumboqlar O'yini",
            description: "Oddiy jumboqlarni yeching va mantiqiy fikrlashni rivojlantiring!",
            icon: "🧩"
        }
    };

    function startGame(game) {
        currentGame = game;
        const data = gameData[game];

        document.getElementById('modalIcon').textContent = data.icon;
        document.getElementById('modalTitle').textContent = data.title;
        document.getElementById('modalDescription').textContent = data.description;
        document.getElementById('gameModal').classList.remove('hidden');
        document.getElementById('gameModal').classList.add('flex');
    }

    document.getElementById('startGameBtn').addEventListener('click', function() {

        window.location.href = '/interactive-game-play/AnimalSounds';

    });
    document.getElementById('MemoryGameBtn').addEventListener('click', function() {

        window.location.href = '/interactive-game-play/MemoryGame';

    });

    document.getElementById('alphabet').addEventListener('click', function() {

        window.location.href = '/interactive-game-play/Alphabet';

    });

    document.getElementById('colors').addEventListener('click', function() {

        window.location.href = '/interactive-game-play/colors';

    });

    function closeModal() {
        document.getElementById('gameModal').classList.add('hidden');
        document.getElementById('gameModal').classList.remove('flex');
    }

    function playGame() {
        closeModal();
        gamesPlayed++;

        showNotification(`${gameData[currentGame].title} boshlandi! 🎮`, 'success');

        // Simulate game completion after 3 seconds
        setTimeout(() => {
            showSuccessModal();
            addReward();
        }, 3000);
    }

    function showSuccessModal() {
        document.getElementById('successModal').classList.remove('hidden');
        document.getElementById('successModal').classList.add('flex');
    }

    function closeSuccessModal() {
        document.getElementById('successModal').classList.add('hidden');
        document.getElementById('successModal').classList.remove('flex');
    }

    function addReward() {
        const rewardEmojis = ['🏆', '🎖️', '🥇', '⭐', '🌟', '💎', '🎁', '🍭'];
        const randomReward = rewardEmojis[Math.floor(Math.random() * rewardEmojis.length)];
        rewards.push(randomReward);
    }

    function filterByAge(age) {
        const cards = document.querySelectorAll('.game-card');
        cards.forEach(card => {
            const cardAge = card.getAttribute('data-age');
            if (cardAge === age || age === 'all') {
                card.style.display = 'block';
                card.style.animation = 'fadeIn 0.5s ease-in';
            } else {
                card.style.display = 'none';
            }
        });

        showNotification(`${age} yosh uchun o'yinlar ko'rsatildi! 👶`, 'info');
    }

    function showRewards() {
        if (rewards.length === 0) {
            showNotification('Hali mukofotlaringiz yo\'q! O\'yin o\'ynab mukofot yig\'ing! 🎮', 'info');
        } else {
            showNotification(`Sizda ${rewards.length} ta mukofot bor: ${rewards.join(' ')} 🎉`, 'success');
        }
    }

    function showProgress() {
        showNotification(`Siz ${gamesPlayed} ta o'yin o'ynagansiz! Davom eting! 📊`, 'info');
    }

    function showParentZone() {
        showNotification('Ota-onalar zonasi tez orada ochiladi! 👨‍👩‍👧‍👦', 'info');
    }

    function showNotification(message, type = 'info') {
        const notification = document.createElement('div');
        let bgColor = 'bg-blue-500';

        if (type === 'success') bgColor = 'bg-green-500';
        if (type === 'error') bgColor = 'bg-red-500';
        if (type === 'info') bgColor = 'bg-purple-500';

        notification.className = `fixed top-4 right-4 ${bgColor} text-white px-6 py-4 rounded-2xl shadow-lg z-50 transform transition-all duration-300 translate-x-full font-bold`;
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
        }, 4000);
    }

    // Add click sound effect simulation
    document.addEventListener('click', function(e) {
        if (e.target.tagName === 'BUTTON') {
            // Simulate click sound
            console.log('🔊 Click sound!');
        }
    });

    // Auto-show age filter hint
    setTimeout(() => {
        showNotification('Yuqoridagi yosh guruhlarini bosib, o\'yinlarni filterlang! 👆', 'info');
    }, 2000);

    // Add some fun interactions
    document.querySelectorAll('.game-card').forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-15px) scale(1.05) rotate(2deg)';
        });

        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1) rotate(0deg)';
        });
    });

    // Close modal when clicking outside
    document.getElementById('gameModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeModal();
        }
    });

    document.getElementById('successModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeSuccessModal();
        }
    });
</script>
</body>
</html>
