<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alifbo O'yini - Thinko.uz</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }

        .game-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .game-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        }

        .letter-btn {
            width: 80px;
            height: 80px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            font-weight: bold;
            transition: all 0.3s ease;
            cursor: pointer;
            border: 3px solid transparent;
            position: relative;
            background: linear-gradient(135deg, #f59e0b, #d97706);
            color: white;
        }

        .letter-btn:hover {
            transform: scale(1.1);
            box-shadow: 0 8px 25px rgba(245, 158, 11, 0.4);
        }

        .letter-btn.active {
            background: linear-gradient(135deg, #10b981, #059669);
            border-color: #10b981;
            animation: letterPulse 0.6s ease;
        }

        .letter-btn.correct {
            background: linear-gradient(135deg, #10b981, #059669);
            animation: correctBounce 0.8s ease;
        }

        .letter-btn.incorrect {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            animation: incorrectShake 0.6s ease;
        }

        .word-slot {
            width: 60px;
            height: 60px;
            border: 3px dashed #9ca3af;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            font-weight: bold;
            background: #f9fafb;
            transition: all 0.3s ease;
        }

        .word-slot.filled {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            color: white;
            border-color: #3b82f6;
        }

        .word-slot.drop-zone {
            border-color: #f59e0b;
            background: #fef3c7;
            animation: dropZonePulse 1s infinite;
        }

        @keyframes letterPulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.2); }
            100% { transform: scale(1); }
        }

        @keyframes correctBounce {
            0%, 100% { transform: scale(1); }
            25% { transform: scale(1.2) rotate(5deg); }
            75% { transform: scale(1.1) rotate(-5deg); }
        }

        @keyframes incorrectShake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-10px); }
            75% { transform: translateX(10px); }
        }

        @keyframes dropZonePulse {
            0%, 100% { opacity: 0.7; }
            50% { opacity: 1; }
        }

        .floating-star {
            position: fixed;
            font-size: 24px;
            color: #fbbf24;
            pointer-events: none;
            animation: floatUp 2s ease-out forwards;
            z-index: 1000;
        }

        @keyframes floatUp {
            0% {
                opacity: 1;
                transform: translateY(0) rotate(0deg);
            }
            100% {
                opacity: 0;
                transform: translateY(-100px) rotate(360deg);
            }
        }

        .progress-ring {
            transform: rotate(-90deg);
        }

        .progress-ring-circle {
            stroke-dasharray: 251;
            stroke-dashoffset: 251;
            transition: stroke-dashoffset 0.5s ease;
        }

        .mode-btn {
            background: linear-gradient(135deg, #8b5cf6, #7c3aed);
            color: white;
            border: none;
            border-radius: 15px;
            padding: 16px 24px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .mode-btn:hover {
            background: linear-gradient(135deg, #7c3aed, #6d28d9);
            transform: translateY(-2px);
        }

        .alphabet-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(80px, 1fr));
            gap: 12px;
            max-width: 800px;
            margin: 0 auto;
        }

        .word-building-area {
            display: flex;
            gap: 8px;
            align-items: center;
            justify-content: center;
            flex-wrap: wrap;
            padding: 20px;
            background: #f8fafc;
            border-radius: 15px;
            margin: 20px 0;
        }

        .example-word {
            background: linear-gradient(135deg, #06b6d4, #0891b2);
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .example-word:hover {
            transform: scale(1.05);
        }

        .achievement-badge {
            background: linear-gradient(135deg, #f59e0b, #d97706);
            color: white;
            padding: 8px 16px;
            border-radius: 25px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            animation: badgeGlow 2s infinite;
        }

        @keyframes badgeGlow {
            0%, 100% { box-shadow: 0 0 20px rgba(245, 158, 11, 0.3); }
            50% { box-shadow: 0 0 30px rgba(245, 158, 11, 0.6); }
        }
    </style>
</head>
<body>
<!-- Header -->
<header class="bg-white bg-opacity-10 backdrop-blur-lg shadow-lg">
    <div class="container mx-auto px-4 py-4">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <button onclick="goBack()" class="text-white hover:text-gray-200 mr-4">
                    <i class="fas fa-arrow-left text-xl"></i>
                </button>
                <h1 class="text-2xl font-bold text-white">Alifbo O'yini</h1>
            </div>
            <div class="flex items-center space-x-4">
                <div class="text-white text-center">
                    <div class="text-sm opacity-80">Yulduzlar</div>
                    <div class="text-xl font-bold" id="totalStars">0</div>
                </div>
                <div class="text-white text-center">
                    <div class="text-sm opacity-80">Dareja</div>
                    <div class="text-xl font-bold" id="currentLevel">1</div>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Main Content -->
<div class="container mx-auto px-4 py-8">

    <!-- Mode Selection Screen -->
    <div id="modeSelection" class="max-w-4xl mx-auto">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-white mb-4">O'yin Rejimini Tanlang</h2>
            <p class="text-white opacity-80">Harflarni o'rganing va so'zlar tuzing!</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Learn Letters -->
            <div class="game-card p-6 text-center cursor-pointer" onclick="selectMode('learn')">
                <div class="text-6xl mb-4">📚</div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Harf O'rganish</h3>
                <p class="text-gray-600 mb-4">Alifboni o'rganing va harflarni tanib oling</p>
                <div class="text-sm text-gray-500 mb-4">
                    <div>• 35 ta harf</div>
                    <div>• Tovush bilan talaffuz</div>
                    <div>• Misol so'zlar</div>
                </div>
                <button class="mode-btn w-full">
                    <i class="fas fa-book-open"></i>
                    Boshlash
                </button>
            </div>

            <!-- Find Letters -->
            <div class="game-card p-6 text-center cursor-pointer" onclick="selectMode('find')">
                <div class="text-6xl mb-4">🔍</div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Harf Topish</h3>
                <p class="text-gray-600 mb-4">Aytilgan harfni toping va ball to'plang</p>
                <div class="text-sm text-gray-500 mb-4">
                    <div>• Tezlik o'yini</div>
                    <div>• Xotira mashqi</div>
                    <div>• Ball tizimi</div>
                </div>
                <button class="mode-btn w-full">
                    <i class="fas fa-search"></i>
                    Boshlash
                </button>
            </div>

            <!-- Build Words -->
            <div class="game-card p-6 text-center cursor-pointer" onclick="selectMode('build')">
                <div class="text-6xl mb-4">✏️</div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">So'z Tuzish</h3>
                <p class="text-gray-600 mb-4">Harflardan so'zlar tuzing va lug'atni boyiting</p>
                <div class="text-sm text-gray-500 mb-4">
                    <div>• Drag & drop</div>
                    <div>• Oddiy so'zlar</div>
                    <div>• Ijodiy faoliyat</div>
                </div>
                <button class="mode-btn w-full">
                    <i class="fas fa-puzzle-piece"></i>
                    Boshlash
                </button>
            </div>

            <!-- Spelling Test -->
            <div class="game-card p-6 text-center cursor-pointer" onclick="selectMode('spell')">
                <div class="text-6xl mb-4">📝</div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Imlo Sinovi</h3>
                <p class="text-gray-600 mb-4">Aytilgan so'zlarni to'g'ri yozing</p>
                <div class="text-sm text-gray-500 mb-4">
                    <div>• Imlo mashqi</div>
                    <div>• Qiyinlik darajalari</div>
                    <div>• Mukofotlar</div>
                </div>
                <button class="mode-btn w-full">
                    <i class="fas fa-pen"></i>
                    Boshlash
                </button>
            </div>
        </div>
    </div>

    <!-- Learn Mode Screen -->
    <div id="learnScreen" class="hidden max-w-4xl mx-auto">
        <div class="game-card p-8 mb-6">
            <div class="text-center mb-6">
                <h3 class="text-2xl font-bold text-gray-800 mb-2">Harf O'rganish</h3>
                <p class="text-gray-600">Harfni bosing va tovushini eshiting</p>
            </div>

            <!-- Current Letter Display -->
            <div class="text-center mb-8" id="currentLetterDisplay">
                <div class="inline-block bg-gradient-to-r from-blue-500 to-purple-600 text-white rounded-3xl p-8 mb-4">
                    <div class="text-8xl font-bold" id="currentLetter">А</div>
                </div>
                <div class="text-xl font-semibold text-gray-700" id="currentLetterName">А - A</div>
                <button onclick="playLetterSound()" class="mt-4 bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded-full">
                    <i class="fas fa-volume-up mr-2"></i>Tovushini eshiting
                </button>
            </div>

            <!-- Example Words -->
            <div class="text-center mb-8">
                <h4 class="text-lg font-semibold text-gray-700 mb-4">Misol so'zlar:</h4>
                <div class="flex flex-wrap gap-3 justify-center" id="exampleWords">
                    <!-- Words will be populated by JavaScript -->
                </div>
            </div>

            <!-- Alphabet Grid -->
            <div class="alphabet-grid" id="alphabetGrid">
                <!-- Letters will be populated by JavaScript -->
            </div>
        </div>

        <div class="text-center">
            <button onclick="selectMode('find')" class="mode-btn">
                Keyingi: Harf Topish <i class="fas fa-arrow-right ml-2"></i>
            </button>
        </div>
    </div>

    <!-- Find Mode Screen -->
    <div id="findScreen" class="hidden max-w-4xl mx-auto">
        <div class="game-card p-8 mb-6">
            <!-- Progress and Timer -->
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center">
                    <div class="bg-blue-500 text-white rounded-full w-12 h-12 flex items-center justify-center font-bold mr-4" id="questionNumber">1</div>
                    <div>
                        <div class="text-sm text-gray-600">Savol</div>
                        <div class="font-semibold" id="questionProgress">1 / 10</div>
                    </div>
                </div>

                <!-- Timer -->
                <div class="relative">
                    <svg class="w-16 h-16 progress-ring">
                        <circle cx="32" cy="32" r="28" stroke="#e5e7eb" stroke-width="4" fill="none"/>
                        <circle cx="32" cy="32" r="28" stroke="#3b82f6" stroke-width="4" fill="none"
                                class="progress-ring-circle" id="timerCircle"/>
                    </svg>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <span class="text-lg font-bold text-gray-800" id="timeLeft">10</span>
                    </div>
                </div>
            </div>

            <!-- Question -->
            <div class="text-center mb-8">
                <h3 class="text-2xl font-bold text-gray-800 mb-4">Quyidagi harfni toping:</h3>
                <div class="text-6xl font-bold text-blue-600 mb-4" id="targetLetter">А</div>
                <button onclick="playTargetSound()" class="bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded-full">
                    <i class="fas fa-volume-up mr-2"></i>Yana eshitish
                </button>
            </div>

            <!-- Letter Options -->
            <div class="alphabet-grid" id="findOptions">
                <!-- Options will be populated by JavaScript -->
            </div>

            <!-- Score Display -->
            <div class="text-center mt-6">
                <div class="inline-block bg-yellow-100 text-yellow-800 px-6 py-3 rounded-full">
                    <span class="text-lg">Ball: </span>
                    <span class="text-xl font-bold" id="findScore">0</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Build Mode Screen -->
    <div id="buildScreen" class="hidden max-w-4xl mx-auto">
        <div class="game-card p-8 mb-6">
            <div class="text-center mb-6">
                <h3 class="text-2xl font-bold text-gray-800 mb-2">So'z Tuzish</h3>
                <p class="text-gray-600">Harflarni sudrab so'z tuzing</p>
            </div>

            <!-- Target Word -->
            <div class="text-center mb-8">
                <h4 class="text-lg font-semibold text-gray-700 mb-4">Bu so'zni tuzing:</h4>
                <div class="text-4xl font-bold text-purple-600 mb-4" id="targetWord">BOLA</div>
                <button onclick="playWordSound()" class="bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded-full">
                    <i class="fas fa-volume-up mr-2"></i>So'zni eshiting
                </button>
            </div>

            <!-- Word Building Area -->
            <div class="word-building-area" id="wordSlots">
                <!-- Word slots will be populated by JavaScript -->
            </div>

            <!-- Available Letters -->
            <div class="text-center mb-6">
                <h4 class="text-lg font-semibold text-gray-700 mb-4">Harflar:</h4>
                <div class="flex flex-wrap gap-3 justify-center" id="availableLetters">
                    <!-- Letters will be populated by JavaScript -->
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="text-center">
                <button onclick="checkWord()" class="bg-blue-500 hover:bg-blue-600 text-white px-8 py-3 rounded-full mr-4">
                    <i class="fas fa-check mr-2"></i>Tekshirish
                </button>
                <button onclick="clearWord()" class="bg-gray-500 hover:bg-gray-600 text-white px-8 py-3 rounded-full">
                    <i class="fas fa-undo mr-2"></i>Tozalash
                </button>
            </div>
        </div>
    </div>

    <!-- Spell Mode Screen -->
    <div id="spellScreen" class="hidden max-w-4xl mx-auto">
        <div class="game-card p-8 mb-6">
            <div class="text-center mb-6">
                <h3 class="text-2xl font-bold text-gray-800 mb-2">Imlo Sinovi</h3>
                <p class="text-gray-600">So'zni eshiting va harflarini tanlang</p>
            </div>

            <!-- Audio Word -->
            <div class="text-center mb-8">
                <div class="text-6xl mb-4">🔊</div>
                <button onclick="playSpellWord()" class="bg-green-500 hover:bg-green-600 text-white px-8 py-4 rounded-full text-xl">
                    <i class="fas fa-play mr-2"></i>So'zni eshiting
                </button>
            </div>

            <!-- Spelling Area -->
            <div class="word-building-area" id="spellSlots">
                <!-- Spelling slots will be populated by JavaScript -->
            </div>

            <!-- Letter Keyboard -->
            <div class="alphabet-grid" id="letterKeyboard">
                <!-- Keyboard will be populated by JavaScript -->
            </div>

            <!-- Action Buttons -->
            <div class="text-center mt-6">
                <button onclick="checkSpelling()" class="bg-blue-500 hover:bg-blue-600 text-white px-8 py-3 rounded-full mr-4">
                    <i class="fas fa-check mr-2"></i>Tekshirish
                </button>
                <button onclick="clearSpelling()" class="bg-gray-500 hover:bg-gray-600 text-white px-8 py-3 rounded-full">
                    <i class="fas fa-backspace mr-2"></i>O'chirish
                </button>
            </div>
        </div>
    </div>

    <!-- Results Screen -->
    <div id="resultsScreen" class="hidden max-w-2xl mx-auto text-center">
        <div class="game-card p-8">
            <div class="text-6xl mb-6" id="resultEmoji">🌟</div>
            <h2 class="text-3xl font-bold text-gray-800 mb-4" id="resultTitle">Ajoyib!</h2>
            <p class="text-gray-600 mb-6" id="resultMessage">Siz alifboni yaxshi o'rgandingiz!</p>

            <!-- Achievement Badge -->
            <div class="mb-8" id="achievementBadge">
                <div class="achievement-badge">
                    <i class="fas fa-star"></i>
                    Alifbo Ustasi
                </div>
            </div>

            <!-- Stats -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                <div class="bg-yellow-50 p-4 rounded-lg">
                    <div class="text-2xl font-bold text-yellow-600" id="finalStars">15</div>
                    <div class="text-sm text-gray-600">Yulduzlar</div>
                </div>
                <div class="bg-green-50 p-4 rounded-lg">
                    <div class="text-2xl font-bold text-green-600" id="correctAnswers">8</div>
                    <div class="text-sm text-gray-600">To'g'ri Javob</div>
                </div>
                <div class="bg-blue-50 p-4 rounded-lg">
                    <div class="text-2xl font-bold text-blue-600" id="accuracy">80%</div>
                    <div class="text-sm text-gray-600">Aniqlik</div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <button onclick="playAgain()" class="mode-btn">
                    <i class="fas fa-redo mr-2"></i>Qayta O'ynash
                </button>
                <button onclick="selectNewMode()" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-full">
                    <i class="fas fa-list mr-2"></i>Boshqa Rejim
                </button>
                <button onclick="goHome()" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-full">
                    <i class="fas fa-home mr-2"></i>Bosh Sahifa
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    // Game State
    let currentMode = '';
    let currentLetterIndex = 0;
    let currentQuestionIndex = 0;
    let totalQuestions = 10;
    let score = 0;
    let stars = 0;
    let level = 1;
    let timeLeft = 10;
    let timerInterval = null;
    let currentTargetWord = '';
    let currentSpellWord = '';
    let builtWord = [];
    let spelledWord = [];

    // Uzbek Alphabet
    const uzbekAlphabet = [
        { letter: 'A', name: 'A - A', examples: ['Olma', 'Archa', 'Ata'] },
        { letter: 'B', name: 'B - Be', examples: ['Bola', 'Bog\'', 'Bosh'] },
        { letter: 'D', name: 'D - De', examples: ['Dala', 'Daraxt', 'Do\'st'] },
        { letter: 'E', name: 'E - E', examples: ['Eshak', 'Erkak', 'Erta'] },
        { letter: 'F', name: 'F - Ef', examples: ['Fasl', 'Fikr', 'Farzand'] },
        { letter: 'G', name: 'G - Ge', examples: ['Gul', 'Gap', 'Guruh'] },
        { letter: 'H', name: 'H - Ha', examples: ['Havo', 'Hayot', 'Harf'] },
        { letter: 'I', name: 'I - I', examples: ['It', 'Ish', 'Ilm'] },
        { letter: 'J', name: 'J - Je', examples: ['Joy', 'Juda', 'Jigar'] },
        { letter: 'K', name: 'K - Ka', examples: ['Kuz', 'Kitob', 'Kecha'] },
        { letter: 'L', name: 'L - El', examples: ['Lola', 'Lug\'at', 'Loyiha'] },
        { letter: 'M', name: 'M - Em', examples: ['Meva', 'Maktab', 'Mushuk'] },
        { letter: 'N', name: 'N - En', examples: ['Non', 'Nima', 'Nazar'] },
        { letter: 'O', name: 'O - O', examples: ['Oy', 'Ona', 'Oltin'] },
        { letter: 'P', name: 'P - Pe', examples: ['Palov', 'Pul', 'Piyola'] },
        { letter: 'Q', name: 'Q - Qu', examples: ['Qush', 'Qalam', 'Quyosh'] },
        { letter: 'R', name: 'R - Er', examples: ['Rasm', 'Rang', 'Reja'] },
        { letter: 'S', name: 'S - Es', examples: ['Suv', 'Salom', 'Savol'] },
        { letter: 'T', name: 'T - Te', examples: ['Tog\'', 'Tosh', 'Tez'] },
        { letter: 'U', name: 'U - U', examples: ['Uy', 'Uzum', 'Ustoz'] },
        { letter: 'V', name: 'V - Ve', examples: ['Vaqt', 'Vazifa', 'Voqea'] },
        { letter: 'X', name: 'X - Xa', examples: ['Xat', 'Xabar', 'Xona'] },
        { letter: 'Y', name: 'Y - Ye', examples: ['Yoz', 'Yaxshi', 'Yer'] },
        { letter: 'Z', name: 'Z - Ze', examples: ['Zamon', 'Zavod', 'Ziyofat'] }
    ];

    // Simple Words for Building
    const simpleWords = [
        'BOLA', 'MAMA', 'DADA', 'SUVA', 'NOMA', 'KOZA', 'GULA', 'TOSH',
        'OLMA', 'UZUM', 'QUSH', 'MUSHUK', 'KITOB', 'MEVA', 'RANG', 'YAXSHI'
    ];

    // Initialize Game
    document.addEventListener('DOMContentLoaded', function() {
        showModeSelection();
        updateStats();
    });

    // Mode Selection
    function selectMode(mode) {
        currentMode = mode;
        hideAllScreens();

        switch(mode) {
            case 'learn':
                showLearnMode();
                break;
            case 'find':
                showFindMode();
                break;
            case 'build':
                showBuildMode();
                break;
            case 'spell':
                showSpellMode();
                break;
        }
    }

    function hideAllScreens() {
        document.getElementById('modeSelection').classList.add('hidden');
        document.getElementById('learnScreen').classList.add('hidden');
        document.getElementById('findScreen').classList.add('hidden');
        document.getElementById('buildScreen').classList.add('hidden');
        document.getElementById('spellScreen').classList.add('hidden');
        document.getElementById('resultsScreen').classList.add('hidden');
    }

    function showModeSelection() {
        hideAllScreens();
        document.getElementById('modeSelection').classList.remove('hidden');
    }

    // Learn Mode
    function showLearnMode() {
        document.getElementById('learnScreen').classList.remove('hidden');
        currentLetterIndex = 0;
        setupAlphabetGrid();
        showCurrentLetter();
    }

    function setupAlphabetGrid() {
        const grid = document.getElementById('alphabetGrid');
        grid.innerHTML = '';

        uzbekAlphabet.forEach((item, index) => {
            const button = document.createElement('button');
            button.className = 'letter-btn';
            button.textContent = item.letter;
            button.onclick = () => selectLetter(index);
            grid.appendChild(button);
        });
    }

    function selectLetter(index) {
        currentLetterIndex = index;
        showCurrentLetter();
        playLetterSound();

        // Update active state
        document.querySelectorAll('.letter-btn').forEach((btn, i) => {
            btn.classList.toggle('active', i === index);
        });
    }

    function showCurrentLetter() {
        const letterData = uzbekAlphabet[currentLetterIndex];
        document.getElementById('currentLetter').textContent = letterData.letter;
        document.getElementById('currentLetterName').textContent = letterData.name;

        // Show example words
        const exampleWordsContainer = document.getElementById('exampleWords');
        exampleWordsContainer.innerHTML = '';

        letterData.examples.forEach(word => {
            const wordElement = document.createElement('div');
            wordElement.className = 'example-word';
            wordElement.textContent = word;
            wordElement.onclick = () => speakText(word);
            exampleWordsContainer.appendChild(wordElement);
        });
    }

    // Find Mode
    function showFindMode() {
        document.getElementById('findScreen').classList.remove('hidden');
        currentQuestionIndex = 0;
        score = 0;
        startFindQuestion();
    }

    function startFindQuestion() {
        if (currentQuestionIndex >= totalQuestions) {
            endGame();
            return;
        }

        // Select random target letter
        const targetIndex = Math.floor(Math.random() * uzbekAlphabet.length);
        const targetLetter = uzbekAlphabet[targetIndex];

        document.getElementById('targetLetter').textContent = targetLetter.letter;
        document.getElementById('questionNumber').textContent = currentQuestionIndex + 1;
        document.getElementById('questionProgress').textContent = `${currentQuestionIndex + 1} / ${totalQuestions}`;

        // Create options (target + 5 random)
        const options = [targetLetter];
        while (options.length < 6) {
            const randomLetter = uzbekAlphabet[Math.floor(Math.random() * uzbekAlphabet.length)];
            if (!options.find(opt => opt.letter === randomLetter.letter)) {
                options.push(randomLetter);
            }
        }

        // Shuffle options
        options.sort(() => Math.random() - 0.5);

        // Display options
        const optionsContainer = document.getElementById('findOptions');
        optionsContainer.innerHTML = '';

        options.forEach(letterData => {
            const button = document.createElement('button');
            button.className = 'letter-btn';
            button.textContent = letterData.letter;
            button.onclick = () => selectAnswer(letterData.letter, targetLetter.letter, button);
            optionsContainer.appendChild(button);
        });

        // Start timer
        startTimer();
        playTargetSound();
    }

    function selectAnswer(selected, correct, buttonElement) {
        clearInterval(timerInterval);

        const isCorrect = selected === correct;

        if (isCorrect) {
            buttonElement.classList.add('correct');
            score += 10;
            stars += 1;
            showFloatingStars(buttonElement);
            speakText('To\'g\'ri!');
        } else {
            buttonElement.classList.add('incorrect');
            speakText('Xato!');

            // Show correct answer
            document.querySelectorAll('#findOptions .letter-btn').forEach(btn => {
                if (btn.textContent === correct) {
                    btn.classList.add('correct');
                }
            });
        }

        document.getElementById('findScore').textContent = score;
        updateStats();

        // Disable all buttons
        document.querySelectorAll('#findOptions .letter-btn').forEach(btn => {
            btn.disabled = true;
            btn.style.pointerEvents = 'none';
        });

        // Next question after delay
        setTimeout(() => {
            currentQuestionIndex++;
            startFindQuestion();
        }, 2000);
    }

    // Build Mode
    function showBuildMode() {
        document.getElementById('buildScreen').classList.remove('hidden');
        startWordBuilding();
    }

    function startWordBuilding() {
        currentTargetWord = simpleWords[Math.floor(Math.random() * simpleWords.length)];
        document.getElementById('targetWord').textContent = currentTargetWord;
        builtWord = [];

        setupWordSlots();
        setupAvailableLetters();
    }

    function setupWordSlots() {
        const slotsContainer = document.getElementById('wordSlots');
        slotsContainer.innerHTML = '';

        for (let i = 0; i < currentTargetWord.length; i++) {
            const slot = document.createElement('div');
            slot.className = 'word-slot';
            slot.dataset.index = i;
            slot.onclick = () => removeLetterFromSlot(i);
            slotsContainer.appendChild(slot);
        }
    }

    function setupAvailableLetters() {
        const lettersContainer = document.getElementById('availableLetters');
        lettersContainer.innerHTML = '';

        // Get letters from target word + some random letters
        const targetLetters = currentTargetWord.split('');
        const extraLetters = [];

        // Add some random letters
        while (extraLetters.length < 4) {
            const randomLetter = uzbekAlphabet[Math.floor(Math.random() * uzbekAlphabet.length)].letter;
            if (!targetLetters.includes(randomLetter) && !extraLetters.includes(randomLetter)) {
                extraLetters.push(randomLetter);
            }
        }

        const allLetters = [...targetLetters, ...extraLetters];
        allLetters.sort(() => Math.random() - 0.5);

        allLetters.forEach(letter => {
            const button = document.createElement('button');
            button.className = 'letter-btn';
            button.textContent = letter;
            button.onclick = () => addLetterToWord(letter, button);
            lettersContainer.appendChild(button);
        });
    }

    function addLetterToWord(letter, buttonElement) {
        if (builtWord.length >= currentTargetWord.length) return;

        builtWord.push(letter);
        buttonElement.style.opacity = '0.5';
        buttonElement.disabled = true;

        updateWordSlots();
    }

    function removeLetterFromSlot(index) {
        if (builtWord[index]) {
            const letter = builtWord[index];
            builtWord[index] = '';

            // Re-enable the letter button
            document.querySelectorAll('#availableLetters .letter-btn').forEach(btn => {
                if (btn.textContent === letter && btn.disabled) {
                    btn.style.opacity = '1';
                    btn.disabled = false;
                    return;
                }
            });

            updateWordSlots();
        }
    }

    function updateWordSlots() {
        const slots = document.querySelectorAll('#wordSlots .word-slot');
        slots.forEach((slot, index) => {
            if (builtWord[index]) {
                slot.textContent = builtWord[index];
                slot.classList.add('filled');
            } else {
                slot.textContent = '';
                slot.classList.remove('filled');
            }
        });
    }

    function checkWord() {
        const word = builtWord.join('');
        if (word === currentTargetWord) {
            speakText('Ajoyib! To\'g\'ri so\'z!');
            score += 20;
            stars += 2;
            updateStats();
            showFloatingStars(document.getElementById('wordSlots'));

            setTimeout(() => {
                startWordBuilding();
            }, 2000);
        } else {
            speakText('Xato! Qaytadan harakat qiling.');
        }
    }

    function clearWord() {
        builtWord = [];
        updateWordSlots();

        // Re-enable all letter buttons
        document.querySelectorAll('#availableLetters .letter-btn').forEach(btn => {
            btn.style.opacity = '1';
            btn.disabled = false;
        });
    }

    // Spell Mode
    function showSpellMode() {
        document.getElementById('spellScreen').classList.remove('hidden');
        startSpelling();
    }

    function startSpelling() {
        currentSpellWord = simpleWords[Math.floor(Math.random() * simpleWords.length)];
        spelledWord = [];

        setupSpellSlots();
        setupLetterKeyboard();
    }

    function setupSpellSlots() {
        const slotsContainer = document.getElementById('spellSlots');
        slotsContainer.innerHTML = '';

        for (let i = 0; i < currentSpellWord.length; i++) {
            const slot = document.createElement('div');
            slot.className = 'word-slot';
            slot.dataset.index = i;
            slotsContainer.appendChild(slot);
        }
    }

    function setupLetterKeyboard() {
        const keyboard = document.getElementById('letterKeyboard');
        keyboard.innerHTML = '';

        uzbekAlphabet.forEach(letterData => {
            const button = document.createElement('button');
            button.className = 'letter-btn';
            button.textContent = letterData.letter;
            button.onclick = () => addLetterToSpelling(letterData.letter);
            keyboard.appendChild(button);
        });
    }

    function addLetterToSpelling(letter) {
        if (spelledWord.length >= currentSpellWord.length) return;

        spelledWord.push(letter);
        updateSpellSlots();
    }

    function updateSpellSlots() {
        const slots = document.querySelectorAll('#spellSlots .word-slot');
        slots.forEach((slot, index) => {
            if (spelledWord[index]) {
                slot.textContent = spelledWord[index];
                slot.classList.add('filled');
            } else {
                slot.textContent = '';
                slot.classList.remove('filled');
            }
        });
    }

    function checkSpelling() {
        const word = spelledWord.join('');
        if (word === currentSpellWord) {
            speakText('Mukammal! To\'g\'ri yozdingiz!');
            score += 25;
            stars += 3;
            updateStats();
            showFloatingStars(document.getElementById('spellSlots'));

            setTimeout(() => {
                startSpelling();
            }, 2000);
        } else {
            speakText('Xato! Qaytadan harakat qiling.');
        }
    }

    function clearSpelling() {
        spelledWord = [];
        updateSpellSlots();
    }

    // Audio Functions
    function playLetterSound() {
        const letter = uzbekAlphabet[currentLetterIndex];
        speakText(letter.name);
    }

    function playTargetSound() {
        const targetLetter = document.getElementById('targetLetter').textContent;
        const letterData = uzbekAlphabet.find(l => l.letter === targetLetter);
        if (letterData) {
            speakText(letterData.name);
        }
    }

    function playWordSound() {
        speakText(currentTargetWord);
    }

    function playSpellWord() {
        speakText(currentSpellWord);
    }

    function speakText(text) {
        if ('speechSynthesis' in window) {
            const utterance = new SpeechSynthesisUtterance(text);
            utterance.lang = 'uz-UZ';
            utterance.rate = 0.8;
            utterance.pitch = 1.2;
            speechSynthesis.speak(utterance);
        }
    }

    // Timer Functions
    function startTimer() {
        timeLeft = 10;
        updateTimerDisplay();

        timerInterval = setInterval(() => {
            timeLeft--;
            updateTimerDisplay();

            if (timeLeft <= 0) {
                clearInterval(timerInterval);
                // Auto-submit wrong answer
                currentQuestionIndex++;
                setTimeout(() => startFindQuestion(), 1000);
            }
        }, 1000);
    }

    function updateTimerDisplay() {
        document.getElementById('timeLeft').textContent = timeLeft;

        // Update progress ring
        const circumference = 2 * Math.PI * 28;
        const progress = (10 - timeLeft) / 10;
        const offset = circumference * progress;
        document.getElementById('timerCircle').style.strokeDashoffset = circumference - offset;
    }

    // Visual Effects
    function showFloatingStars(element) {
        for (let i = 0; i < 5; i++) {
            setTimeout(() => {
                const star = document.createElement('div');
                star.className = 'floating-star';
                star.textContent = '⭐';

                const rect = element.getBoundingClientRect();
                star.style.left = (rect.left + Math.random() * rect.width) + 'px';
                star.style.top = (rect.top + Math.random() * rect.height) + 'px';

                document.body.appendChild(star);

                setTimeout(() => {
                    star.remove();
                }, 2000);
            }, i * 200);
        }
    }

    // Game Management
    function updateStats() {
        document.getElementById('totalStars').textContent = stars;
        document.getElementById('currentLevel').textContent = Math.floor(stars / 10) + 1;
    }

    function endGame() {
        hideAllScreens();
        document.getElementById('resultsScreen').classList.remove('hidden');

        const accuracy = Math.round((score / (totalQuestions * 10)) * 100);

        document.getElementById('finalStars').textContent = stars;
        document.getElementById('correctAnswers').textContent = Math.floor(score / 10);
        document.getElementById('accuracy').textContent = accuracy + '%';

        // Determine achievement
        let emoji, title, message, badge;
        if (accuracy >= 90) {
            emoji = '🏆';
            title = 'Alifbo Ustasi!';
            message = 'Siz alifboni mukammal o\'rgandingiz!';
            badge = 'Alifbo Chempioni';
        } else if (accuracy >= 70) {
            emoji = '⭐';
            title = 'Ajoyib!';
            message = 'Harflarni yaxshi bilasiz!';
            badge = 'Harf Ustasi';
        } else {
            emoji = '👍';
            title = 'Yaxshi!';
            message = 'Davom eting va yanada yaxshi bo\'ling!';
            badge = 'O\'rganuvchi';
        }

        document.getElementById('resultEmoji').textContent = emoji;
        document.getElementById('resultTitle').textContent = title;
        document.getElementById('resultMessage').textContent = message;
        document.getElementById('achievementBadge').innerHTML = `
            <div class="achievement-badge">
                <i class="fas fa-star"></i>
                ${badge}
            </div>
        `;
    }

    function playAgain() {
        score = 0;
        currentQuestionIndex = 0;
        selectMode(currentMode);
    }

    function selectNewMode() {
        showModeSelection();
    }

    function goBack() {
        if (confirm('O\'yinni tark etishni xohlaysizmi?')) {
            window.history.back();
        }
    }

    function goHome() {
        window.location.href = 'index.html';
    }

    // Keyboard Support
    document.addEventListener('keydown', function(e) {
        if (currentMode === 'find' && !document.getElementById('findScreen').classList.contains('hidden')) {
            const key = e.key.toUpperCase();
            const buttons = document.querySelectorAll('#findOptions .letter-btn');
            buttons.forEach(btn => {
                if (btn.textContent === key && !btn.disabled) {
                    btn.click();
                }
            });
        }
    });
</script>
</body>
</html>

