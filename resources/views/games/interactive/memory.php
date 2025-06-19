<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xotira Sinovlari - Thinko.uz</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }

        .memory-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .memory-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        }

        .level-btn {
            background: linear-gradient(135deg, #10b981, #059669);
            transition: all 0.3s ease;
            border-radius: 15px;
        }

        .level-btn:hover {
            background: linear-gradient(135deg, #059669, #047857);
            transform: translateY(-2px);
        }

        .memory-item {
            width: 80px;
            height: 80px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            font-weight: bold;
            transition: all 0.3s ease;
            cursor: pointer;
            border: 3px solid transparent;
            position: relative;
            overflow: hidden;
        }

        .memory-item:hover {
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .memory-item.flipped {
            transform: rotateY(180deg);
        }

        .memory-item.matched {
            border-color: #10b981;
            background: #d1fae5;
            animation: matchPulse 0.6s ease;
        }

        .memory-item.wrong {
            border-color: #ef4444;
            background: #fee2e2;
            animation: wrongShake 0.6s ease;
        }

        .memory-item.hidden {
            background: #6b7280;
            color: transparent;
            cursor: pointer;
        }

        .memory-item.revealed {
            animation: revealPulse 0.5s ease;
        }

        .memory-item.selected {
            border-color: #3b82f6;
            transform: scale(1.1);
            box-shadow: 0 8px 25px rgba(59, 130, 246, 0.4);
        }

        @keyframes matchPulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.2); }
            100% { transform: scale(1); }
        }

        @keyframes wrongShake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }

        @keyframes revealPulse {
            0% { transform: scale(1); opacity: 0.5; }
            50% { transform: scale(1.1); opacity: 1; }
            100% { transform: scale(1); opacity: 1; }
        }

        .memory-grid {
            display: grid;
            gap: 15px;
            justify-content: center;
            margin: 20px 0;
        }

        .memory-grid.grid-2x2 { grid-template-columns: repeat(2, 1fr); }
        .memory-grid.grid-3x3 { grid-template-columns: repeat(3, 1fr); }
        .memory-grid.grid-4x4 { grid-template-columns: repeat(4, 1fr); }
        .memory-grid.grid-5x5 { grid-template-columns: repeat(5, 1fr); }

        .sequence-display {
            display: flex;
            gap: 10px;
            align-items: center;
            justify-content: center;
            flex-wrap: wrap;
            padding: 20px;
            background: #f8fafc;
            border-radius: 15px;
            margin: 20px 0;
        }

        .progress-bar {
            background: linear-gradient(90deg, #10b981, #059669);
            border-radius: 10px;
            transition: width 0.5s ease;
        }

        .timer-circle {
            stroke-dasharray: 283;
            stroke-dashoffset: 283;
            transition: stroke-dashoffset 1s linear;
        }

        .floating-score {
            animation: floatUp 1s ease-out forwards;
        }

        @keyframes floatUp {
            0% {
                opacity: 1;
                transform: translateY(0);
            }
            100% {
                opacity: 0;
                transform: translateY(-50px);
            }
        }

        .phase-indicator {
            background: linear-gradient(135deg, #f59e0b, #d97706);
            color: white;
            border-radius: 20px;
            padding: 8px 16px;
            font-size: 14px;
            font-weight: 600;
            display: inline-block;
            margin-bottom: 20px;
        }

        .countdown {
            font-size: 4rem;
            font-weight: bold;
            color: #10b981;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
            animation: countdownPulse 1s ease-in-out;
        }

        @keyframes countdownPulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.2); }
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
                <h1 class="text-2xl font-bold text-white">Xotira Sinovlari</h1>
            </div>
            <div class="flex items-center space-x-4">
                <div class="text-white text-center">
                    <div class="text-sm opacity-80">Ball</div>
                    <div class="text-xl font-bold" id="totalScore">0</div>
                </div>
                <div class="text-white text-center">
                    <div class="text-sm opacity-80">Daraja</div>
                    <div class="text-xl font-bold" id="currentRound">1</div>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Main Content -->
