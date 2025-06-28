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
                        <div id="smartTaskCategories" class="hidden grid grid-cols-1 md:grid-cols-3 gap-4">
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

<!-- Template Loading Modal -->
<div id="templateModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-lg max-w-4xl w-full max-h-[90vh] overflow-y-auto">
        <div class="p-6 border-b">
            <div class="flex justify-between items-center">
                <h2 class="text-2xl font-bold text-gray-800">Shablon Tanlash</h2>
                <button onclick="closeTemplateModal()" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            <p class="text-gray-600 mt-2">Tez boshlash uchun tayyor shablonlardan birini tanlang</p>
        </div>

        <div class="p-6">
            <!-- Template Categories -->
            <div class="flex space-x-4 mb-6 border-b">
                <button onclick="showTemplateCategory('all')" class="template-category-btn active pb-2 px-1 border-b-2 border-indigo-500 text-indigo-600 font-medium">
                    Barchasi
                </button>
                <button onclick="showTemplateCategory('smart-task')" class="template-category-btn pb-2 px-1 border-b-2 border-transparent text-gray-600 hover:text-indigo-600">
                    Smart Topshiriqlar
                </button>
                <button onclick="showTemplateCategory('interactive-game')" class="template-category-btn pb-2 px-1 border-b-2 border-transparent text-gray-600 hover:text-indigo-600">
                    Interaktiv O'yinlar
                </button>
                <button onclick="showTemplateCategory('popular')" class="template-category-btn pb-2 px-1 border-b-2 border-transparent text-gray-600 hover:text-indigo-600">
                    Mashhur
                </button>
            </div>

            <!-- Templates Grid -->
            <div id="templatesGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <!-- Templates will be populated by JavaScript -->
            </div>
        </div>
    </div>
</div>

<!-- Template Preview Modal -->
<div id="templatePreviewModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-lg max-w-2xl w-full max-h-[90vh] overflow-y-auto">
        <div class="p-6 border-b">
            <div class="flex justify-between items-center">
                <h2 class="text-2xl font-bold text-gray-800" id="templatePreviewTitle">Shablon Ko'rish</h2>
                <button onclick="closeTemplatePreviewModal()" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
        </div>

        <div class="p-6" id="templatePreviewContent">
            <!-- Template preview content will be populated by JavaScript -->
        </div>

        <div class="p-6 border-t bg-gray-50 flex justify-end space-x-3">
            <button onclick="closeTemplatePreviewModal()" class="px-4 py-2 text-gray-600 hover:text-gray-800">
                Bekor Qilish
            </button>
            <button onclick="loadSelectedTemplate()" class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700">
                Shablonni Yuklash
            </button>
        </div>
    </div>
</div>

