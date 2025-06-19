<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mantiq Jumboqlari - Thinko.uz</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }

        .logic-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .logic-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        }

        .category-btn {
            background: linear-gradient(135deg, #f59e0b, #d97706);
            transition: all 0.3s ease;
            border-radius: 15px;
        }

        .category-btn:hover {
            background: linear-gradient(135deg, #d97706, #b45309);
            transform: translateY(-2px);
        }

        .puzzle-item {
            width: 80px;
            height: 80px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            font-weight: bold;
            transition: all 0.3s ease;
            cursor: pointer;
            border: 3px solid transparent;
            position: relative;
        }

        .puzzle-item:hover {
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .puzzle-item.selected {
            border-color: #f59e0b;
            transform: scale(1.1);
            box-shadow: 0 8px 25px rgba(245, 158, 11, 0.4);
        }

        .puzzle-item.correct {
            border-color: #10b981;
            background: #d1fae5;
            animation: correctPulse 0.6s ease;
        }

        .puzzle-item.incorrect {
            border-color: #ef4444;
            background: #fee2e2;
            animation: incorrectShake 0.6s ease;
        }

        .puzzle-item.missing {
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

        .puzzle-grid {
            display: grid;
            gap: 15px;
            justify-content: center;
            margin: 20px 0;
        }

        .puzzle-grid.grid-3x3 { grid-template-columns: repeat(3, 1fr); }
        .puzzle-grid.grid-4x4 { grid-template-columns: repeat(4, 1fr); }
        .puzzle-grid.grid-2x4 { grid-template-columns: repeat(4, 1fr); }

        .logic-sequence {
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
            background: linear-gradient(90deg, #f59e0b, #d97706);
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

        .hint-btn {
            background: linear-gradient(135deg, #8b5cf6, #7c3aed);
            color: white;
            border: none;
            border-radius: 10px;
            padding: 8px 16px;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .hint-btn:hover {
            background: linear-gradient(135deg, #7c3aed, #6d28d9);
            transform: translateY(-2px);
        }

        .hint-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .difficulty-badge {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            display: inline-block;
        }

        .difficulty-easy { background: #dcfce7; color: #166534; }
        .difficulty-medium { background: #fef3c7; color: #92400e; }
        .difficulty-hard { background: #fee2e2; color: #991b1b; }

        .explanation-box {
            background: #eff6ff;
            border: 2px solid #3b82f6;
            border-radius: 12px;
            padding: 16px;
            margin: 16px 0;
        }

        .logic-rule {
            background: #f0f9ff;
            border-left: 4px solid #0ea5e9;
            padding: 12px 16px;
            margin: 8px 0;
            border-radius: 0 8px 8px 0;
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
                <h1 class="text-2xl font-bold text-white">Mantiq Jumboqlari</h1>
            </div>
            <div class="flex items-center space-x-4">
                <div class="text-white text-center">
                    <div class="text-sm opacity-80">Ball</div>
                    <div class="text-xl font-bold" id="totalScore">0</div>
                </div>
                <div class="text-white text-center">
                    <div class="text-sm opacity-80">Maslahat</div>
                    <div class="text-xl font-bold" id="hintsLeft">3</div>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Main Content -->
<div class="container mx-auto px-4 py-8">

    <!-- Category Selection Screen -->
    <div id="categorySelection" class="max-w-4xl mx-auto">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-white mb-4">Jumboq Turini Tanlang</h2>
            <p class="text-white opacity-80">Mantiqiy fikrlashni rivojlantiring va jumboqlarni yeching!</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Pattern Logic -->
            <div class="logic-card p-6 text-center cursor-pointer" onclick="selectCategory('pattern')">
                <div class="text-6xl mb-4">🔄</div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Naqsh Mantiq</h3>
                <p class="text-gray-600 mb-4">Naqshlarni toping va davom ettiring</p>
                <div class="text-sm text-gray-500 mb-4">
                    <div>• Ranglar va shakllar naqshlari</div>
                    <div>• 12 ta jumboq</div>
                    <div>• Har bir to'g'ri javob: 25 ball</div>
                </div>
                <div class="logic-sequence justify-center mb-4">
                    <div class="puzzle-item bg-red-400">●</div>
                    <div class="puzzle-item bg-blue-400">■</div>
                    <div class="puzzle-item bg-red-400">●</div>
                    <div class="puzzle-item bg-blue-400">■</div>
                    <div class="puzzle-item missing">?</div>
                </div>
                <div class="difficulty-badge difficulty-easy mb-4">Oson</div>
                <button class="category-btn w-full py-3 text-white font-semibold">
                    Boshlash
                </button>
            </div>

            <!-- Deduction Logic -->
            <div class="logic-card p-6 text-center cursor-pointer" onclick="selectCategory('deduction')">
                <div class="text-6xl mb-4">🕵️</div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Xulosa Chiqarish</h3>
                <p class="text-gray-600 mb-4">Ma'lumotlardan to'g'ri xulosa chiqaring</p>
                <div class="text-sm text-gray-500 mb-4">
                    <div>• Mantiqiy masalalar</div>
                    <div>• 10 ta jumboq</div>
                    <div>• Har bir to'g'ri javob: 30 ball</div>
                </div>
                <div class="explanation-box text-left text-sm mb-4">
                    <strong>Masala:</strong> Ahmad Bobur va Doniyor dan uzun. Bobur Doniyor dan qisqa. Kim eng uzun?
                </div>
                <div class="difficulty-badge difficulty-medium mb-4">O'rta</div>
                <button id="startButton" class="category-btn w-full py-3 text-white font-semibold" onclick="startGame(event)">
                    Boshlash
                </button>
            </div>


            <!-- Number Logic -->
            <div class="logic-card p-6 text-center cursor-pointer" onclick="selectCategory('number')">
                <div class="text-6xl mb-4">🔢</div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Raqam Mantiq</h3>
                <p class="text-gray-600 mb-4">Raqamlar orasidagi bog'lanishni toping</p>
                <div class="text-sm text-gray-500 mb-4">
                    <div>• Matematik mantiq</div>
                    <div>• 15 ta jumboq</div>
                    <div>• Har bir to'g'ri javob: 20 ball</div>
                </div>
                <div class="logic-sequence justify-center mb-4">
                    <div class="puzzle-item bg-blue-400">2</div>
                    <div class="puzzle-item bg-blue-400">4</div>
                    <div class="puzzle-item bg-blue-400">8</div>
                    <div class="puzzle-item bg-blue-400">16</div>
                    <div class="puzzle-item missing">?</div>
                </div>
                <div class="difficulty-badge difficulty-medium mb-4">O'rta</div>
                <button class="category-btn w-full py-3 text-white font-semibold">
                    Boshlash
                </button>
            </div>

            <!-- Spatial Logic -->
            <div class="logic-card p-6 text-center cursor-pointer" onclick="selectCategory('spatial')">
                <div class="text-6xl mb-4">🧩</div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Fazoviy Mantiq</h3>
                <p class="text-gray-600 mb-4">Shakllar va pozitsiyalar bilan ishlang</p>
                <div class="text-sm text-gray-500 mb-4">
                    <div>• Geometrik mantiq</div>
                    <div>• 8 ta jumboq</div>
                    <div>• Har bir to'g'ri javob: 35 ball</div>
                </div>
                <div class="puzzle-grid grid-3x3 max-w-xs mx-auto mb-4">
                    <div class="puzzle-item bg-red-400">●</div>
                    <div class="puzzle-item bg-white border-2 border-gray-300"></div>
                    <div class="puzzle-item bg-blue-400">■</div>
                    <div class="puzzle-item bg-white border-2 border-gray-300"></div>
                    <div class="puzzle-item bg-green-400">▲</div>
                    <div class="puzzle-item bg-white border-2 border-gray-300"></div>
                    <div class="puzzle-item bg-yellow-400">♦</div>
                    <div class="puzzle-item bg-white border-2 border-gray-300"></div>
                    <div class="puzzle-item missing">?</div>
                </div>
                <div class="difficulty-badge difficulty-hard mb-4">Qiyin</div>
                <button class="category-btn w-full py-3 text-white font-semibold">
                    Boshlash
                </button>
            </div>
        </div>
    </div>

    <!-- Game Screen -->
    <div id="gameScreen" class="hidden max-w-4xl mx-auto">
        <!-- Progress and Timer -->
        <div class="logic-card p-6 mb-6">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center">
                    <div class="bg-orange-500 text-white rounded-full w-10 h-10 flex items-center justify-center font-bold mr-4" id="puzzleNumber">1</div>
                    <div>
                        <div class="text-sm text-gray-600">Jumboq</div>
                        <div class="font-semibold" id="puzzleProgress">1 / 12</div>
                    </div>
                </div>

                <!-- Timer -->
                <div class="relative">
                    <svg class="w-16 h-16 transform -rotate-90">
                        <circle cx="32" cy="32" r="28" stroke="#e5e7eb" stroke-width="4" fill="none"/>
                        <circle cx="32" cy="32" r="28" stroke="#f59e0b" stroke-width="4" fill="none"
                                class="timer-circle" id="timerCircle"/>
                    </svg>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <span class="text-lg font-bold text-gray-800" id="timeLeft">60</span>
                    </div>
                </div>
            </div>

            <!-- Progress Bar -->
            <div class="w-full bg-gray-200 rounded-full h-3">
                <div class="progress-bar h-3 rounded-full" id="progressBar" style="width: 0%"></div>
            </div>
        </div>

        <!-- Puzzle Card -->
        <div class="logic-card p-8 mb-6">
            <div class="text-center mb-6">
                <h3 class="text-2xl font-bold text-gray-800 mb-2" id="puzzleTitle">Mantiq Jumboq</h3>
                <p class="text-gray-600" id="puzzleDescription">Quyidagi jumboqni yeching</p>
                <div class="difficulty-badge difficulty-easy mt-2" id="puzzleDifficulty">Oson</div>
            </div>

            <!-- Puzzle Content -->
            <div id="puzzleContent" class="text-center">
                <!-- Content will be populated by JavaScript -->
            </div>

            <!-- Answer Options -->
            <div class="mt-8" id="answerSection">
                <h4 class="text-lg font-semibold text-gray-800 text-center mb-4">Javobni tanlang:</h4>
                <div id="answerOptions">
                    <!-- Options will be populated by JavaScript -->
                </div>
            </div>

            <!-- Hint Section -->
            <div class="text-center mt-6">
                <button class="hint-btn" id="hintBtn" onclick="useHint()">
                    <i class="fas fa-lightbulb mr-2"></i>Maslahat olish
                </button>
            </div>

            <!-- Explanation Section -->
            <div id="explanationSection" class="hidden mt-6">
                <div class="explanation-box">
                    <h5 class="font-semibold text-blue-800 mb-2">
                        <i class="fas fa-info-circle mr-2"></i>Tushuntirish:
                    </h5>
                    <p id="explanationText" class="text-gray-700"></p>
                </div>
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
        <div class="logic-card p-8">
            <div class="text-6xl mb-6" id="resultEmoji">🧠</div>
            <h2 class="text-3xl font-bold text-gray-800 mb-4" id="resultTitle">Mantiq Ustasi!</h2>
            <p class="text-gray-600 mb-6" id="resultMessage">Siz mantiqiy fikrlashda juda yaxshi natija ko'rsatdingiz!</p>

            <!-- Score Details -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                <div class="bg-orange-50 p-4 rounded-lg">
                    <div class="text-2xl font-bold text-orange-600" id="finalScore">300</div>
                    <div class="text-sm text-gray-600">Jami Ball</div>
                </div>
                <div class="bg-green-50 p-4 rounded-lg">
                    <div class="text-2xl font-bold text-green-600" id="correctPuzzles">10</div>
                    <div class="text-sm text-gray-600">To'g'ri Jumboq</div>
                </div>
                <div class="bg-blue-50 p-4 rounded-lg">
                    <div class="text-2xl font-bold text-blue-600" id="accuracy">83%</div>
                    <div class="text-sm text-gray-600">Aniqlik</div>
                </div>
            </div>

            <!-- Achievement Badge -->
            <div class="mb-8" id="achievementBadge">
                <!-- Badge will be populated by JavaScript -->
            </div>

            <!-- Logic Skills Summary -->
            <div class="mb-8" id="skillsSummary">
                <h4 class="text-lg font-semibold text-gray-800 mb-4">Mantiqiy Ko'nikmalar:</h4>
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div class="logic-rule">
                        <strong>Naqsh Tanish:</strong> <span id="patternSkill">Yaxshi</span>
                    </div>
                    <div class="logic-rule">
                        <strong>Xulosa Chiqarish:</strong> <span id="deductionSkill">A'lo</span>
                    </div>
                    <div class="logic-rule">
                        <strong>Matematik Mantiq:</strong> <span id="mathSkill">O'rta</span>
                    </div>
                    <div class="logic-rule">
                        <strong>Fazoviy Fikrlash:</strong> <span id="spatialSkill">Yaxshi</span>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <button onclick="playAgain()" class="category-btn px-8 py-3 text-white font-semibold">
                    <i class="fas fa-redo mr-2"></i>Qayta O'ynash
                </button>
                <button onclick="selectNewCategory()" class="bg-gray-500 hover:bg-gray-600 px-8 py-3 text-white font-semibold rounded-lg transition-colors">
                    <i class="fas fa-list mr-2"></i>Boshqa Tur
                </button>
                <button onclick="goHome()" class="bg-blue-500 hover:bg-blue-600 px-8 py-3 text-white font-semibold rounded-lg transition-colors">
                    <i class="fas fa-home mr-2"></i>Bosh Sahifa
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Floating Score Animation -->
<div id="floatingScore" class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-4xl font-bold text-orange-500 pointer-events-none hidden">
    +25
</div>

<!-- Hint Modal -->
<div id="hintModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-xl p-6 max-w-md mx-4">
        <h3 class="text-xl font-bold text-gray-800 mb-4">💡 Maslahat</h3>
        <p id="hintText" class="text-gray-600 mb-6">Bu jumboqda naqshni diqqat bilan kuzating.</p>
        <button onclick="closeHintModal()" class="w-full bg-purple-500 hover:bg-purple-600 text-white py-2 px-4 rounded-lg transition-colors">
            Tushundim
        </button>
    </div>
</div>

<script>
    // Game State
    let currentCategory = '';
    let currentPuzzleIndex = 0;
    let totalPuzzles = 0;
    let score = 0;
    let correctAnswersCount = 0;
    let timeLeft = 0;
    let timerInterval = null;
    let puzzles = [];
    let currentPuzzle = null;
    let hintsUsed = 0;
    let maxHints = 3;
    let categoryStats = {
        pattern: 0,
        deduction: 0,
        number: 0,
        spatial: 0
    };

    // Category Configurations
    const categoryConfig = {
        pattern: {
            name: 'Naqsh Mantiq',
            puzzles: 12,
            pointsPerPuzzle: 25,
            timeLimit: 60,
            difficulty: 'easy'
        },
        deduction: {
            name: 'Xulosa Chiqarish',
            puzzles: 10,
            pointsPerPuzzle: 30,
            timeLimit: 90,
            difficulty: 'medium'
        },
        number: {
            name: 'Raqam Mantiq',
            puzzles: 15,
            pointsPerPuzzle: 20,
            timeLimit: 45,
            difficulty: 'medium'
        },
        spatial: {
            name: 'Fazoviy Mantiq',
            puzzles: 8,
            pointsPerPuzzle: 35,
            timeLimit: 75,
            difficulty: 'hard'
        }
    };

    // Initialize
    document.addEventListener('DOMContentLoaded', function() {
        showCategorySelection();
        updateHintsDisplay();
    });

    // Category Selection
    function selectCategory(category) {
        console.log('Category selected:', category);
        try {
            currentCategory = category;
            const config = categoryConfig[category];
            totalPuzzles = config.puzzles;
            currentPuzzleIndex = 0;
            score = 0;
            correctAnswersCount = 0;
            hintsUsed = 0;

            generatePuzzles();
            showGameScreen();
            startNextPuzzle();
        } catch (error) {
            console.error('Error in selectCategory:', error);
            alert('Xatolik yuz berdi: ' + error.message);
        }
    }

    // Generate Puzzles
    function generatePuzzles() {
        puzzles = [];

        for (let i = 0; i < totalPuzzles; i++) {
            const puzzle = generatePuzzleByCategory(currentCategory, i);
            puzzles.push(puzzle);
        }

        console.log('Generated puzzles:', puzzles.length);
    }

    function generatePuzzleByCategory(category, index) {
        const difficulty = Math.floor(index / 4) + 1;

        switch (category) {
            case 'pattern':
                return generatePatternPuzzle(index, difficulty);
            case 'deduction':
                return generateDeductionPuzzle(index, difficulty);
            case 'number':
                return generateNumberPuzzle(index, difficulty);
            case 'spatial':
                return generateSpatialPuzzle(index, difficulty);
            default:
                return generateDefaultPuzzle(index);
        }
    }

    function generatePatternPuzzle(index, difficulty) {
        const patterns = [
            // Rang naqshlari
            {
                colors: ['bg-red-400', 'bg-blue-400'],
                length: 4 + difficulty
            },
            {
                colors: ['bg-green-400', 'bg-yellow-400', 'bg-purple-400'],
                length: 5 + difficulty
            },
            {
                colors: ['bg-orange-400', 'bg-pink-400'],
                length: 4 + difficulty
            },
            // Shakl naqshlari
            {
                shapes: ['●', '■'],
                length: 4 + difficulty
            },
            {
                shapes: ['▲', '♦', '★'],
                length: 5 + difficulty
            },
            {
                shapes: ['♠', '♣'],
                length: 4 + difficulty
            }
        ];

        const pattern = patterns[index % patterns.length];
        const sequence = [];
        const elements = pattern.colors || pattern.shapes;

        for (let i = 0; i < pattern.length; i++) {
            sequence.push(elements[i % elements.length]);
        }

        const answer = elements[pattern.length % elements.length];

        // Noto'g'ri variantlar
        let allOptions;
        if (pattern.colors) {
            allOptions = ['bg-red-400', 'bg-blue-400', 'bg-green-400', 'bg-yellow-400', 'bg-purple-400', 'bg-orange-400'];
        } else {
            allOptions = ['●', '■', '▲', '♦', '★', '♠', '♣'];
        }

        const wrongOptions = allOptions.filter(opt => opt !== answer).slice(0, 3);
        const options = [answer, ...wrongOptions].sort(() => Math.random() - 0.5);

        return {
            type: 'pattern',
            question: pattern.colors ? 'Quyidagi rang naqshida keyingi element qanday bo\'lishi kerak?' : 'Shakllar ketma-ketligida keyingi element nima?',
            sequence: sequence,
            answer: answer,
            options: options,
            hint: `Bu naqshda ${elements.length} ta element navbat bilan takrorlanadi.`,
            explanation: `Naqsh: ${elements.join(', ')} - bu ketma-ketlik takrorlanadi.`
        };
    }

    function generateDeductionPuzzle(index, difficulty) {
        const puzzles = [
            {
                question: 'Ahmad Bobur dan uzun. Bobur Doniyor dan uzun. Kim eng uzun?',
                options: ['Ahmad', 'Bobur', 'Doniyor', 'Aniqlab bo\'lmaydi'],
                answer: 'Ahmad',
                hint: 'Taqqoslashlarni ketma-ket qiling: Ahmad > Bobur > Doniyor',
                explanation: 'Ahmad > Bobur > Doniyor, demak Ahmad eng uzun.'
            },
            {
                question: 'Barcha qushlar uchadi. Burgut qush. Demak, burgut nima qiladi?',
                options: ['Uchadi', 'Yuguradi', 'Suzadi', 'Noma\'lum'],
                answer: 'Uchadi',
                hint: 'Mantiqiy zanjirni kuzating: qush → uchadi',
                explanation: 'Agar barcha qushlar uchadi va burgut qush bo\'lsa, demak burgut ham uchadi.'
            },
            {
                question: 'Malika Zarina dan katta. Zarina Nodira dan katta. Kim eng yosh?',
                options: ['Malika', 'Zarina', 'Nodira', 'Aniqlab bo\'lmaydi'],
                answer: 'Nodira',
                hint: 'Yoshlik tartibini aniqlang: katta > o\'rta > yosh',
                explanation: 'Malika > Zarina > Nodira, demak Nodira eng yosh.'
            },
            {
                question: 'Agar yomg\'ir yog\'sa, ko\'cha ho\'l bo\'ladi. Ko\'cha ho\'l. Demak nima?',
                options: ['Yomg\'ir yog\'gan', 'Yomg\'ir yog\'maydi', 'Aniqlab bo\'lmaydi', 'Ko\'cha quruq'],
                answer: 'Aniqlab bo\'lmaydi',
                hint: 'Ko\'cha boshqa sababdan ham ho\'l bo\'lishi mumkin',
                explanation: 'Ko\'cha ho\'l bo\'lishining boshqa sabablari ham bo\'lishi mumkin, faqat yomg\'ir emas.'
            },
            {
                question: 'Ali Vali dan tez yuguradi. Vali Gani dan tez yuguradi. Kim eng sekin?',
                options: ['Ali', 'Vali', 'Gani', 'Hammasi teng'],
                answer: 'Gani',
                hint: 'Tezlik tartibini aniqlang: tez > o\'rta > sekin',
                explanation: 'Ali > Vali > Gani, demak Gani eng sekin.'
            },
            {
                question: 'Barcha mushuklar hayvon. Barsik mushuk. Demak, Barsik nima?',
                options: ['Hayvon', 'Mushuk', 'Inson', 'Noma\'lum'],
                answer: 'Hayvon',
                hint: 'Umumiy qoidani alohida holatga qo\'llang',
                explanation: 'Agar barcha mushuklar hayvon va Barsik mushuk bo\'lsa, demak Barsik ham hayvon.'
            },
            {
                question: 'Doniyor Akmal dan baland. Akmal Jasur dan baland. Jasur Bobur dan baland. Kim eng past?',
                options: ['Doniyor', 'Akmal', 'Jasur', 'Bobur'],
                answer: 'Bobur',
                hint: 'Balandlik tartibini to\'liq aniqlang',
                explanation: 'Doniyor > Akmal > Jasur > Bobur, demak Bobur eng past.'
            },
            {
                question: 'Agar kitob qiziq bo\'lsa, men uni o\'qiyman. Men bu kitobni o\'qimayapman. Demak, kitob qanday?',
                options: ['Qiziq', 'Qiziq emas', 'Aniqlab bo\'lmaydi', 'Qiyin'],
                answer: 'Qiziq emas',
                hint: 'Teskari mantiqni qo\'llang',
                explanation: 'Agar qiziq bo\'lsa o\'qir edim, lekin o\'qimayapman, demak qiziq emas.'
            },
            {
                question: 'Hamma talabalar o\'qiydi. Aziz talaba. Aziz nima qiladi?',
                options: ['O\'qiydi', 'Ishlaydi', 'O\'ynamaydi', 'Uxlaydi'],
                answer: 'O\'qiydi',
                hint: 'Umumiy xususiyatni shaxsga qo\'llang',
                explanation: 'Agar hamma talabalar o\'qiydi va Aziz talaba bo\'lsa, demak Aziz ham o\'qiydi.'
            },
            {
                question: 'Gulnora Sevara dan uzun. Sevara Manzura dan uzun. Manzura Dildora dan uzun. Kim eng uzun?',
                options: ['Gulnora', 'Sevara', 'Manzura', 'Dildora'],
                answer: 'Gulnora',
                hint: 'Zanjir tartibini kuzating',
                explanation: 'Gulnora > Sevara > Manzura > Dildora, demak Gulnora eng uzun.'
            }
        ];

        const puzzle = puzzles[index % puzzles.length];
        puzzle.type = 'deduction';
        return puzzle;
    }

    function generateNumberPuzzle(index, difficulty) {
        const puzzleTypes = [
            // Arifmetik progressiya
            () => {
                const start = Math.floor(Math.random() * 5) + 1;
                const step = Math.floor(Math.random() * 4) + 2;
                const length = 4 + Math.floor(difficulty / 2);

                const sequence = [];
                for (let i = 0; i < length; i++) {
                    sequence.push(start + (i * step));
                }

                const answer = start + (length * step);
                const wrongOptions = [answer + step, answer - step, answer + 1];
                const options = [answer, ...wrongOptions].sort(() => Math.random() - 0.5);

                return {
                    question: `Ketma-ketlikni davom ettiring: ${sequence.join(', ')}, ?`,
                    sequence: sequence,
                    answer: answer,
                    options: options,
                    hint: `Har safar ${step} qo'shiladi.`,
                    explanation: `Bu arifmetik progressiya: har safar ${step} qo'shiladi.`
                };
            },
            // Geometrik progressiya
            () => {
                const start = Math.floor(Math.random() * 3) + 1;
                const multiplier = 2 + Math.floor(difficulty / 3);
                const length = 4;

                const sequence = [];
                for (let i = 0; i < length; i++) {
                    sequence.push(start * Math.pow(multiplier, i));
                }

                const answer = start * Math.pow(multiplier, length);
                const wrongOptions = [answer + multiplier, answer - multiplier, answer / multiplier];
                const options = [answer, ...wrongOptions].sort(() => Math.random() - 0.5);

                return {
                    question: `Quyidagi ketma-ketlikda keyingi raqam nima? ${sequence.join(', ')}, ?`,
                    sequence: sequence,
                    answer: answer,
                    options: options,
                    hint: `Har bir raqam ${multiplier} ga ko'paytiriladi.`,
                    explanation: `Bu geometrik progressiya: har bir raqam ${multiplier} ga ko'paytiriladi.`
                };
            },
            // Fibonacci
            () => {
                const sequence = [1, 1];
                const length = 5 + Math.floor(difficulty / 2);

                for (let i = 2; i < length; i++) {
                    sequence.push(sequence[i-1] + sequence[i-2]);
                }

                const answer = sequence[length-1] + sequence[length-2];
                const wrongOptions = [answer + 1, answer - 1, answer * 2];
                const options = [answer, ...wrongOptions].sort(() => Math.random() - 0.5);

                return {
                    question: `Ketma-ketlikni davom ettiring: ${sequence.join(', ')}, ?`,
                    sequence: sequence,
                    answer: answer,
                    options: options,
                    hint: 'Har bir raqam oldingi ikkitasining yig\'indisi.',
                    explanation: 'Bu Fibonachchi ketma-ketligi: har bir raqam oldingi ikkitasining yig\'indisi.'
                };
            },
            // Kvadrat sonlar
            () => {
                const length = 4;
                const sequence = [];
                for (let i = 1; i <= length; i++) {
                    sequence.push(i * i);
                }

                const answer = (length + 1) * (length + 1);
                const wrongOptions = [answer + 1, answer - 1, answer + 2];
                const options = [answer, ...wrongOptions].sort(() => Math.random() - 0.5);

                return {
                    question: `Ketma-ketlikni davom ettiring: ${sequence.join(', ')}, ?`,
                    sequence: sequence,
                    answer: answer,
                    options: options,
                    hint: 'Bu sonlar kvadrat sonlar: 1², 2², 3², 4²...',
                    explanation: 'Bu kvadrat sonlar ketma-ketligi: har bir son o\'zining kvadrati.'
                };
            }
        ];

        const generator = puzzleTypes[index % puzzleTypes.length];
        const puzzle = generator();
        puzzle.type = 'number';
        return puzzle;
    }

    function generateSpatialPuzzle(index, difficulty) {
        const puzzles = [
            {
                question: 'Shakl soat yo\'nalishi bo\'yicha 90° burilsa, qanday ko\'rinadi?',
                shape: '▲',
                answer: '▶',
                options: ['▲', '▼', '◀', '▶'],
                hint: 'Soat yo\'nalishi bo\'yicha 90° burilishni tasavvur qiling.',
                explanation: 'Yuqoriga yo\'nalgan uchburchak soat yo\'nalishi bo\'yicha burilganda o\'ngga yo\'naladi.'
            },
            {
                question: 'Quyidagi naqshda simmetriya o\'qini toping.',
                shape: '▲',
                answer: '▶',
                options: ['▲', '▼', '◀', '▶'],
                hint: 'Soat yo\'nalishi bo\'yicha 90° burilishni tasavvur qiling.',
                explanation: 'Yuqoriga yo\'nalgan uchburchak soat yo\'nalishi bo\'yicha burilganda o\'ngga yo\'naladi.'
            },
            {
                question: 'Shakl soat yo\'nalishi bo\'yicha 90° burilsa, qanday ko\'rinadi?',
                shape: '▲',
                answer: '▶',
                options: ['▲', '▼', '◀', '▶'],
                hint: 'Soat yo\'nalishi bo\'yicha 90° burilishni tasavvur qiling.',
                explanation: 'Yuqoriga yo\'nalgan uchburchak soat yo\'nalishi bo\'yicha burilganda o\'ngga yo\'naladi.'
            },
            {
                question: 'Quyidagi 3x3 gridda markaziy element nima bo\'lishi kerak?',
                shape: '▲',
                answer: '▶',
                options: ['▲', '▼', '◀', '▶'],
                hint: 'Soat yo\'nalishi bo\'yicha 90° burilishni tasavvur qiling.',
                explanation: 'Yuqoriga yo\'nalgan uchburchak soat yo\'nalishi bo\'yicha burilganda o\'ngga yo\'naladi.'
            }
        ];

        const puzzle = puzzles[index % puzzles.length];
        puzzle.type = 'spatial';
        return puzzle;
    }

    function generateDefaultPuzzle(index) {
        return {
            type: 'default',
            question: 'Quyidagi ketma-ketlikda keyingi raqam nima? 2, 4, 6, 8, ?',
            sequence: [2, 4, 6, 8],
            answer: 10,
            options: [10, 12, 9, 11],
            hint: 'Juft sonlar ketma-ketligi.',
            explanation: 'Bu juft sonlar ketma-ketligi: 2, 4, 6, 8, 10...'
        };
    }

    // Start Next Puzzle
    function startNextPuzzle() {
        try {
            if (currentPuzzleIndex >= puzzles.length) {
                endGame();
                return;
            }

            currentPuzzle = puzzles[currentPuzzleIndex];
            if (!currentPuzzle) {
                console.error('Current puzzle is undefined');
                endGame();
                return;
            }

            updateUI();
            displayPuzzle();
            startTimer();
        } catch (error) {
            console.error('Error in startNextPuzzle:', error);
            endGame();
        }
    }

    // Update UI
    function updateUI() {
        document.getElementById('puzzleNumber').textContent = currentPuzzleIndex + 1;
        document.getElementById('puzzleProgress').textContent = `${currentPuzzleIndex + 1} / ${totalPuzzles}`;

        const progress = ((currentPuzzleIndex + 1) / totalPuzzles) * 100;
        document.getElementById('progressBar').style.width = progress + '%';

        const config = categoryConfig[currentCategory];
        document.getElementById('puzzleTitle').textContent = config.name;
        document.getElementById('puzzleDifficulty').className = `difficulty-badge difficulty-${config.difficulty}`;
        document.getElementById('puzzleDifficulty').textContent = getDifficultyText(config.difficulty);

        updateHintButton();
    }

    function getDifficultyText(difficulty) {
        const texts = { easy: 'Oson', medium: 'O\'rta', hard: 'Qiyin' };
        return texts[difficulty] || difficulty;
    }

    // Display Puzzle
    function displayPuzzle() {
        const puzzleContent = document.getElementById('puzzleContent');
        const answerOptions = document.getElementById('answerOptions');

        document.getElementById('puzzleDescription').textContent = currentPuzzle.question;

        // Clear previous content
        puzzleContent.innerHTML = '';
        answerOptions.innerHTML = '';
        document.getElementById('explanationSection').classList.add('hidden');

        // Display puzzle based on type
        if (currentPuzzle.sequence) {
            displaySequence();
        } else if (currentPuzzle.shape) {
            displayShape();
        } else if (currentPuzzle.grid) {
            displayGrid();
        }

        // Display answer options
        displayAnswerOptions();
    }

    function displaySequence() {
        const puzzleContent = document.getElementById('puzzleContent');
        const container = document.createElement('div');
        container.className = 'logic-sequence';

        currentPuzzle.sequence.forEach(item => {
            const element = document.createElement('div');

            if (typeof item === 'string' && item.startsWith('bg-')) {
                // Color sequence
                element.className = `puzzle-item ${item}`;
            } else if (typeof item === 'string') {
                // Shape sequence
                element.className = 'puzzle-item bg-gray-300';
                element.textContent = item;
            } else {
                // Number sequence
                element.className = 'puzzle-item bg-blue-400';
                element.textContent = item;
            }

            container.appendChild(element);
        });

        // Add missing element placeholder
        const missingElement = document.createElement('div');
        missingElement.className = 'puzzle-item missing';
        missingElement.textContent = '?';
        container.appendChild(missingElement);

        puzzleContent.appendChild(container);
    }

    function displayShape() {
        const puzzleContent = document.getElementById('puzzleContent');
        const container = document.createElement('div');
        container.className = 'text-center mb-4';

        const shapeElement = document.createElement('div');
        shapeElement.className = 'puzzle-item bg-blue-400 mx-auto';
        shapeElement.textContent = currentPuzzle.shape;

        container.appendChild(shapeElement);
        puzzleContent.appendChild(container);
    }

    function displayGrid() {
        const puzzleContent = document.getElementById('puzzleContent');
        const container = document.createElement('div');
        container.className = 'puzzle-grid grid-3x3 max-w-xs mx-auto';

        // Sample grid pattern
        const gridItems = ['●', '', '■', '', '▲', '', '♦', '', '?'];

        gridItems.forEach(item => {
            const element = document.createElement('div');
            if (item === '?') {
                element.className = 'puzzle-item missing';
            } else if (item === '') {
                element.className = 'puzzle-item bg-white border-2 border-gray-300';
            } else {
                element.className = 'puzzle-item bg-gray-300';
            }
            element.textContent = item;
            container.appendChild(element);
        });

        puzzleContent.appendChild(container);
    }

    function displayAnswerOptions() {
        const answerOptions = document.getElementById('answerOptions');
        const container = document.createElement('div');
        container.className = 'grid grid-cols-2 md:grid-cols-4 gap-4 max-w-md mx-auto';

        if (!currentPuzzle.options) {
            console.error('No options available for current puzzle');
            return;
        }

        currentPuzzle.options.forEach((option, index) => {
            const button = document.createElement('button');
            button.className = 'puzzle-item bg-gray-200 hover:bg-gray-300 transition-colors';
            button.onclick = () => selectAnswer(option, button);

            // Keyboard support
            button.setAttribute('data-key', index + 1);

            if (typeof option === 'string' && option.startsWith('bg-')) {
                // Color option
                button.className = `puzzle-item ${option} hover:opacity-80 transition-opacity cursor-pointer`;
            } else if (typeof option === 'string') {
                // Shape or text option
                button.textContent = option;
            } else {
                // Number option
                button.textContent = option;
            }

            container.appendChild(button);
        });

        answerOptions.appendChild(container);
    }

    // Select Answer
    function selectAnswer(selectedAnswer, buttonElement) {
        if (timerInterval) {
            clearInterval(timerInterval);
        }

        // Null check qo'shish
        if (selectedAnswer === null || selectedAnswer === undefined) {
            // Vaqt tugaganda avtomatik noto'g'ri javob
            showTimeUpMessage();
            setTimeout(() => {
                currentPuzzleIndex++;
                startNextPuzzle();
            }, 2000);
            return;
        }

        const isCorrect = selectedAnswer === currentPuzzle.answer;
        const config = categoryConfig[currentCategory];

        // Disable all buttons
        document.querySelectorAll('#answerOptions button').forEach(btn => {
            btn.disabled = true;
            btn.style.pointerEvents = 'none';
        });

        if (isCorrect) {
            if (buttonElement) buttonElement.classList.add('correct');
            score += config.pointsPerPuzzle;
            correctAnswersCount++;
            categoryStats[currentCategory]++;
            showFloatingScore('+' + config.pointsPerPuzzle);
        } else {
            if (buttonElement) buttonElement.classList.add('incorrect');
            // Show correct answer
            document.querySelectorAll('#answerOptions button').forEach(btn => {
                const btnText = btn.textContent?.toString() || '';
                const answerText = currentPuzzle.answer?.toString() || '';

                if (btnText === answerText ||
                    (typeof currentPuzzle.answer === 'string' &&
                        currentPuzzle.answer.startsWith('bg-') &&
                        btn.classList.contains(currentPuzzle.answer.replace('bg-', '').replace('-400', '')))) {
                    btn.classList.add('correct');
                }
            });
        }

        // Show explanation
        showExplanation();

        // Update score display
        document.getElementById('currentScore').textContent = score;
        document.getElementById('totalScore').textContent = score;

        // Move to next puzzle after delay
        setTimeout(() => {
            currentPuzzleIndex++;
            startNextPuzzle();
        }, 3000);
    }

    function showTimeUpMessage() {
        const explanationSection = document.getElementById('explanationSection');
        const explanationText = document.getElementById('explanationText');

        explanationText.textContent = 'Vaqt tugadi! To\'g\'ri javob: ' + currentPuzzle.answer + '. ' + currentPuzzle.explanation;
        explanationSection.classList.remove('hidden');

        // Show correct answer
        document.querySelectorAll('#answerOptions button').forEach(btn => {
            const btnText = btn.textContent?.toString() || '';
            const answerText = currentPuzzle.answer?.toString() || '';

            if (btnText === answerText) {
                btn.classList.add('correct');
            }
            btn.disabled = true;
            btn.style.pointerEvents = 'none';
        });
    }

    function showExplanation() {
        const explanationSection = document.getElementById('explanationSection');
        const explanationText = document.getElementById('explanationText');

        explanationText.textContent = currentPuzzle.explanation;
        explanationSection.classList.remove('hidden');
    }

    // Hint System
    function useHint() {
        if (hintsUsed >= maxHints) return;

        hintsUsed++;
        updateHintsDisplay();
        updateHintButton();

        document.getElementById('hintText').textContent = currentPuzzle.hint;
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
        const config = categoryConfig[currentCategory];
        timeLeft = config.timeLimit;

        timerInterval = setInterval(() => {
            timeLeft--;
            updateTimerDisplay();

            if (timeLeft <= 0) {
                selectAnswer(null, null); // Auto-submit when time runs out
            }
        }, 1000);
    }

    function updateTimerDisplay() {
        document.getElementById('timeLeft').textContent = timeLeft;

        // Update timer circle
        const config = categoryConfig[currentCategory];
        const totalTime = config.timeLimit;
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

        const accuracy = Math.round((correctAnswersCount / totalPuzzles) * 100);

        // Update results
        document.getElementById('finalScore').textContent = score;
        document.getElementById('correctPuzzles').textContent = correctAnswersCount;
        document.getElementById('accuracy').textContent = accuracy + '%';

        // Update skills summary
        updateSkillsSummary();

        // Determine result message and emoji
        let emoji, title, message, badgeHtml = '';

        if (accuracy >= 90) {
            emoji = '🧠';
            title = 'Mantiq Ustasi!';
            message = 'Sizning mantiqiy fikrlashingiz ajoyib! Mukammal natija!';
            badgeHtml = '<div class="inline-block bg-orange-100 text-orange-800 px-4 py-2 rounded-full font-semibold"><i class="fas fa-brain mr-2"></i>Mantiq Chempioni</div>';
        } else if (accuracy >= 70) {
            emoji = '🎯';
            title = 'Ajoyib!';
            message = 'Mantiqiy masalalarni yaxshi yechdingiz! Davom eting!';
            badgeHtml = '<div class="inline-block bg-blue-100 text-blue-800 px-4 py-2 rounded-full font-semibold"><i class="fas fa-puzzle-piece mr-2"></i>Mantiq Yulduzi</div>';
        } else if (accuracy >= 50) {
            emoji = '🤔';
            title = 'Yaxshi!';
            message = 'Yaxshi harakat! Mantiqiy fikrlashni rivojlantirishda davom eting!';
            badgeHtml = '<div class="inline-block bg-green-100 text-green-800 px-4 py-2 rounded-full font-semibold"><i class="fas fa-lightbulb mr-2"></i>Mantiq O\'rganuvchi</div>';
        } else {
            emoji = '💪';
            title = 'Mashq Kerak!';
            message = 'Xafa bo\'lmang! Ko\'proq mashq qilsangiz, mantiqiy fikrlash yaxshiroq bo\'ladi!';
            badgeHtml = '<div class="inline-block bg-purple-100 text-purple-800 px-4 py-2 rounded-full font-semibold"><i class="fas fa-dumbbell mr-2"></i>Mashq Qiluvchi</div>';
        }

        document.getElementById('resultEmoji').textContent = emoji;
        document.getElementById('resultTitle').textContent = title;
        document.getElementById('resultMessage').textContent = message;
        document.getElementById('achievementBadge').innerHTML = badgeHtml;
    }

    function updateSkillsSummary() {
        const skillLevels = ['Boshlang\'ich', 'O\'rta', 'Yaxshi', 'A\'lo'];

        // Calculate skill levels based on performance
        const patternLevel = Math.min(Math.floor(categoryStats.pattern / 2), 3);
        const deductionLevel = Math.min(Math.floor(categoryStats.deduction / 2), 3);
        const numberLevel = Math.min(Math.floor(categoryStats.number / 3), 3);
        const spatialLevel = Math.min(Math.floor(categoryStats.spatial / 1), 3);

        document.getElementById('patternSkill').textContent = skillLevels[patternLevel];
        document.getElementById('deductionSkill').textContent = skillLevels[deductionLevel];
        document.getElementById('mathSkill').textContent = skillLevels[numberLevel];
        document.getElementById('spatialSkill').textContent = skillLevels[spatialLevel];
    }

    // Screen Navigation
    function showCategorySelection() {
        document.getElementById('categorySelection').classList.remove('hidden');
        document.getElementById('gameScreen').classList.add('hidden');
        document.getElementById('resultsScreen').classList.add('hidden');
        resetGame();
    }

    function showGameScreen() {
        document.getElementById('categorySelection').classList.add('hidden');
        document.getElementById('gameScreen').classList.remove('hidden');
        document.getElementById('resultsScreen').classList.add('hidden');
    }

    // Game Actions
    function playAgain() {
        resetGame();
        selectCategory(currentCategory);
    }

    function selectNewCategory() {
        showCategorySelection();
    }

    function resetGame() {
        currentPuzzleIndex = 0;
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
            const buttons = document.querySelectorAll('#answerOptions button');
            if (buttons[index] && !buttons[index].disabled) {
                buttons[index].click();
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
