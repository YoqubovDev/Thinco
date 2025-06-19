<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Matematik Sinovlar - Thinko.uz</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }

        .math-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .math-card:hover {
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

        .level-btn.selected {
            background: linear-gradient(135deg, #667eea, #764ba2);
            transform: scale(1.05);
        }

        .answer-btn {
            transition: all 0.2s ease;
            border-radius: 12px;
        }

        .answer-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .answer-btn.correct {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            animation: correctPulse 0.6s ease;
        }

        .answer-btn.incorrect {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: white;
            animation: incorrectShake 0.6s ease;
        }

        @keyframes correctPulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }

        @keyframes incorrectShake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
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

        .celebration {
            animation: celebrate 2s ease-in-out;
        }

        @keyframes celebrate {
            0%, 100% { transform: scale(1) rotate(0deg); }
            25% { transform: scale(1.1) rotate(-5deg); }
            75% { transform: scale(1.1) rotate(5deg); }
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

        .math-symbol {
            font-size: 3rem;
            font-weight: bold;
            color: #667eea;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
        }

        .question-number {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
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
                <h1 class="text-2xl font-bold text-white">Matematik Sinovlar</h1>
            </div>
            <div class="flex items-center space-x-4">
                <div class="text-white text-center">
                    <div class="text-sm opacity-80">Ball</div>
                    <div class="text-xl font-bold" id="totalScore">0</div>
                </div>
                <div class="text-white text-center">
                    <div class="text-sm opacity-80">Darajangiz</div>
                    <div class="text-xl font-bold" id="currentLevel">1</div>
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
            <p class="text-white opacity-80">O'zingizga mos darajani tanlab, matematik sinovni boshlang!</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Beginner Level -->
            <div class="math-card p-6 text-center cursor-pointer" onclick="selectLevel('beginner')">
                <div class="text-6xl mb-4">🌱</div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Boshlang'ich</h3>
                <p class="text-gray-600 mb-4">1-10 gacha qo'shish va ayirish</p>
                <div class="text-sm text-gray-500">
                    <div>• 10 ta savol</div>
                    <div>• Har bir to'g'ri javob: 10 ball</div>
                    <div>• Vaqt: 5 daqiqa</div>
                </div>
                <button class="level-btn w-full py-3 text-white font-semibold mt-4">
                    Boshlash
                </button>
            </div>

            <!-- Intermediate Level -->
            <div class="math-card p-6 text-center cursor-pointer" onclick="selectLevel('intermediate')">
                <div class="text-6xl mb-4">🚀</div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">O'rta</h3>
                <p class="text-gray-600 mb-4">1-100 gacha amallar va ko'paytirish</p>
                <div class="text-sm text-gray-500">
                    <div>• 15 ta savol</div>
                    <div>• Har bir to'g'ri javob: 15 ball</div>
                    <div>• Vaqt: 7 daqiqa</div>
                </div>
                <button class="level-btn w-full py-3 text-white font-semibold mt-4">
                    Boshlash
                </button>
            </div>

            <!-- Advanced Level -->
            <div class="math-card p-6 text-center cursor-pointer" onclick="selectLevel('advanced')">
                <div class="text-6xl mb-4">🏆</div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Murakkab</h3>
                <p class="text-gray-600 mb-4">Katta sonlar va bo'lish</p>
                <div class="text-sm text-gray-500">
                    <div>• 20 ta savol</div>
                    <div>• Har bir to'g'ri javob: 20 ball</div>
                    <div>• Vaqt: 10 daqiqa</div>
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
        <div class="math-card p-6 mb-6">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center">
                    <div class="question-number mr-4" id="questionNumber">1</div>
                    <div>
                        <div class="text-sm text-gray-600">Savol</div>
                        <div class="font-semibold" id="questionProgress">1 / 10</div>
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
                        <span class="text-lg font-bold text-gray-800" id="timeLeft">300</span>
                    </div>
                </div>
            </div>

            <!-- Progress Bar -->
            <div class="w-full bg-gray-200 rounded-full h-3">
                <div class="progress-bar h-3 rounded-full" id="progressBar" style="width: 0%"></div>
            </div>
        </div>

        <!-- Question Card -->
        <div class="math-card p-8 mb-6 text-center">
            <div class="mb-8">
                <div class="text-4xl md:text-6xl font-bold text-gray-800 mb-4" id="mathQuestion">
                    5 + 3 = ?
                </div>
                <div class="text-lg text-gray-600" id="questionHint">
                    To'g'ri javobni tanlang
                </div>
            </div>

            <!-- Answer Options -->
            <div class="grid grid-cols-2 gap-4 max-w-md mx-auto" id="answerOptions">
                <!-- Options will be populated by JavaScript -->
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
        <div class="math-card p-8">
            <div class="text-6xl mb-6" id="resultEmoji">🎉</div>
            <h2 class="text-3xl font-bold text-gray-800 mb-4" id="resultTitle">Ajoyib!</h2>
            <p class="text-gray-600 mb-6" id="resultMessage">Siz barcha savollarni to'g'ri javoblangiz!</p>

            <!-- Score Details -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                <div class="bg-green-50 p-4 rounded-lg">
                    <div class="text-2xl font-bold text-green-600" id="finalScore">100</div>
                    <div class="text-sm text-gray-600">Jami Ball</div>
                </div>
                <div class="bg-blue-50 p-4 rounded-lg">
                    <div class="text-2xl font-bold text-blue-600" id="correctAnswers">10</div>
                    <div class="text-sm text-gray-600">To'g'ri Javob</div>
                </div>
                <div class="bg-purple-50 p-4 rounded-lg">
                    <div class="text-2xl font-bold text-purple-600" id="accuracy">100%</div>
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
<div id="floatingScore" class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-4xl font-bold text-green-500 pointer-events-none hidden">
    +10
</div>

<!-- Sound Effects (Optional) -->
<audio id="correctSound" preload="auto">
    <source src="data:audio/wav;base64,UklGRnoGAABXQVZFZm10IBAAAAABAAEAQB8AAEAfAAABAAgAZGF0YQoGAACBhYqFbF1fdJivrJBhNjVgodDbq2EcBj+a2/LDciUFLIHO8tiJNwgZaLvt559NEAxQp+PwtmMcBjiR1/LMeSwFJHfH8N2QQAoUXrTp66hVFApGn+DyvmwhBSuBzvLZiTYIG2m98OScTgwOUarm7blmGgU7k9n1unEiBC13yO/eizEIHWq+8+OWT" type="audio/wav">
</audio>
<audio id="incorrectSound" preload="auto">
    <source src="data:audio/wav;base64,UklGRnoGAABXQVZFZm10IBAAAAABAAEAQB8AAEAfAAABAAgAZGF0YQoGAACBhYqFbF1fdJivrJBhNjVgodDbq2EcBj+a2/LDciUFLIHO8tiJNwgZaLvt559NEAxQp+PwtmMcBjiR1/LMeSwFJHfH8N2QQAoUXrTp66hVFApGn+DyvmwhBSuBzvLZiTYIG2m98OScTgwOUarm7blmGgU7k9n1unEiBC13yO/eizEIHWq+8+OWT" type="audio/wav">
</audio>

<script>
    // Game State
    let currentGameLevel = '';
    let currentQuestionIndex = 0;
    let totalQuestions = 0;
    let score = 0;
    let correctAnswersCount = 0;
    let timeLeft = 0;
    let timerInterval = null;
    let questions = [];
    let currentQuestion = null;

    // Level Configurations
    const levelConfig = {
        beginner: {
            name: 'Boshlang\'ich',
            questions: 10,
            timeLimit: 300, // 5 minutes
            pointsPerQuestion: 10,
            operations: ['+', '-'],
            maxNumber: 10
        },
        intermediate: {
            name: 'O\'rta',
            questions: 15,
            timeLimit: 420, // 7 minutes
            pointsPerQuestion: 15,
            operations: ['+', '-', '*'],
            maxNumber: 100
        },
        advanced: {
            name: 'Murakkab',
            questions: 20,
            timeLimit: 600, // 10 minutes
            pointsPerQuestion: 20,
            operations: ['+', '-', '*', '/'],
            maxNumber: 1000
        }
    };

    // Initialize
    document.addEventListener('DOMContentLoaded', function() {
        showLevelSelection();
    });

    // Level Selection
    function selectLevel(level) {
        currentGameLevel = level;
        const config = levelConfig[level];
        totalQuestions = config.questions;
        timeLeft = config.timeLimit;

        generateQuestions();
        showGameScreen();
        startTimer();
        showQuestion();
    }

    // Generate Questions
    function generateQuestions() {
        questions = [];
        const config = levelConfig[currentGameLevel];

        for (let i = 0; i < config.questions; i++) {
            const question = generateQuestion(config);
            questions.push(question);
        }
    }

    function generateQuestion(config) {
        const operation = config.operations[Math.floor(Math.random() * config.operations.length)];
        let num1, num2, correctAnswer;

        switch (operation) {
            case '+':
                num1 = Math.floor(Math.random() * config.maxNumber) + 1;
                num2 = Math.floor(Math.random() * config.maxNumber) + 1;
                correctAnswer = num1 + num2;
                break;
            case '-':
                num1 = Math.floor(Math.random() * config.maxNumber) + 1;
                num2 = Math.floor(Math.random() * num1) + 1;
                correctAnswer = num1 - num2;
                break;
            case '*':
                num1 = Math.floor(Math.random() * Math.min(config.maxNumber / 10, 12)) + 1;
                num2 = Math.floor(Math.random() * Math.min(config.maxNumber / 10, 12)) + 1;
                correctAnswer = num1 * num2;
                break;
            case '/':
                correctAnswer = Math.floor(Math.random() * 20) + 1;
                num2 = Math.floor(Math.random() * 10) + 1;
                num1 = correctAnswer * num2;
                break;
        }

        // Generate wrong answers
        const wrongAnswers = [];
        while (wrongAnswers.length < 3) {
            let wrongAnswer;
            if (operation === '/') {
                wrongAnswer = correctAnswer + Math.floor(Math.random() * 10) - 5;
            } else {
                wrongAnswer = correctAnswer + Math.floor(Math.random() * 20) - 10;
            }

            if (wrongAnswer !== correctAnswer && wrongAnswer > 0 && !wrongAnswers.includes(wrongAnswer)) {
                wrongAnswers.push(wrongAnswer);
            }
        }

        // Shuffle answers
        const allAnswers = [correctAnswer, ...wrongAnswers];
        for (let i = allAnswers.length - 1; i > 0; i--) {
            const j = Math.floor(Math.random() * (i + 1));
            [allAnswers[i], allAnswers[j]] = [allAnswers[j], allAnswers[i]];
        }

        return {
            question: `${num1} ${operation} ${num2} = ?`,
            correctAnswer: correctAnswer,
            options: allAnswers
        };
    }

    // Show Question
    function showQuestion() {
        if (currentQuestionIndex >= questions.length) {
            endGame();
            return;
        }

        currentQuestion = questions[currentQuestionIndex];

        // Update UI
        document.getElementById('questionNumber').textContent = currentQuestionIndex + 1;
        document.getElementById('questionProgress').textContent = `${currentQuestionIndex + 1} / ${totalQuestions}`;
        document.getElementById('mathQuestion').textContent = currentQuestion.question;

        // Update progress bar
        const progress = ((currentQuestionIndex + 1) / totalQuestions) * 100;
        document.getElementById('progressBar').style.width = progress + '%';

        // Show answer options
        const optionsContainer = document.getElementById('answerOptions');
        optionsContainer.innerHTML = '';

        currentQuestion.options.forEach((option, index) => {
            const button = document.createElement('button');
            button.className = 'answer-btn bg-white border-2 border-gray-300 hover:border-blue-500 p-4 rounded-lg text-xl font-semibold transition-all';
            button.textContent = option;
            button.onclick = () => selectAnswer(option, button);
            optionsContainer.appendChild(button);
        });
    }

    // Select Answer
    function selectAnswer(selectedAnswer, buttonElement) {
        const isCorrect = selectedAnswer === currentQuestion.correctAnswer;
        const config = levelConfig[currentGameLevel];

        // Disable all buttons
        document.querySelectorAll('.answer-btn').forEach(btn => {
            btn.disabled = true;
            btn.style.pointerEvents = 'none';
        });

        if (isCorrect) {
            buttonElement.classList.add('correct');
            score += config.pointsPerQuestion;
            correctAnswersCount++;
            showFloatingScore('+' + config.pointsPerQuestion);
            playSound('correct');
        } else {
            buttonElement.classList.add('incorrect');
            // Show correct answer
            document.querySelectorAll('.answer-btn').forEach(btn => {
                if (parseInt(btn.textContent) === currentQuestion.correctAnswer) {
                    btn.classList.add('correct');
                }
            });
            playSound('incorrect');
        }

        // Update score display
        document.getElementById('currentScore').textContent = score;
        document.getElementById('totalScore').textContent = score;

        // Move to next question after delay
        setTimeout(() => {
            currentQuestionIndex++;
            showQuestion();
        }, 1500);
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
        document.getElementById('timeLeft').textContent = `${minutes}:${seconds.toString().padStart(2, '0')}`;

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
        document.getElementById('correctAnswers').textContent = correctAnswersCount;
        document.getElementById('accuracy').textContent = accuracy + '%';

        // Determine result message and emoji
        let emoji, title, message, badgeHtml = '';

        if (accuracy >= 90) {
            emoji = '🏆';
            title = 'Mukammal!';
            message = 'Siz matematik ustasiz! Ajoyib natija!';
            badgeHtml = '<div class="inline-block bg-yellow-100 text-yellow-800 px-4 py-2 rounded-full font-semibold"><i class="fas fa-crown mr-2"></i>Matematik Chempioni</div>';
        } else if (accuracy >= 70) {
            emoji = '🎉';
            title = 'Ajoyib!';
            message = 'Yaxshi natija! Davom eting!';
            badgeHtml = '<div class="inline-block bg-blue-100 text-blue-800 px-4 py-2 rounded-full font-semibold"><i class="fas fa-star mr-2"></i>Matematik Yulduzi</div>';
        } else if (accuracy >= 50) {
            emoji = '👍';
            title = 'Yaxshi!';
            message = 'Yaxshi harakat! Yana mashq qiling!';
            badgeHtml = '<div class="inline-block bg-green-100 text-green-800 px-4 py-2 rounded-full font-semibold"><i class="fas fa-thumbs-up mr-2"></i>Yaxshi Harakat</div>';
        } else {
            emoji = '💪';
            title = 'Mashq Kerak!';
            message = 'Xafa bo\'lmang! Mashq qilsangiz, yaxshiroq bo\'lasiz!';
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
        selectLevel(currentGameLevel);
    }

    function selectNewLevel() {
        showLevelSelection();
    }

    function resetGame() {
        currentQuestionIndex = 0;
        score = 0;
        correctAnswersCount = 0;
        if (timerInterval) {
            clearInterval(timerInterval);
        }
        document.getElementById('currentScore').textContent = '0';
        document.getElementById('totalScore').textContent = '0';
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

    function playSound(type) {
        try {
            const sound = document.getElementById(type + 'Sound');
            if (sound) {
                sound.currentTime = 0;
                sound.play().catch(e => console.log('Sound play failed:', e));
            }
        } catch (e) {
            console.log('Sound error:', e);
        }
    }

    // Keyboard Support
    document.addEventListener('keydown', function(e) {
        if (document.getElementById('gameScreen').classList.contains('hidden')) return;

        const key = e.key;
        if (key >= '1' && key <= '4') {
            const index = parseInt(key) - 1;
            const buttons = document.querySelectorAll('.answer-btn');
            if (buttons[index] && !buttons[index].disabled) {
                buttons[index].click();
            }
        }
    });

    // Prevent cheating (basic)
    document.addEventListener('contextmenu', e => e.preventDefault());
    document.addEventListener('keydown', function(e) {
        if (e.key === 'F12' || (e.ctrlKey && e.shiftKey && e.key === 'I')) {
            e.preventDefault();
        }
    });
</script>
</body>
</html>