<div class="container mx-auto px-4 py-8">

    <!-- Level Selection Screen -->
    <div id="levelSelection" class="max-w-4xl mx-auto">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-white mb-4">Test Turini Tanlang</h2>
            <p class="text-white opacity-80">Xotirangizni sinab, aqlingizni rivojlantiring!</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Visual Memory Test -->
            <div class="memory-card p-6 text-center cursor-pointer" onclick="selectTest('visual')">
                <div class="text-6xl mb-4">👁️</div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Ko'rish Xotirasi</h3>
                <p class="text-gray-600 mb-4">Ranglar va shakllarni eslab qoling</p>
                <div class="text-sm text-gray-500 mb-4">
                    <div>• Ranglar va shakllar</div>
                    <div>• 10 ta daraja</div>
                    <div>• Har bir to'g'ri javob: 20 ball</div>
                </div>
                <div class="memory-grid grid-2x2 max-w-xs mx-auto mb-4">
                    <div class="memory-item bg-red-400"></div>
                    <div class="memory-item bg-blue-400">★</div>
                    <div class="memory-item bg-green-400">●</div>
                    <div class="memory-item bg-yellow-400">■</div>
                </div>
                <button class="level-btn w-full py-3 text-white font-semibold">
                    Boshlash
                </button>
            </div>

            <!-- Sequence Memory Test -->
            <div class="memory-card p-6 text-center cursor-pointer" onclick="selectTest('sequence')">
                <div class="text-6xl mb-4">🔢</div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Ketma-ketlik Xotirasi</h3>
                <p class="text-gray-600 mb-4">Raqamlar ketma-ketligini eslab qoling</p>
                <div class="text-sm text-gray-500 mb-4">
                    <div>• Raqamlar ketma-ketligi</div>
                    <div>• 15 ta daraja</div>
                    <div>• Har bir to'g'ri javob: 15 ball</div>
                </div>
                <div class="sequence-display max-w-xs mx-auto mb-4">
                    <div class="memory-item bg-blue-400">3</div>
                    <div class="memory-item bg-blue-400">7</div>
                    <div class="memory-item bg-blue-400">1</div>
                    <div class="memory-item bg-blue-400">9</div>
                </div>
                <button class="level-btn w-full py-3 text-white font-semibold">
                    Boshlash
                </button>
            </div>

            <!-- Word Memory Test -->
            <div class="memory-card p-6 text-center cursor-pointer" onclick="selectTest('word')">
                <div class="text-6xl mb-4">📝</div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">So'z Xotirasi</h3>
                <p class="text-gray-600 mb-4">So'zlarni eslab qoling</p>
                <div class="text-sm text-gray-500 mb-4">
                    <div>• Oddiy so'zlar</div>
                    <div>• 12 ta daraja</div>
                    <div>• Har bir to'g'ri javob: 25 ball</div>
                </div>
                <div class="sequence-display max-w-xs mx-auto mb-4">
                    <div class="memory-item bg-purple-400 text-sm">OTA</div>
                    <div class="memory-item bg-purple-400 text-sm">UY</div>
                    <div class="memory-item bg-purple-400 text-sm">KUN</div>
                </div>
                <button class="level-btn w-full py-3 text-white font-semibold">
                    Boshlash
                </button>
            </div>

            <!-- Pattern Memory Test -->
            <div class="memory-card p-6 text-center cursor-pointer" onclick="selectTest('pattern')">
                <div class="text-6xl mb-4">🧩</div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Naqsh Xotirasi</h3>
                <p class="text-gray-600 mb-4">Murakkab naqshlarni eslab qoling</p>
                <div class="text-sm text-gray-500 mb-4">
                    <div>• Murakkab naqshlar</div>
                    <div>• 8 ta daraja</div>
                    <div>• Har bir to'g'ri javob: 30 ball</div>
                </div>
                <div class="memory-grid grid-3x3 max-w-xs mx-auto mb-4">
                    <div class="memory-item bg-red-400">●</div>
                    <div class="memory-item bg-white border-2 border-gray-300"></div>
                    <div class="memory-item bg-blue-400">■</div>
                    <div class="memory-item bg-white border-2 border-gray-300"></div>
                    <div class="memory-item bg-green-400">★</div>
                    <div class="memory-item bg-white border-2 border-gray-300"></div>
                    <div class="memory-item bg-yellow-400">▲</div>
                    <div class="memory-item bg-white border-2 border-gray-300"></div>
                    <div class="memory-item bg-purple-400">♦</div>
                </div>
                <button class="level-btn w-full py-3 text-white font-semibold">
                    Boshlash
                </button>
            </div>
        </div>
    </div>

    <!-- Game Screen -->
    <div id="gameScreen" class="hidden max-w-4xl mx-auto">
        <!-- Progress and Info -->
        <div class="memory-card p-6 mb-6">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center">
                    <div class="bg-green-500 text-white rounded-full w-10 h-10 flex items-center justify-center font-bold mr-4" id="roundNumber">1</div>
                    <div>
                        <div class="text-sm text-gray-600">Daraja</div>
                        <div class="font-semibold" id="roundProgress">1 / 10</div>
                    </div>
                </div>

                <!-- Timer -->
                <div class="relative">
                    <svg class="w-16 h-16 transform -rotate-90">
                        <circle cx="32" cy="32" r="28" stroke="#e5e7eb" stroke-width="4" fill="none"/>
                        <circle cx="32" cy="32" r="28" stroke="#10b981" stroke-width="4" fill="none"
                                class="timer-circle" id="timerCircle"/>
                    </svg>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <span class="text-lg font-bold text-gray-800" id="timeLeft">30</span>
                    </div>
                </div>
            </div>

            <!-- Progress Bar -->
            <div class="w-full bg-gray-200 rounded-full h-3">
                <div class="progress-bar h-3 rounded-full" id="progressBar" style="width: 0%"></div>
            </div>
        </div>

        <!-- Phase Indicator -->
        <div class="text-center mb-6">
            <div class="phase-indicator" id="phaseIndicator">Tayyorgarlik</div>
        </div>

        <!-- Game Area -->
        <div class="memory-card p-8 mb-6">
            <!-- Countdown -->
            <div id="countdownArea" class="text-center mb-6 hidden">
                <div class="countdown" id="countdownNumber">3</div>
                <p class="text-gray-600 text-lg">Tayyorgarlik...</p>
            </div>

            <!-- Instructions -->
            <div id="instructionArea" class="text-center mb-6">
                <h3 class="text-2xl font-bold text-gray-800 mb-2" id="gameTitle">Xotira Sinovi</h3>
                <p class="text-gray-600" id="gameInstructions">Ko'rsatilgan elementlarni eslab qoling</p>
            </div>

            <!-- Memory Display Area -->
            <div id="memoryArea" class="text-center">
                <!-- Content will be populated by JavaScript -->
            </div>

            <!-- Input Area -->
            <div id="inputArea" class="hidden text-center mt-6">
                <h4 class="text-lg font-semibold text-gray-800 mb-4">Javobingizni kiriting:</h4>
                <div id="inputContent">
                    <!-- Input elements will be populated by JavaScript -->
                </div>
                <button id="submitBtn" class="level-btn px-8 py-3 text-white font-semibold mt-4" onclick="submitAnswer()">
                    Javobni Yuborish
                </button>
            </div>
        </div>

        <!-- Current Score -->
        <div class="text-center">
            <div class="inline-block bg-white bg-opacity-20 backdrop-blur-lg rounded-full px-6 py-3">
                <span class="text-white text-lg">Joriy ball: </span>
                <span class="text-white text-xl font-bold" id="currentScore">0</span>
            </div>
        </div>
    </div>

    <!-- Results Screen -->
    <div id="resultsScreen" class="hidden max-w-2xl mx-auto text-center">
        <div class="memory-card p-8">
            <div class="text-6xl mb-6" id="resultEmoji">🧠</div>
            <h2 class="text-3xl font-bold text-gray-800 mb-4" id="resultTitle">Ajoyib Xotira!</h2>
            <p class="text-gray-600 mb-6" id="resultMessage">Sizning xotirangiz juda yaxshi!</p>

            <!-- Score Details -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                <div class="bg-green-50 p-4 rounded-lg">
                    <div class="text-2xl font-bold text-green-600" id="finalScore">200</div>
                    <div class="text-sm text-gray-600">Jami Ball</div>
                </div>
                <div class="bg-blue-50 p-4 rounded-lg">
                    <div class="text-2xl font-bold text-blue-600" id="correctAnswers">8</div>
                    <div class="text-sm text-gray-600">To'g'ri Javob</div>
                </div>
                <div class="bg-purple-50 p-4 rounded-lg">
                    <div class="text-2xl font-bold text-purple-600" id="accuracy">80%</div>
                    <div class="text-sm text-gray-600">Aniqlik</div>
                </div>
            </div>

            <!-- Achievement Badge -->
            <div class="mb-8" id="achievementBadge">
                <!-- Badge will be populated by JavaScript -->
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <button onclick="playAgain()" class="level-btn px-8 py-3 text-white font-semibold">
                    <i class="fas fa-redo mr-2"></i>Qayta O'ynash
                </button>
                <button onclick="selectNewTest()" class="bg-gray-500 hover:bg-gray-600 px-8 py-3 text-white font-semibold rounded-lg transition-colors">
                    <i class="fas fa-list mr-2"></i>Boshqa Test
                </button>
                <button onclick="goHome()" class="bg-blue-500 hover:bg-blue-600 px-8 py-3 text-white font-semibold rounded-lg transition-colors">
                    <i class="fas fa-home mr-2"></i>Bosh Sahifa
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Floating Score Animation -->
<div id="floatingScore" class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-4xl font-bold text-green-500 pointer-events-none hidden">
    +20
