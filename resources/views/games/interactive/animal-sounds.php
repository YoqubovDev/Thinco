<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hayvonlar Ovozi - Thinko.uz</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Fredoka+One:wght@400&family=Inter:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
            min-height: 100vh;
        }

        .game-title {
            font-family: 'Fredoka One', cursive;
            color: #2d3748;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
        }

        .animal-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 25px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            border: 4px solid transparent;
        }

        .animal-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        }

        .animal-card.selected {
            border-color: #f59e0b;
            transform: translateY(-8px) scale(1.05);
            box-shadow: 0 20px 50px rgba(245, 158, 11, 0.3);
        }

        .animal-card.correct {
            border-color: #10b981;
            background: linear-gradient(135deg, #d1fae5, #a7f3d0);
            animation: correctBounce 0.8s ease;
        }

        .animal-card.incorrect {
            border-color: #ef4444;
            background: linear-gradient(135deg, #fee2e2, #fecaca);
            animation: incorrectShake 0.6s ease;
        }

        @keyframes correctBounce {
            0%, 100% { transform: translateY(-8px) scale(1.05); }
            50% { transform: translateY(-15px) scale(1.1); }
        }

        @keyframes incorrectShake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-10px); }
            75% { transform: translateX(10px); }
        }

        .play-button {
            background: linear-gradient(135deg, #667eea, #764ba2);
            width: 120px;
            height: 120px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 3rem;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
        }

        .play-button:hover {
            transform: scale(1.1);
            box-shadow: 0 12px 35px rgba(102, 126, 234, 0.6);
        }

        .play-button:active {
            transform: scale(0.95);
        }

        .play-button.playing {
            animation: pulse 1.5s infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        .animal-emoji {
            font-size: 4rem;
            margin-bottom: 1rem;
            display: block;
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }

        .score-star {
            color: #fbbf24;
            font-size: 2rem;
            margin: 0 5px;
            animation: starTwinkle 2s infinite;
        }

        @keyframes starTwinkle {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.7; transform: scale(1.1); }
        }

        .level-badge {
            background: linear-gradient(135deg, #f59e0b, #d97706);
            color: white;
            padding: 8px 20px;
            border-radius: 25px;
            font-weight: bold;
            font-size: 1.1rem;
            box-shadow: 0 4px 15px rgba(245, 158, 11, 0.3);
        }

        .progress-ring {
            transform: rotate(-90deg);
        }

        .progress-ring-circle {
            stroke-dasharray: 251.2;
            stroke-dashoffset: 251.2;
            transition: stroke-dashoffset 0.5s ease;
        }

        .celebration {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 6rem;
            z-index: 1000;
            pointer-events: none;
            animation: celebrate 1s ease-out;
        }

        @keyframes celebrate {
            0% { transform: translate(-50%, -50%) scale(0); opacity: 0; }
            50% { transform: translate(-50%, -50%) scale(1.2); opacity: 1; }
            100% { transform: translate(-50%, -50%) scale(1); opacity: 0; }
        }

        .kid-button {
            background: linear-gradient(135deg, #ff6b6b, #feca57);
            color: white;
            border: none;
            border-radius: 20px;
            padding: 15px 30px;
            font-size: 1.2rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 6px 20px rgba(255, 107, 107, 0.3);
        }

        .kid-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(255, 107, 107, 0.4);
        }

        .volume-control {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            padding: 10px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .difficulty-selector {
            display: flex;
            gap: 10px;
            margin: 20px 0;
        }

        .difficulty-btn {
            padding: 10px 20px;
            border-radius: 15px;
            border: 3px solid transparent;
            background: rgba(255, 255, 255, 0.8);
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: bold;
        }

        .difficulty-btn.active {
            border-color: #f59e0b;
            background: #fef3c7;
            transform: scale(1.05);
        }

        .hint-bubble {
            background: #fef3c7;
            border: 3px solid #f59e0b;
            border-radius: 20px;
            padding: 15px;
            margin: 15px 0;
            position: relative;
            animation: bounce 2s infinite;
        }

        .hint-bubble::before {
            content: '';
            position: absolute;
            bottom: -15px;
            left: 30px;
            width: 0;
            height: 0;
            border-left: 15px solid transparent;
            border-right: 15px solid transparent;
            border-top: 15px solid #f59e0b;
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-5px); }
        }
    </style>
</head>
<body>
<!-- Header -->
<header class="bg-white bg-opacity-20 backdrop-blur-lg shadow-lg">
    <div class="container mx-auto px-4 py-4">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <button onclick="goBack()" class="text-white hover:text-gray-200 mr-4 text-2xl">
                    <i class="fas fa-arrow-left"></i>
                </button>
                <h1 class="game-title text-3xl">🐾 Hayvonlar Ovozi</h1>
            </div>
            <div class="flex items-center space-x-4">
                <!-- Volume Control -->
                <div class="volume-control">
                    <i class="fas fa-volume-up text-gray-600"></i>
                    <input type="range" id="volumeSlider" min="0" max="100" value="70"
                           class="w-20 h-2 bg-gray-300 rounded-lg appearance-none cursor-pointer">
                </div>
                <!-- Score -->
                <div class="text-white text-center">
                    <div class="flex items-center">
                        <span class="score-star">⭐</span>
                        <span class="text-2xl font-bold" id="scoreDisplay">0</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Main Content -->
<div class="container mx-auto px-4 py-8">

    <!-- Welcome Screen -->
    <div id="welcomeScreen" class="max-w-4xl mx-auto text-center">
        <div class="animal-card p-8 mb-8">
            <div class="text-8xl mb-6">🎵🐾</div>
            <h2 class="game-title text-4xl mb-4">Hayvonlar Ovozini Toping!</h2>
            <p class="text-xl text-gray-600 mb-6">
                Hayvonlarning ovozini eshiting va qaysi hayvon ekanligini toping!
            </p>
            <div class="text-lg text-gray-500 mb-8">
                <div class="flex items-center justify-center gap-4 mb-4">
                        <span class="bg-green-100 text-green-800 px-4 py-2 rounded-full font-semibold">
                            👶 3-6 yosh
                        </span>
                    <span class="bg-blue-100 text-blue-800 px-4 py-2 rounded-full font-semibold">
                            🎯 10 ta hayvon
                        </span>
                    <span class="bg-purple-100 text-purple-800 px-4 py-2 rounded-full font-semibold">
                            ⭐ Yulduzcha yig'ing
                        </span>
                </div>
            </div>

            <!-- Difficulty Selection -->
            <div class="difficulty-selector justify-center">
                <div class="difficulty-btn active" data-level="easy">
                    <div class="text-2xl mb-2">😊</div>
                    <div class="font-bold">Oson</div>
                    <div class="text-sm">4 ta hayvon</div>
                </div>
                <div class="difficulty-btn" data-level="medium">
                    <div class="text-2xl mb-2">🤔</div>
                    <div class="font-bold">O'rta</div>
                    <div class="text-sm">6 ta hayvon</div>
                </div>
                <div class="difficulty-btn" data-level="hard">
                    <div class="text-2xl mb-2">🧠</div>
                    <div class="font-bold">Qiyin</div>
                    <div class="text-sm">8 ta hayvon</div>
                </div>
            </div>

            <button onclick="startGame()" class="kid-button text-2xl mt-8">
                🎮 O'yinni Boshlash
            </button>
        </div>
    </div>

    <!-- Game Screen -->
    <div id="gameScreen" class="hidden max-w-6xl mx-auto">
        <!-- Progress and Level Info -->
        <div class="animal-card p-6 mb-8">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <div class="level-badge">
                        Savol <span id="questionNumber">1</span> / <span id="totalQuestions">10</span>
                    </div>
                    <div class="text-2xl" id="currentAnimalEmoji">🐱</div>
                </div>

                <!-- Progress Ring -->
                <div class="relative">
                    <svg class="progress-ring w-20 h-20">
                        <circle class="progress-ring-circle" stroke="#e5e7eb" stroke-width="4"
                                fill="transparent" r="40" cx="40" cy="40"/>
                        <circle class="progress-ring-circle" stroke="#f59e0b" stroke-width="4"
                                fill="transparent" r="40" cx="40" cy="40" id="progressCircle"/>
                    </svg>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <span class="text-lg font-bold text-gray-800" id="progressPercent">0%</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sound Player -->
        <div class="animal-card p-8 mb-8 text-center">
            <h3 class="game-title text-3xl mb-6">Bu qaysi hayvonning ovozi? 🎧</h3>

            <!-- Hint Bubble -->
            <div id="hintBubble" class="hint-bubble hidden">
                <div class="flex items-center justify-center gap-3">
                    <span class="text-2xl">💡</span>
                    <span class="font-bold text-lg" id="hintText">Bu hayvon sut beradi va "moo" deydi!</span>
                </div>
            </div>

            <!-- Play Button -->
            <div class="mb-8">
                <button id="playButton" class="play-button mx-auto" onclick="playCurrentSound()">
                    <i class="fas fa-play"></i>
                </button>
                <p class="text-gray-600 mt-4 text-lg">Ovozni eshitish uchun tugmani bosing</p>
            </div>

            <!-- Replay Button -->
            <button onclick="playCurrentSound()" class="kid-button mb-6">
                🔄 Qayta Eshitish
            </button>
        </div>

        <!-- Animal Options -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-8" id="animalOptions">
            <!-- Options will be populated by JavaScript -->
        </div>

        <!-- Help Button -->
        <div class="text-center">
            <button onclick="showHint()" class="kid-button" id="hintButton">
                💡 Yordam
            </button>
        </div>
    </div>

    <!-- Results Screen -->
    <div id="resultsScreen" class="hidden max-w-4xl mx-auto text-center">
        <div class="animal-card p-8">
            <div class="text-8xl mb-6" id="resultEmoji">🎉</div>
            <h2 class="game-title text-4xl mb-4" id="resultTitle">Ajoyib!</h2>
            <p class="text-xl text-gray-600 mb-8" id="resultMessage">
                Siz hayvonlar ovozini juda yaxshi bilasiz!
            </p>

            <!-- Score Display -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-yellow-50 p-6 rounded-2xl">
                    <div class="text-4xl mb-2">⭐</div>
                    <div class="text-3xl font-bold text-yellow-600" id="finalScore">8</div>
                    <div class="text-gray-600">Yulduzcha</div>
                </div>
                <div class="bg-green-50 p-6 rounded-2xl">
                    <div class="text-4xl mb-2">✅</div>
                    <div class="text-3xl font-bold text-green-600" id="correctAnswers">8</div>
                    <div class="text-gray-600">To'g'ri Javob</div>
                </div>
                <div class="bg-blue-50 p-6 rounded-2xl">
                    <div class="text-4xl mb-2">🎯</div>
                    <div class="text-3xl font-bold text-blue-600" id="accuracy">80%</div>
                    <div class="text-gray-600">Aniqlik</div>
                </div>
            </div>

            <!-- Achievement Badge -->
            <div class="mb-8" id="achievementBadge">
                <!-- Badge will be populated by JavaScript -->
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <button onclick="playAgain()" class="kid-button text-xl">
                    🔄 Qayta O'ynash
                </button>
                <button onclick="goHome()" class="kid-button text-xl bg-gradient-to-r from-blue-500 to-purple-600">
                    🏠 Bosh Sahifa
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Celebration Effect -->
<div id="celebration" class="celebration hidden">🎉</div>

<!-- Audio Elements -->
<audio id="gameAudio" preload="auto"></audio>
<audio id="correctSound" preload="auto">
    <source src="data:audio/wav;base64,UklGRnoGAABXQVZFZm10IBAAAAABAAEAQB8AAEAfAAABAAgAZGF0YQoGAACBhYqFbF1fdJivrJBhNjVgodDbq2EcBj+a2/LDciUFLIHO8tiJNwgZaLvt559NEAxQp+PwtmMcBjiR1/LMeSwFJHfH8N2QQAoUXrTp66hVFApGn+DyvmwhBSuBzvLZiTYIG2m98OScTgwOUarm7blmGgU7k9n1unEiBC13yO/eizEIHWq+8+OWT" type="audio/wav">
</audio>
<audio id="incorrectSound" preload="auto">
    <source src="data:audio/wav;base64,UklGRnoGAABXQVZFZm1" type="audio/wav">
</audio>

<script>
    // Game State
    let currentLevel = 'easy';
    let currentQuestionIndex = 0;
    let totalQuestions = 10;
    let score = 0;
    let correctAnswersCount = 0;
    let gameQuestions = [];
    let currentQuestion = null;
    let hintsUsed = 0;
    let gameAudio = null;

    // Animal Data
    const animalData = {
        easy: [
            { name: 'Mushuk', emoji: '🐱', sound: 'meow', uzbek: 'Mushuk', hint: 'Bu hayvon "miyov" deydi va sichqon ovlaydi!' },
            { name: 'It', emoji: '🐶', sound: 'woof', uzbek: 'It', hint: 'Bu hayvon "vov" deydi va uyni qo\'riqlaydi!' },
            { name: 'Sigir', emoji: '🐄', sound: 'moo', uzbek: 'Sigir', hint: 'Bu hayvon "moo" deydi va sut beradi!' },
            { name: 'Qo\'y', emoji: '🐑', sound: 'baa', uzbek: 'Qo\'y', hint: 'Bu hayvon "bee" deydi va jun beradi!' }
        ],
        medium: [
            { name: 'Mushuk', emoji: '🐱', sound: 'meow', uzbek: 'Mushuk', hint: 'Bu hayvon "miyov" deydi va sichqon ovlaydi!' },
            { name: 'It', emoji: '🐶', sound: 'woof', uzbek: 'It', hint: 'Bu hayvon "vov" deydi va uyni qo\'riqlaydi!' },
            { name: 'Sigir', emoji: '🐄', sound: 'moo', uzbek: 'Sigir', hint: 'Bu hayvon "moo" deydi va sut beradi!' },
            { name: 'Qo\'y', emoji: '🐑', sound: 'baa', uzbek: 'Qo\'y', hint: 'Bu hayvon "bee" deydi va jun beradi!' },
            { name: 'Ot', emoji: '🐴', sound: 'neigh', uzbek: 'Ot', hint: 'Bu hayvon "ihaha" deydi va tez yuguradi!' },
            { name: 'Cho\'chqa', emoji: '🐷', sound: 'oink', uzbek: 'Cho\'chqa', hint: 'Bu hayvon "xro-xro" deydi va loyda yotadi!' }
        ],
        hard: [
            { name: 'Mushuk', emoji: '🐱', sound: 'meow', uzbek: 'Mushuk', hint: 'Bu hayvon "miyov" deydi va sichqon ovlaydi!' },
            { name: 'It', emoji: '🐶', sound: 'woof', uzbek: 'It', hint: 'Bu hayvon "vov" deydi va uyni qo\'riqlaydi!' },
            { name: 'Sigir', emoji: '🐄', sound: 'moo', uzbek: 'Sigir', hint: 'Bu hayvon "moo" deydi va sut beradi!' },
            { name: 'Qo\'y', emoji: '🐑', sound: 'baa', uzbek: 'Qo\'y', hint: 'Bu hayvon "bee" deydi va jun beradi!' },
            { name: 'Ot', emoji: '🐴', sound: 'neigh', uzbek: 'Ot', hint: 'Bu hayvon "ihaha" deydi va tez yuguradi!' },
            { name: 'Cho\'chqa', emoji: '🐷', sound: 'oink', uzbek: 'Cho\'chqa', hint: 'Bu hayvon "xro-xro" deydi va loyda yotadi!' },
            { name: 'Tovuq', emoji: '🐔', sound: 'cluck', uzbek: 'Tovuq', hint: 'Bu hayvon "qo\'qo\'qo\'" deydi va tuxum qo\'yadi!' },
            { name: 'O\'rdak', emoji: '🦆', sound: 'quack', uzbek: 'O\'rdak', hint: 'Bu hayvon "vak-vak" deydi va suvda suzadi!' }
        ]
    };

    // Sound synthesis for animal sounds
    const animalSounds = {
        meow: () => createAnimalSound([800, 600, 400], [0.3, 0.4, 0.3], 0.8),
        woof: () => createAnimalSound([200, 300, 150], [0.2, 0.3, 0.5], 0.6),
        moo: () => createAnimalSound([150, 200, 100], [0.5, 0.8, 0.7], 1.2),
        baa: () => createAnimalSound([400, 300, 500], [0.3, 0.4, 0.3], 0.7),
        neigh: () => createAnimalSound([600, 400, 800, 300], [0.2, 0.3, 0.2, 0.3], 1.0),
        oink: () => createAnimalSound([300, 200, 400], [0.2, 0.3, 0.2], 0.5),
        cluck: () => createAnimalSound([800, 400, 600], [0.1, 0.2, 0.1], 0.4),
        quack: () => createAnimalSound([500, 300, 400], [0.2, 0.3, 0.2], 0.6)
    };

    // Initialize
    document.addEventListener('DOMContentLoaded', function() {
        setupEventListeners();
        showWelcomeScreen();
    });

    function setupEventListeners() {
        // Difficulty selection
        document.querySelectorAll('.difficulty-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                document.querySelectorAll('.difficulty-btn').forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                currentLevel = this.dataset.level;
            });
        });

        // Volume control
        document.getElementById('volumeSlider').addEventListener('input', function() {
            const volume = this.value / 100;
            if (gameAudio) {
                gameAudio.volume = volume;
            }
        });
    }

    function createAnimalSound(frequencies, durations, totalDuration) {
        const audioContext = new (window.AudioContext || window.webkitAudioContext)();
        const sampleRate = audioContext.sampleRate;
        const length = sampleRate * totalDuration;
        const buffer = audioContext.createBuffer(1, length, sampleRate);
        const data = buffer.getChannelData(0);

        let currentTime = 0;
        for (let i = 0; i < frequencies.length; i++) {
            const freq = frequencies[i];
            const duration = durations[i];
            const samples = sampleRate * duration;

            for (let j = 0; j < samples && currentTime < length; j++, currentTime++) {
                const t = currentTime / sampleRate;
                const envelope = Math.exp(-t * 3); // Decay envelope
                data[currentTime] = Math.sin(2 * Math.PI * freq * t) * envelope * 0.3;
            }
        }

        return buffer;
    }

    function playAnimalSound(soundType) {
        try {
            const audioContext = new (window.AudioContext || window.webkitAudioContext)();
            const buffer = animalSounds[soundType]();
            const source = audioContext.createBufferSource();
            const gainNode = audioContext.createGain();

            source.buffer = buffer;
            const volume = document.getElementById('volumeSlider').value / 100;
            gainNode.gain.value = volume;

            source.connect(gainNode);
            gainNode.connect(audioContext.destination);
            source.start();

            // Update play button
            const playButton = document.getElementById('playButton');
            playButton.classList.add('playing');
            playButton.innerHTML = '<i class="fas fa-pause"></i>';

            setTimeout(() => {
                playButton.classList.remove('playing');
                playButton.innerHTML = '<i class="fas fa-play"></i>';
            }, buffer.duration * 1000);

        } catch (error) {
            console.log('Audio not supported, using text feedback');
            showTextFeedback(soundType);
        }
    }

    function showTextFeedback(soundType) {
        const soundTexts = {
            meow: 'Miyov-miyov! 🐱',
            woof: 'Vov-vov! 🐶',
            moo: 'Moo-moo! 🐄',
            baa: 'Bee-bee! 🐑',
            neigh: 'Ihaha! 🐴',
            oink: 'Xro-xro! 🐷',
            cluck: 'Qo\'qo\'qo\'! 🐔',
            quack: 'Vak-vak! 🦆'
        };

        const feedback = document.createElement('div');
        feedback.className = 'fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-white p-6 rounded-2xl shadow-2xl text-3xl font-bold z-50';
        feedback.textContent = soundTexts[soundType] || 'Ovoz!';
        document.body.appendChild(feedback);

        setTimeout(() => {
            document.body.removeChild(feedback);
        }, 2000);
    }

    function startGame() {
        const animals = animalData[currentLevel];
        totalQuestions = Math.min(10, animals.length * 2);

        // Generate questions
        gameQuestions = [];
        for (let i = 0; i < totalQuestions; i++) {
            const correctAnimal = animals[Math.floor(Math.random() * animals.length)];
            const wrongAnimals = animals.filter(a => a.name !== correctAnimal.name);
            const shuffledWrong = wrongAnimals.sort(() => Math.random() - 0.5);
            const options = [correctAnimal, ...shuffledWrong.slice(0, 3)].sort(() => Math.random() - 0.5);

            gameQuestions.push({
                correct: correctAnimal,
                options: options
            });
        }

        currentQuestionIndex = 0;
        score = 0;
        correctAnswersCount = 0;
        hintsUsed = 0;

        showGameScreen();
        loadNextQuestion();
    }

    function loadNextQuestion() {
        if (currentQuestionIndex >= gameQuestions.length) {
            endGame();
            return;
        }

        currentQuestion = gameQuestions[currentQuestionIndex];
        updateGameUI();
        displayAnimalOptions();
        hideHint();
    }

    function updateGameUI() {
        document.getElementById('questionNumber').textContent = currentQuestionIndex + 1;
        document.getElementById('totalQuestions').textContent = gameQuestions.length;
        document.getElementById('currentAnimalEmoji').textContent = currentQuestion.correct.emoji;

        // Update progress
        const progress = ((currentQuestionIndex + 1) / gameQuestions.length) * 100;
        document.getElementById('progressPercent').textContent = Math.round(progress) + '%';

        const circumference = 2 * Math.PI * 40;
        const offset = circumference - (progress / 100) * circumference;
        document.getElementById('progressCircle').style.strokeDashoffset = offset;

        // Update score
        document.getElementById('scoreDisplay').textContent = score;
    }

    function displayAnimalOptions() {
        const container = document.getElementById('animalOptions');
        container.innerHTML = '';

        currentQuestion.options.forEach(animal => {
            const card = document.createElement('div');
            card.className = 'animal-card p-6 text-center cursor-pointer transition-all duration-300';
            card.onclick = () => selectAnimal(animal, card);

            card.innerHTML = `
                    <div class="animal-emoji">${animal.emoji}</div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">${animal.uzbek}</h3>
                    <p class="text-gray-600">${animal.name}</p>
                `;

            container.appendChild(card);
        });
    }

    function selectAnimal(selectedAnimal, cardElement) {
        const isCorrect = selectedAnimal.name === currentQuestion.correct.name;

        // Disable all cards
        document.querySelectorAll('#animalOptions .animal-card').forEach(card => {
            card.style.pointerEvents = 'none';
        });

        if (isCorrect) {
            cardElement.classList.add('correct');
            score++;
            correctAnswersCount++;
            showCelebration('🎉');
            playCorrectSound();
        } else {
            cardElement.classList.add('incorrect');
            // Show correct answer
            document.querySelectorAll('#animalOptions .animal-card').forEach(card => {
                const emoji = card.querySelector('.animal-emoji').textContent;
                if (emoji === currentQuestion.correct.emoji) {
                    card.classList.add('correct');
                }
            });
            playIncorrectSound();
        }

        // Move to next question after delay
        setTimeout(() => {
            currentQuestionIndex++;
            loadNextQuestion();
        }, 2500);
    }

    function playCurrentSound() {
        if (currentQuestion) {
            playAnimalSound(currentQuestion.correct.sound);
        }
    }

    function showHint() {
        if (currentQuestion) {
            document.getElementById('hintText').textContent = currentQuestion.correct.hint;
            document.getElementById('hintBubble').classList.remove('hidden');
            document.getElementById('hintButton').style.display = 'none';
            hintsUsed++;
        }
    }

    function hideHint() {
        document.getElementById('hintBubble').classList.add('hidden');
        document.getElementById('hintButton').style.display = 'inline-block';
    }

    function showCelebration(emoji) {
        const celebration = document.getElementById('celebration');
        celebration.textContent = emoji;
        celebration.classList.remove('hidden');

        setTimeout(() => {
            celebration.classList.add('hidden');
        }, 1000);
    }

    function playCorrectSound() {
        try {
            const audioContext = new (window.AudioContext || window.webkitAudioContext)();
            const oscillator = audioContext.createOscillator();
            const gainNode = audioContext.createGain();

            oscillator.connect(gainNode);
            gainNode.connect(audioContext.destination);

            oscillator.frequency.setValueAtTime(523.25, audioContext.currentTime); // C5
            oscillator.frequency.setValueAtTime(659.25, audioContext.currentTime + 0.1); // E5
            oscillator.frequency.setValueAtTime(783.99, audioContext.currentTime + 0.2); // G5

            gainNode.gain.setValueAtTime(0.3, audioContext.currentTime);
            gainNode.gain.exponentialRampToValueAtTime(0.01, audioContext.currentTime + 0.5);

            oscillator.start(audioContext.currentTime);
            oscillator.stop(audioContext.currentTime + 0.5);
        } catch (error) {
            console.log('Audio not supported');
        }
    }

    function playIncorrectSound() {
        try {
            const audioContext = new (window.AudioContext || window.webkitAudioContext)();
            const oscillator = audioContext.createOscillator();
            const gainNode = audioContext.createGain();

            oscillator.connect(gainNode);
            gainNode.connect(audioContext.destination);

            oscillator.frequency.setValueAtTime(200, audioContext.currentTime);
            oscillator.frequency.setValueAtTime(150, audioContext.currentTime + 0.2);

            gainNode.gain.setValueAtTime(0.3, audioContext.currentTime);
            gainNode.gain.exponentialRampToValueAtTime(0.01, audioContext.currentTime + 0.4);

            oscillator.start(audioContext.currentTime);
            oscillator.stop(audioContext.currentTime + 0.4);
        } catch (error) {
            console.log('Audio not supported');
        }
    }

    function endGame() {
        showResultsScreen();
    }

    function showResultsScreen() {
        document.getElementById('gameScreen').classList.add('hidden');
        document.getElementById('resultsScreen').classList.remove('hidden');

        const accuracy = Math.round((correctAnswersCount / gameQuestions.length) * 100);

        // Update results
        document.getElementById('finalScore').textContent = score;
        document.getElementById('correctAnswers').textContent = correctAnswersCount;
        document.getElementById('accuracy').textContent = accuracy + '%';

        // Determine result message and emoji
        let emoji, title, message, badgeHtml = '';

        if (accuracy >= 90) {
            emoji = '🏆';
            title = 'Hayvonlar Ustasi!';
            message = 'Siz barcha hayvonlar ovozini juda yaxshi bilasiz!';
            badgeHtml = '<div class="inline-block bg-yellow-100 text-yellow-800 px-6 py-3 rounded-full font-bold text-xl"><i class="fas fa-crown mr-2"></i>Hayvonlar Chempioni</div>';
        } else if (accuracy >= 70) {
            emoji = '🌟';
            title = 'Ajoyib!';
            message = 'Hayvonlar ovozini yaxshi bilasiz! Davom eting!';
            badgeHtml = '<div class="inline-block bg-blue-100 text-blue-800 px-6 py-3 rounded-full font-bold text-xl"><i class="fas fa-star mr-2"></i>Hayvonlar Yulduzi</div>';
        } else if (accuracy >= 50) {
            emoji = '😊';
            title = 'Yaxshi!';
            message = 'Yaxshi harakat! Ko\'proq mashq qiling!';
            badgeHtml = '<div class="inline-block bg-green-100 text-green-800 px-6 py-3 rounded-full font-bold text-xl"><i class="fas fa-thumbs-up mr-2"></i>Yaxshi O\'quvchi</div>';
        } else {
            emoji = '🤗';
            title = 'Davom eting!';
            message = 'Hayvonlar haqida ko\'proq o\'rganing va qayta urinib ko\'ring!';
            badgeHtml = '<div class="inline-block bg-purple-100 text-purple-800 px-6 py-3 rounded-full font-bold text-xl"><i class="fas fa-heart mr-2"></i>Hayvonlar Do\'sti</div>';
        }

        document.getElementById('resultEmoji').textContent = emoji;
        document.getElementById('resultTitle').textContent = title;
        document.getElementById('resultMessage').textContent = message;
        document.getElementById('achievementBadge').innerHTML = badgeHtml;
    }

    // Screen Navigation
    function showWelcomeScreen() {
        document.getElementById('welcomeScreen').classList.remove('hidden');
        document.getElementById('gameScreen').classList.add('hidden');
        document.getElementById('resultsScreen').classList.add('hidden');
    }

    function showGameScreen() {
        document.getElementById('welcomeScreen').classList.add('hidden');
        document.getElementById('gameScreen').classList.remove('hidden');
        document.getElementById('resultsScreen').classList.add('hidden');
    }

    function playAgain() {
        showWelcomeScreen();
    }

    function goBack() {
        if (confirm('O\'yinni tark etishni xohlaysizmi?')) {
            window.history.back();
        }
    }

    function goHome() {
        window.location.href = 'index.html';
    }

    // Keyboard support for accessibility
    document.addEventListener('keydown', function(e) {
        if (document.getElementById('gameScreen').classList.contains('hidden')) return;

        if (e.key === ' ' || e.key === 'Enter') {
            e.preventDefault();
            playCurrentSound();
        } else if (e.key >= '1' && e.key <= '4') {
            const index = parseInt(e.key) - 1;
            const cards = document.querySelectorAll('#animalOptions .animal-card');
            if (cards[index] && cards[index].style.pointerEvents !== 'none') {
                cards[index].click();
            }
        } else if (e.key === 'h' || e.key === 'H') {
            if (document.getElementById('hintButton').style.display !== 'none') {
                showHint();
            }
        }
    });
</script>
</body>
</html>
