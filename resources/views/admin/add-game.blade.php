<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>O'yin Qo'shish - Thinko.uz Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Inter', sans-serif;
        }

        .admin-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .admin-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
        }

        .form-section {
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            transition: all 0.3s ease;
        }

        .form-section:hover {
            border-color: #667eea;
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.1);
        }

        .form-section.active {
            border-color: #667eea;
            background: rgba(102, 126, 234, 0.05);
        }

        .category-card {
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            padding: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            text-align: center;
        }

        .category-card:hover {
            border-color: #667eea;
            transform: translateY(-2px);
        }

        .category-card.selected {
            border-color: #667eea;
            background: rgba(102, 126, 234, 0.1);
        }

        .difficulty-badge {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .difficulty-easy { background: #10b981; color: white; }
        .difficulty-medium { background: #f59e0b; color: white; }
        .difficulty-hard { background: #ef4444; color: white; }

        .preview-card {
            border: 2px dashed #d1d5db;
            border-radius: 12px;
            padding: 2rem;
            text-align: center;
            background: #f9fafb;
            min-height: 200px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .step-indicator {
            display: flex;
            align-items: center;
            margin-bottom: 2rem;
        }

        .step {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            margin-right: 1rem;
            position: relative;
        }

        .step.active {
            background: #667eea;
            color: white;
        }

        .step.completed {
            background: #10b981;
            color: white;
        }

        .step.inactive {
            background: #e5e7eb;
            color: #6b7280;
        }

        .step::after {
            content: '';
            position: absolute;
            right: -20px;
            width: 20px;
            height: 2px;
            background: #e5e7eb;
        }

        .step.completed::after {
            background: #10b981;
        }

        .step:last-child::after {
            display: none;
        }

        .toggle-switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }

        .toggle-switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: .4s;
            border-radius: 34px;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
        }

        input:checked + .slider {
            background-color: #667eea;
        }

        input:checked + .slider:before {
            transform: translateX(26px);
        }
    </style>
</head>
<body class="min-h-screen bg-gradient-to-br from-indigo-500 to-purple-600">

<div class="min-h-screen p-6">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <div class="flex items-center">
            <a href="admin.html" class="text-white hover:text-gray-200 mr-4">
                <i class="fas fa-arrow-left text-xl"></i>
            </a>
            <div>
                <h1 class="text-3xl font-bold text-white">Yangi O'yin Yaratish</h1>
                <p class="text-white/80">Smart topshiriqlar va interaktiv o'yinlar uchun</p>
            </div>
        </div>
        <div class="flex space-x-3">
            <button onclick="saveAsDraft()" class="bg-white/20 text-white px-4 py-2 rounded-lg hover:bg-white/30 transition-colors">
                <i class="fas fa-save mr-2"></i>Qoralama Saqlash
            </button>
            <button onclick="previewGame()" class="bg-white/20 text-white px-4 py-2 rounded-lg hover:bg-white/30 transition-colors">
                <i class="fas fa-eye mr-2"></i>Ko'rib Chiqish
            </button>
        </div>
    </div>

    <!-- Step Indicator -->
    <div class="admin-card p-6 mb-6">
        <div class="step-indicator">
            <div class="step active" id="step1">1</div>
            <div class="step inactive" id="step2">2</div>
            <div class="step inactive" id="step3">3</div>
            <div class="step inactive" id="step4">4</div>
            <div class="step inactive" id="step5">5</div>
        </div>
        <div class="text-sm text-gray-600">
            <span id="stepText">1-qadam: O'yin turini tanlang</span>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Form -->
        <div class="lg:col-span-2">
            <!-- Step 1: Game Type Selection -->
            <div id="gameTypeStep" class="step-content">
                <div class="admin-card p-6 mb-6">
                    <h2 class="text-2xl font-bold mb-6 text-gray-800">O'yin Turini Tanlang</h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                        <div class="category-card" onclick="selectGameType('smart-task')">
                            <div class="text-4xl mb-3">🧠</div>
                            <h3 class="text-lg font-bold">Smart Topshiriq</h3>
                            <p class="text-sm text-gray-600 mt-2">Matematik, mantiqiy va bilim topshiriqlari</p>
                        </div>
                        <div class="category-card" onclick="selectGameType('interactive-game')">
                            <div class="text-4xl mb-3">🎮</div>
                            <h3 class="text-lg font-bold">Interaktiv O'yin</h3>
                            <p class="text-sm text-gray-600 mt-2">Ijodiy va ko'ngilochar o'yinlar</p>
                        </div>
                    </div>

                    <div id="categorySelection" class="hidden">
                        <h3 class="text-xl font-bold mb-4">Kategoriyani Tanlang</h3>
                        <div id="smartTaskCategories" class="hidden grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="category-card" onclick="selectCategory('math')">
                                <div class="text-3xl mb-2">🔢</div>
                                <h4 class="font-semibold">Matematik</h4>
                            </div>
                            <div class="category-card" onclick="selectCategory('logic')">
                                <div class="text-3xl mb-2">🧩</div>
                                <h4 class="font-semibold">Mantiq</h4>
                            </div>
                            <div class="category-card" onclick="selectCategory('memory')">
                                <div class="text-3xl mb-2">🧠</div>
                                <h4 class="font-semibold">Xotira</h4>
                            </div>
                            <div class="category-card" onclick="selectCategory('language')">
                                <div class="text-3xl mb-2">📚</div>
                                <h4 class="font-semibold">Til</h4>
                            </div>
                            <div class="category-card" onclick="selectCategory('science')">
                                <div class="text-3xl mb-2">🔬</div>
                                <h4 class="font-semibold">Fan</h4>
                            </div>
                            <div class="category-card" onclick="selectCategory('geography')">
                                <div class="text-3xl mb-2">🌍</div>
                                <h4 class="font-semibold">Geografiya</h4>
                            </div>
                        </div>
                        <div id="interactiveGameCategories" class="hidden grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="category-card" onclick="selectCategory('drawing')">
                                <div class="text-3xl mb-2">🎨</div>
                                <h4 class="font-semibold">Rasm Chizish</h4>
                            </div>
                            <div class="category-card" onclick="selectCategory('music')">
                                <div class="text-3xl mb-2">🎵</div>
                                <h4 class="font-semibold">Musiqa</h4>
                            </div>
                            <div class="category-card" onclick="selectCategory('puzzle')">
                                <div class="text-3xl mb-2">🧩</div>
                                <h4 class="font-semibold">Puzzle</h4>
                            </div>
                            <div class="category-card" onclick="selectCategory('adventure')">
                                <div class="text-3xl mb-2">🗺️</div>
                                <h4 class="font-semibold">Sarguzasht</h4>
                            </div>
                            <div class="category-card" onclick="selectCategory('simulation')">
                                <div class="text-3xl mb-2">🏗️</div>
                                <h4 class="font-semibold">Simulyatsiya</h4>
                            </div>
                            <div class="category-card" onclick="selectCategory('strategy')">
                                <div class="text-3xl mb-2">♟️</div>
                                <h4 class="font-semibold">Strategiya</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Step 2: Basic Information -->
            <div id="basicInfoStep" class="step-content hidden">
                <div class="admin-card p-6 mb-6">
                    <h2 class="text-2xl font-bold mb-6 text-gray-800">Asosiy Ma'lumotlar</h2>

                    <div class="form-section">
                        <h3 class="text-lg font-semibold mb-4">O'yin Nomi va Tavsifi</h3>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium mb-2">O'yin Nomi *</label>
                                <input type="text" id="gameName" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" placeholder="Masalan: Matematik Sarguzasht">
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-2">Qisqa Tavsif *</label>
                                <textarea id="gameDescription" rows="3" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" placeholder="O'yin haqida qisqacha ma'lumot..."></textarea>
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-2">Batafsil Tavsif</label>
                                <textarea id="gameDetailedDescription" rows="5" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" placeholder="O'yin qoidalari va batafsil ma'lumot..."></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="form-section">
                        <h3 class="text-lg font-semibold mb-4">Yosh Guruhi va Qiyinlik</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium mb-2">Yosh Oralig'i *</label>
                                <div class="flex space-x-3">
                                    <select id="minAge" class="flex-1 p-3 border rounded-lg focus:ring-2 focus:ring-indigo-500">
                                        <option value="">Min yosh</option>
                                        <option value="3">3 yosh</option>
                                        <option value="4">4 yosh</option>
                                        <option value="5">5 yosh</option>
                                        <option value="6">6 yosh</option>
                                        <option value="7">7 yosh</option>
                                        <option value="8">8 yosh</option>
                                        <option value="9">9 yosh</option>
                                        <option value="10">10 yosh</option>
                                        <option value="11">11 yosh</option>
                                        <option value="12">12 yosh</option>
                                        <option value="13">13 yosh</option>
                                        <option value="14">14 yosh</option>
                                        <option value="15">15 yosh</option>
                                        <option value="16">16 yosh</option>
                                    </select>
                                    <span class="flex items-center">-</span>
                                    <select id="maxAge" class="flex-1 p-3 border rounded-lg focus:ring-2 focus:ring-indigo-500">
                                        <option value="">Max yosh</option>
                                        <option value="4">4 yosh</option>
                                        <option value="5">5 yosh</option>
                                        <option value="6">6 yosh</option>
                                        <option value="7">7 yosh</option>
                                        <option value="8">8 yosh</option>
                                        <option value="9">9 yosh</option>
                                        <option value="10">10 yosh</option>
                                        <option value="11">11 yosh</option>
                                        <option value="12">12 yosh</option>
                                        <option value="13">13 yosh</option>
                                        <option value="14">14 yosh</option>
                                        <option value="15">15 yosh</option>
                                        <option value="16">16 yosh</option>
                                        <option value="18">18 yosh</option>
                                    </select>
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-2">Qiyinlik Darajasi *</label>
                                <div class="flex space-x-2">
                                    <span class="difficulty-badge difficulty-easy" onclick="selectDifficulty('easy')">Oson</span>
                                    <span class="difficulty-badge difficulty-medium" onclick="selectDifficulty('medium')">O'rta</span>
                                    <span class="difficulty-badge difficulty-hard" onclick="selectDifficulty('hard')">Qiyin</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Step 3: Game Content -->
            <div id="gameContentStep" class="step-content hidden">
                <div class="admin-card p-6 mb-6">
                    <h2 class="text-2xl font-bold mb-6 text-gray-800">O'yin Mazmuni</h2>

                    <div class="form-section">
                        <h3 class="text-lg font-semibold mb-4">Vizual Elementlar</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium mb-2">O'yin Rasmi</label>
                                <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center">
                                    <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-2"></i>
                                    <p class="text-gray-600">Rasm yuklash uchun bosing</p>
                                    <input type="file" class="hidden" accept="image/*">
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-2">Qo'shimcha Rasmlar</label>
                                <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center">
                                    <i class="fas fa-images text-3xl text-gray-400 mb-2"></i>
                                    <p class="text-gray-600">Ko'p rasm yuklash</p>
                                    <input type="file" class="hidden" accept="image/*" multiple>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-section">
                        <h3 class="text-lg font-semibold mb-4">O'yin Qoidalari va Ko'rsatmalar</h3>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium mb-2">O'yin Qoidalari *</label>
                                <textarea id="gameRules" rows="4" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" placeholder="O'yin qoidalarini batafsil yozing..."></textarea>
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-2">Boshlash Ko'rsatmalari</label>
                                <textarea id="gameInstructions" rows="3" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" placeholder="Foydalanuvchi uchun boshlash ko'rsatmalari..."></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="form-section" id="smartTaskContent" style="display: none;">
                        <h3 class="text-lg font-semibold mb-4">Smart Topshiriq Mazmuni</h3>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium mb-2">Savollar Soni</label>
                                <input type="number" id="questionCount" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" placeholder="10" min="1" max="100">
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-2">Vaqt Chegarasi (daqiqa)</label>
                                <input type="number" id="timeLimit" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" placeholder="15" min="1" max="120">
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-2">O'tish Bali (%)</label>
                                <input type="number" id="passingScore" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" placeholder="70" min="1" max="100">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Step 4: Rewards and Settings -->
            <div id="rewardsStep" class="step-content hidden">
                <div class="admin-card p-6 mb-6">
                    <h2 class="text-2xl font-bold mb-6 text-gray-800">Mukofotlar va Sozlamalar</h2>

                    <div class="form-section">
                        <h3 class="text-lg font-semibold mb-4">Mukofot Tizimi</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label class="block text-sm font-medium mb-2">Asosiy Mukofot (coin)</label>
                                <input type="number" id="baseReward" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" placeholder="25" min="1">
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-2">Bonus Mukofot (coin)</label>
                                <input type="number" id="bonusReward" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" placeholder="10" min="0">
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-2">Maksimal Mukofot (coin)</label>
                                <input type="number" id="maxReward" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" placeholder="50" min="1">
                            </div>
                        </div>
                        <div class="mt-4">
                            <label class="block text-sm font-medium mb-2">Badge Mukofoti</label>
                            <select id="badgeReward" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="">Badge tanlamang</option>
                                <option value="math-master">Matematik Usta</option>
                                <option value="logic-genius">Mantiq Dahisi</option>
                                <option value="creative-artist">Ijodiy Rassom</option>
                                <option value="puzzle-solver">Puzzle Yechuvchi</option>
                                <option value="quick-thinker">Tez Fikrlovchi</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-section">
                        <h3 class="text-lg font-semibold mb-4">O'yin Sozlamalari</h3>
                        <div class="space-y-4">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h4 class="font-medium">Takrorlash Imkoniyati</h4>
                                    <p class="text-sm text-gray-600">Foydalanuvchi o'yinni qayta o'ynay oladimi?</p>
                                </div>
                                <label class="toggle-switch">
                                    <input type="checkbox" id="allowReplay">
                                    <span class="slider"></span>
                                </label>
                            </div>
                            <div class="flex items-center justify-between">
                                <div>
                                    <h4 class="font-medium">Vaqt Chegarasi</h4>
                                    <p class="text-sm text-gray-600">O'yinda vaqt chegarasi bo'ladimi?</p>
                                </div>
                                <label class="toggle-switch">
                                    <input type="checkbox" id="hasTimeLimit">
                                    <span class="slider"></span>
                                </label>
                            </div>
                            <div class="flex items-center justify-between">
                                <div>
                                    <h4 class="font-medium">Yordam Ko'rsatish</h4>
                                    <p class="text-sm text-gray-600">O'yin davomida yordam berilsinmi?</p>
                                </div>
                                <label class="toggle-switch">
                                    <input type="checkbox" id="showHints">
                                    <span class="slider"></span>
                                </label>
                            </div>
                            <div class="flex items-center justify-between">
                                <div>
                                    <h4 class="font-medium">Natijalarni Ko'rsatish</h4>
                                    <p class="text-sm text-gray-600">O'yin oxirida natijalar ko'rsatilsinmi?</p>
                                </div>
                                <label class="toggle-switch">
                                    <input type="checkbox" id="showResults" checked>
                                    <span class="slider"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Step 5: Review and Publish -->
            <div id="reviewStep" class="step-content hidden">
                <div class="admin-card p-6 mb-6">
                    <h2 class="text-2xl font-bold mb-6 text-gray-800">Ko'rib Chiqish va Nashr Qilish</h2>

                    <div class="form-section">
                        <h3 class="text-lg font-semibold mb-4">O'yin Xulasasi</h3>
                        <div id="gameSummary" class="space-y-3">
                            <!-- Summary will be populated by JavaScript -->
                        </div>
                    </div>

                    <div class="form-section">
                        <h3 class="text-lg font-semibold mb-4">Nashr Sozlamalari</h3>
                        <div class="space-y-4">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h4 class="font-medium">Darhol Nashr Qilish</h4>
                                    <p class="text-sm text-gray-600">O'yin yaratilishi bilan birga faol bo'ladimi?</p>
                                </div>
                                <label class="toggle-switch">
                                    <input type="checkbox" id="publishImmediately" checked>
                                    <span class="slider"></span>
                                </label>
                            </div>
                            <div class="flex items-center justify-between">
                                <div>
                                    <h4 class="font-medium">Test Rejimi</h4>
                                    <p class="text-sm text-gray-600">Avval test rejimida ishga tushirilsinmi?</p>
                                </div>
                                <label class="toggle-switch">
                                    <input type="checkbox" id="testMode">
                                    <span class="slider"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Navigation Buttons -->
            <div class="flex justify-between">
                <button id="prevBtn" onclick="previousStep()" class="bg-gray-500 text-white px-6 py-3 rounded-lg hover:bg-gray-600 transition-colors hidden">
                    <i class="fas fa-arrow-left mr-2"></i>Orqaga
                </button>
                <div class="flex space-x-3 ml-auto">
                    <button id="nextBtn" onclick="nextStep()" class="bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700 transition-colors">
                        Keyingi <i class="fas fa-arrow-right ml-2"></i>
                    </button>
                    <button id="publishBtn" onclick="publishGame()" class="bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700 transition-colors hidden">
                        <i class="fas fa-rocket mr-2"></i>Nashr Qilish
                    </button>
                </div>
            </div>
        </div>

        <!-- Preview Panel -->
        <div class="lg:col-span-1">
            <div class="admin-card p-6 sticky top-6">
                <h3 class="text-xl font-bold mb-4 text-gray-800">Ko'rib Chiqish</h3>
                <div id="gamePreview" class="preview-card">
                    <div class="text-gray-500">
                        <i class="fas fa-eye text-4xl mb-3"></i>
                        <p>O'yin ma'lumotlarini to'ldiring</p>
                        <p class="text-sm">Ko'rib chiqish bu yerda ko'rinadi</p>
                    </div>
                </div>

                <div class="mt-6">
                    <h4 class="font-semibold mb-3">Tezkor Harakatlar</h4>
                    <div class="space-y-2">
                        <button onclick="saveAsDraft()" class="w-full text-left p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                            <i class="fas fa-save mr-2"></i>Qoralama Saqlash
                        </button>
                        <button onclick="loadTemplate()" class="w-full text-left p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                            <i class="fas fa-file-import mr-2"></i>Shablon Yuklash
                        </button>
                        <button onclick="exportGame()" class="w-full text-left p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                            <i class="fas fa-download mr-2"></i>Eksport Qilish
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Notification -->
<div id="notification" class="fixed top-4 right-4 px-6 py-3 rounded-lg shadow-lg transform translate-x-full transition-transform duration-300 z-50">
    <span id="notificationText"></span>
</div>

<script>
    let currentStep = 1;
    let selectedGameType = '';
    let selectedCategory = '';
    let selectedDifficulty = '';
    let gameData = {};

    // Step navigation
    function nextStep() {
        if (validateCurrentStep()) {
            if (currentStep < 5) {
                currentStep++;
                updateStepDisplay();
            }
        }
    }

    function previousStep() {
        if (currentStep > 1) {
            currentStep--;
            updateStepDisplay();
        }
    }

    function updateStepDisplay() {
        // Hide all step contents
        document.querySelectorAll('.step-content').forEach(content => {
            content.classList.add('hidden');
        });

        // Show current step content
        const stepContents = ['gameTypeStep', 'basicInfoStep', 'gameContentStep', 'rewardsStep', 'reviewStep'];
        document.getElementById(stepContents[currentStep - 1]).classList.remove('hidden');

        // Update step indicators
        for (let i = 1; i <= 5; i++) {
            const step = document.getElementById(`step${i}`);
            if (i < currentStep) {
                step.className = 'step completed';
            } else if (i === currentStep) {
                step.className = 'step active';
            } else {
                step.className = 'step inactive';
            }
        }

        // Update step text
        const stepTexts = [
            '1-qadam: O\'yin turini tanlang',
            '2-qadam: Asosiy ma\'lumotlarni kiriting',
            '3-qadam: O\'yin mazmunini yarating',
            '4-qadam: Mukofotlar va sozlamalar',
            '5-qadam: Ko\'rib chiqish va nashr qilish'
        ];
        document.getElementById('stepText').textContent = stepTexts[currentStep - 1];

        // Update navigation buttons
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');
        const publishBtn = document.getElementById('publishBtn');

        if (currentStep === 1) {
            prevBtn.classList.add('hidden');
        } else {
            prevBtn.classList.remove('hidden');
        }

        if (currentStep === 5) {
            nextBtn.classList.add('hidden');
            publishBtn.classList.remove('hidden');
            generateSummary();
        } else {
            nextBtn.classList.remove('hidden');
            publishBtn.classList.add('hidden');
        }

        updatePreview();
    }

    function validateCurrentStep() {
        switch (currentStep) {
            case 1:
                if (!selectedGameType || !selectedCategory) {
                    showNotification('O\'yin turi va kategoriyani tanlang', 'warning');
                    return false;
                }
                break;
            case 2:
                const gameName = document.getElementById('gameName').value;
                const gameDescription = document.getElementById('gameDescription').value;
                const minAge = document.getElementById('minAge').value;
                const maxAge = document.getElementById('maxAge').value;

                if (!gameName || !gameDescription || !minAge || !maxAge || !selectedDifficulty) {
                    showNotification('Barcha majburiy maydonlarni to\'ldiring', 'warning');
                    return false;
                }
                break;
            case 3:
                const gameRules = document.getElementById('gameRules').value;
                if (!gameRules) {
                    showNotification('O\'yin qoidalarini kiriting', 'warning');
                    return false;
                }
                break;
            case 4:
                const baseReward = document.getElementById('baseReward').value;
                if (!baseReward) {
                    showNotification('Asosiy mukofot miqdorini kiriting', 'warning');
                    return false;
                }
                break;
        }
        return true;
    }

    // Game type and category selection
    function selectGameType(type) {
        selectedGameType = type;

        // Update UI
        document.querySelectorAll('.category-card').forEach(card => {
            card.classList.remove('selected');
        });
        event.target.closest('.category-card').classList.add('selected');

        // Show category selection
        document.getElementById('categorySelection').classList.remove('hidden');

        if (type === 'smart-task') {
            document.getElementById('smartTaskCategories').classList.remove('hidden');
            document.getElementById('interactiveGameCategories').classList.add('hidden');
        } else {
            document.getElementById('smartTaskCategories').classList.add('hidden');
            document.getElementById('interactiveGameCategories').classList.remove('hidden');
        }

        updatePreview();
    }

    function selectCategory(category) {
        selectedCategory = category;

        // Update UI
        document.querySelectorAll('#categorySelection .category-card').forEach(card => {
            card.classList.remove('selected');
        });
        event.target.closest('.category-card').classList.add('selected');

        updatePreview();
    }

    function selectDifficulty(difficulty) {
        selectedDifficulty = difficulty;

        // Update UI
        document.querySelectorAll('.difficulty-badge').forEach(badge => {
            badge.style.opacity = '0.5';
        });
        event.target.style.opacity = '1';

        updatePreview();
    }

    // Preview functions
    function updatePreview() {
        const preview = document.getElementById('gamePreview');
        const gameName = document.getElementById('gameName')?.value || 'O\'yin Nomi';
        const gameDescription = document.getElementById('gameDescription')?.value || 'O\'yin tavsifi';

        if (selectedGameType && selectedCategory) {
            const categoryNames = {
                'math': 'Matematik',
                'logic': 'Mantiq',
                'memory': 'Xotira',
                'language': 'Til',
                'science': 'Fan',
                'geography': 'Geografiya',
                'drawing': 'Rasm Chizish',
                'music': 'Musiqa',
                'puzzle': 'Puzzle',
                'adventure': 'Sarguzasht',
                'simulation': 'Simulyatsiya',
                'strategy': 'Strategiya'
            };

            const difficultyNames = {
                'easy': 'Oson',
                'medium': 'O\'rta',
                'hard': 'Qiyin'
            };

            preview.innerHTML = `
            <div class="text-left">
                <div class="flex items-center mb-3">
                    <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-gamepad text-indigo-600"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-lg">${gameName}</h4>
                        <p class="text-sm text-gray-600">${categoryNames[selectedCategory] || selectedCategory}</p>
                    </div>
                </div>
                <p class="text-sm text-gray-700 mb-3">${gameDescription}</p>
                <div class="flex items-center space-x-2">
                    ${selectedDifficulty ? `<span class="difficulty-badge difficulty-${selectedDifficulty}">${difficultyNames[selectedDifficulty]}</span>` : ''}
                    <span class="text-xs text-gray-500">${selectedGameType === 'smart-task' ? 'Smart Topshiriq' : 'Interaktiv O\'yin'}</span>
                </div>
            </div>
        `;
        }
    }

    function previewGame() {
        // Collect all form data
        collectGameData();

        // Open preview modal or new window
        showNotification('O\'yin ko\'rib chiqish oynasi ochilmoqda...', 'success');
    }

    // Data collection and saving
    function collectGameData() {
        gameData = {
            type: selectedGameType,
            category: selectedCategory,
            difficulty: selectedDifficulty,
            name: document.getElementById('gameName')?.value,
            description: document.getElementById('gameDescription')?.value,
            detailedDescription: document.getElementById('gameDetailedDescription')?.value,
            minAge: document.getElementById('minAge')?.value,
            maxAge: document.getElementById('maxAge')?.value,
            rules: document.getElementById('gameRules')?.value,
            instructions: document.getElementById('gameInstructions')?.value,
            baseReward: document.getElementById('baseReward')?.value,
            bonusReward: document.getElementById('bonusReward')?.value,
            maxReward: document.getElementById('maxReward')?.value,
            badgeReward: document.getElementById('badgeReward')?.value,
            settings: {
                allowReplay: document.getElementById('allowReplay')?.checked,
                hasTimeLimit: document.getElementById('hasTimeLimit')?.checked,
                showHints: document.getElementById('showHints')?.checked,
                showResults: document.getElementById('showResults')?.checked,
                publishImmediately: document.getElementById('publishImmediately')?.checked,
                testMode: document.getElementById('testMode')?.checked
            }
        };

        if (selectedGameType === 'smart-task') {
            gameData.smartTask = {
                questionCount: document.getElementById('questionCount')?.value,
                timeLimit: document.getElementById('timeLimit')?.value,
                passingScore: document.getElementById('passingScore')?.value
            };
        }

        return gameData;
    }

    function saveAsDraft() {
        collectGameData();
        // Save to localStorage or send to server
        localStorage.setItem('gameDraft', JSON.stringify(gameData));
        showNotification('Qoralama saqlandi', 'success');
    }

    function loadTemplate() {
        showNotification('Shablon yuklash funksiyasi ishlab chiqilmoqda...', 'info');
    }

    function exportGame() {
        collectGameData();
        const dataStr = JSON.stringify(gameData, null, 2);
        const dataBlob = new Blob([dataStr], {type: 'application/json'});
        const url = URL.createObjectURL(dataBlob);
        const link = document.createElement('a');
        link.href = url;
        link.download = `${gameData.name || 'game'}.json`;
        link.click();
        showNotification('O\'yin eksport qilindi', 'success');
    }

    function publishGame() {
        if (validateCurrentStep()) {
            collectGameData();
            showNotification('O\'yin nashr qilinmoqda...', 'info');
            fetch('http://localhost:9000/api/games', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': 'Bearer ' + window.apiToken,
                },
                body: JSON.stringify(gameData)
            })
                .then(response => response.json())
                .then(data => {
                    showNotification('O\'yin muvaffaqiyatli nashr qilindi!', 'success');
                    setTimeout(() => {
                        window.location.href = '/admin';
                    }, 2000);
                })
                .catch(error => {
                    showNotification('Xatolik yuz berdi: ' + error.message, 'error');
                });
        }
    }

    function generateSummary() {
        const summary = document.getElementById('gameSummary');
        collectGameData();

        const categoryNames = {
            'math': 'Matematik',
            'logic': 'Mantiq',
            'memory': 'Xotira',
            'language': 'Til',
            'science': 'Fan',
            'geography': 'Geografiya',
            'drawing': 'Rasm Chizish',
            'music': 'Musiqa',
            'puzzle': 'Puzzle',
            'adventure': 'Sarguzasht',
            'simulation': 'Simulyatsiya',
            'strategy': 'Strategiya'
        };

        const difficultyNames = {
            'easy': 'Oson',
            'medium': 'O\'rta',
            'hard': 'Qiyin'
        };

        summary.innerHTML = `
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="space-y-2">
                <div class="flex justify-between">
                    <span class="font-medium">O'yin Nomi:</span>
                    <span>${gameData.name || 'Kiritilmagan'}</span>
                </div>
                <div class="flex justify-between">
                    <span class="font-medium">Turi:</span>
                    <span>${gameData.type === 'smart-task' ? 'Smart Topshiriq' : 'Interaktiv O\'yin'}</span>
                </div>
                <div class="flex justify-between">
                    <span class="font-medium">Kategoriya:</span>
                    <span>${categoryNames[gameData.category] || gameData.category}</span>
                </div>
                <div class="flex justify-between">
                    <span class="font-medium">Qiyinlik:</span>
                    <span>${difficultyNames[gameData.difficulty] || gameData.difficulty}</span>
                </div>
            </div>
            <div class="space-y-2">
                <div class="flex justify-between">
                    <span class="font-medium">Yosh Oralig'i:</span>
                    <span>${gameData.minAge}-${gameData.maxAge} yosh</span>
                </div>
                <div class="flex justify-between">
                    <span class="font-medium">Asosiy Mukofot:</span>
                    <span>${gameData.baseReward || 0} coin</span>
                </div>
                <div class="flex justify-between">
                    <span class="font-medium">Maksimal Mukofot:</span>
                    <span>${gameData.maxReward || 0} coin</span>
                </div>
                <div class="flex justify-between">
                    <span class="font-medium">Holat:</span>
                    <span class="${gameData.settings?.publishImmediately ? 'text-green-600' : 'text-yellow-600'}">
                        ${gameData.settings?.publishImmediately ? 'Darhol nashr' : 'Qoralama'}
                    </span>
                </div>
            </div>
        </div>
    `;
    }

    // Notification function
    function showNotification(message, type = 'success') {
        const notification = document.getElementById('notification');
        const notificationText = document.getElementById('notificationText');

        notificationText.textContent = message;

        // Set color based on type
        const colors = {
            success: 'bg-green-500',
            warning: 'bg-yellow-500',
            error: 'bg-red-500',
            info: 'bg-blue-500'
        };

        notification.className = `fixed top-4 right-4 px-6 py-3 rounded-lg shadow-lg transform transition-transform duration-300 z-50 ${colors[type] || colors.success} text-white`;

        // Show notification
        notification.classList.remove('translate-x-full');

        // Hide after 3 seconds
        setTimeout(() => {
            notification.classList.add('translate-x-full');
        }, 3000);
    }

    // Initialize
    document.addEventListener('DOMContentLoaded', function() {
        updateStepDisplay();

        // Load draft if exists
        const draft = localStorage.getItem('gameDraft');
        if (draft) {
            try {
                const draftData = JSON.parse(draft);
                // Populate form with draft data
                showNotification('Qoralama yuklandi', 'info');
            } catch (e) {
                console.error('Error loading draft:', e);
            }
        }
    });

    // Show smart task content when smart task is selected
    document.addEventListener('change', function(e) {
        if (e.target.id === 'gameType' && e.target.value === 'smart-task') {
            document.getElementById('smartTaskContent').style.display = 'block';
        } else if (e.target.id === 'gameType') {
            document.getElementById('smartTaskContent').style.display = 'none';
        }
    });
</script>

</body>
</html>