</div>

<script>
    // Game State
    let currentTestType = '';
    let currentRound = 0;
    let totalRounds = 0;
    let score = 0;
    let correctAnswersCount = 0;
    let timeLeft = 0;
    let timerInterval = null;
    let currentSequence = [];
    let userAnswer = [];
    let gamePhase = 'preparation'; // preparation, memorize, recall
    let memoryTime = 0;
    let recallTime = 0;

    // Test Configurations
    const testConfig = {
        visual: {
            name: 'Ko\'rish Xotirasi',
            rounds: 10,
            pointsPerRound: 20,
            memoryTime: 3000, // 3 seconds
            recallTime: 30000, // 30 seconds
            colors: ['bg-red-400', 'bg-blue-400', 'bg-green-400', 'bg-yellow-400', 'bg-purple-400', 'bg-pink-400'],
            shapes: ['●', '■', '▲', '★', '♦', '♠']
        },
        sequence: {
            name: 'Ketma-ketlik Xotirasi',
            rounds: 15,
            pointsPerRound: 15,
            memoryTime: 2000, // 2 seconds
            recallTime: 20000, // 20 seconds
        },
        word: {
            name: 'So\'z Xotirasi',
            rounds: 12,
            pointsPerRound: 25,
            memoryTime: 4000, // 4 seconds
            recallTime: 30000, // 30 seconds
            words: ['OTA', 'ONA', 'UY', 'KUN', 'OY', 'YUZ', 'KOZ', 'QOL', 'OG\'IZ', 'BOSH', 'OYOQ', 'QULOQ', 'BURUN', 'TISH', 'TIL', 'SOCH', 'QOSH', 'KIRPIK', 'BO\'YIN', 'YELKA', 'QO\'L', 'BARMOQ', 'TIZ', 'TOVON']
        },
        pattern: {
            name: 'Naqsh Xotirasi',
            rounds: 8,
            pointsPerRound: 30,
            memoryTime: 5000, // 5 seconds
            recallTime: 45000, // 45 seconds
            colors: ['bg-red-400', 'bg-blue-400', 'bg-green-400', 'bg-yellow-400', 'bg-purple-400'],
            shapes: ['●', '■', '▲', '★', '♦']
        }
    };

    // Initialize
    document.addEventListener('DOMContentLoaded', function() {
        showLevelSelection();
    });

    // Test Selection
    function selectTest(testType) {
        console.log('Test selected:', testType);
        try {
            currentTestType = testType;
            const config = testConfig[testType];
            totalRounds = config.rounds;
            currentRound = 0;
            score = 0;
            correctAnswersCount = 0;

            showGameScreen();
            startNextRound();
        } catch (error) {
            console.error('Error in selectTest:', error);
            alert('Xatolik yuz berdi: ' + error.message);
        }
    }

    // Start Next Round
    function startNextRound() {
        currentRound++;

        if (currentRound > totalRounds) {
            endGame();
            return;
        }

        updateUI();
        generateSequence();
        startCountdown();
    }

    // Update UI
    function updateUI() {
        document.getElementById('roundNumber').textContent = currentRound;
        document.getElementById('roundProgress').textContent = `${currentRound} / ${totalRounds}`;
        document.getElementById('currentRound').textContent = currentRound;

        const progress = (currentRound / totalRounds) * 100;
        document.getElementById('progressBar').style.width = progress + '%';

        const config = testConfig[currentTestType];
        document.getElementById('gameTitle').textContent = config.name;
    }

    // Generate Sequence
    function generateSequence() {
        const config = testConfig[currentTestType];
        currentSequence = [];

        // Difficulty increases with rounds
        const difficulty = Math.min(Math.floor((currentRound - 1) / 2) + 2, 8);

        switch (currentTestType) {
            case 'visual':
                generateVisualSequence(difficulty);
                break;
            case 'sequence':
                generateNumberSequence(difficulty);
                break;
            case 'word':
                generateWordSequence(difficulty);
                break;
            case 'pattern':
                generatePatternSequence(difficulty);
                break;
        }
    }

    // Generate Visual Sequence
    function generateVisualSequence(difficulty) {
        const config = testConfig.visual;
        const gridSize = Math.min(difficulty + 1, 5);

        for (let i = 0; i < difficulty; i++) {
            const color = config.colors[Math.floor(Math.random() * config.colors.length)];
            const shape = config.shapes[Math.floor(Math.random() * config.shapes.length)];
            const position = Math.floor(Math.random() * (gridSize * gridSize));

            currentSequence.push({
                color: color,
                shape: shape,
                position: position
            });
        }
    }

    // Generate Number Sequence
    function generateNumberSequence(difficulty) {
        for (let i = 0; i < difficulty; i++) {
            currentSequence.push(Math.floor(Math.random() * 10));
        }
    }

    // Generate Word Sequence
    function generateWordSequence(difficulty) {
        const config = testConfig.word;
        const usedWords = [];

        for (let i = 0; i < Math.min(difficulty, 6); i++) {
            let word;
            do {
                word = config.words[Math.floor(Math.random() * config.words.length)];
            } while (usedWords.includes(word));

            usedWords.push(word);
            currentSequence.push(word);
        }
    }

    // Generate Pattern Sequence
    function generatePatternSequence(difficulty) {
        const config = testConfig.pattern;
        const gridSize = 3;
        const patternCount = Math.min(difficulty + 2, 9);

        for (let i = 0; i < patternCount; i++) {
            const color = config.colors[Math.floor(Math.random() * config.colors.length)];
            const shape = config.shapes[Math.floor(Math.random() * config.shapes.length)];
            const position = Math.floor(Math.random() * (gridSize * gridSize));

            currentSequence.push({
                color: color,
                shape: shape,
                position: position
            });
        }
    }

    // Start Countdown
    function startCountdown() {
        gamePhase = 'preparation';
        document.getElementById('phaseIndicator').textContent = 'Tayyorgarlik';
        document.getElementById('countdownArea').classList.remove('hidden');
        document.getElementById('memoryArea').innerHTML = '';
        document.getElementById('inputArea').classList.add('hidden');

        let countdown = 3;
        document.getElementById('countdownNumber').textContent = countdown;

        const countdownInterval = setInterval(() => {
            countdown--;
            if (countdown > 0) {
                document.getElementById('countdownNumber').textContent = countdown;
            } else {
                clearInterval(countdownInterval);
                document.getElementById('countdownArea').classList.add('hidden');
                startMemorizePhase();
            }
        }, 1000);
    }

    // Start Memorize Phase
    function startMemorizePhase() {
        gamePhase = 'memorize';
        document.getElementById('phaseIndicator').textContent = 'Eslab Qoling';
        document.getElementById('gameInstructions').textContent = 'Diqqat bilan kuzating va eslab qoling!';

        displaySequence();

        const config = testConfig[currentTestType];
        setTimeout(() => {
            startRecallPhase();
        }, config.memoryTime);
    }

    // Display Sequence
    function displaySequence() {
        const memoryArea = document.getElementById('memoryArea');
        memoryArea.innerHTML = '';

        switch (currentTestType) {
            case 'visual':
                displayVisualSequence();
                break;
            case 'sequence':
                displayNumberSequence();
                break;
            case 'word':
                displayWordSequence();
                break;
            case 'pattern':
                displayPatternSequence();
                break;
        }
    }

    // Display Visual Sequence
    function displayVisualSequence() {
        const memoryArea = document.getElementById('memoryArea');
        const gridSize = Math.min(Math.floor((currentRound - 1) / 2) + 3, 5);

        const grid = document.createElement('div');
        grid.className = `memory-grid grid-${gridSize}x${gridSize}`;

        for (let i = 0; i < gridSize * gridSize; i++) {
            const cell = document.createElement('div');
            cell.className = 'memory-item bg-gray-200';

            const item = currentSequence.find(seq => seq.position === i);
            if (item) {
                cell.className = `memory-item ${item.color} revealed`;
                cell.textContent = item.shape;
            }

            grid.appendChild(cell);
        }

        memoryArea.appendChild(grid);
    }

    // Display Number Sequence
    function displayNumberSequence() {
        const memoryArea = document.getElementById('memoryArea');
        const container = document.createElement('div');
        container.className = 'sequence-display';

        currentSequence.forEach(number => {
            const item = document.createElement('div');
            item.className = 'memory-item bg-blue-400 revealed';
            item.textContent = number;
            container.appendChild(item);
        });

        memoryArea.appendChild(container);
    }

    // Display Word Sequence
    function displayWordSequence() {
        const memoryArea = document.getElementById('memoryArea');
        const container = document.createElement('div');
        container.className = 'sequence-display';

        currentSequence.forEach(word => {
            const item = document.createElement('div');
            item.className = 'memory-item bg-purple-400 revealed text-sm';
            item.textContent = word;
            container.appendChild(item);
        });

        memoryArea.appendChild(container);
    }

    // Display Pattern Sequence
    function displayPatternSequence() {
        const memoryArea = document.getElementById('memoryArea');
        const grid = document.createElement('div');
        grid.className = 'memory-grid grid-3x3';

        for (let i = 0; i < 9; i++) {
            const cell = document.createElement('div');
            cell.className = 'memory-item bg-gray-200';

            const item = currentSequence.find(seq => seq.position === i);
            if (item) {
                cell.className = `memory-item ${item.color} revealed`;
                cell.textContent = item.shape;
            }

            grid.appendChild(cell);
        }

        memoryArea.appendChild(grid);
    }

    // Start Recall Phase
    function startRecallPhase() {
        gamePhase = 'recall';
        document.getElementById('phaseIndicator').textContent = 'Javob Bering';
        document.getElementById('gameInstructions').textContent = 'Endi eslab qolgan narsalarni kiriting!';

        // Hide the sequence
        document.getElementById('memoryArea').innerHTML = '';

        // Show input area
        createInputArea();
        document.getElementById('inputArea').classList.remove('hidden');

        // Start timer
        const config = testConfig[currentTestType];
        timeLeft = Math.floor(config.recallTime / 1000);
        startTimer();
    }

    // Create Input Area
    function createInputArea() {
        const inputContent = document.getElementById('inputContent');
        inputContent.innerHTML = '';
        userAnswer = [];

        switch (currentTestType) {
            case 'visual':
                createVisualInput();
                break;
            case 'sequence':
                createSequenceInput();
                break;
            case 'word':
                createWordInput();
                break;
            case 'pattern':
                createPatternInput();
                break;
        }
    }

    // Create Visual Input
    function createVisualInput() {
        const inputContent = document.getElementById('inputContent');
        const gridSize = Math.min(Math.floor((currentRound - 1) / 2) + 3, 5);

        const grid = document.createElement('div');
        grid.className = `memory-grid grid-${gridSize}x${gridSize}`;

        for (let i = 0; i < gridSize * gridSize; i++) {
            const cell = document.createElement('div');
            cell.className = 'memory-item bg-gray-200 cursor-pointer';
            cell.onclick = () => toggleVisualCell(cell, i);
            grid.appendChild(cell);
        }

        inputContent.appendChild(grid);

        // Add color and shape selectors
        const controls = document.createElement('div');
        controls.className = 'mt-6';
        controls.innerHTML = `
                <div class="mb-4">
                    <h5 class="font-semibold mb-2">Rang tanlang:</h5>
                    <div class="flex gap-2 justify-center flex-wrap">
                        ${testConfig.visual.colors.map(color =>
            `<div class="memory-item ${color} cursor-pointer" onclick="selectColor('${color}')"></div>`
        ).join('')}
                    </div>
                </div>
                <div>
                    <h5 class="font-semibold mb-2">Shakl tanlang:</h5>
                    <div class="flex gap-2 justify-center flex-wrap">
                        ${testConfig.visual.shapes.map(shape =>
            `<div class="memory-item bg-gray-300 cursor-pointer" onclick="selectShape('${shape}')">${shape}</div>`
        ).join('')}
                    </div>
                </div>
            `;
        inputContent.appendChild(controls);
    }

    // Create Sequence Input
    function createSequenceInput() {
        const inputContent = document.getElementById('inputContent');
        const input = document.createElement('input');
        input.type = 'text';
        input.placeholder = 'Raqamlarni ketma-ket kiriting (masalan: 1234)';
        input.className = 'w-full max-w-md p-3 border-2 border-gray-300 rounded-lg text-center text-xl';
        input.id = 'sequenceInput';
        inputContent.appendChild(input);
    }

    // Create Word Input
    function createWordInput() {
        const inputContent = document.getElementById('inputContent');
        const input = document.createElement('input');
        input.type = 'text';
        input.placeholder = 'So\'zlarni vergul bilan ajrating (masalan: OTA, UY, KUN)';
        input.className = 'w-full max-w-md p-3 border-2 border-gray-300 rounded-lg text-center';
        input.id = 'wordInput';
        inputContent.appendChild(input);
    }

    // Create Pattern Input
    function createPatternInput() {
        const inputContent = document.getElementById('inputContent');
        const grid = document.createElement('div');
        grid.className = 'memory-grid grid-3x3';

        for (let i = 0; i < 9; i++) {
            const cell = document.createElement('div');
            cell.className = 'memory-item bg-gray-200 cursor-pointer';
            cell.onclick = () => togglePatternCell(cell, i);
            grid.appendChild(cell);
        }

        inputContent.appendChild(grid);

        // Add controls
        const controls = document.createElement('div');
        controls.className = 'mt-6';
        controls.innerHTML = `
                <div class="mb-4">
                    <h5 class="font-semibold mb-2">Rang tanlang:</h5>
                    <div class="flex gap-2 justify-center flex-wrap">
                        ${testConfig.pattern.colors.map(color =>
            `<div class="memory-item ${color} cursor-pointer" onclick="selectColor('${color}')"></div>`
        ).join('')}
                    </div>
                </div>
                <div>
                    <h5 class="font-semibold mb-2">Shakl tanlang:</h5>
                    <div class="flex gap-2 justify-center flex-wrap">
                        ${testConfig.pattern.shapes.map(shape =>
            `<div class="memory-item bg-gray-300 cursor-pointer" onclick="selectShape('${shape}')">${shape}</div>`
        ).join('')}
                    </div>
                </div>
            `;
        inputContent.appendChild(controls);
    }

    // Input Handlers
    let selectedColor = '';
    let selectedShape = '';

    function selectColor(color) {
        selectedColor = color;
        // Update visual feedback
        document.querySelectorAll('.memory-item').forEach(item => {
            item.classList.remove('selected');
        });
        event.target.classList.add('selected');
    }

    function selectShape(shape) {
        selectedShape = shape;
        // Update visual feedback
        document.querySelectorAll('.memory-item').forEach(item => {
            item.classList.remove('selected');
        });
        event.target.classList.add('selected');
    }

    function toggleVisualCell(cell, position) {
        if (selectedColor && selectedShape) {
            cell.className = `memory-item ${selectedColor}`;
            cell.textContent = selectedShape;

            // Update user answer
            const existingIndex = userAnswer.findIndex(item => item.position === position);
            if (existingIndex >= 0) {
                userAnswer[existingIndex] = { color: selectedColor, shape: selectedShape, position: position };
            } else {
                userAnswer.push({ color: selectedColor, shape: selectedShape, position: position });
            }
        }
    }

    function togglePatternCell(cell, position) {
        if (selectedColor && selectedShape) {
            cell.className = `memory-item ${selectedColor}`;
            cell.textContent = selectedShape;

            // Update user answer
            const existingIndex = userAnswer.findIndex(item => item.position === position);
            if (existingIndex >= 0) {
                userAnswer[existingIndex] = { color: selectedColor, shape: selectedShape, position: position };
            } else {
                userAnswer.push({ color: selectedColor, shape: selectedShape, position: position });
            }
        }
    }

    // Submit Answer
    function submitAnswer() {
        if (timerInterval) {
            clearInterval(timerInterval);
        }

        let isCorrect = false;

        switch (currentTestType) {
            case 'visual':
            case 'pattern':
                isCorrect = checkVisualAnswer();
                break;
            case 'sequence':
                isCorrect = checkSequenceAnswer();
                break;
            case 'word':
                isCorrect = checkWordAnswer();
                break;
        }

        const config = testConfig[currentTestType];

        if (isCorrect) {
            score += config.pointsPerRound;
            correctAnswersCount++;
            showFloatingScore('+' + config.pointsPerRound);
        }

        // Update score display
        document.getElementById('currentScore').textContent = score;
        document.getElementById('totalScore').textContent = score;

        // Show feedback and continue
        setTimeout(() => {
            startNextRound();
        }, 1500);
    }

    // Check Answers
    function checkVisualAnswer() {
        if (userAnswer.length !== currentSequence.length) return false;

        return currentSequence.every(correct => {
            return userAnswer.some(user =>
                user.position === correct.position &&
                user.color === correct.color &&
                user.shape === correct.shape
            );
        });
    }

    function checkSequenceAnswer() {
        const input = document.getElementById('sequenceInput').value;
        const userSequence = input.split('').map(char => parseInt(char)).filter(num => !isNaN(num));

        if (userSequence.length !== currentSequence.length) return false;

        return userSequence.every((num, index) => num === currentSequence[index]);
    }

    function checkWordAnswer() {
        const input = document.getElementById('wordInput').value.toUpperCase();
        const userWords = input.split(',').map(word => word.trim()).filter(word => word.length > 0);

        if (userWords.length !== currentSequence.length) return false;

        return currentSequence.every(word => userWords.includes(word));
    }

    // Timer Functions
    function startTimer() {
        timerInterval = setInterval(() => {
            timeLeft--;
            updateTimerDisplay();

            if (timeLeft <= 0) {
                submitAnswer();
            }
        }, 1000);
    }

    function updateTimerDisplay() {
        document.getElementById('timeLeft').textContent = timeLeft;

        // Update timer circle
        const config = testConfig[currentTestType];
        const totalTime = Math.floor(config.recallTime / 1000);
        const progress = (totalTime - timeLeft) / totalTime;
        const circumference = 2 * Math.PI * 28;
        const offset = circumference * progress;
        document.getElementById('timerCircle').style.strokeDashoffset = circumference - offset;
    }

    // End Game
    function endGame() {
        if (timerInterval) {
            clearInterval(timerInterval);
        }
        showResultsScreen();
    }

    // Show Results
    function showResultsScreen() {
        document.getElementById('gameScreen').classList.add('hidden');
        document.getElementById('resultsScreen').classList.remove('hidden');

        const accuracy = Math.round((correctAnswersCount / totalRounds) * 100);

        // Update results
        document.getElementById('finalScore').textContent = score;
        document.getElementById('correctAnswers').textContent = correctAnswersCount;
        document.getElementById('accuracy').textContent = accuracy + '%';

        // Determine result message and emoji
        let emoji, title, message, badgeHtml = '';

        if (accuracy >= 90) {
            emoji = '🧠';
            title = 'Xotira Ustasi!';
            message = 'Sizning xotirangiz ajoyib! Mukammal natija!';
            badgeHtml = '<div class="inline-block bg-green-100 text-green-800 px-4 py-2 rounded-full font-semibold"><i class="fas fa-brain mr-2"></i>Xotira Chempioni</div>';
        } else if (accuracy >= 70) {
            emoji = '🎯';
            title = 'Ajoyib!';
            message = 'Xotirangiz juda yaxshi! Davom eting!';
            badgeHtml = '<div class="inline-block bg-blue-100 text-blue-800 px-4 py-2 rounded-full font-semibold"><i class="fas fa-medal mr-2"></i>Xotira Yulduzi</div>';
        } else if (accuracy >= 50) {
            emoji = '👍';
            title = 'Yaxshi!';
            message = 'Yaxshi harakat! Xotirani rivojlantirishda davom eting!';
            badgeHtml = '<div class="inline-block bg-yellow-100 text-yellow-800 px-4 py-2 rounded-full font-semibold"><i class="fas fa-thumbs-up mr-2"></i>Yaxshi Harakat</div>';
        } else {
            emoji = '💪';
            title = 'Mashq Kerak!';
            message = 'Xafa bo\'lmang! Mashq qilsangiz, xotirangiz yaxshiroq bo\'ladi!';
            badgeHtml = '<div class="inline-block bg-purple-100 text-purple-800 px-4 py-2 rounded-full font-semibold"><i class="fas fa-dumbbell mr-2"></i>Mashq Qiluvchi</div>';
        }

        document.getElementById('resultEmoji').textContent = emoji;
        document.getElementById('resultTitle').textContent = title;
        document.getElementById('resultMessage').textContent = message;
        document.getElementById('achievementBadge').innerHTML = badgeHtml;
    }

    // Screen Navigation
    function showLevelSelection() {
        document.getElementById('levelSelection').classList.remove('hidden');
        document.getElementById('gameScreen').classList.add('hidden');
        document.getElementById('resultsScreen').classList.add('hidden');
        resetGame();
    }

    function showGameScreen() {
        document.getElementById('levelSelection').classList.add('hidden');
        document.getElementById('gameScreen').classList.remove('hidden');
        document.getElementById('resultsScreen').classList.add('hidden');
    }

    // Game Actions
    function playAgain() {
        resetGame();
        selectTest(currentTestType);
    }

    function selectNewTest() {
        showLevelSelection();
    }

    function resetGame() {
        currentRound = 0;
        score = 0;
        correctAnswersCount = 0;
        if (timerInterval) {
            clearInterval(timerInterval);
        }
        document.getElementById('currentScore').textContent = '0';
        document.getElementById('totalScore').textContent = '0';
        document.getElementById('currentRound').textContent = '1';
    }

    function goBack() {
        if (confirm('O\'yinni tark etishni xohlaysizmi?')) {
            window.history.back();
        }
    }

    function goHome() {
        window.location.href = 'index.html';
    }

    // Utility Functions
    function showFloatingScore(scoreText) {
        const floatingScore = document.getElementById('floatingScore');
        floatingScore.textContent = scoreText;
        floatingScore.classList.remove('hidden');
        floatingScore.classList.add('floating-score');

        setTimeout(() => {
            floatingScore.classList.add('hidden');
            floatingScore.classList.remove('floating-score');
        }, 1000);
    }

    // Keyboard Support
    document.addEventListener('keydown', function(e) {
        if (gamePhase === 'recall' && e.key === 'Enter') {
            submitAnswer();
        }
    });
</script>
</body>
</html>