<script>
    // Template data
    const gameTemplates = {
        smartTasks: [
            {
                id: 'math-basic',
                name: 'Asosiy Matematik Amallar',
                category: 'math',
                type: 'smart-task',
                difficulty: 'easy',
                description: 'Qo\'shish va ayirish amallarini o\'rganish',
                detailedDescription: 'Bolalar uchun asosiy matematik amallarni o\'rganish va mashq qilish uchun mo\'ljallangan topshiriq.',
                minAge: 5,
                maxAge: 8,
                rules: '1. Ekranda matematik misol ko\'rsatiladi\n2. To\'g\'ri javobni tanlang\n3. Har bir to\'g\'ri javob uchun coin oling',
                instructions: 'Matematik misollarni yechib, to\'g\'ri javobni tanlang',
                baseReward: 15,
                bonusReward: 5,
                maxReward: 30,
                badgeReward: 'math-master',
                smartTask: {
                    questionCount: 10,
                    timeLimit: 10,
                    passingScore: 70
                },
                settings: {
                    allowReplay: true,
                    hasTimeLimit: true,
                    showHints: true,
                    showResults: true
                },
                popular: true
            },
            {
                id: 'logic-puzzle',
                name: 'Mantiqiy Boshqotirmalar',
                category: 'logic',
                type: 'smart-task',
                difficulty: 'medium',
                description: 'Mantiqiy fikrlashni rivojlantiruvchi topshiriqlar',
                detailedDescription: 'Bolalarning mantiqiy fikrlash qobiliyatini rivojlantirish uchun turli xil boshqotirmalar.',
                minAge: 7,
                maxAge: 12,
                rules: '1. Berilgan sharoitni o\'qing\n2. Mantiqiy yechimni toping\n3. Javobingizni tasdiqlang',
                instructions: 'Diqqat bilan o\'qing va mantiqiy yechim toping',
                baseReward: 25,
                bonusReward: 10,
                maxReward: 50,
                badgeReward: 'logic-genius',
                smartTask: {
                    questionCount: 8,
                    timeLimit: 15,
                    passingScore: 75
                },
                settings: {
                    allowReplay: true,
                    hasTimeLimit: true,
                    showHints: false,
                    showResults: true
                },
                popular: true
            },
            {
                id: 'memory-game',
                name: 'Xotira Mashqi',
                category: 'memory',
                type: 'smart-task',
                difficulty: 'easy',
                description: 'Xotirani kuchaytiruvchi mashqlar',
                detailedDescription: 'Qisqa muddatli va uzoq muddatli xotirani rivojlantirish uchun maxsus ishlab chiqilgan topshiriqlar.',
                minAge: 4,
                maxAge: 10,
                rules: '1. Rasmlar ketma-ketligini eslab qoling\n2. Bir necha soniyadan keyin takrorlang\n3. To\'g\'ri ketma-ketlik uchun mukofot oling',
                instructions: 'Rasmlarni diqqat bilan kuzating va eslab qoling',
                baseReward: 20,
                bonusReward: 8,
                maxReward: 40,
                badgeReward: 'memory-master',
                smartTask: {
                    questionCount: 12,
                    timeLimit: 8,
                    passingScore: 65
                },
                settings: {
                    allowReplay: true,
                    hasTimeLimit: false,
                    showHints: true,
                    showResults: true
                },
                popular: false
            },
            {
                id: 'language-words',
                name: 'So\'z O\'yini',
                category: 'language',
                type: 'smart-task',
                difficulty: 'medium',
                description: 'Lug\'at boyitish va til rivojlantirish',
                detailedDescription: 'Bolalarning lug\'at boyligini oshirish va til ko\'nikmalarini rivojlantirish uchun so\'z o\'yinlari.',
                minAge: 6,
                maxAge: 14,
                rules: '1. Berilgan harflardan so\'z tuzing\n2. Ma\'nosi to\'g\'ri bo\'lishi kerak\n3. Uzun so\'zlar ko\'proq ball beradi',
                instructions: 'Harflarni ishlatib, ma\'noli so\'zlar tuzing',
                baseReward: 18,
                bonusReward: 7,
                maxReward: 35,
                badgeReward: 'word-master',
                smartTask: {
                    questionCount: 15,
                    timeLimit: 12,
                    passingScore: 60
                },
                settings: {
                    allowReplay: true,
                    hasTimeLimit: true,
                    showHints: true,
                    showResults: true
                },
                popular: true
            }
        ],
        interactiveGames: [
            {
                id: 'drawing-canvas',
                name: 'Raqamli Rasm Chizish',
                category: 'drawing',
                type: 'interactive-game',
                difficulty: 'easy',
                description: 'Ijodiy rasm chizish va rang berish',
                detailedDescription: 'Bolalar uchun raqamli rasm chizish va rang berish imkoniyati. Turli xil cho\'tkalar va ranglar.',
                minAge: 3,
                maxAge: 16,
                rules: '1. Cho\'tka va rang tanlang\n2. Xohlagancha rasm chizing\n3. Tayyor rasmni saqlang va ulashing',
                instructions: 'Ijodingizni namoyon eting va chiroyli rasmlar yarating',
                baseReward: 12,
                bonusReward: 5,
                maxReward: 25,
                badgeReward: 'creative-artist',
                settings: {
                    allowReplay: true,
                    hasTimeLimit: false,
                    showHints: false,
                    showResults: false
                },
                popular: true
            },
            {
                id: 'music-composer',
                name: 'Musiqa Yaratuvchi',
                category: 'music',
                type: 'interactive-game',
                difficulty: 'medium',
                description: 'Oddiy melodiyalar yaratish',
                detailedDescription: 'Bolalar uchun oddiy musiqa yaratish vositasi. Turli xil asboblar va notalar bilan tanishish.',
                minAge: 5,
                maxAge: 15,
                rules: '1. Asbobni tanlang\n2. Notalarni bosib melodiya yarating\n3. Yaratgan musiqangizni tinglang',
                instructions: 'Turli asboblar bilan o\'ynab, o\'z melodiyangizni yarating',
                baseReward: 20,
                bonusReward: 8,
                maxReward: 40,
                badgeReward: 'music-creator',
                settings: {
                    allowReplay: true,
                    hasTimeLimit: false,
                    showHints: true,
                    showResults: false
                },
                popular: false
            },
            {
                id: 'puzzle-builder',
                name: 'Puzzle Quruvchi',
                category: 'puzzle',
                type: 'interactive-game',
                difficulty: 'medium',
                description: 'Puzzle yasash va yechish',
                detailedDescription: 'Turli qiyinlikdagi puzzle o\'yinlari. O\'z puzzle\'ingizni ham yaratishingiz mumkin.',
                minAge: 4,
                maxAge: 12,
                rules: '1. Puzzle bo\'laklarini to\'g\'ri joyga qo\'ying\n2. Rasm to\'liq bo\'lganda o\'yin tugaydi\n3. Vaqtni tejab ko\'proq ball oling',
                instructions: 'Bo\'laklarni sudrab, to\'g\'ri joyga qo\'ying',
                baseReward: 15,
                bonusReward: 10,
                maxReward: 35,
                badgeReward: 'puzzle-solver',
                settings: {
                    allowReplay: true,
                    hasTimeLimit: true,
                    showHints: true,
                    showResults: true
                },
                popular: true
            },
            {
                id: 'adventure-quest',
                name: 'Sarguzasht Sayohati',
                category: 'adventure',
                type: 'interactive-game',
                difficulty: 'hard',
                description: 'Interaktiv hikoya va sarguzasht',
                detailedDescription: 'Bolalar uchun interaktiv hikoya. Har bir tanlov hikoyaning davomini o\'zgartiradi.',
                minAge: 8,
                maxAge: 16,
                rules: '1. Hikoyani o\'qing\n2. Tanlov qiling\n3. Oqibatlarni ko\'ring va davom eting',
                instructions: 'Hikoyani diqqat bilan o\'qib, to\'g\'ri tanlov qiling',
                baseReward: 30,
                bonusReward: 15,
                maxReward: 60,
                badgeReward: 'adventure-hero',
                settings: {
                    allowReplay: true,
                    hasTimeLimit: false,
                    showHints: false,
                    showResults: true
                },
                popular: true
            },
            {
                id: 'city-builder',
                name: 'Shahar Quruvchi',
                category: 'simulation',
                type: 'interactive-game',
                difficulty: 'hard',
                description: 'Virtual shahar qurish simulyatori',
                detailedDescription: 'Bolalar uchun oddiy shahar qurish o\'yini. Binolar qurish va shaharni rivojlantirish.',
                minAge: 7,
                maxAge: 15,
                rules: '1. Binolarni tanlang va quring\n2. Resurslarni boshqaring\n3. Aholini xursand qiling',
                instructions: 'Shaharingizni aqlli rejalashtiring va quring',
                baseReward: 25,
                bonusReward: 12,
                maxReward: 50,
                badgeReward: 'city-planner',
                settings: {
                    allowReplay: true,
                    hasTimeLimit: false,
                    showHints: false,
                    showResults: false
                },
                popular: false
            }
        ]
    };

    let selectedTemplate = null;
    let currentTemplateCategory = 'all';

    function loadTemplate() {
        document.getElementById('templateModal').classList.remove('hidden');
        showTemplateCategory('all');
    }

    function closeTemplateModal() {
        document.getElementById('templateModal').classList.add('hidden');
    }

    function closeTemplatePreviewModal() {
        document.getElementById('templatePreviewModal').classList.add('hidden');
    }

    function showTemplateCategory(category) {
        currentTemplateCategory = category;

        // Update category buttons
        document.querySelectorAll('.template-category-btn').forEach(btn => {
            btn.classList.remove('active', 'border-indigo-500', 'text-indigo-600');
            btn.classList.add('border-transparent', 'text-gray-600');
        });

        event.target.classList.add('active', 'border-indigo-500', 'text-indigo-600');
        event.target.classList.remove('border-transparent', 'text-gray-600');

        // Filter and display templates
        displayTemplates(category);
    }

    function displayTemplates(category) {
        const grid = document.getElementById('templatesGrid');
        const allTemplates = [...gameTemplates.smartTasks, ...gameTemplates.interactiveGames];

        let filteredTemplates = allTemplates;

        if (category === 'smart-task') {
            filteredTemplates = gameTemplates.smartTasks;
        } else if (category === 'interactive-game') {
            filteredTemplates = gameTemplates.interactiveGames;
        } else if (category === 'popular') {
            filteredTemplates = allTemplates.filter(template => template.popular);
        }

        grid.innerHTML = '';

        filteredTemplates.forEach(template => {
            const templateCard = document.createElement('div');
            templateCard.className = 'border rounded-lg p-4 hover:shadow-lg transition-shadow cursor-pointer';
            templateCard.onclick = () => previewTemplate(template);

            const categoryIcons = {
                'math': '🔢',
                'logic': '🧩',
                'memory': '🧠',
                'language': '📚',
                'science': '🔬',
                'geography': '🌍',
                'drawing': '🎨',
                'music': '🎵',
                'puzzle': '🧩',
                'adventure': '🗺️',
                'simulation': '🏗️',
                'strategy': '♟️'
            };

            const difficultyColors = {
                'easy': 'bg-green-100 text-green-800',
                'medium': 'bg-yellow-100 text-yellow-800',
                'hard': 'bg-red-100 text-red-800'
            };

            const difficultyNames = {
                'easy': 'Oson',
                'medium': 'O\'rta',
                'hard': 'Qiyin'
            };

            templateCard.innerHTML = `
            <div class="flex items-start justify-between mb-3">
                <div class="text-2xl">${categoryIcons[template.category] || '🎮'}</div>
                <div class="flex items-center space-x-2">
                    ${template.popular ? '<span class="text-yellow-500"><i class="fas fa-star"></i></span>' : ''}
                    <span class="px-2 py-1 rounded-full text-xs ${difficultyColors[template.difficulty]}">
                        ${difficultyNames[template.difficulty]}
                    </span>
                </div>
            </div>
            <h3 class="font-bold text-lg mb-2">${template.name}</h3>
            <p class="text-gray-600 text-sm mb-3">${template.description}</p>
            <div class="flex items-center justify-between text-xs text-gray-500">
                <span>${template.minAge}-${template.maxAge} yosh</span>
                <span>${template.baseReward} coin</span>
            </div>
            <div class="mt-3 pt-3 border-t">
                <span class="text-xs px-2 py-1 bg-gray-100 rounded">
                    ${template.type === 'smart-task' ? 'Smart Topshiriq' : 'Interaktiv O\'yin'}
                </span>
            </div>
        `;

            grid.appendChild(templateCard);
        });
    }

    function previewTemplate(template) {
        selectedTemplate = template;

        const modal = document.getElementById('templatePreviewModal');
        const title = document.getElementById('templatePreviewTitle');
        const content = document.getElementById('templatePreviewContent');

        title.textContent = template.name;

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

        content.innerHTML = `
        <div class="space-y-6">
            <div>
                <h3 class="text-lg font-semibold mb-3">Asosiy Ma'lumotlar</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <div class="flex justify-between">
                            <span class="font-medium">Kategoriya:</span>
                            <span>${categoryNames[template.category]}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="font-medium">Qiyinlik:</span>
                            <span>${difficultyNames[template.difficulty]}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="font-medium">Yosh oralig'i:</span>
                            <span>${template.minAge}-${template.maxAge} yosh</span>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <div class="flex justify-between">
                            <span class="font-medium">Asosiy mukofot:</span>
                            <span>${template.baseReward} coin</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="font-medium">Maksimal mukofot:</span>
                            <span>${template.maxReward} coin</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="font-medium">Badge:</span>
                            <span>${template.badgeReward || 'Yo\'q'}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <h3 class="text-lg font-semibold mb-3">Tavsif</h3>
                <p class="text-gray-700">${template.detailedDescription}</p>
            </div>

            <div>
                <h3 class="text-lg font-semibold mb-3">O'yin Qoidalari</h3>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <pre class="whitespace-pre-wrap text-sm">${template.rules}</pre>
                </div>
            </div>

            ${template.smartTask ? `
            <div>
                <h3 class="text-lg font-semibold mb-3">Smart Topshiriq Sozlamalari</h3>
                <div class="grid grid-cols-3 gap-4">
                    <div class="text-center p-3 bg-blue-50 rounded-lg">
                        <div class="text-2xl font-bold text-blue-600">${template.smartTask.questionCount}</div>
                        <div class="text-sm text-gray-600">Savollar soni</div>
                    </div>
                    <div class="text-center p-3 bg-green-50 rounded-lg">
                        <div class="text-2xl font-bold text-green-600">${template.smartTask.timeLimit}</div>
                        <div class="text-sm text-gray-600">Vaqt (daqiqa)</div>
                    </div>
                    <div class="text-center p-3 bg-purple-50 rounded-lg">
                        <div class="text-2xl font-bold text-purple-600">${template.smartTask.passingScore}%</div>
                        <div class="text-sm text-gray-600">O'tish bali</div>
                    </div>
                </div>
            </div>
            ` : ''}

            <div>
                <h3 class="text-lg font-semibold mb-3">Sozlamalar</h3>
                <div class="grid grid-cols-2 gap-4">
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <span>Takrorlash</span>
                        <span class="${template.settings.allowReplay ? 'text-green-600' : 'text-red-600'}">
                            ${template.settings.allowReplay ? '✓ Ha' : '✗ Yo\'q'}
                        </span>
                    </div>
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <span>Vaqt chegarasi</span>
                        <span class="${template.settings.hasTimeLimit ? 'text-green-600' : 'text-red-600'}">
                            ${template.settings.hasTimeLimit ? '✓ Ha' : '✗ Yo\'q'}
                        </span>
                    </div>
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <span>Yordam</span>
                        <span class="${template.settings.showHints ? 'text-green-600' : 'text-red-600'}">
                            ${template.settings.showHints ? '✓ Ha' : '✗ Yo\'q'}
                        </span>
                    </div>
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <span>Natijalar</span>
                        <span class="${template.settings.showResults ? 'text-green-600' : 'text-red-600'}">
                            ${template.settings.showResults ? '✓ Ha' : '✗ Yo\'q'}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    `;

        modal.classList.remove('hidden');
    }

    function loadSelectedTemplate() {
        if (!selectedTemplate) return;

        // Populate form with template data
        selectedGameType = selectedTemplate.type;
        selectedCategory = selectedTemplate.category;
        selectedDifficulty = selectedTemplate.difficulty;

        // Fill form fields
        if (document.getElementById('gameName')) {
            document.getElementById('gameName').value = selectedTemplate.name;
        }
        if (document.getElementById('gameDescription')) {
            document.getElementById('gameDescription').value = selectedTemplate.description;
        }
        if (document.getElementById('gameDetailedDescription')) {
            document.getElementById('gameDetailedDescription').value = selectedTemplate.detailedDescription;
        }
        if (document.getElementById('minAge')) {
            document.getElementById('minAge').value = selectedTemplate.minAge;
        }
        if (document.getElementById('maxAge')) {
            document.getElementById('maxAge').value = selectedTemplate.maxAge;
        }
        if (document.getElementById('gameRules')) {
            document.getElementById('gameRules').value = selectedTemplate.rules;
        }
        if (document.getElementById('gameInstructions')) {
            document.getElementById('gameInstructions').value = selectedTemplate.instructions;
        }
        if (document.getElementById('baseReward')) {
            document.getElementById('baseReward').value = selectedTemplate.baseReward;
        }
        if (document.getElementById('bonusReward')) {
            document.getElementById('bonusReward').value = selectedTemplate.bonusReward;
        }
        if (document.getElementById('maxReward')) {
            document.getElementById('maxReward').value = selectedTemplate.maxReward;
        }
        if (document.getElementById('badgeReward')) {
            document.getElementById('badgeReward').value = selectedTemplate.badgeReward || '';
        }

        // Smart task specific fields
        if (selectedTemplate.smartTask) {
            if (document.getElementById('questionCount')) {
                document.getElementById('questionCount').value = selectedTemplate.smartTask.questionCount;
            }
            if (document.getElementById('timeLimit')) {
                document.getElementById('timeLimit').value = selectedTemplate.smartTask.timeLimit;
            }
            if (document.getElementById('passingScore')) {
                document.getElementById('passingScore').value = selectedTemplate.smartTask.passingScore;
            }
        }

        // Settings
        if (document.getElementById('allowReplay')) {
            document.getElementById('allowReplay').checked = selectedTemplate.settings.allowReplay;
        }
        if (document.getElementById('hasTimeLimit')) {
            document.getElementById('hasTimeLimit').checked = selectedTemplate.settings.hasTimeLimit;
        }
        if (document.getElementById('showHints')) {
            document.getElementById('showHints').checked = selectedTemplate.settings.showHints;
        }
        if (document.getElementById('showResults')) {
            document.getElementById('showResults').checked = selectedTemplate.settings.showResults;
        }

        // Close modals
        closeTemplatePreviewModal();
        closeTemplateModal();

        // Go to step 2 (basic info)
        currentStep = 2;
        updateStepDisplay();

        // Update UI elements
        updateGameTypeSelection();
        updateCategorySelection();
        updateDifficultySelection();

        showNotification('Shablon muvaffaqiyatli yuklandi! Ma\'lumotlarni tahrirlashingiz mumkin.', 'success');
    }

    function updateGameTypeSelection() {
        // Update game type selection UI
        document.querySelectorAll('.category-card').forEach(card => {
            card.classList.remove('selected');
        });

        // Show category selection
        document.getElementById('categorySelection').classList.remove('hidden');

        if (selectedGameType === 'smart-task') {
            document.getElementById('smartTaskCategories').classList.remove('hidden');
            document.getElementById('interactiveGameCategories').classList.add('hidden');
            document.getElementById('smartTaskContent').style.display = 'block';
        } else {
            document.getElementById('smartTaskCategories').classList.add('hidden');
            document.getElementById('interactiveGameCategories').classList.remove('hidden');
            document.getElementById('smartTaskContent').style.display = 'none';
        }
    }

    function updateCategorySelection() {
        // Update category selection UI
        document.querySelectorAll('#categorySelection .category-card').forEach(card => {
            card.classList.remove('selected');
            if (card.onclick.toString().includes(selectedCategory)) {
                card.classList.add('selected');
            }
        });
    }

    function updateDifficultySelection() {
        // Update difficulty selection UI
        document.querySelectorAll('.difficulty-badge').forEach(badge => {
            badge.style.opacity = '0.5';
            if (badge.onclick.toString().includes(selectedDifficulty)) {
                badge.style.opacity = '1';
            }
        });
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
