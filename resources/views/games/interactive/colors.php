<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ranglar O'yini - Thinko.uz</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #ff9a9e 0%, #fecfef 50%, #fecfef 100%);
            min-height: 100vh;
        }

        .color-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .color-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        }

        .mode-btn {
            background: linear-gradient(135deg, #667eea, #764ba2);
            transition: all 0.3s ease;
            border-radius: 15px;
        }

        .mode-btn:hover {
            background: linear-gradient(135deg, #764ba2, #667eea);
            transform: translateY(-2px);
        }

        .color-circle {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            font-weight: bold;
            color: white;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.5);
            transition: all 0.3s ease;
            cursor: pointer;
            border: 4px solid transparent;
            position: relative;
        }

        .color-circle:hover {
            transform: scale(1.1);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
        }

        .color-circle.selected {
            border-color: #ffd700;
            transform: scale(1.15);
            box-shadow: 0 0 20px rgba(255, 215, 0, 0.6);
        }

        .color-circle.correct {
            border-color: #10b981;
            animation: correctPulse 0.6s ease;
        }

        .color-circle.incorrect {
            border-color: #ef4444;
            animation: incorrectShake 0.6s ease;
        }

        @keyframes correctPulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.3); }
            100% { transform: scale(1); }
        }

        @keyframes incorrectShake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-10px); }
            75% { transform: translateX(10px); }
        }

        .color-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
            gap: 20px;
            justify-content: center;
            padding: 20px;
        }

        .mixer-container {
            background: #f8fafc;
            border-radius: 20px;
            padding: 30px;
            margin: 20px 0;
        }

        .mixer-circle {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            border: 4px dashed #cbd5e1;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .mixer-circle.filled {
            border-style: solid;
            border-color: #10b981;
        }

        .drawing-canvas {
            border: 3px solid #e2e8f0;
            border-radius: 15px;
            cursor: crosshair;
            background: white;
        }

        .color-palette {
            display: flex;
            gap: 10px;
            justify-content: center;
            flex-wrap: wrap;
            margin: 20px 0;
        }

        .palette-color {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            cursor: pointer;
            border: 3px solid transparent;
            transition: all 0.3s ease;
        }

        .palette-color:hover {
            transform: scale(1.1);
        }

        .palette-color.active {
            border-color: #ffd700;
            transform: scale(1.2);
        }

        .sortable-item {
            width: 60px;
            height: 60px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            cursor: grab;
            transition: all 0.3s ease;
            border: 2px solid rgba(255,255,255,0.3);
        }

        .sortable-item:hover {
            transform: scale(1.05);
        }

        .sortable-item.dragging {
            opacity: 0.5;
            transform: rotate(5deg);
        }

        .drop-zone {
            min-height: 100px;
            border: 3px dashed #cbd5e1;
            border-radius: 15px;
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            padding: 15px;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .drop-zone.drag-over {
            border-color: #10b981;
            background: rgba(16, 185, 129, 0.1);
        }

        .progress-bar {
            background: linear-gradient(90deg, #667eea, #764ba2);
            border-radius: 10px;
            transition: width 0.5s ease;
        }

        .timer-circle {
            stroke-dasharray: 251;
            stroke-dashoffset: 251;
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

        .star-animation {
            animation: starTwinkle 0.6s ease-in-out;
        }

        @keyframes starTwinkle {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.5) rotate(180deg); }
        }

        .achievement-badge {
            background: linear-gradient(135deg, #ffd700, #ffed4e);
            color: #92400e;
            border-radius: 25px;
            padding: 8px 16px;
            font-weight: bold;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 4px 15px rgba(255, 215, 0, 0.3);
        }

        .pulse {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.7; }
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
                <h1 class="text-2xl font-bold text-white">Ranglar O'yini</h1>
            </div>
            <div class="flex items-center space-x-4">
                <div class="text-white text-center">
                    <div class="text-sm opacity-80">Ball</div>
                    <div class="text-xl font-bold" id="totalScore">0</div>
                </div>
                <div class="text-white text-center">
                    <div class="text-sm opacity-80">Yulduz</div>
                    <div class="text-xl font-bold" id="totalStars">0</div>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Main Content -->
<div class="container mx-auto px-4 py-8">

    <!-- Mode Selection Screen -->
    <div id="modeSelection" class="max-w-6xl mx-auto">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-white mb-4">Rang O'rganish Rejimini Tanlang</h2>
            <p class="text-white opacity-80">Ranglar bilan o'ynang va o'rganing!</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Learn Colors -->
            <div class="color-card p-6 text-center cursor-pointer" onclick="selectMode('learn')">
                <div class="text-6xl mb-4">🎨</div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Rang O'rganish</h3>
                <p class="text-gray-600 mb-4">Barcha ranglarni o'rganing</p>
                <div class="text-sm text-gray-500 mb-4">
                    <div>• 12 ta asosiy rang</div>
                    <div>• Tovushli talaffuz</div>
                    <div>• Misol narsalar</div>
                </div>
                <button class="mode-btn w-full py-3 text-white font-semibold">
                    Boshlash
                </button>
            </div>

            <!-- Find Colors -->
            <div class="color-card p-6 text-center cursor-pointer" onclick="selectMode('find')">
                <div class="text-6xl mb-4">🔍</div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Rang Topish</h3>
                <p class="text-gray-600 mb-4">Aytilgan rangni toping</p>
                <div class="text-sm text-gray-500 mb-4">
                    <div>• 10 ta savol</div>
                    <div>• Timer bilan</div>
                    <div>• Ball to'plash</div>
                </div>
                <button class="mode-btn w-full py-3 text-white font-semibold">
                    Boshlash
                </button>
            </div>

            <!-- Mix Colors -->
            <div class="color-card p-6 text-center cursor-pointer" onclick="selectMode('mix')">
                <div class="text-6xl mb-4">🧪</div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Rang Aralashtirish</h3>
                <p class="text-gray-600 mb-4">Ranglarni aralashtirib yangi rang oling</p>
                <div class="text-sm text-gray-500 mb-4">
                    <div>• Asosiy ranglar</div>
                    <div>• Interaktiv tajriba</div>
                    <div>• Ilmiy bilim</div>
                </div>
                <button class="mode-btn w-full py-3 text-white font-semibold">
                    Boshlash
                </button>
            </div>

            <!-- Color Drawing -->
            <div class="color-card p-6 text-center cursor-pointer" onclick="selectMode('draw')">
                <div class="text-6xl mb-4">🖍️</div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Ranglash</h3>
                <p class="text-gray-600 mb-4">Rasmlarni ranglang</p>
                <div class="text-sm text-gray-500 mb-4">
                    <div>• 6 ta turli rasm</div>
                    <div>• Brush tool</div>
                    <div>• Ijodkorlik</div>
                </div>
                <button class="mode-btn w-full py-3 text-white font-semibold">
                    Boshlash
                </button>
            </div>

            <!-- Sort Colors -->
            <div class="color-card p-6 text-center cursor-pointer" onclick="selectMode('sort')">
                <div class="text-6xl mb-4">📦</div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Rang Saralash</h3>
                <p class="text-gray-600 mb-4">Narsalarni rangi bo'yicha saralang</p>
                <div class="text-sm text-gray-500 mb-4">
                    <div>• Drag & drop</div>
                    <div>• Mantiqiy fikrlash</div>
                    <div>• Kategoriyalash</div>
                </div>
                <button class="mode-btn w-full py-3 text-white font-semibold">
                    Boshlash
                </button>
            </div>

            <!-- Color Quiz -->
            <div class="color-card p-6 text-center cursor-pointer" onclick="selectMode('quiz')">
                <div class="text-6xl mb-4">❓</div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Rang Viktorina</h3>
                <p class="text-gray-600 mb-4">Bilimingizni sinab ko'ring</p>
                <div class="text-sm text-gray-500 mb-4">
                    <div>• Aralash savollar</div>
                    <div>• Qiyinlik darajasi</div>
                    <div>• Mukofotlar</div>
                </div>
                <button class="mode-btn w-full py-3 text-white font-semibold">
                    Boshlash
                </button>
            </div>
        </div>
    </div>

    <!-- Learn Mode Screen -->
    <div id="learnScreen" class="hidden max-w-4xl mx-auto">
        <div class="color-card p-8 mb-6">
            <div class="text-center mb-6">
                <h3 class="text-2xl font-bold text-gray-800 mb-2">Ranglarni O'rganing</h3>
                <p class="text-gray-600">Har bir rangni bosing va eshiting</p>
            </div>

            <div class="color-grid" id="colorGrid">
                <!-- Colors will be populated by JavaScript -->
            </div>

            <div class="text-center mt-6">
                <button onclick="backToModes()" class="bg-gray-500 hover:bg-gray-600 px-6 py-3 text-white font-semibold rounded-lg transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i>Orqaga
                </button>
            </div>
        </div>
    </div>

    <!-- Find Mode Screen -->
    <div id="findScreen" class="hidden max-w-4xl mx-auto">
        <!-- Progress and Timer -->
        <div class="color-card p-6 mb-6">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center">
                    <div class="bg-purple-500 text-white rounded-full w-10 h-10 flex items-center justify-center font-bold mr-4" id="questionNumber">1</div>
                    <div>
                        <div class="text-sm text-gray-600">Savol</div>
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
                        <span class="text-lg font-bold text-gray-800" id="timeLeft">8</span>
                    </div>
                </div>
            </div>

            <!-- Progress Bar -->
            <div class="w-full bg-gray-200 rounded-full h-3">
                <div class="progress-bar h-3 rounded-full" id="progressBar" style="width: 0%"></div>
            </div>
        </div>

        <!-- Question Card -->
        <div class="color-card p-8 mb-6">
            <div class="text-center mb-6">
                <h3 class="text-2xl font-bold text-gray-800 mb-4" id="questionText">Quyidagi rangni toping:</h3>
                <div class="text-4xl font-bold text-purple-600" id="colorName">Qizil</div>
            </div>

            <div class="color-grid" id="findColorGrid">
                <!-- Color options will be populated by JavaScript -->
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

    <!-- Mix Mode Screen -->
    <div id="mixScreen" class="hidden max-w-4xl mx-auto">
        <div class="color-card p-8 mb-6">
            <div class="text-center mb-6">
                <h3 class="text-2xl font-bold text-gray-800 mb-2">Rang Aralashtirish</h3>
                <p class="text-gray-600">Ikki rangni tanlang va natijani ko'ring</p>
            </div>

            <div class="mixer-container">
                <div class="flex items-center justify-center gap-8 mb-8">
                    <div class="text-center">
                        <div class="mixer-circle" id="mixer1" onclick="selectMixerColor(1)">
                            <span class="text-gray-400">?</span>
                        </div>
                        <p class="mt-2 text-sm text-gray-600">Birinchi rang</p>
                    </div>

                    <div class="text-4xl text-gray-400">+</div>

                    <div class="text-center">
                        <div class="mixer-circle" id="mixer2" onclick="selectMixerColor(2)">
                            <span class="text-gray-400">?</span>
                        </div>
                        <p class="mt-2 text-sm text-gray-600">Ikkinchi rang</p>
                    </div>

                    <div class="text-4xl text-gray-400">=</div>

                    <div class="text-center">
                        <div class="mixer-circle" id="mixResult">
                            <span class="text-gray-400">?</span>
                        </div>
                        <p class="mt-2 text-sm text-gray-600">Natija</p>
                    </div>
                </div>

                <div class="text-center mb-6">
                    <button onclick="mixColors()" id="mixBtn" class="bg-purple-500 hover:bg-purple-600 px-8 py-3 text-white font-semibold rounded-lg transition-colors disabled:opacity-50" disabled>
                        <i class="fas fa-flask mr-2"></i>Aralashtirish
                    </button>
                </div>

                <div class="color-grid" id="mixColorGrid">
                    <!-- Colors for mixing will be populated by JavaScript -->
                </div>
            </div>

            <div class="text-center">
                <button onclick="backToModes()" class="bg-gray-500 hover:bg-gray-600 px-6 py-3 text-white font-semibold rounded-lg transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i>Orqaga
                </button>
            </div>
        </div>
    </div>

    <!-- Draw Mode Screen -->
    <div id="drawScreen" class="hidden max-w-4xl mx-auto">
        <div class="color-card p-8 mb-6">
            <div class="text-center mb-6">
                <h3 class="text-2xl font-bold text-gray-800 mb-2">Ranglash</h3>
                <p class="text-gray-600">Rasmni ranglang</p>
            </div>

            <!-- Color Palette -->
            <div class="color-palette" id="colorPalette">
                <!-- Palette colors will be populated by JavaScript -->
            </div>

            <!-- Drawing Canvas -->
            <div class="text-center mb-6">
                <canvas id="drawingCanvas" class="drawing-canvas" width="400" height="300"></canvas>
            </div>

            <!-- Drawing Controls -->
            <div class="flex justify-center gap-4 mb-6">
                <button onclick="clearCanvas()" class="bg-red-500 hover:bg-red-600 px-4 py-2 text-white rounded-lg transition-colors">
                    <i class="fas fa-eraser mr-2"></i>Tozalash
                </button>
                <button onclick="saveDrawing()" class="bg-green-500 hover:bg-green-600 px-4 py-2 text-white rounded-lg transition-colors">
                    <i class="fas fa-save mr-2"></i>Saqlash
                </button>
                <button onclick="loadTemplate()" class="bg-blue-500 hover:bg-blue-600 px-4 py-2 text-white rounded-lg transition-colors">
                    <i class="fas fa-image mr-2"></i>Shablon
                </button>
            </div>

            <div class="text-center">
                <button onclick="backToModes()" class="bg-gray-500 hover:bg-gray-600 px-6 py-3 text-white font-semibold rounded-lg transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i>Orqaga
                </button>
            </div>
        </div>
    </div>

    <!-- Sort Mode Screen -->
    <div id="sortScreen" class="hidden max-w-4xl mx-auto">
        <div class="color-card p-8 mb-6">
            <div class="text-center mb-6">
                <h3 class="text-2xl font-bold text-gray-800 mb-2">Rang Saralash</h3>
                <p class="text-gray-600">Narsalarni to'g'ri rang guruhiga sudrab olib boring</p>
            </div>

            <!-- Items to Sort -->
            <div class="mb-8">
                <h4 class="text-lg font-semibold text-gray-700 mb-4 text-center">Saralanishi kerak bo'lgan narsalar:</h4>
                <div class="flex flex-wrap justify-center gap-4" id="sortableItems">
                    <!-- Sortable items will be populated by JavaScript -->
                </div>
            </div>

            <!-- Drop Zones -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4" id="dropZones">
                <!-- Drop zones will be populated by JavaScript -->
            </div>

            <div class="text-center mt-6">
                <button onclick="checkSorting()" id="checkSortBtn" class="bg-green-500 hover:bg-green-600 px-6 py-3 text-white font-semibold rounded-lg transition-colors">
                    <i class="fas fa-check mr-2"></i>Tekshirish
                </button>
                <button onclick="resetSorting()" class="bg-yellow-500 hover:bg-yellow-600 px-6 py-3 text-white font-semibold rounded-lg transition-colors ml-4">
                    <i class="fas fa-redo mr-2"></i>Qayta boshlash
                </button>
            </div>

            <div class="text-center mt-4">
                <button onclick="backToModes()" class="bg-gray-500 hover:bg-gray-600 px-6 py-3 text-white font-semibold rounded-lg transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i>Orqaga
                </button>
            </div>
        </div>
    </div>

    <!-- Results Screen -->
    <div id="resultsScreen" class="hidden max-w-2xl mx-auto text-center">
        <div class="color-card p-8">
            <div class="text-6xl mb-6" id="resultEmoji">🌈</div>
            <h2 class="text-3xl font-bold text-gray-800 mb-4" id="resultTitle">Ajoyib!</h2>
            <p class="text-gray-600 mb-6" id="resultMessage">Siz ranglar bilan juda yaxshi ishladingiz!</p>

            <!-- Score Details -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                <div class="bg-purple-50 p-4 rounded-lg">
                    <div class="text-2xl font-bold text-purple-600" id="finalScore">100</div>
                    <div class="text-sm text-gray-600">Jami Ball</div>
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

            <!-- Achievement Badge -->
            <div class="mb-8" id="achievementBadge">
                <!-- Badge will be populated by JavaScript -->
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <button onclick="playAgain()" class="mode-btn px-8 py-3 text-white font-semibold">
                    <i class="fas fa-redo mr-2"></i>Qayta O'ynash
                </button>
                <button onclick="selectNewMode()" class="bg-gray-500 hover:bg-gray-600 px-8 py-3 text-white font-semibold rounded-lg transition-colors">
                    <i class="fas fa-list mr-2"></i>Boshqa Rejim
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
    +10
</div>

<script>
    // Game State
    let currentMode = '';
    let currentQuestion = 0;
    let totalQuestions = 10;
    let score = 0;
    let stars = 0;
    let correctAnswersCount = 0;
    let timeLeft = 8;
    let timerInterval = null;
    let selectedMixerSlot = 0;
    let mixerColors = { 1: null, 2: null };
    let currentDrawingColor = '#ff0000';
    let isDrawing = false;

    // Colors Data
    const colors = [
        { name: 'Qizil', color: '#ff0000', examples: ['Olma', 'Qon', 'Atirgul'] },
        { name: 'Ko\'k', color: '#0000ff', examples: ['Osmon', 'Dengiz', 'Muz'] },
        { name: 'Yashil', color: '#00ff00', examples: ['O\'t', 'Daraxt', 'Beda'] },
        { name: 'Sariq', color: '#ffff00', examples: ['Quyosh', 'Banan', 'Limon'] },
        { name: 'To\'q sariq', color: '#ffa500', examples: ['Apelsin', 'Sabzi', 'Kuz bargi'] },
        { name: 'Binafsha', color: '#800080', examples: ['Beda gul', 'Uzum', 'Lavanda'] },
        { name: 'Pushti', color: '#ffc0cb', examples: ['Atirgul', 'Flamingo', 'Sakura'] },
        { name: 'Jigarrang', color: '#8b4513', examples: ['Tuproq', 'Yog\'och', 'Shokolad'] },
        { name: 'Qora', color: '#000000', examples: ['Kecha', 'Ko\'mir', 'Soya'] },
        { name: 'Oq', color: '#ffffff', examples: ['Qor', 'Sut', 'Bulut'] },
        { name: 'Kulrang', color: '#808080', examples: ['Bulut', 'Tosh', 'Fil'] },
        { name: 'Moviy', color: '#87ceeb', examples: ['Dengiz', 'Muz', 'Osmon'] }
    ];

    // Color mixing rules
    const colorMixing = {
        'Qizil+Sariq': { result: 'To\'q sariq', color: '#ffa500' },
        'Sariq+Qizil': { result: 'To\'q sariq', color: '#ffa500' },
        'Ko\'k+Sariq': { result: 'Yashil', color: '#00ff00' },
        'Sariq+Ko\'k': { result: 'Yashil', color: '#00ff00' },
        'Qizil+Ko\'k': { result: 'Binafsha', color: '#800080' },
        'Ko\'k+Qizil': { result: 'Binafsha', color: '#800080' },
        'Qizil+Oq': { result: 'Pushti', color: '#ffc0cb' },
        'Oq+Qizil': { result: 'Pushti', color: '#ffc0cb' },
        'Qora+Oq': { result: 'Kulrang', color: '#808080' },
        'Oq+Qora': { result: 'Kulrang', color: '#808080' }
    };

    // Sortable items for sorting game
    const sortableItems = [
        { name: '🍎', color: 'Qizil', group: 'red' },
        { name: '🍌', color: 'Sariq', group: 'yellow' },
        { name: '🍇', color: 'Binafsha', group: 'purple' },
        { name: '🍊', color: 'To\'q sariq', group: 'orange' },
        { name: '🍓', color: 'Qizil', group: 'red' },
        { name: '🌻', color: 'Sariq', group: 'yellow' },
        { name: '🍆', color: 'Binafsha', group: 'purple' },
        { name: '🥕', color: 'To\'q sariq', group: 'orange' }
    ];

    // Initialize
    document.addEventListener('DOMContentLoaded', function() {
        showModeSelection();
        updateScoreDisplay();
    });

    // Mode Selection
    function selectMode(mode) {
        currentMode = mode;

        switch(mode) {
            case 'learn':
                showLearnMode();
                break;
            case 'find':
                showFindMode();
                break;
            case 'mix':
                showMixMode();
                break;
            case 'draw':
                showDrawMode();
                break;
            case 'sort':
                showSortMode();
                break;
            case 'quiz':
                showFindMode(); // Quiz uses same as find for now
                break;
        }
    }

    // Show Learn Mode
    function showLearnMode() {
        document.getElementById('modeSelection').classList.add('hidden');
        document.getElementById('learnScreen').classList.remove('hidden');

        const colorGrid = document.getElementById('colorGrid');
        colorGrid.innerHTML = '';

        colors.forEach((colorData, index) => {
            const colorDiv = document.createElement('div');
            colorDiv.className = 'text-center';
            colorDiv.innerHTML = `
                <div class="color-circle" style="background-color: ${colorData.color}; ${colorData.color === '#ffffff' ? 'border: 2px solid #ccc;' : ''}"
                     onclick="speakColor('${colorData.name}', ${index})">
                    ${colorData.name}
                </div>
                <div class="mt-2 text-sm text-gray-600">${colorData.examples.join(', ')}</div>
            `;
            colorGrid.appendChild(colorDiv);
        });
    }

    // Show Find Mode
    function showFindMode() {
        document.getElementById('modeSelection').classList.add('hidden');
        document.getElementById('findScreen').classList.remove('hidden');

        currentQuestion = 0;
        score = 0;
        correctAnswersCount = 0;

        startNextQuestion();
    }

    // Start Next Question
    function startNextQuestion() {
        if (currentQuestion >= totalQuestions) {
            endGame();
            return;
        }

        currentQuestion++;
        updateQuestionUI();
        generateQuestion();
        startTimer();
    }

    // Update Question UI
    function updateQuestionUI() {
        document.getElementById('questionNumber').textContent = currentQuestion;
        document.getElementById('questionProgress').textContent = `${currentQuestion} / ${totalQuestions}`;

        const progress = (currentQuestion / totalQuestions) * 100;
        document.getElementById('progressBar').style.width = progress + '%';
    }

    // Generate Question
    function generateQuestion() {
        const correctColor = colors[Math.floor(Math.random() * colors.length)];
        const wrongColors = colors.filter(c => c !== correctColor)
            .sort(() => Math.random() - 0.5)
            .slice(0, 3);

        const allOptions = [correctColor, ...wrongColors].sort(() => Math.random() - 0.5);

        document.getElementById('colorName').textContent = correctColor.name;
        speakText(correctColor.name);

        const colorGrid = document.getElementById('findColorGrid');
        colorGrid.innerHTML = '';

        allOptions.forEach(colorData => {
            const colorDiv = document.createElement('div');
            colorDiv.className = 'text-center';
            colorDiv.innerHTML = `
                <div class="color-circle" style="background-color: ${colorData.color}; ${colorData.color === '#ffffff' ? 'border: 2px solid #ccc;' : ''}"
                     onclick="selectAnswer('${colorData.name}', '${correctColor.name}', this)">
                </div>
            `;
            colorGrid.appendChild(colorDiv);
        });
    }

    // Select Answer
    function selectAnswer(selectedColor, correctColor, element) {
        if (timerInterval) {
            clearInterval(timerInterval);
        }

        const isCorrect = selectedColor === correctColor;

        // Disable all options
        document.querySelectorAll('#findColorGrid .color-circle').forEach(circle => {
            circle.style.pointerEvents = 'none';
        });

        if (isCorrect) {
            element.classList.add('correct');
            score += 10;
            correctAnswersCount++;
            stars++;
            showFloatingScore('+10');
            speakText('To\'g\'ri!');
        } else {
            element.classList.add('incorrect');
            speakText('Noto\'g\'ri. To\'g\'ri javob: ' + correctColor);

            // Show correct answer
            document.querySelectorAll('#findColorGrid .color-circle').forEach(circle => {
                const colorName = colors.find(c => c.color === circle.style.backgroundColor.replace(/[^\d,]/g, '').split(',').map(n => parseInt(n)).map(n => n.toString(16).padStart(2, '0')).join(''));
                if (colorName && colorName.name === correctColor) {
                    circle.classList.add('correct');
                }
            });
        }

        updateScoreDisplay();

        setTimeout(() => {
            startNextQuestion();
        }, 2000);
    }

    // Show Mix Mode
    function showMixMode() {
        document.getElementById('modeSelection').classList.add('hidden');
        document.getElementById('mixScreen').classList.remove('hidden');

        const mixColorGrid = document.getElementById('mixColorGrid');
        mixColorGrid.innerHTML = '';

        // Show only primary colors for mixing
        const primaryColors = colors.filter(c => ['Qizil', 'Ko\'k', 'Sariq', 'Oq', 'Qora'].includes(c.name));

        primaryColors.forEach(colorData => {
            const colorDiv = document.createElement('div');
            colorDiv.className = 'text-center';
            colorDiv.innerHTML = `
                <div class="color-circle" style="background-color: ${colorData.color}; ${colorData.color === '#ffffff' ? 'border: 2px solid #ccc;' : ''}"
                     onclick="selectColorForMixing('${colorData.name}', '${colorData.color}')">
                    ${colorData.name}
                </div>
            `;
            mixColorGrid.appendChild(colorDiv);
        });

        resetMixer();
    }

    // Select Mixer Color
    function selectMixerColor(slot) {
        selectedMixerSlot = slot;
        document.querySelectorAll('.mixer-circle').forEach(circle => {
            circle.style.borderColor = '#cbd5e1';
        });
        document.getElementById(`mixer${slot}`).style.borderColor = '#ffd700';
    }

    // Select Color for Mixing
    function selectColorForMixing(colorName, colorValue) {
        if (selectedMixerSlot === 0) {
            speakText('Avval birinchi yoki ikkinchi joyni tanlang');
            return;
        }

        mixerColors[selectedMixerSlot] = { name: colorName, color: colorValue };

        const mixerElement = document.getElementById(`mixer${selectedMixerSlot}`);
        mixerElement.style.backgroundColor = colorValue;
        mixerElement.innerHTML = colorName;
        mixerElement.classList.add('filled');

        selectedMixerSlot = 0;
        document.querySelectorAll('.mixer-circle').forEach(circle => {
            circle.style.borderColor = '#cbd5e1';
        });

        // Enable mix button if both colors selected
        if (mixerColors[1] && mixerColors[2]) {
            document.getElementById('mixBtn').disabled = false;
        }
    }

    // Mix Colors
    function mixColors() {
        const color1 = mixerColors[1].name;
        const color2 = mixerColors[2].name;
        const mixKey = `${color1}+${color2}`;

        const result = colorMixing[mixKey];
        const resultElement = document.getElementById('mixResult');

        if (result) {
            resultElement.style.backgroundColor = result.color;
            resultElement.innerHTML = result.result;
            resultElement.classList.add('filled');
            speakText(`${color1} va ${color2} aralashtirilsa ${result.result} hosil bo'ladi`);

            // Add score and stars
            score += 15;
            stars++;
            showFloatingScore('+15');
            updateScoreDisplay();
        } else {
            resultElement.style.backgroundColor = '#666';
            resultElement.innerHTML = 'Noma\'lum';
            speakText('Bu ranglar aralashtirilmaydi');
        }

        setTimeout(() => {
            resetMixer();
        }, 3000);
    }

    // Reset Mixer
    function resetMixer() {
        mixerColors = { 1: null, 2: null };
        selectedMixerSlot = 0;

        document.querySelectorAll('.mixer-circle').forEach(circle => {
            circle.style.backgroundColor = '';
            circle.style.borderColor = '#cbd5e1';
            circle.innerHTML = '<span class="text-gray-400">?</span>';
            circle.classList.remove('filled');
        });

        document.getElementById('mixBtn').disabled = true;
    }

    // Show Draw Mode
    function showDrawMode() {
        document.getElementById('modeSelection').classList.add('hidden');
        document.getElementById('drawScreen').classList.remove('hidden');

        setupCanvas();
        setupColorPalette();
    }

    // Setup Canvas
    function setupCanvas() {
        const canvas = document.getElementById('drawingCanvas');
        const ctx = canvas.getContext('2d');

        // Clear canvas
        ctx.fillStyle = 'white';
        ctx.fillRect(0, 0, canvas.width, canvas.height);

        // Mouse events
        canvas.addEventListener('mousedown', startDrawing);
        canvas.addEventListener('mousemove', draw);
        canvas.addEventListener('mouseup', stopDrawing);
        canvas.addEventListener('mouseout', stopDrawing);

        // Touch events
        canvas.addEventListener('touchstart', handleTouch);
        canvas.addEventListener('touchmove', handleTouch);
        canvas.addEventListener('touchend', stopDrawing);
    }

    // Setup Color Palette
    function setupColorPalette() {
        const palette = document.getElementById('colorPalette');
        palette.innerHTML = '';

        colors.forEach((colorData, index) => {
            const colorDiv = document.createElement('div');
            colorDiv.className = `palette-color ${index === 0 ? 'active' : ''}`;
            colorDiv.style.backgroundColor = colorData.color;
            colorDiv.style.border = colorData.color === '#ffffff' ? '2px solid #ccc' : '2px solid transparent';
            colorDiv.onclick = () => selectDrawingColor(colorData.color, colorDiv);
            palette.appendChild(colorDiv);
        });
    }

    // Select Drawing Color
    function selectDrawingColor(color, element) {
        currentDrawingColor = color;
        document.querySelectorAll('.palette-color').forEach(el => el.classList.remove('active'));
        element.classList.add('active');
    }

    // Drawing Functions
    function startDrawing(e) {
        isDrawing = true;
        draw(e);
    }

    function draw(e) {
        if (!isDrawing) return;

        const canvas = document.getElementById('drawingCanvas');
        const ctx = canvas.getContext('2d');
        const rect = canvas.getBoundingClientRect();

        const x = e.clientX - rect.left;
        const y = e.clientY - rect.top;

        ctx.fillStyle = currentDrawingColor;
        ctx.beginPath();
        ctx.arc(x, y, 5, 0, Math.PI * 2);
        ctx.fill();
    }

    function stopDrawing() {
        isDrawing = false;
    }

    function handleTouch(e) {
        e.preventDefault();
        const touch = e.touches[0];
        const mouseEvent = new MouseEvent(e.type === 'touchstart' ? 'mousedown' : 'mousemove', {
            clientX: touch.clientX,
            clientY: touch.clientY
        });
        document.getElementById('drawingCanvas').dispatchEvent(mouseEvent);
    }

    // Canvas Controls
    function clearCanvas() {
        const canvas = document.getElementById('drawingCanvas');
        const ctx = canvas.getContext('2d');
        ctx.fillStyle = 'white';
        ctx.fillRect(0, 0, canvas.width, canvas.height);
    }

    function saveDrawing() {
        const canvas = document.getElementById('drawingCanvas');
        const link = document.createElement('a');
        link.download = 'mening-rasmim.png';
        link.href = canvas.toDataURL();
        link.click();

        score += 20;
        stars++;
        showFloatingScore('+20');
        updateScoreDisplay();
        speakText('Rasm saqlandi!');
    }

    function loadTemplate() {
        const canvas = document.getElementById('drawingCanvas');
        const ctx = canvas.getContext('2d');

        // Draw a simple template (house)
        ctx.fillStyle = 'white';
        ctx.fillRect(0, 0, canvas.width, canvas.height);

        ctx.strokeStyle = '#000';
        ctx.lineWidth = 2;

        // House outline
        ctx.beginPath();
        ctx.rect(150, 150, 100, 80);
        ctx.stroke();

        // Roof
        ctx.beginPath();
        ctx.moveTo(140, 150);
        ctx.lineTo(200, 100);
        ctx.lineTo(260, 150);
        ctx.stroke();

        // Door
        ctx.beginPath();
        ctx.rect(180, 190, 20, 40);
        ctx.stroke();

        // Window
        ctx.beginPath();
        ctx.rect(160, 170, 15, 15);
        ctx.stroke();

        speakText('Uyni ranglang!');
    }

    // Show Sort Mode
    function showSortMode() {
        document.getElementById('modeSelection').classList.add('hidden');
        document.getElementById('sortScreen').classList.remove('hidden');

        setupSortingGame();
    }

    // Setup Sorting Game
    function setupSortingGame() {
        const itemsContainer = document.getElementById('sortableItems');
        const dropZonesContainer = document.getElementById('dropZones');

        // Clear containers
        itemsContainer.innerHTML = '';
        dropZonesContainer.innerHTML = '';

        // Create sortable items
        const shuffledItems = [...sortableItems].sort(() => Math.random() - 0.5);
        shuffledItems.forEach((item, index) => {
            const itemDiv = document.createElement('div');
            itemDiv.className = 'sortable-item';
            itemDiv.draggable = true;
            itemDiv.dataset.group = item.group;
            itemDiv.dataset.color = item.color;
            itemDiv.innerHTML = item.name;
            itemDiv.style.backgroundColor = colors.find(c => c.name === item.color)?.color || '#ccc';

            itemDiv.addEventListener('dragstart', handleDragStart);
            itemDiv.addEventListener('dragend', handleDragEnd);

            itemsContainer.appendChild(itemDiv);
        });

        // Create drop zones
        const groups = ['red', 'yellow', 'purple', 'orange'];
        const groupNames = ['Qizil', 'Sariq', 'Binafsha', 'To\'q sariq'];
        const groupColors = ['#ff0000', '#ffff00', '#800080', '#ffa500'];

        groups.forEach((group, index) => {
            const dropZone = document.createElement('div');
            dropZone.className = 'drop-zone';
            dropZone.dataset.group = group;
            dropZone.innerHTML = `
                <div class="text-center w-full">
                    <div class="w-12 h-12 rounded-full mx-auto mb-2" style="background-color: ${groupColors[index]}"></div>
                    <div class="font-semibold text-gray-700">${groupNames[index]}</div>
                </div>
            `;

            dropZone.addEventListener('dragover', handleDragOver);
            dropZone.addEventListener('drop', handleDrop);

            dropZonesContainer.appendChild(dropZone);
        });
    }

    // Drag and Drop Handlers
    function handleDragStart(e) {
        e.dataTransfer.setData('text/plain', e.target.dataset.group);
        e.target.classList.add('dragging');
    }

    function handleDragEnd(e) {
        e.target.classList.remove('dragging');
    }

    function handleDragOver(e) {
        e.preventDefault();
        e.currentTarget.classList.add('drag-over');
    }

    function handleDrop(e) {
        e.preventDefault();
        e.currentTarget.classList.remove('drag-over');

        const draggedGroup = e.dataTransfer.getData('text/plain');
        const dropZoneGroup = e.currentTarget.dataset.group;
        const draggedElement = document.querySelector('.dragging');

        if (draggedElement) {
            e.currentTarget.appendChild(draggedElement);
            draggedElement.classList.remove('dragging');
        }
    }

    // Check Sorting
    function checkSorting() {
        const dropZones = document.querySelectorAll('.drop-zone');
        let correctCount = 0;
        let totalItems = 0;

        dropZones.forEach(zone => {
            const items = zone.querySelectorAll('.sortable-item');
            const zoneGroup = zone.dataset.group;

            items.forEach(item => {
                totalItems++;
                if (item.dataset.group === zoneGroup) {
                    correctCount++;
                    item.style.border = '3px solid #10b981';
                } else {
                    item.style.border = '3px solid #ef4444';
                }
            });
        });

        const accuracy = Math.round((correctCount / totalItems) * 100);
        const points = correctCount * 5;

        score += points;
        stars += Math.floor(correctCount / 2);
        updateScoreDisplay();

        if (accuracy === 100) {
            speakText('Ajoyib! Hammasi to\'g\'ri!');
            showFloatingScore(`+${points}`);
        } else {
            speakText(`${accuracy}% to'g'ri. Yana harakat qiling!`);
        }

        setTimeout(() => {
            if (accuracy === 100) {
                setupSortingGame(); // New round
            }
        }, 2000);
    }

    // Reset Sorting
    function resetSorting() {
        setupSortingGame();
    }

    // Timer Functions
    function startTimer() {
        timeLeft = 8;
        updateTimerDisplay();

        timerInterval = setInterval(() => {
            timeLeft--;
            updateTimerDisplay();

            if (timeLeft <= 0) {
                selectAnswer('', '', null); // Auto-submit when time runs out
            }
        }, 1000);
    }

    function updateTimerDisplay() {
        document.getElementById('timeLeft').textContent = timeLeft;

        const totalTime = 8;
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

    // Show Results Screen
    function showResultsScreen() {
        document.getElementById('findScreen').classList.add('hidden');
        document.getElementById('resultsScreen').classList.remove('hidden');

        const accuracy = Math.round((correctAnswersCount / totalQuestions) * 100);

        // Update results
        document.getElementById('finalScore').textContent = score;
        document.getElementById('correctAnswers').textContent = correctAnswersCount;
        document.getElementById('accuracy').textContent = accuracy + '%';

        // Determine result message and emoji
        let emoji, title, message, badgeHtml = '';

        if (accuracy >= 90) {
            emoji = '🌈';
            title = 'Rang Chempioni!';
            message = 'Siz ranglar ustasi ekansiz! Mukammal natija!';
            badgeHtml = '<div class="achievement-badge"><i class="fas fa-crown mr-2"></i>Rang Chempioni</div>';
        } else if (accuracy >= 70) {
            emoji = '⭐';
            title = 'Rang Ustasi!';
            message = 'Ranglarni yaxshi bilasiz! Davom eting!';
            badgeHtml = '<div class="achievement-badge"><i class="fas fa-star mr-2"></i>Rang Ustasi</div>';
        } else {
            emoji = '🎨';
            title = 'Rang O\'rganuvchi!';
            message = 'Yaxshi harakat! Ranglarni o\'rganishda davom eting!';
            badgeHtml = '<div class="achievement-badge"><i class="fas fa-palette mr-2"></i>Rang O\'rganuvchi</div>';
        }

        document.getElementById('resultEmoji').textContent = emoji;
        document.getElementById('resultTitle').textContent = title;
        document.getElementById('resultMessage').textContent = message;
        document.getElementById('achievementBadge').innerHTML = badgeHtml;
    }

    // Screen Navigation
    function showModeSelection() {
        document.getElementById('modeSelection').classList.remove('hidden');
        document.querySelectorAll('#learnScreen, #findScreen, #mixScreen, #drawScreen, #sortScreen, #resultsScreen').forEach(screen => {
            screen.classList.add('hidden');
        });
        resetGame();
    }

    function backToModes() {
        showModeSelection();
    }

    // Game Actions
    function playAgain() {
        resetGame();
        selectMode(currentMode);
    }

    function selectNewMode() {
        showModeSelection();
    }

    function resetGame() {
        currentQuestion = 0;
        score = 0;
        correctAnswersCount = 0;
        if (timerInterval) {
            clearInterval(timerInterval);
        }
        document.getElementById('currentScore').textContent = '0';
        updateScoreDisplay();
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
    function updateScoreDisplay() {
        document.getElementById('totalScore').textContent = score;
        document.getElementById('totalStars').textContent = stars;
        if (document.getElementById('currentScore')) {
            document.getElementById('currentScore').textContent = score;
        }
    }

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

    function speakColor(colorName, index) {
        const colorData = colors[index];
        speakText(`${colorName}. Masalan: ${colorData.examples.join(', ')}`);

        // Add visual feedback
        const colorCircle = event.target;
        colorCircle.classList.add('star-animation');
        setTimeout(() => {
            colorCircle.classList.remove('star-animation');
        }, 600);

        // Add score for learning
        score += 2;
        stars++;
        updateScoreDisplay();
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

    // Keyboard Support
    document.addEventListener('keydown', function(e) {
        if (document.getElementById('findScreen').classList.contains('hidden')) return;

        const key = e.key;
        if (key >= '1' && key <= '4') {
            const index = parseInt(key) - 1;
            const colorCircles = document.querySelectorAll('#findColorGrid .color-circle');
            if (colorCircles[index]) {
                colorCircles[index].click();
            }
        }
    });
</script>
</body>
</html>
