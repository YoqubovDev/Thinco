<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Naqsh Tanish - Thinko.uz</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }

        .pattern-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .pattern-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        }

        .level-btn {
            background: linear-gradient(135deg, #8b5cf6, #7c3aed);
            transition: all 0.3s ease;
            border-radius: 15px;
        }

        .level-btn:hover {
            background: linear-gradient(135deg, #7c3aed, #6d28d9);
            transform: translateY(-2px);
        }

        .level-btn.selected {
            background: linear-gradient(135deg, #667eea, #764ba2);
            transform: scale(1.05);
        }

        .pattern-item {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            font-weight: bold;
            transition: all 0.3s ease;
            cursor: pointer;
            border: 3px solid transparent;
        }

        .pattern-item:hover {
            transform: scale(1.1);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .pattern-item.selected {
            border-color: #667eea;
            transform: scale(1.15);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
        }

        .pattern-item.correct {
            border-color: #10b981;
            background: #d1fae5;
            animation: correctPulse 0.6s ease;
        }

        .pattern-item.incorrect {
            border-color: #ef4444;
            background: #fee2e2;
            animation: incorrectShake 0.6s ease;
        }

        .pattern-item.missing {
            border: 3px dashed #9ca3af;
            background: #f9fafb;
            animation: missingPulse 2s infinite;
        }

        @keyframes correctPulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.2); }
            100% { transform: scale(1); }
        }

        @keyframes incorrectShake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }

        @keyframes missingPulse {
            0%, 100% { opacity: 0.5; }
            50% { opacity: 1; }
        }

        .progress-bar {
            background: linear-gradient(90deg, #8b5cf6, #7c3aed);
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

        .pattern-sequence {
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

        .pattern-options {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(80px, 1fr));
            gap: 15px;
            max-width: 400px;
            margin: 0 auto;
        }

        .hint-btn {
            background: linear-gradient(135deg, #f59e0b, #d97706);
            color: white;
            border: none;
            border-radius: 10px;
            padding: 8px 16px;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .hint-btn:hover {
            background: linear-gradient(135deg, #d97706, #b45309);
            transform: translateY(-2px);
        }

        .hint-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
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
                <h1 class="text-2xl font-bold text-white">Naqsh Tanish</h1>
            </div>
            <div class="flex items-center space-x-4">
                <div class="text-white text-center">
                    <div class="text-sm opacity-80">Ball</div>
                    <div class="text-xl font-bold" id="totalScore">0</div>
                </div>
                <div class="text-white text-center">
                    <div class="text-sm opacity-80">Hint</div>
                    <div class="text-xl font-bold" id="hintsLeft">3</div>
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
            <h2 class="text-3xl font-bold text-white mb-4">Darajani Tanlang</h2>
            <p class="text-white opacity-80">Naqshlarni tanib, mantiqiy fikrlashni rivojlantiring!</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Beginner Level -->
            <div class="pattern-card p-6 text-center cursor-pointer" onclick="selectLevel('beginner')">
                <div class="text-6xl mb-4">🟢</div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Boshlang'ich</h3>
                <p class="text-gray-600 mb-4">Oddiy ranglar va shakllar naqshlari</p>
                <div class="text-sm text-gray-500 mb-4">
                    <div>• 10 ta naqsh</div>
                    <div>• Har bir to'g'ri javob: 15 ball</div>
                    <div>• Vaqt: 8 daqiqa</div>
                </div>
                <div class="pattern-sequence justify-center">
                    <div class="pattern-item bg-red-400"></div>
                    <div class="pattern-item bg-blue-400"></div>
                    <div class="pattern-item bg-red-400"></div>
                    <div class="pattern-item bg-blue-400"></div>
                    <div class="pattern-item missing">?</div>
                </div>
                <button class="level-btn w-full py-3 text-white font-semibold mt-4">
                    Boshlash
                </button>
            </div>

            <!-- Intermediate Level -->
            <div class="pattern-card p-6 text-center cursor-pointer" onclick="selectLevel('intermediate')">
                <div class="text-6xl mb-4">🟡</div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">O'rta</h3>
                <p class="text-gray-600 mb-4">Murakkab shakllar va raqamlar</p>
                <div class="text-sm text-gray-500 mb-4">
                    <div>• 15 ta naqsh</div>
                    <div>• Har bir to'g'ri javob: 20 ball</div>
                    <div>• Vaqt: 10 daqiqa</div>
                </div>
                <div class="pattern-sequence justify-center">
                    <div class="pattern-item bg-green-400">△</div>
                    <div class="pattern-item bg-yellow-400">□</div>
                    <div class="pattern-item bg-green-400">△</div>
                    <div class="pattern-item bg-yellow-400">□</div>
                    <div class="pattern-item missing">?</div>
                </div>
                <button class="level-btn w-full py-3 text-white font-semibold mt-4">
                    Boshlash
                </button>
            </div>

            <!-- Advanced Level -->
            <div class="pattern-card p-6 text-center cursor-pointer" onclick="selectLevel('advanced')">
                <div class="text-6xl mb-4">🔴</div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Murakkab</h3>
                <p class="text-gray-600 mb-4">Matematik va mantiqiy naqshlar</p>
                <div class="text-sm text-gray-500 mb-4">
                    <div>• 20 ta naqsh</div>
                    <div>• Har bir to'g'ri javob: 25 ball</div>
                    <div>• Vaqt: 12 daqiqa</div>
                </div>
                <div class="pattern-sequence justify-center">
                    <div class="pattern-item bg-purple-400">2</div>
                    <div class="pattern-item bg-pink-400">4</div>
                    <div class="pattern-item bg-purple-400">8</div>
                    <div class="pattern-item bg-pink-400">16</div>
                    <div class="pattern-item missing">?</div>
                </div>
                <button class="level-btn w-full py-3 text-white font-semibold mt-4">
                    Boshlash
                </button>
            </div>
        </div>
    </div>

    <!-- Game Screen -->
    <div id="gameScreen" class="hidden max-w-4xl mx-auto">
        <!-- Progress and Timer -->
        <div class="pattern-card p-6 mb-6">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center">
                    <div class="bg-purple-500 text-white rounded-full w-10 h-10 flex items-center justify-center font-bold mr-4" id="questionNumber">1</div>
                    <div>
                        <div class="text-sm text-gray-600">Naqsh</div>
                        <div class="font-semibold" id="questionProgress">1 / 10</div>
                    </div>
                </div>

                <!-- Timer -->
                <div class="relative">
                    <svg class="w-16 h-16 transform -rotate-90">
                        <circle cx="32" cy="32" r="28" stroke="#e5e7eb" stroke-width="4" fill="none"/>
                        <circle cx="32" cy="32" r="28" stroke="#8b5cf6" stroke-width="4" fill="none"
                                class="timer-circle" id="timerCircle"/>
                    </svg>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <span class="text-lg font-bold text-gray-800" id="timeLeft">480</span>
                    </div>
                </div>
            </div>

            <!-- Progress Bar -->
            <div class="w-full bg-gray-200 rounded-full h-3">
                <div class="progress-bar h-3 rounded-full" id="progressBar" style="width: 0%"></div>
            </div>
        </div>

        <!-- Pattern Display -->
        <div class="pattern-card p-8 mb-6">
            <div class="text-center mb-6">
                <h3 class="text-2xl font-bold text-gray-800 mb-2">Naqshni davom ettiring</h3>
                <p class="text-gray-600" id="patternHint">Qaysi element keyingi bo'lishi kerak?</p>
            </div>

            <!-- Pattern Sequence -->
            <div class="pattern-sequence" id="patternSequence">
                <!-- Pattern items will be populated by JavaScript -->
            </div>

            <!-- Answer Options -->
            <div class="mt-8">
                <h4 class="text-lg font-semibold text-gray-800 text-center mb-4">Javobni tanlang:</h4>
                <div class="pattern-options" id="answerOptions">
                    <!-- Options will be populated by JavaScript -->
                </div>
            </div>

            <!-- Hint Button -->
            <div class="text-center mt-6">
                <button class="hint-btn" id="hintBtn" onclick="useHint()">
                    <i class="fas fa-lightbulb mr-2"></i>Maslahat olish
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
        <div class="pattern-card p-8">
            <div class="text-6xl mb-6" id="resultEmoji">🎉</div>
            <h2 class="text-3xl font-bold text-gray-800 mb-4" id="resultTitle">Ajoyib!</h2>
            <p class="text-gray-600 mb-6" id="resultMessage">Siz naqshlarni juda yaxshi tanidingiz!</p>

            <!-- Score Details -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                <div class="bg-purple-50 p-4 rounded-lg">
                    <div class="text-2xl font-bold text-purple-600" id="finalScore">150</div>
                    <div class="text-sm text-gray-600">Jami Ball</div>
                </div>
                <div class="bg-green-50 p-4 rounded-lg">
                    <div class="text-2xl font-bold text-green-600" id="correctPatterns">10</div>
                    <div class="text-sm text-gray-600">To'g'ri Naqsh</div>
                </div>
                <div class="bg-blue-50 p-4 rounded-lg">
                    <div class="text-2xl font-bold text-blue-600" id="accuracy">100%</div>
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
                <button onclick="selectNewLevel()" class="bg-gray-500 hover:bg-gray-600 px-8 py-3 text-white font-semibold rounded-lg transition-colors">
                    <i class="fas fa-level-up-alt mr-2"></i>Boshqa Daraja
                </button>
                <button onclick="goHome()" class="bg-blue-500 hover:bg-blue-600 px-8 py-3 text-white font-semibold rounded-lg transition-colors">
                    <i class="fas fa-home mr-2"></i>Bosh Sahifa
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Floating Score Animation -->
<div id="floatingScore" class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-4xl font-bold text-purple-500 pointer-events-none hidden">
    +15
</div>

<!-- Hint Modal -->
<div id="hintModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-xl p-6 max-w-md mx-4">
        <h3 class="text-xl font-bold text-gray-800 mb-4">💡 Maslahat</h3>
        <p id="hintText" class="text-gray-600 mb-6">Bu naqshda ranglar navbat bilan takrorlanadi.</p>
        <button onclick="closeHintModal()" class="w-full bg-purple-500 hover:bg-purple-600 text-white py-2 px-4 rounded-lg transition-colors">
            Tushundim
        </button>
    </div>
</div>

<script>
    // Game State
    let currentGameLevel = '';
    let currentQuestionIndex = 0;
    let totalQuestions = 0;
    let score = 0;
    let correctAnswersCount = 0;
    let timeLeft = 0;
    let timerInterval = null;
    let patterns = [];
    let currentPattern = null;
    let hintsUsed = 0;
    let maxHints = 3;

    // Level Configurations
    const levelConfig = {
        beginner: {
            name: 'Boshlang\'ich',
            questions: 10,
            timeLimit: 480, // 8 minutes
            pointsPerQuestion: 15,
            patternTypes: ['color', 'simple_shape'] // Bu to'g'ri
        },
        intermediate: {
            name: 'O\'rta',
            questions: 15,
            timeLimit: 600, // 10 minutes
            pointsPerQuestion: 20,
            patternTypes: ['color', 'simple_shape', 'number'] // 'size', 'shape' ni olib tashlash
        },
        advanced: {
            name: 'Murakkab',
            questions: 20,
            timeLimit: 720, // 12 minutes
            pointsPerQuestion: 25,
            patternTypes: ['number', 'math', 'simple_shape'] // faqat mavjud turlarni qoldirish
        }
    };

    // Pattern Templates
    const patternTemplates = {
        color: {
            colors: ['bg-red-400', 'bg-blue-400', 'bg-green-400', 'bg-yellow-400', 'bg-purple-400', 'bg-pink-400'],
            generatePattern: function() {
                const colors = this.colors.slice(0, 3 + Math.floor(Math.random() * 2));
                const pattern = [];
                const patternLength = 2 + Math.floor(Math.random() * 2); // 2-3 colors in pattern

                for (let i = 0; i < 6; i++) {
                    pattern.push({
                        type: 'color',
                        value: colors[i % patternLength],
                        display: ''
                    });
                }

                return {
                    sequence: pattern.slice(0, 5),
                    answer: pattern[5],
                    options: this.generateOptions(pattern[5], colors),
                    hint: `Bu naqshda ${patternLength} ta rang navbat bilan takrorlanadi.`
                };
            }
        },

        simple_shape: {
            shapes: ['△', '□', '○', '◇', '★', '♠'],
            colors: ['bg-red-400', 'bg-blue-400', 'bg-green-400', 'bg-yellow-400'],
            generatePattern: function() {
                const shapes = ['△', '□', '○', '◇'];
                const colors = ['bg-red-400', 'bg-blue-400', 'bg-green-400', 'bg-yellow-400'];
                const pattern = [];
                const patternLength = 2; // 2 ta element takrorlanadi

                for (let i = 0; i < 6; i++) {
                    pattern.push({
                        type: 'shape',
                        value: colors[i % patternLength],
                        display: shapes[i % patternLength]
                    });
                }

                return {
                    sequence: pattern.slice(0, 5),
                    answer: pattern[5],
                    options: this.generateOptions(pattern[5], shapes, colors),
                    hint: `Bu naqshda ${patternLength} ta shakl va rang navbat bilan takrorlanadi.`
                };
            }
        },

        number: {
            generatePattern: function() {
                const start = 1 + Math.floor(Math.random() * 5);
                const step = 1 + Math.floor(Math.random() * 3);
                const pattern = [];

                for (let i = 0; i < 6; i++) {
                    pattern.push({
                        type: 'number',
                        value: 'bg-blue-400',
                        display: start + (i * step)
                    });
                }

                return {
                    sequence: pattern.slice(0, 5),
                    answer: pattern[5],
                    options: this.generateNumberOptions(pattern[5].display),
                    hint: `Bu naqshda har bir raqam ${step} ga ortib boradi.`
                };
            }
        },

        math: {
            generatePattern: function() {
                const operations = [
                    { type: 'multiply', factor: 2, hint: 'har bir raqam 2 ga ko\'paytiriladi' },
                    { type: 'add', factor: 3, hint: 'har bir raqamga 3 qo\'shiladi' },
                    { type: 'fibonacci', hint: 'har bir raqam oldingi ikkitasining yig\'indisi' }
                ];

                const op = operations[Math.floor(Math.random() * operations.length)];
                const pattern = [];

                if (op.type === 'fibonacci') {
                    const fib = [1, 1, 2, 3, 5, 8];
                    for (let i = 0; i < 6; i++) {
                        pattern.push({
                            type: 'number',
                            value: 'bg-purple-400',
                            display: fib[i]
                        });
                    }
                } else {
                    const start = 1 + Math.floor(Math.random() * 3);
                    for (let i = 0; i < 6; i++) {
                        let value;
                        if (op.type === 'multiply') {
                            value = start * Math.pow(op.factor, i);
                        } else {
                            value = start + (i * op.factor);
                        }
                        pattern.push({
                            type: 'number',
                            value: 'bg-purple-400',
                            display: value
                        });
                    }
                }

                return {
                    sequence: pattern.slice(0, 5),
                    answer: pattern[5],
                    options: this.generateNumberOptions(pattern[5].display),
                    hint: `Bu matematik naqshda ${op.hint}.`
                };
            }
        }
    };

    // Add generateOptions methods to pattern templates
    patternTemplates.color.generateOptions = function(correct, colors) {
        const options = [correct];
        while (options.length < 4) {
            const randomColor = colors[Math.floor(Math.random() * colors.length)];
            const option = { type: 'color', value: randomColor, display: '' };
            if (!options.some(opt => opt.value === option.value)) {
                options.push(option);
            }
        }
        return this.shuffleArray(options);
    };

    patternTemplates.simple_shape.generateOptions = function(correct, shapes, colors) {
        const options = [correct];
        while (options.length < 4) {
            const randomShape = shapes[Math.floor(Math.random() * shapes.length)];
            const randomColor = colors[Math.floor(Math.random() * colors.length)];
            const option = { type: 'shape', value: randomColor, display: randomShape };
            if (!options.some(opt => opt.value === option.value && opt.display === option.display)) {
                options.push(option);
            }
        }
        return this.shuffleArray(options);
    };

    patternTemplates.number.generateNumberOptions = function(correct) {
        const options = [{ type: 'number', value: 'bg-blue-400', display: correct }];
        while (options.length < 4) {
            const randomNum = correct + Math.floor(Math.random() * 10) - 5;
            if (randomNum > 0 && !options.some(opt => opt.display === randomNum)) {
                options.push({ type: 'number', value: 'bg-blue-400', display: randomNum });
            }
        }
        return this.shuffleArray(options);
    };

    patternTemplates.math.generateNumberOptions = patternTemplates.number.generateNumberOptions;

    // Add shuffle method to all templates
    Object.values(patternTemplates).forEach(template => {
        template.shuffleArray = function(array) {
            const shuffled = [...array];
            for (let i = shuffled.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));
                [shuffled[i], shuffled[j]] = [shuffled[j], shuffled[i]];
            }
            return shuffled;
        };
    });

    // Initialize
    document.addEventListener('DOMContentLoaded', function() {
        showLevelSelection();
        updateHintsDisplay();
    });

    // Level Selection
    function selectLevel(level) {
        console.log('Level selected:', level); // Debug uchun
        try {
            currentGameLevel = level;
            const config = levelConfig[level];
            totalQuestions = config.questions;
            timeLeft = config.timeLimit;
            hintsUsed = 0;

            generatePatterns();
            showGameScreen();
            startTimer();
            showPattern();
        } catch (error) {
            console.error('Error in selectLevel:', error);
            alert('Xatolik yuz berdi: ' + error.message);
        }
    }

    // Generate Patterns
    function generatePatterns() {
        patterns = [];
        const config = levelConfig[currentGameLevel];

        for (let i = 0; i < config.questions; i++) {
            const availableTypes = config.patternTypes.filter(type => patternTemplates[type]);
            if (availableTypes.length === 0) {
                console.error('No available pattern types for level:', currentGameLevel);
                return;
            }

            const patternType = availableTypes[Math.floor(Math.random() * availableTypes.length)];
            const pattern = patternTemplates[patternType].generatePattern();
            patterns.push(pattern);
        }
    }

    // Show Pattern
    function showPattern() {
        if (currentQuestionIndex >= patterns.length) {
            endGame();
            return;
        }

        currentPattern = patterns[currentQuestionIndex];

        // Update UI
        document.getElementById('questionNumber').textContent = currentQuestionIndex + 1;
        document.getElementById('questionProgress').textContent = `${currentQuestionIndex + 1} / ${totalQuestions}`;

        // Update progress bar
        const progress = ((currentQuestionIndex + 1) / totalQuestions) * 100;
        document.getElementById('progressBar').style.width = progress + '%';

        // Show pattern sequence
        const sequenceContainer = document.getElementById('patternSequence');
        sequenceContainer.innerHTML = '';

        currentPattern.sequence.forEach(item => {
            const div = document.createElement('div');
            div.className = `pattern-item ${item.value}`;
            div.textContent = item.display;
            sequenceContainer.appendChild(div);
        });

        // Add missing item placeholder
        const missingDiv = document.createElement('div');
        missingDiv.className = 'pattern-item missing';
        missingDiv.textContent = '?';
        sequenceContainer.appendChild(missingDiv);

        // Show answer options
        const optionsContainer = document.getElementById('answerOptions');
        optionsContainer.innerHTML = '';

        currentPattern.options.forEach((option, index) => {
            const div = document.createElement('div');
            div.className = `pattern-item ${option.value} cursor-pointer`;
            div.textContent = option.display;
            div.onclick = () => selectAnswer(option, div);
            optionsContainer.appendChild(div);
        });

        // Update hint button
        updateHintButton();
    }

    // Select Answer
    function selectAnswer(selectedOption, element) {
        const isCorrect = (selectedOption.type === currentPattern.answer.type &&
            selectedOption.value === currentPattern.answer.value &&
            selectedOption.display === currentPattern.answer.display);
        const config = levelConfig[currentGameLevel];

        // Disable all options
        document.querySelectorAll('#answerOptions .pattern-item').forEach(item => {
            item.style.pointerEvents = 'none';
        });

        if (isCorrect) {
            element.classList.add('correct');
            score += config.pointsPerQuestion;
            correctAnswersCount++;
            showFloatingScore('+' + config.pointsPerQuestion);

            // Update missing item in sequence
            const missingItem = document.querySelector('.pattern-item.missing');
            missingItem.className = `pattern-item ${currentPattern.answer.value} correct`;
            missingItem.textContent = currentPattern.answer.display;
        } else {
            element.classList.add('incorrect');
            // Show correct answer
            document.querySelectorAll('#answerOptions .pattern-item').forEach(item => {
                if (item.textContent === currentPattern.answer.display.toString() &&
                    item.classList.contains(currentPattern.answer.value.replace('bg-', ''))) {
                    item.classList.add('correct');
                }
            });

            // Update missing item with correct answer
            const missingItem = document.querySelector('.pattern-item.missing');
            missingItem.className = `pattern-item ${currentPattern.answer.value}`;
            missingItem.textContent = currentPattern.answer.display;
        }

        // Update score display
        document.getElementById('currentScore').textContent = score;
        document.getElementById('totalScore').textContent = score;

        // Move to next pattern after delay
        setTimeout(() => {
            currentQuestionIndex++;
            showPattern();
        }, 2000);
    }

    // Hint System
    function useHint() {
        if (hintsUsed >= maxHints) return;

        hintsUsed++;
        updateHintsDisplay();
        updateHintButton();

        document.getElementById('hintText').textContent = currentPattern.hint;
        document.getElementById('hintModal').classList.remove('hidden');
        document.getElementById('hintModal').classList.add('flex');
    }

    function closeHintModal() {
        document.getElementById('hintModal').classList.add('hidden');
        document.getElementById('hintModal').classList.remove('flex');
    }

    function updateHintsDisplay() {
        document.getElementById('hintsLeft').textContent = maxHints - hintsUsed;
    }

    function updateHintButton() {
        const hintBtn = document.getElementById('hintBtn');
        if (hintsUsed >= maxHints) {
            hintBtn.disabled = true;
            hintBtn.textContent = 'Maslahat tugadi';
        } else {
            hintBtn.disabled = false;
            hintBtn.innerHTML = '<i class="fas fa-lightbulb mr-2"></i>Maslahat olish';
        }
    }

    // Timer Functions
    function startTimer() {
        const totalTime = levelConfig[currentGameLevel].timeLimit;

        timerInterval = setInterval(() => {
            timeLeft--;
            updateTimerDisplay();

            if (timeLeft <= 0) {
                endGame();
            }
        }, 1000);
    }

    function updateTimerDisplay() {
        const minutes = Math.floor(timeLeft / 60);
        const seconds = timeLeft % 60;
        const timeDisplay = minutes > 0 ? `${minutes}:${seconds.toString().padStart(2, '0')}` : seconds.toString();
        document.getElementById('timeLeft').textContent = timeDisplay;

        // Update timer circle
        const totalTime = levelConfig[currentGameLevel].timeLimit;
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

        const accuracy = Math.round((correctAnswersCount / totalQuestions) * 100);

        // Update results
        document.getElementById('finalScore').textContent = score;
        document.getElementById('correctPatterns').textContent = correctAnswersCount;
        document.getElementById('accuracy').textContent = accuracy + '%';

        // Determine result message and emoji
        let emoji, title, message, badgeHtml = '';

        if (accuracy >= 90) {
            emoji = '🧠';
            title = 'Naqsh Ustasi!';
            message = 'Siz naqshlarni ajoyib tanidingiz! Mantiqiy fikrlash qobiliyatingiz mukammal!';
            badgeHtml = '<div class="inline-block bg-purple-100 text-purple-800 px-4 py-2 rounded-full font-semibold"><i class="fas fa-brain mr-2"></i>Naqsh Chempioni</div>';
        } else if (accuracy >= 70) {
            emoji = '🎯';
            title = 'Ajoyib!';
            message = 'Naqshlarni yaxshi tanidingiz! Mantiqiy fikrlashda yaxshi natija!';
            badgeHtml = '<div class="inline-block bg-blue-100 text-blue-800 px-4 py-2 rounded-full font-semibold"><i class="fas fa-eye mr-2"></i>Naqsh Ko\'ruvchi</div>';
        } else if (accuracy >= 50) {
            emoji = '🔍';
            title = 'Yaxshi!';
            message = 'Yaxshi harakat! Naqshlarni tanishda davom eting!';
            badgeHtml = '<div class="inline-block bg-green-100 text-green-800 px-4 py-2 rounded-full font-semibold"><i class="fas fa-search mr-2"></i>Naqsh Qidiruvchi</div>';
        } else {
            emoji = '🤔';
            title = 'Mashq Kerak!';
            message = 'Naqshlarni tanish qiyin! Ko\'proq mashq qiling!';
            badgeHtml = '<div class="inline-block bg-yellow-100 text-yellow-800 px-4 py-2 rounded-full font-semibold"><i class="fas fa-puzzle-piece mr-2"></i>Naqsh O\'rganuvchi</div>';
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
        selectLevel(currentGameLevel);
    }

    function selectNewLevel() {
        showLevelSelection();
    }

    function resetGame() {
        currentQuestionIndex = 0;
        score = 0;
        correctAnswersCount = 0;
        hintsUsed = 0;
        if (timerInterval) {
            clearInterval(timerInterval);
        }
        document.getElementById('currentScore').textContent = '0';
        document.getElementById('totalScore').textContent = '0';
        updateHintsDisplay();
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

    // Close hint modal when clicking outside
    document.getElementById('hintModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeHintModal();
        }
    });

    // Keyboard Support
    document.addEventListener('keydown', function(e) {
        if (document.getElementById('gameScreen').classList.contains('hidden')) return;

        const key = e.key;
        if (key >= '1' && key <= '4') {
            const index = parseInt(key) - 1;
            const options = document.querySelectorAll('#answerOptions .pattern-item');
            if (options[index] && options[index].style.pointerEvents !== 'none') {
                options[index].click();
            }
        } else if (key === 'h' || key === 'H') {
            if (!document.getElementById('hintBtn').disabled) {
                useHint();
            }
        }
    });
</script>
</body>
</html>
