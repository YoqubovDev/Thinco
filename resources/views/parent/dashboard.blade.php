<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ota-onalar Nazorati - Bolalar Faoliyati Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }

        .dashboard-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .dashboard-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
        }

        .stat-card {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: scale(1.05);
        }

        .child-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: linear-gradient(135deg, #ff6b6b, #4ecdc4);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: white;
            font-weight: bold;
        }

        .activity-item {
            transition: all 0.2s ease;
        }

        .activity-item:hover {
            background-color: #f8f9fa;
            border-radius: 8px;
        }

        .progress-ring {
            transform: rotate(-90deg);
        }

        .nav-item {
            transition: all 0.3s ease;
            border-radius: 8px;
        }

        .nav-item:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .nav-item.active {
            background-color: rgba(255, 255, 255, 0.2);
            border-left: 4px solid #fff;
        }

        .alert-high { border-left: 4px solid #ef4444; }
        .alert-medium { border-left: 4px solid #f59e0b; }
        .alert-low { border-left: 4px solid #10b981; }
    </style>
</head>
<body>
<div class="min-h-screen flex">
    <!-- Sidebar -->
    <div class="w-64 bg-white bg-opacity-10 backdrop-blur-lg p-6">
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold text-white mb-2">Ota-onalar Nazorati</h1>
            <p class="text-white opacity-80 text-sm">Bolalar faoliyati dashboard</p>
        </div>

        <nav class="space-y-2">
            <div class="nav-item active p-3 cursor-pointer text-white" onclick="showSection('overview')">
                <div class="flex items-center">
                    <span class="mr-3">📊</span>
                    <span>Umumiy Ko'rinish</span>
                </div>
            </div>
            <div class="nav-item p-3 cursor-pointer text-white" onclick="showSection('children')">
                <div class="flex items-center">
                    <span class="mr-3">👶</span>
                    <span>Bolalar Profili</span>
                </div>
            </div>
            <div class="nav-item p-3 cursor-pointer text-white" onclick="showSection('activities')">
                <div class="flex items-center">
                    <span class="mr-3">🎮</span>
                    <span>Faoliyat Hisoboti</span>
                </div>
            </div>
            <div class="nav-item p-3 cursor-pointer text-white" onclick="showSection('time-control')">
                <div class="flex items-center">
                    <span class="mr-3">⏰</span>
                    <span>Vaqt Nazorati</span>
                </div>
            </div>
            <div class="nav-item p-3 cursor-pointer text-white" onclick="showSection('achievements')">
                <div class="flex items-center">
                    <span class="mr-3">🏆</span>
                    <span>Yutuqlar</span>
                </div>
            </div>
            <div class="nav-item p-3 cursor-pointer text-white" onclick="showSection('safety')">
                <div class="flex items-center">
                    <span class="mr-3">🛡️</span>
                    <span>Xavfsizlik</span>
                </div>
            </div>
            <div class="nav-item p-3 cursor-pointer text-white" onclick="showSection('reports')">
                <div class="flex items-center">
                    <span class="mr-3">📈</span>
                    <span>Hisobotlar</span>
                </div>
            </div>
            <div class="nav-item p-3 cursor-pointer text-white" onclick="showSection('settings')">
                <div class="flex items-center">
                    <span class="mr-3">⚙️</span>
                    <span>Sozlamalar</span>
                </div>
            </div>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="flex-1 p-6 overflow-y-auto">

        <!-- Overview Section -->
        <div id="overview" class="section">
            <!-- Header -->
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h2 class="text-3xl font-bold text-white mb-2">Umumiy Ko'rinish</h2>
                    <p class="text-white opacity-80">Bolalaringizning bugungi faoliyati</p>
                </div>
                <div class="text-white text-right">
                    <div class="text-sm opacity-80">Bugun</div>
                    <div class="text-xl font-bold" id="currentDate"></div>
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="stat-card p-6 text-center">
                    <div class="text-3xl mb-2">👶</div>
                    <div class="text-2xl font-bold">3</div>
                    <div class="text-sm opacity-90">Faol Bolalar</div>
                </div>
                <div class="stat-card p-6 text-center">
                    <div class="text-3xl mb-2">⏱️</div>
                    <div class="text-2xl font-bold">2s 45d</div>
                    <div class="text-sm opacity-90">Bugungi Vaqt</div>
                </div>
                <div class="stat-card p-6 text-center">
                    <div class="text-3xl mb-2">🎯</div>
                    <div class="text-2xl font-bold">12</div>
                    <div class="text-sm opacity-90">Bajarilgan Vazifa</div>
                </div>
                <div class="stat-card p-6 text-center">
                    <div class="text-3xl mb-2">🏆</div>
                    <div class="text-2xl font-bold">8</div>
                    <div class="text-sm opacity-90">Yangi Yutuq</div>
                </div>
            </div>

            <!-- Children Overview -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                <div class="dashboard-card p-6">
                    <h3 class="text-xl font-bold mb-4 text-gray-800">Bolalar Holati</h3>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between p-4 bg-green-50 rounded-lg">
                            <div class="flex items-center">
                                <div class="child-avatar mr-4">A</div>
                                <div>
                                    <h4 class="font-semibold text-gray-800">Ahmad (8 yosh)</h4>
                                    <p class="text-sm text-gray-600">Hozir: Matematik o'yin</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="text-green-600 font-semibold">Faol</div>
                                <div class="text-sm text-gray-500">45 daqiqa</div>
                            </div>
                        </div>

                        <div class="flex items-center justify-between p-4 bg-blue-50 rounded-lg">
                            <div class="flex items-center">
                                <div class="child-avatar mr-4" style="background: linear-gradient(135deg, #ff9ff3, #54a0ff);">M</div>
                                <div>
                                    <h4 class="font-semibold text-gray-800">Malika (6 yosh)</h4>
                                    <p class="text-sm text-gray-600">Hozir: Rasm chizish</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="text-blue-600 font-semibold">Faol</div>
                                <div class="text-sm text-gray-500">23 daqiqa</div>
                            </div>
                        </div>

                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                            <div class="flex items-center">
                                <div class="child-avatar mr-4" style="background: linear-gradient(135deg, #feca57, #ff9ff3);">B</div>
                                <div>
                                    <h4 class="font-semibold text-gray-800">Bobur (10 yosh)</h4>
                                    <p class="text-sm text-gray-600">Offline</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="text-gray-500 font-semibold">Offline</div>
                                <div class="text-sm text-gray-500">2 soat oldin</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="dashboard-card p-6">
                    <h3 class="text-xl font-bold mb-4 text-gray-800">Bugungi Faoliyat</h3>
                    <canvas id="activityChart" width="400" height="200"></canvas>
                </div>
            </div>

            <!-- Recent Activities -->
            <div class="dashboard-card p-6">
                <h3 class="text-xl font-bold mb-4 text-gray-800">So'nggi Faoliyatlar</h3>
                <div class="space-y-3">
                    <div class="activity-item flex items-center justify-between p-3">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center mr-3">
                                <span class="text-green-600">🎯</span>
                            </div>
                            <div>
                                <p class="font-medium text-gray-800">Ahmad matematik masalani yechdi</p>
                                <p class="text-sm text-gray-500">5 daqiqa oldin</p>
                            </div>
                        </div>
                        <div class="text-green-600 font-semibold">+15 ball</div>
                    </div>

                    <div class="activity-item flex items-center justify-between p-3">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                <span class="text-blue-600">🎨</span>
                            </div>
                            <div>
                                <p class="font-medium text-gray-800">Malika rasm chizishni yakunladi</p>
                                <p class="text-sm text-gray-500">12 daqiqa oldin</p>
                            </div>
                        </div>
                        <div class="text-blue-600 font-semibold">+10 ball</div>
                    </div>

                    <div class="activity-item flex items-center justify-between p-3">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center mr-3">
                                <span class="text-purple-600">🏆</span>
                            </div>
                            <div>
                                <p class="font-medium text-gray-800">Ahmad "Xotira Chempioni" mukofotini oldi</p>
                                <p class="text-sm text-gray-500">1 soat oldin</p>
                            </div>
                        </div>
                        <div class="text-purple-600 font-semibold">Mukofot</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Children Section -->
        <div id="children" class="section hidden">
            <h2 class="text-3xl font-bold text-white mb-6">Bolalar Profili</h2>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Ahmad Profile -->
                <div class="dashboard-card p-6">
                    <div class="text-center mb-6">
                        <div class="child-avatar mx-auto mb-4" style="width: 80px; height: 80px; font-size: 32px;">A</div>
                        <h3 class="text-xl font-bold text-gray-800">Ahmad</h3>
                        <p class="text-gray-600">8 yosh • 3-sinf</p>
                    </div>

                    <div class="space-y-4">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Bugungi vaqt:</span>
                            <span class="font-semibold">2s 15d</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Sevimli o'yin:</span>
                            <span class="font-semibold">Matematik</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Jami ball:</span>
                            <span class="font-semibold text-green-600">1,250</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Mukofotlar:</span>
                            <span class="font-semibold">12 ta</span>
                        </div>
                    </div>

                    <div class="mt-6">
                        <h4 class="font-semibold mb-2">Haftalik Progress</h4>
                        <div class="bg-gray-200 rounded-full h-2">
                            <div class="bg-green-500 h-2 rounded-full" style="width: 75%"></div>
                        </div>
                        <p class="text-sm text-gray-600 mt-1">75% - Ajoyib!</p>
                    </div>

                    <button class="w-full mt-4 bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 transition-colors" onclick="showChildDetails('Ahmad')">
                        Batafsil Ko'rish
                    </button>
                </div>

                <!-- Malika Profile -->
                <div class="dashboard-card p-6">
                    <div class="text-center mb-6">
                        <div class="child-avatar mx-auto mb-4" style="width: 80px; height: 80px; font-size: 32px; background: linear-gradient(135deg, #ff9ff3, #54a0ff);">M</div>
                        <h3 class="text-xl font-bold text-gray-800">Malika</h3>
                        <p class="text-gray-600">6 yosh • 1-sinf</p>
                    </div>

                    <div class="space-y-4">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Bugungi vaqt:</span>
                            <span class="font-semibold">1s 30d</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Sevimli o'yin:</span>
                            <span class="font-semibold">Rasm chizish</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Jami ball:</span>
                            <span class="font-semibold text-green-600">850</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Mukofotlar:</span>
                            <span class="font-semibold">8 ta</span>
                        </div>
                    </div>

                    <div class="mt-6">
                        <h4 class="font-semibold mb-2">Haftalik Progress</h4>
                        <div class="bg-gray-200 rounded-full h-2">
                            <div class="bg-pink-500 h-2 rounded-full" style="width: 60%"></div>
                        </div>
                        <p class="text-sm text-gray-600 mt-1">60% - Yaxshi!</p>
                    </div>

                    <button class="w-full mt-4 bg-pink-500 text-white py-2 rounded-lg hover:bg-pink-600 transition-colors" onclick="showChildDetails('Malika')">
                        Batafsil Ko'rish
                    </button>
                </div>

                <!-- Bobur Profile -->
                <div class="dashboard-card p-6">
                    <div class="text-center mb-6">
                        <div class="child-avatar mx-auto mb-4" style="width: 80px; height: 80px; font-size: 32px; background: linear-gradient(135deg, #feca57, #ff9ff3);">B</div>
                        <h3 class="text-xl font-bold text-gray-800">Bobur</h3>
                        <p class="text-gray-600">10 yosh • 4-sinf</p>
                    </div>

                    <div class="space-y-4">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Bugungi vaqt:</span>
                            <span class="font-semibold">0s 0d</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Sevimli o'yin:</span>
                            <span class="font-semibold">Strategiya</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Jami ball:</span>
                            <span class="font-semibold text-green-600">2,100</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Mukofotlar:</span>
                            <span class="font-semibold">18 ta</span>
                        </div>
                    </div>

                    <div class="mt-6">
                        <h4 class="font-semibold mb-2">Haftalik Progress</h4>
                        <div class="bg-gray-200 rounded-full h-2">
                            <div class="bg-orange-500 h-2 rounded-full" style="width: 30%"></div>
                        </div>
                        <p class="text-sm text-gray-600 mt-1">30% - Faolroq bo'ling!</p>
                    </div>

                    <button class="w-full mt-4 bg-orange-500 text-white py-2 rounded-lg hover:bg-orange-600 transition-colors" onclick="showChildDetails('Bobur')">
                        Batafsil Ko'rish
                    </button>
                </div>
            </div>
        </div>

        <!-- Time Control Section -->
        <div id="time-control" class="section hidden">
            <h2 class="text-3xl font-bold text-white mb-6">Vaqt Nazorati</h2>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div class="dashboard-card p-6">
                    <h3 class="text-xl font-bold mb-4 text-gray-800">Kunlik Vaqt Chegaralari</h3>

                    <div class="space-y-6">
                        <div>
                            <div class="flex justify-between items-center mb-2">
                                <span class="font-medium">Ahmad (8 yosh)</span>
                                <span class="text-sm text-gray-500">2s 15d / 3s 0d</span>
                            </div>
                            <div class="bg-gray-200 rounded-full h-3">
                                <div class="bg-green-500 h-3 rounded-full" style="width: 75%"></div>
                            </div>
                            <div class="flex justify-between mt-2">
                                <button class="text-blue-600 text-sm hover:underline" onclick="adjustTime('Ahmad', -15)">-15d</button>
                                <button class="text-blue-600 text-sm hover:underline" onclick="adjustTime('Ahmad', 15)">+15d</button>
                            </div>
                        </div>

                        <div>
                            <div class="flex justify-between items-center mb-2">
                                <span class="font-medium">Malika (6 yosh)</span>
                                <span class="text-sm text-gray-500">1s 30d / 2s 0d</span>
                            </div>
                            <div class="bg-gray-200 rounded-full h-3">
                                <div class="bg-blue-500 h-3 rounded-full" style="width: 75%"></div>
                            </div>
                            <div class="flex justify-between mt-2">
                                <button class="text-blue-600 text-sm hover:underline" onclick="adjustTime('Malika', -15)">-15d</button>
                                <button class="text-blue-600 text-sm hover:underline" onclick="adjustTime('Malika', 15)">+15d</button>
                            </div>
                        </div>

                        <div>
                            <div class="flex justify-between items-center mb-2">
                                <span class="font-medium">Bobur (10 yosh)</span>
                                <span class="text-sm text-gray-500">0s 0d / 4s 0d</span>
                            </div>
                            <div class="bg-gray-200 rounded-full h-3">
                                <div class="bg-gray-400 h-3 rounded-full" style="width: 0%"></div>
                            </div>
                            <div class="flex justify-between mt-2">
                                <button class="text-blue-600 text-sm hover:underline" onclick="adjustTime('Bobur', -15)">-15d</button>
                                <button class="text-blue-600 text-sm hover:underline" onclick="adjustTime('Bobur', 15)">+15d</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="dashboard-card p-6">
                    <h3 class="text-xl font-bold mb-4 text-gray-800">Vaqt Jadvali</h3>

                    <div class="space-y-4">
                        <div class="p-4 bg-green-50 rounded-lg">
                            <h4 class="font-semibold text-green-800">Ruxsat etilgan vaqt</h4>
                            <p class="text-sm text-green-600">Dushanba - Juma: 16:00 - 19:00</p>
                            <p class="text-sm text-green-600">Shanba - Yakshanba: 10:00 - 12:00, 15:00 - 18:00</p>
                        </div>

                        <div class="p-4 bg-red-50 rounded-lg">
                            <h4 class="font-semibold text-red-800">Taqiqlangan vaqt</h4>
                            <p class="text-sm text-red-600">Ovqat vaqti: 12:00 - 13:00</p>
                            <p class="text-sm text-red-600">Uyqu vaqti: 21:00 - 07:00</p>
                        </div>

                        <div class="space-y-2">
                            <button class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 transition-colors" onclick="editSchedule()">
                                Jadvalni Tahrirlash
                            </button>
                            <button class="w-full bg-gray-500 text-white py-2 rounded-lg hover:bg-gray-600 transition-colors" onclick="pauseAllDevices()">
                                Barcha Qurilmalarni To'xtatish
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Safety Section -->
        <div id="safety" class="section hidden">
            <h2 class="text-3xl font-bold text-white mb-6">Xavfsizlik Nazorati</h2>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div class="dashboard-card p-6">
                    <h3 class="text-xl font-bold mb-4 text-gray-800">Xavfsizlik Ogohlantirishlari</h3>

                    <div class="space-y-4">
                        <div class="alert-low p-4 bg-green-50 rounded-lg">
                            <div class="flex items-center">
                                <span class="text-green-600 mr-3">✅</span>
                                <div>
                                    <h4 class="font-semibold text-green-800">Barcha bolalar xavfsiz</h4>
                                    <p class="text-sm text-green-600">Hech qanday xavfsizlik muammosi yo'q</p>
                                </div>
                            </div>
                        </div>

                        <div class="alert-medium p-4 bg-yellow-50 rounded-lg">
                            <div class="flex items-center">
                                <span class="text-yellow-600 mr-3">⚠️</span>
                                <div>
                                    <h4 class="font-semibold text-yellow-800">Vaqt chegarasi yaqinlashmoqda</h4>
                                    <p class="text-sm text-yellow-600">Ahmad uchun 15 daqiqa qoldi</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="dashboard-card p-6">
                    <h3 class="text-xl font-bold mb-4 text-gray-800">Kontent Filtri</h3>

                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <span class="font-medium">Yoshga mos kontent</span>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" checked class="sr-only peer">
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                            </label>
                        </div>

                        <div class="flex items-center justify-between">
                            <span class="font-medium">Noto'g'ri so'zlarni bloklash</span>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" checked class="sr-only peer">
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                            </label>
                        </div>

                        <div class="flex items-center justify-between">
                            <span class="font-medium">Onlayn chat bloklash</span>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" checked class="sr-only peer">
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                            </label>
                        </div>

                        <div class="flex items-center justify-between">
                            <span class="font-medium">Shaxsiy ma'lumotlarni himoya</span>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" checked class="sr-only peer">
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Reports Section -->
        <div id="reports" class="section hidden">
            <h2 class="text-3xl font-bold text-white mb-6">Batafsil Hisobotlar</h2>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                <div class="dashboard-card p-6">
                    <h3 class="text-xl font-bold mb-4 text-gray-800">Haftalik Faoliyat</h3>
                    <canvas id="weeklyChart" width="400" height="200"></canvas>
                </div>

                <div class="dashboard-card p-6">
                    <h3 class="text-xl font-bold mb-4 text-gray-800">O'yin Kategoriyalari</h3>
                    <canvas id="categoryChart" width="400" height="200"></canvas>
                </div>
            </div>

            <div class="dashboard-card p-6">
                <h3 class="text-xl font-bold mb-4 text-gray-800">Oylik Hisobot</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="text-center p-4 bg-blue-50 rounded-lg">
                        <div class="text-3xl font-bold text-blue-600">156</div>
                        <div class="text-sm text-gray-600">Jami o'ynalgan o'yinlar</div>
                    </div>
                    <div class="text-center p-4 bg-green-50 rounded-lg">
                        <div class="text-3xl font-bold text-green-600">42s</div>
                        <div class="text-sm text-gray-600">Jami sarflangan vaqt</div>
                    </div>
                    <div class="text-center p-4 bg-purple-50 rounded-lg">
                        <div class="text-3xl font-bold text-purple-600">28</div>
                        <div class="text-sm text-gray-600">Olingan mukofotlar</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Settings Section -->
        <div id="settings" class="section hidden">
            <h2 class="text-3xl font-bold text-white mb-6">Sozlamalar</h2>

            <div class="dashboard-card p-6">
                <h3 class="text-xl font-bold mb-4 text-gray-800">Umumiy Sozlamalar</h3>

                <div class="space-y-6">
                    <div>
                        <h4 class="font-semibold mb-3">Bildirishnomalar</h4>
                        <div class="space-y-2">
                            <div class="flex items-center justify-between">
                                <span>Email bildirishnomalar</span>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" checked class="sr-only peer">
                                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                                </label>
                            </div>
                            <div class="flex items-center justify-between">
                                <span>SMS bildirishnomalar</span>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" class="sr-only peer">
                                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h4 class="font-semibold mb-3">Ma'lumotlar</h4>
                        <div class="space-y-2">
                            <button class="w-full text-left p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                                Hisobotni eksport qilish
                            </button>
                            <button class="w-full text-left p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                                Ma'lumotlarni tozalash
                            </button>
                        </div>
                    </div>

                    <div>
                        <h4 class="font-semibold mb-3">Hisob</h4>
                        <div class="space-y-2">
                            <button class="w-full text-left p-3 bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors text-blue-700">
                                Parolni o'zgartirish
                            </button>
                            <button class="w-full text-left p-3 bg-red-50 rounded-lg hover:bg-red-100 transition-colors text-red-700">
                                Hisobni o'chirish
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Notification -->
<div id="notification" class="fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg transform translate-x-full transition-transform duration-300 z-50">
    <div class="flex items-center">
        <span class="mr-2">✅</span>
        <span id="notificationText">Sozlamalar saqlandi</span>
    </div>
</div>

<script>
    // Current date
    document.getElementById('currentDate').textContent = new Date().toLocaleDateString('uz-UZ');

    // Navigation
    function showSection(sectionId) {
        // Hide all sections
        document.querySelectorAll('.section').forEach(section => {
            section.classList.add('hidden');
        });

        // Show selected section
        document.getElementById(sectionId).classList.remove('hidden');

        // Update navigation
        document.querySelectorAll('.nav-item').forEach(item => {
            item.classList.remove('active');
        });
        event.target.closest('.nav-item').classList.add('active');
    }

    // Charts
    function initCharts() {
        // Activity Chart
        const activityCtx = document.getElementById('activityChart').getContext('2d');
        new Chart(activityCtx, {
            type: 'line',
            data: {
                labels: ['6:00', '9:00', '12:00', '15:00', '18:00', '21:00'],
                datasets: [{
                    label: 'Faol foydalanuvchilar',
                    data: [0, 1, 0, 3, 2, 0],
                    borderColor: '#667eea',
                    backgroundColor: 'rgba(102, 126, 234, 0.1)',
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 3
                    }
                }
            }
        });

        // Weekly Chart
        const weeklyCtx = document.getElementById('weeklyChart').getContext('2d');
        new Chart(weeklyCtx, {
            type: 'bar',
            data: {
                labels: ['Dush', 'Sesh', 'Chor', 'Pay', 'Jum', 'Shan', 'Yak'],
                datasets: [{
                    label: 'Soatlar',
                    data: [2.5, 3, 2, 3.5, 2.8, 4, 3.2],
                    backgroundColor: '#667eea'
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });

        // Category Chart
        const categoryCtx = document.getElementById('categoryChart').getContext('2d');
        new Chart(categoryCtx, {
            type: 'doughnut',
            data: {
                labels: ['Matematik', 'Rasm', 'Musiqa', 'Xotira', 'Boshqa'],
                datasets: [{
                    data: [30, 25, 20, 15, 10],
                    backgroundColor: ['#667eea', '#764ba2', '#ff6b6b', '#4ecdc4', '#feca57']
                }]
            },
            options: {
                responsive: true
            }
        });
    }

    // Functions
    function adjustTime(childName, minutes) {
        showNotification(`${childName} uchun vaqt ${minutes > 0 ? 'qo\'shildi' : 'kamaytirildi'}: ${Math.abs(minutes)} daqiqa`);
    }

    function showChildDetails(childName) {
        showNotification(`${childName}ning batafsil ma'lumotlari yuklanmoqda...`);
    }

    function editSchedule() {
        showNotification('Vaqt jadvali tahrirlash oynasi ochilmoqda...');
    }

    function pauseAllDevices() {
        showNotification('Barcha qurilmalar to\'xtatildi!', 'warning');
    }

    function buyReward(rewardType) {
        showNotification('Mukofot muvaffaqiyatli sotib olindi!');
    }

    function showNotification(message, type = 'success') {
        const notification = document.getElementById('notification');
        const notificationText = document.getElementById('notificationText');

        notificationText.textContent = message;

        // Set color based on type
        notification.className = `fixed top-4 right-4 px-6 py-3 rounded-lg shadow-lg transform transition-transform duration-300 z-50 ${
            type === 'warning' ? 'bg-yellow-500' :
                type === 'error' ? 'bg-red-500' : 'bg-green-500'
        } text-white`;

        // Show notification
        notification.classList.remove('translate-x-full');

        // Hide after 3 seconds
        setTimeout(() => {
            notification.classList.add('translate-x-full');
        }, 3000);
    }

    // Initialize charts when page loads
    window.addEventListener('load', initCharts);

    // Simulate real-time updates
    setInterval(() => {
        // Random activity updates
        if (Math.random() < 0.3) {
            const activities = [
                'Ahmad yangi o\'yin boshladi',
                'Malika mukofot oldi',
                'Bobur onlayn keldi'
            ];
            const randomActivity = activities[Math.floor(Math.random() * activities.length)];
            showNotification(randomActivity, 'info');
        }
    }, 30000); // Every 30 seconds
</script>
</body>
</html>
