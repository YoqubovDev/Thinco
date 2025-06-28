<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Thinko.uz</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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

        .stat-card {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: scale(1.05);
        }

        .user-avatar {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: linear-gradient(135deg, #ff6b6b, #4ecdc4);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            color: white;
            font-weight: bold;
        }

        .nav-item {
            transition: all 0.3s ease;
            border-radius: 8px;
            cursor: pointer;
        }

        .nav-item:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .nav-item.active {
            background-color: rgba(255, 255, 255, 0.2);
            border-left: 4px solid #fff;
        }

        .role-badge {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .role-admin { background: #ef4444; color: white; }
        .role-parent { background: #3b82f6; color: white; }
        .role-user { background: #10b981; color: white; }
    </style>
</head>
<body class="min-h-screen bg-gradient-to-br from-indigo-500 to-purple-600">
<div class="min-h-screen flex">
    <!-- Sidebar -->
    <div class="w-64 bg-white/10 backdrop-blur-lg p-6">
        <div class="text-center mb-8">
            <a href="index.html" class="block">
                <h1 class="text-2xl font-bold text-white mb-2">Thinko.uz</h1>
            </a>
            <p class="text-white/80 text-sm">Admin Panel</p>
            <div class="mt-4">
                <div class="role-badge role-admin">Admin</div>
            </div>
        </div>

        <nav class="space-y-2">
            <div class="nav-item active p-3 text-white" onclick="showSection('dashboard')">
                <div class="flex items-center">
                    <span class="mr-3">📊</span>
                    <span>Dashboard</span>
                </div>
            </div>
            <div class="nav-item p-3 text-white" onclick="showSection('users')">
                <div class="flex items-center">
                    <span class="mr-3">👥</span>
                    <span>Foydalanuvchilar</span>
                </div>
            </div>
            <div class="nav-item p-3 text-white" onclick="showSection('smart-tasks')">
                <div class="flex items-center">
                    <span class="mr-3">🧠</span>
                    <span>Smart Topshiriqlar</span>
                </div>
            </div>
            <div class="nav-item p-3 text-white" onclick="showSection('games')">
                <div class="flex items-center">
                    <span class="mr-3">🎮</span>
                    <span>Interaktiv O'yinlar</span>
                </div>
            </div>
            <div class="nav-item p-3 text-white" onclick="showSection('rewards')">
                <div class="flex items-center">
                    <span class="mr-3">🏆</span>
                    <span>Mukofotlar</span>
                </div>
            </div>
            <div class="nav-item p-3 text-white" onclick="showSection('analytics')">
                <div class="flex items-center">
                    <span class="mr-3">📈</span>
                    <span>Analitika</span>
                </div>
            </div>
            <div class="nav-item p-3 text-white" onclick="showSection('settings')">
                <div class="flex items-center">
                    <span class="mr-3">⚙️</span>
                    <span>Sozlamalar</span>
                </div>
            </div>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="flex-1 p-6 overflow-y-auto">
        <!-- Dashboard Section -->
        <div id="dashboard" class="section">
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h2 class="text-3xl font-bold text-white mb-2">Admin Dashboard</h2>
                    <p class="text-white/80">Tizim umumiy ko'rinishi</p>
                </div>
                <div class="text-white text-right">
                    <div class="text-sm opacity-80">Bugun</div>
                    <div class="text-xl font-bold" id="currentDate"></div>
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="stat-card p-6 text-center">
                    <div class="text-3xl mb-2">👥</div>
                    <div class="text-2xl font-bold">1,247</div>
                    <div class="text-sm opacity-90">Jami Foydalanuvchi</div>
                </div>
                <div class="stat-card p-6 text-center">
                    <div class="text-3xl mb-2">🎯</div>
                    <div class="text-2xl font-bold">3,456</div>
                    <div class="text-sm opacity-90">Bajarilgan Topshiriq</div>
                </div>
                <div class="stat-card p-6 text-center">
                    <div class="text-3xl mb-2">🏆</div>
                    <div class="text-2xl font-bold">892</div>
                    <div class="text-sm opacity-90">Berilgan Mukofot</div>
                </div>
                <div class="stat-card p-6 text-center">
                    <div class="text-3xl mb-2">💰</div>
                    <div class="text-2xl font-bold">45,678</div>
                    <div class="text-sm opacity-90">Jami Coin</div>
                </div>
            </div>

            <!-- Recent Activities -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div class="admin-card p-6">
                    <h3 class="text-xl font-bold mb-4 text-gray-800">So'nggi Faoliyatlar</h3>
                    <div class="space-y-4">
                        <div class="relative pl-8">
                            <div class="absolute left-0 top-2 w-3 h-3 bg-indigo-500 rounded-full"></div>
                            <div class="p-3 bg-green-50 border border-green-200 rounded-lg">
                                <p class="font-medium text-gray-800">Ahmad matematik topshiriqni yakunladi</p>
                                <p class="text-sm text-gray-600">+25 coin</p>
                                <p class="text-xs text-gray-500 mt-1">5 daqiqa oldin</p>
                            </div>
                        </div>
                        <div class="relative pl-8">
                            <div class="absolute left-0 top-2 w-3 h-3 bg-indigo-500 rounded-full"></div>
                            <div class="p-3 bg-blue-50 border border-blue-200 rounded-lg">
                                <p class="font-medium text-gray-800">Malika yangi badge oldi</p>
                                <p class="text-sm text-gray-600">"Rasm Ustasi"</p>
                                <p class="text-xs text-gray-500 mt-1">12 daqiqa oldin</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="admin-card p-6">
                    <h3 class="text-xl font-bold mb-4 text-gray-800">Tizim Holati</h3>
                    <div class="space-y-4">
                        <div class="flex justify-between items-center p-3 bg-green-50 rounded-lg">
                            <div>
                                <p class="font-medium text-green-800">Server Holati</p>
                                <p class="text-sm text-green-600">Barcha xizmatlar faol</p>
                            </div>
                            <div class="text-green-600 text-2xl">✅</div>
                        </div>
                        <div class="flex justify-between items-center p-3 bg-blue-50 rounded-lg">
                            <div>
                                <p class="font-medium text-blue-800">Ma'lumotlar Bazasi</p>
                                <p class="text-sm text-blue-600">99.9% uptime</p>
                            </div>
                            <div class="text-blue-600 text-2xl">🗄️</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Users Section -->
        <div id="users" class="section hidden">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-3xl font-bold text-white">Foydalanuvchilar</h2>
                <button class="bg-white text-purple-600 px-4 py-2 rounded-lg hover:bg-gray-100 transition-colors">
                    ➕ Yangi Foydalanuvchi
                </button>
            </div>

            <div class="admin-card p-6 mb-6">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <input type="text" placeholder="Qidirish..." class="p-3 border rounded-lg">
                    <select class="p-3 border rounded-lg">
                        <option value="">Barcha rollar</option>
                        <option value="admin">Admin</option>
                        <option value="parent">Ota-ona</option>
                        <option value="user">Foydalanuvchi</option>
                    </select>
                    <select class="p-3 border rounded-lg">
                        <option value="">Barcha holatlar</option>
                        <option value="active">Faol</option>
                        <option value="inactive">Nofaol</option>
                    </select>
                    <button class="bg-blue-500 text-white p-3 rounded-lg hover:bg-blue-600 transition-colors">
                        📥 Export
                    </button>
                </div>
            </div>

            <div class="admin-card p-6">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                        <tr class="border-b">
                            <th class="text-left p-3">Foydalanuvchi</th>
                            <th class="text-left p-3">Role</th>
                            <th class="text-left p-3">Holat</th>
                            <th class="text-left p-3">Oxirgi faoliyat</th>
                            <th class="text-left p-3">Coin</th>
                            <th class="text-left p-3">Amallar</th>
                        </tr>
                        </thead>
                        <tbody id="usersTableBody">
                        <tr class="border-b hover:bg-gray-50">
                            <td class="p-3">
                                <div class="flex items-center">
                                    <div class="user-avatar mr-3">A</div>
                                    <div>
                                        <div class="font-semibold">Ahmad Karimov</div>
                                    </div>
                                </div>
                            </td>
                            <td class="p-3">
                                <span class="role-badge role-user">Foydalanuvchi</span>
                            </td>
                            <td class="p-3">
                                <span class="px-2 py-1 rounded-full text-xs bg-green-100 text-green-800">Faol</span>
                            </td>
                            <td class="p-3 text-sm text-gray-600">5 daqiqa oldin</td>
                            <td class="p-3 font-semibold">1250</td>
                            <td class="p-3">
                                <button class="text-blue-600 hover:text-blue-800 mr-2">✏️</button>
                                <button class="text-red-600 hover:text-red-800">🗑️</button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Other sections would be similar... -->
        <!-- Smart Tasks Section -->
        <div id="smart-tasks" class="section hidden">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-3xl font-bold text-white">Smart Topshiriqlar</h2>

                <div class="flex space-x-4">
                    <a href="{{ route('game.index') }}" class="bg-white text-purple-600 px-4 py-2 rounded-lg hover:bg-gray-100 transition-colors" onclick="addTask()">
                        <i class="fas fa-plus mr-2"></i>Yangi Topshiriq
                    </a>

                    <a href="/gameList"
                       class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition-colors flex items-center">
                        <i class="fas fa-play mr-2"></i>O‘yinni boshlash
                    </a>
                </div>
            </div>



            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
                <div class="admin-card p-6">
                    <h3 class="text-xl font-bold mb-4 text-gray-800">Matematik Topshiriqlar</h3>
                    <div class="space-y-3">
                        <div class="p-3 bg-blue-50 rounded-lg cursor-pointer hover:bg-blue-100" onclick="editTask('math-1')">
                            <h4 class="font-semibold">Qo'shish va Ayirish</h4>
                            <p class="text-sm text-gray-600">6-8 yosh • 15 coin</p>
                            <div class="flex justify-between mt-2">
                                <span class="text-xs text-green-600">✅ Faol</span>
                                <span class="text-xs text-gray-500">245 marta bajarilgan</span>
                            </div>
                        </div>
                        <div class="p-3 bg-blue-50 rounded-lg cursor-pointer hover:bg-blue-100" onclick="editTask('math-2')">
                            <h4 class="font-semibold">Ko'paytirish Jadvali</h4>
                            <p class="text-sm text-gray-600">8-10 yosh • 25 coin</p>
                            <div class="flex justify-between mt-2">
                                <span class="text-xs text-green-600">✅ Faol</span>
                                <span class="text-xs text-gray-500">189 marta bajarilgan</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="admin-card p-6">
                    <h3 class="text-xl font-bold mb-4 text-gray-800">Ijodiy Topshiriqlar</h3>
                    <div class="space-y-3">
                        <div class="p-3 bg-green-50 rounded-lg cursor-pointer hover:bg-green-100" onclick="editTask('creative-1')">
                            <h4 class="font-semibold">Rasm Chizish</h4>
                            <p class="text-sm text-gray-600">4-12 yosh • 20 coin</p>
                            <div class="flex justify-between mt-2">
                                <span class="text-xs text-green-600">✅ Faol</span>
                                <span class="text-xs text-gray-500">356 marta bajarilgan</span>
                            </div>
                        </div>
                        <div class="p-3 bg-green-50 rounded-lg cursor-pointer hover:bg-green-100" onclick="editTask('creative-2')">
                            <h4 class="font-semibold">Hikoya Yozish</h4>
                            <p class="text-sm text-gray-600">8-14 yosh • 30 coin</p>
                            <div class="flex justify-between mt-2">
                                <span class="text-xs text-yellow-600">⏸️ Nofaol</span>
                                <span class="text-xs text-gray-500">78 marta bajarilgan</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="admin-card p-6">
                    <h3 class="text-xl font-bold mb-4 text-gray-800">Jismoniy Topshiriqlar</h3>
                    <div class="space-y-3">
                        <div class="p-3 bg-orange-50 rounded-lg cursor-pointer hover:bg-orange-100" onclick="editTask('physical-1')">
                            <h4 class="font-semibold">Ertalabki Mashq</h4>
                            <p class="text-sm text-gray-600">6-16 yosh • 10 coin</p>
                            <div class="flex justify-between mt-2">
                                <span class="text-xs text-green-600">✅ Faol</span>
                                <span class="text-xs text-gray-500">423 marta bajarilgan</span>
                            </div>
                        </div>
                        <div class="p-3 bg-orange-50 rounded-lg cursor-pointer hover:bg-orange-100" onclick="editTask('physical-2')">
                            <h4 class="font-semibold">Yugurish</h4>
                            <p class="text-sm text-gray-600">8-16 yosh • 15 coin</p>
                            <div class="flex justify-between mt-2">
                                <span class="text-xs text-green-600">✅ Faol</span>
                                <span class="text-xs text-gray-500">267 marta bajarilgan</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- games Section -->
        <div id="games" class="section hidden">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-3xl font-bold text-white">Interaktiv O'yinlar</h2>
                <a href="{{ route('game.index') }}"  class="bg-white text-purple-600 px-4 py-2 rounded-lg hover:bg-gray-100 transition-colors" onclick="addGame()">
                    <i class="fas fa-plus mr-2"></i>Yangi O'yin
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="admin-card p-6">
                    <div class="text-center mb-4">
                        <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-3">
                            <i class="fas fa-puzzle-piece text-2xl text-blue-600"></i>
                        </div>
                        <h3 class="text-lg font-bold">Puzzle O'yini</h3>
                        <p class="text-sm text-gray-600">4-8 yosh</p>
                    </div>
                    <div class="space-y-2 text-sm">
                        <div class="flex justify-between">
                            <span>O'yinchilar:</span>
                            <span class="font-semibold">1,234</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Reyting:</span>
                            <span class="font-semibold">4.8/5</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Holat:</span>
                            <span class="text-green-600 font-semibold">Faol</span>
                        </div>
                    </div>
                    <button class="w-full mt-4 bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 transition-colors" onclick="manageGame('puzzle')">
                        Boshqarish
                    </button>
                </div>

                <div class="admin-card p-6">
                    <div class="text-center mb-4">
                        <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-3">
                            <i class="fas fa-paint-brush text-2xl text-green-600"></i>
                        </div>
                        <h3 class="text-lg font-bold">Rang Berish</h3>
                        <p class="text-sm text-gray-600">3-7 yosh</p>
                    </div>
                    <div class="space-y-2 text-sm">
                        <div class="flex justify-between">
                            <span>O'yinchilar:</span>
                            <span class="font-semibold">2,156</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Reyting:</span>
                            <span class="font-semibold">4.9/5</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Holat:</span>
                            <span class="text-green-600 font-semibold">Faol</span>
                        </div>
                    </div>
                    <button class="w-full mt-4 bg-green-500 text-white py-2 rounded-lg hover:bg-green-600 transition-colors" onclick="manageGame('coloring')">
                        Boshqarish
                    </button>
                </div>

                <div class="admin-card p-6">
                    <div class="text-center mb-4">
                        <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-3">
                            <i class="fas fa-music text-2xl text-purple-600"></i>
                        </div>
                        <h3 class="text-lg font-bold">Musiqa O'yini</h3>
                        <p class="text-sm text-gray-600">5-12 yosh</p>
                    </div>
                    <div class="space-y-2 text-sm">
                        <div class="flex justify-between">
                            <span>O'yinchilar:</span>
                            <span class="font-semibold">856</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Reyting:</span>
                            <span class="font-semibold">4.7/5</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Holat:</span>
                            <span class="text-yellow-600 font-semibold">Test</span>
                        </div>
                    </div>
                    <button class="w-full mt-4 bg-purple-500 text-white py-2 rounded-lg hover:bg-purple-600 transition-colors" onclick="manageGame('music')">
                        Boshqarish
                    </button>
                </div>
            </div>
        </div>

        <!-- Rewards Section -->
        <div id="rewards" class="section hidden">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-3xl font-bold text-white">Mukofotlar Boshqaruvi</h2>
                <button class="bg-white text-purple-600 px-4 py-2 rounded-lg hover:bg-gray-100 transition-colors" onclick="addReward()">
                    <i class="fas fa-plus mr-2"></i>Yangi Mukofot
                </button>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                <div class="admin-card p-6">
                    <h3 class="text-xl font-bold mb-4 text-gray-800">Virtual Mukofotlar</h3>
                    <div class="space-y-3" id="virtualRewards">
                        <!-- Virtual rewards will be populated by JavaScript -->
                    </div>
                </div>

                <div class="admin-card p-6">
                    <h3 class="text-xl font-bold mb-4 text-gray-800">Jismoniy Mukofotlar</h3>
                    <div class="space-y-3" id="physicalRewards">
                        <!-- Physical rewards will be populated by JavaScript -->
                    </div>
                </div>
            </div>

            <div class="admin-card p-6">
                <h3 class="text-xl font-bold mb-4 text-gray-800">Mukofot Statistikasi</h3>
                <canvas id="rewardsChart" width="400" height="200"></canvas>
            </div>

            <!-- 🎮 Oyinni boshlash tugmasi -->
            <div class="flex justify-center mt-6">
                <a href="#"
                   class="bg-purple-600 text-white px-6 py-3 rounded-lg text-lg font-semibold hover:bg-purple-700 transition-colors">
                    O‘yinni boshlash
                </a>
            </div>





        </div>

        <!-- Analytics Section -->
        <div id="analytics" class="section hidden">
            <h2 class="text-3xl font-bold text-white mb-6">Analitika va Hisobotlar</h2>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                <div class="admin-card p-6">
                    <h3 class="text-xl font-bold mb-4 text-gray-800">Foydalanuvchi Faolligi</h3>
                    <canvas id="userActivityChart" width="400" height="200"></canvas>
                </div>

                <div class="admin-card p-6">
                    <h3 class="text-xl font-bold mb-4 text-gray-800">Topshiriqlar Statistikasi</h3>
                    <canvas id="tasksChart" width="400" height="200"></canvas>
                </div>
            </div>

            <div class="admin-card p-6">
                <h3 class="text-xl font-bold mb-4 text-gray-800">Oylik Hisobot</h3>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    <div class="text-center p-4 bg-blue-50 rounded-lg">
                        <div class="text-3xl font-bold text-blue-600">15,678</div>
                        <div class="text-sm text-gray-600">Yangi foydalanuvchi</div>
                    </div>
                    <div class="text-center p-4 bg-green-50 rounded-lg">
                        <div class="text-3xl font-bold text-green-600">89,234</div>
                        <div class="text-sm text-gray-600">Bajarilgan topshiriq</div>
                    </div>
                    <div class="text-center p-4 bg-purple-50 rounded-lg">
                        <div class="text-3xl font-bold text-purple-600">12,456</div>
                        <div class="text-sm text-gray-600">Berilgan mukofot</div>
                    </div>
                    <div class="text-center p-4 bg-orange-50 rounded-lg">
                        <div class="text-3xl font-bold text-orange-600">98.5%</div>
                        <div class="text-sm text-gray-600">Foydalanuvchi mamnunligi</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Settings Section -->
        <div id="settings" class="section hidden">
            <h2 class="text-3xl font-bold text-white mb-6">Tizim Sozlamalari</h2>

            <div class="admin-card p-6">
                <h3 class="text-xl font-bold mb-4 text-gray-800">Umumiy Sozlamalar</h3>

                <div class="space-y-6">
                    <div>
                        <h4 class="font-semibold mb-3">Tizim Sozlamalari</h4>
                        <div class="space-y-3">
                            <div class="flex items-center justify-between">
                                <span>Avtomatik backup</span>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" checked class="sr-only peer">
                                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                                </label>
                            </div>
                            <div class="flex items-center justify-between">
                                <span>Email bildirishnomalar</span>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" checked class="sr-only peer">
                                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                                </label>
                            </div>
                            <div class="flex items-center justify-between">
                                <span>Xavfsizlik loglari</span>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" checked class="sr-only peer">
                                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h4 class="font-semibold mb-3">Ma'lumotlar</h4>
                        <div class="space-y-2">
                            <button class="w-full text-left p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                                Ma'lumotlar bazasini tozalash
                            </button>
                            <button class="w-full text-left p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                                Hisobotlarni eksport qilish
                            </button>
                            <button class="w-full text-left p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                                Backup yaratish
                            </button>
                        </div>
                    </div>

                    <div>
                        <h4 class="font-semibold mb-3">Xavfsizlik</h4>
                        <div class="space-y-2">
                            <button class="w-full text-left p-3 bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors text-blue-700">
                                Admin parolini o'zgartirish
                            </button>
                            <button class="w-full text-left p-3 bg-yellow-50 rounded-lg hover:bg-yellow-100 transition-colors text-yellow-700">
                                Tizimni qayta ishga tushirish
                            </button>
                            <button class="w-full text-left p-3 bg-red-50 rounded-lg hover:bg-red-100 transition-colors text-red-700">
                                Favqulodda to'xtatish
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Sample data
    const users = [
        { id: 1, name: 'Ahmad Karimov', role: 'user', status: 'active', lastActivity: '5 daqiqa oldin', coins: 1250, avatar: 'A', children: [] },
        { id: 2, name: 'Malika Tosheva', role: 'user', status: 'active', lastActivity: '12 daqiqa oldin', coins: 850, avatar: 'M', children: [] },
        { id: 3, name: 'Bobur Aliyev', role: 'user', status: 'inactive', lastActivity: '2 soat oldin', coins: 2100, avatar: 'B', children: [] },
        { id: 4, name: 'Oybek Rahimov', role: 'parent', status: 'active', lastActivity: '1 daqiqa oldin', coins: 0, avatar: 'O', children: ['Ahmad', 'Malika'] },
        { id: 5, name: 'Nodira Karimova', role: 'parent', status: 'active', lastActivity: '30 daqiqa oldin', coins: 0, avatar: 'N', children: ['Bobur'] },
        { id: 6, name: 'Admin User', role: 'admin', status: 'active', lastActivity: 'Hozir', coins: 0, avatar: 'A', children: [] }
    ];

    const rewards = {
        virtual: [
            { id: 1, name: 'Oltin Badge', cost: 100, type: 'badge', available: true, purchased: 45 },
            { id: 2, name: 'Kumush Badge', cost: 50, type: 'badge', available: true, purchased: 123 },
            { id: 3, name: 'Avatar Frame', cost: 75, type: 'cosmetic', available: true, purchased: 67 },
            { id: 4, name: 'Maxsus Rang', cost: 25, type: 'cosmetic', available: true, purchased: 234 }
        ],
        physical: [
            { id: 5, name: 'Kitob', cost: 500, type: 'book', available: true, purchased: 12, stock: 25 },
            { id: 6, name: 'O\'yinchoq', cost: 800, type: 'toy', available: true, purchased: 8, stock: 15 },
            { id: 7, name: 'Daftar', cost: 200, type: 'stationery', available: true, purchased: 34, stock: 50 },
            { id: 8, name: 'Ruchka', cost: 150, type: 'stationery', available: false, purchased: 23, stock: 0 }
        ]
    };

    let currentRole = 'admin';

    // Initialize
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('currentDate').textContent = new Date().toLocaleDateString('uz-UZ');
        populateUsersTable();
        populateRewards();
        initCharts();
    });

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

    // Role switching
    function switchRole() {
        const roleSelector = document.getElementById('roleSelector');
        currentRole = roleSelector.value;

        const roleDisplay = document.getElementById('currentRole');
        const roleClasses = {
            admin: 'role-admin',
            parent: 'role-parent',
            user: 'role-user'
        };

        roleDisplay.className = `role-badge ${roleClasses[currentRole]}`;
        roleDisplay.textContent = roleSelector.options[roleSelector.selectedIndex].text;

        // Update UI based on role
        updateUIForRole();
        showNotification(`Role ${roleSelector.options[roleSelector.selectedIndex].text}ga o'zgartirildi`);
    }

    function updateUIForRole() {
        const restrictedSections = document.querySelectorAll('.nav-item');

        if (currentRole === 'user') {
            // Hide admin-only sections for users
            restrictedSections.forEach((item, index) => {
                if (index > 2) { // Only show dashboard, users (own profile), smart-tasks
                    item.style.display = 'none';
                } else {
                    item.style.display = 'block';
                }
            });
        } else if (currentRole === 'parent') {
            // Show parental control and limited access
            restrictedSections.forEach((item, index) => {
                if (index === 1 || index === 5) { // Users and parental control
                    item.style.display = 'block';
                } else if (index > 6) { // Hide admin settings
                    item.style.display = 'none';
                } else {
                    item.style.display = 'block';
                }
            });
        } else {
            // Admin sees everything
            restrictedSections.forEach(item => {
                item.style.display = 'block';
            });
        }
    }

    // Users management
    function populateUsersTable() {
        const tbody = document.getElementById('usersTableBody');
        tbody.innerHTML = '';

        users.forEach(user => {
            const row = document.createElement('tr');
            row.className = 'border-b hover:bg-gray-50 cursor-pointer';
            row.onclick = () => showUserDetails(user.id);

            row.innerHTML = `
                <td class="p-3">
                    <div class="flex items-center">
                        <div class="user-avatar mr-3">${user.avatar}</div>
                        <div>
                            <div class="font-semibold">${user.name}</div>
                            <div class="text-sm text-gray-500">${user.children.length > 0 ? user.children.length + ' ta bola' : 'Yolg\'iz foydalanuvchi'}</div>
                        </div>
                    </div>
                </td>
                <td class="p-3">
                    <span class="role-badge role-${user.role}">${getRoleText(user.role)}</span>
                </td>
                <td class="p-3">
                    <span class="px-2 py-1 rounded-full text-xs ${getStatusClass(user.status)}">${getStatusText(user.status)}</span>
                </td>
                <td class="p-3 text-sm text-gray-600">${user.lastActivity}</td>
                <td class="p-3 font-semibold">${user.coins}</td>
                <td class="p-3">
                    <button class="text-blue-600 hover:text-blue-800 mr-2" onclick="event.stopPropagation(); editUser(${user.id})">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button class="text-red-600 hover:text-red-800" onclick="event.stopPropagation(); deleteUser(${user.id})">
                        <i class="fas fa-trash"></i>
                    </button>
                </td>
            `;

            tbody.appendChild(row);
        });
    }

    function getRoleText(role) {
        const roles = { admin: 'Admin', parent: 'Ota-ona', user: 'Foydalanuvchi' };
        return roles[role] || role;
    }

    function getStatusClass(status) {
        const classes = {
            active: 'bg-green-100 text-green-800',
            inactive: 'bg-yellow-100 text-yellow-800',
            blocked: 'bg-red-100 text-red-800'
        };
        return classes[status] || 'bg-gray-100 text-gray-800';
    }

    function getStatusText(status) {
        const statuses = { active: 'Faol', inactive: 'Nofaol', blocked: 'Bloklangan' };
        return statuses[status] || status;
    }

    function showUserDetails(userId) {
        const user = users.find(u => u.id === userId);
        if (!user) return;

        const modal = document.getElementById('userModal');
        const content = document.getElementById('userModalContent');

        content.innerHTML = `
            <h2 class="text-2xl font-bold mb-4">${user.name}</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="text-lg font-semibold mb-3">Asosiy Ma'lumotlar</h3>
                    <div class="space-y-2">
                        <div class="flex justify-between">
                            <span>Role:</span>
                            <span class="role-badge role-${user.role}">${getRoleText(user.role)}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Holat:</span>
                            <span class="px-2 py-1 rounded-full text-xs ${getStatusClass(user.status)}">${getStatusText(user.status)}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Coinlar:</span>
                            <span class="font-semibold">${user.coins}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Oxirgi faoliyat:</span>
                            <span>${user.lastActivity}</span>
                        </div>
                    </div>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-3">Faoliyat</h3>
                    <div class="activity-timeline">
                        <div class="activity-item">
                            <div class="bg-green-50 p-3 rounded-lg">
                                <p class="font-medium">Matematik topshiriq bajarildi</p>
                                <p class="text-sm text-gray-500">2 soat oldin • +25 coin</p>
                            </div>
                        </div>
                        <div class="activity-item">
                            <div class="bg-blue-50 p-3 rounded-lg">
                                <p class="font-medium">Yangi badge olindi</p>
                                <p class="text-sm text-gray-500">1 kun oldin • "Matematik Usta"</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-6 flex gap-3">
                <button class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600" onclick="editUser(${user.id})">
                    Tahrirlash
                </button>
                <button class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600" onclick="giveReward(${user.id})">
                    Mukofot Berish
                </button>
                <button class="bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600" onclick="adjustCoins(${user.id})">
                    Coin Sozlash
                </button>
            </div>
        `;

        modal.style.display = 'block';
    }

    // Rewards management
    function populateRewards() {
        const virtualContainer = document.getElementById('virtualRewards');
        const physicalContainer = document.getElementById('physicalRewards');

        virtualContainer.innerHTML = '';
        physicalContainer.innerHTML = '';

        rewards.virtual.forEach(reward => {
            const div = document.createElement('div');
            div.className = `reward-item ${reward.available ? '' : 'opacity-50'}`;
            div.onclick = () => manageReward(reward.id);

            div.innerHTML = `
                <div class="flex justify-between items-center">
                    <div>
                        <h4 class="font-semibold">${reward.name}</h4>
                        <p class="text-sm text-gray-600">${reward.cost} coin • ${reward.purchased} marta sotilgan</p>
                    </div>
                    <div class="text-right">
                        <span class="text-xs ${reward.available ? 'text-green-600' : 'text-red-600'}">
                            ${reward.available ? '✅ Mavjud' : '❌ Mavjud emas'}
                        </span>
                    </div>
                </div>
            `;

            virtualContainer.appendChild(div);
        });

        rewards.physical.forEach(reward => {
            const div = document.createElement('div');
            div.className = `reward-item ${reward.available ? '' : 'opacity-50'}`;
            div.onclick = () => manageReward(reward.id);

            div.innerHTML = `
                <div class="flex justify-between items-center">
                    <div>
                        <h4 class="font-semibold">${reward.name}</h4>
                        <p class="text-sm text-gray-600">${reward.cost} coin • ${reward.purchased} marta sotilgan</p>
                        <p class="text-xs text-gray-500">Omborda: ${reward.stock} ta</p>
                    </div>
                    <div class="text-right">
                        <span class="text-xs ${reward.available ? 'text-green-600' : 'text-red-600'}">
                            ${reward.available ? '✅ Mavjud' : '❌ Tugagan'}
                        </span>
                    </div>
                </div>
            `;

            physicalContainer.appendChild(div);
        });
    }

    function manageReward(rewardId) {
        const allRewards = [...rewards.virtual, ...rewards.physical];
        const reward = allRewards.find(r => r.id === rewardId);
        if (!reward) return;

        const modal = document.getElementById('rewardModal');
        const content = document.getElementById('rewardModalContent');

        content.innerHTML = `
            <h2 class="text-2xl font-bold mb-4">${reward.name} - Boshqarish</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="text-lg font-semibold mb-3">Mukofot Ma'lumotlari</h3>
                    <div class="space-y-3">
                        <div>
                            <label class="block text-sm font-medium mb-1">Nom</label>
                            <input type="text" value="${reward.name}" class="w-full p-2 border rounded-lg">
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1">Narx (coin)</label>
                            <input type="number" value="${reward.cost}" class="w-full p-2 border rounded-lg">
                        </div>
                        ${reward.stock !== undefined ? `
                        <div>
                            <label class="block text-sm font-medium mb-1">Ombor miqdori</label>
                            <input type="number" value="${reward.stock}" class="w-full p-2 border rounded-lg">
                        </div>
                        ` : ''}
                        <div class="flex items-center">
                            <input type="checkbox" ${reward.available ? 'checked' : ''} class="mr-2">
                            <label>Mavjud</label>
                        </div>
                    </div>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-3">Statistika</h3>
                    <div class="space-y-2">
                        <div class="flex justify-between">
                            <span>Jami sotilgan:</span>
                            <span class="font-semibold">${reward.purchased}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Jami daromad:</span>
                            <span class="font-semibold">${reward.purchased * reward.cost} coin</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Holat:</span>
                            <span class="${reward.available ? 'text-green-600' : 'text-red-600'}">${reward.available ? 'Faol' : 'Nofaol'}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-6 flex gap-3">
                <button class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600" onclick="saveReward(${reward.id})">
                    Saqlash
                </button>
                <button class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600" onclick="duplicateReward(${reward.id})">
                    Nusxa Yaratish
                </button>
                <button class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600" onclick="deleteReward(${reward.id})">
                    O'chirish
                </button>
            </div>
        `;

        modal.style.display = 'block';
    }

    // Charts
    function initCharts() {
        // Rewards Chart
        const rewardsCtx = document.getElementById('rewardsChart').getContext('2d');
        new Chart(rewardsCtx, {
            type: 'doughnut',
            data: {
                labels: ['Virtual Mukofotlar', 'Jismoniy Mukofotlar', 'Badge', 'Kosmetik'],
                datasets: [{
                    data: [45, 25, 20, 10],
                    backgroundColor: ['#667eea', '#764ba2', '#10b981', '#f59e0b']
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });

        // User Activity Chart
        const userActivityCtx = document.getElementById('userActivityChart');
        if (userActivityCtx) {
            new Chart(userActivityCtx.getContext('2d'), {
                type: 'line',
                data: {
                    labels: ['Dush', 'Sesh', 'Chor', 'Pay', 'Jum', 'Shan', 'Yak'],
                    datasets: [{
                        label: 'Faol foydalanuvchilar',
                        data: [120, 150, 180, 200, 170, 220, 190],
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
                    }
                }
            });
        }

        // Tasks Chart
        const tasksCtx = document.getElementById('tasksChart');
        if (tasksCtx) {
            new Chart(tasksCtx.getContext('2d'), {
                type: 'bar',
                data: {
                    labels: ['Matematik', 'Ijodiy', 'Jismoniy', 'Xotira', 'Mantiq'],
                    datasets: [{
                        label: 'Bajarilgan topshiriqlar',
                        data: [450, 320, 280, 190, 150],
                        backgroundColor: ['#667eea', '#10b981', '#f59e0b', '#ef4444', '#8b5cf6']
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
        }
    }

    // Filter functions
    function filterUsers() {
        const searchTerm = document.getElementById('userSearch').value.toLowerCase();
        const roleFilter = document.getElementById('roleFilter').value;
        const statusFilter = document.getElementById('statusFilter').value;

        // This would filter the users table in a real implementation
        showNotification('Filtrlar qo\'llanildi');
    }

    // Modal functions
    function closeModal(modalId) {
        document.getElementById(modalId).style.display = 'none';
    }

    // Action functions
    function addUser() {
        showNotification('Yangi foydalanuvchi qo\'shish oynasi ochilmoqda...');
    }

    function editUser(userId) {
        showNotification(`Foydalanuvchi ${userId} tahrirlash oynasi ochilmoqda...`);
    }

    function deleteUser(userId) {
        if (confirm('Foydalanuvchini o\'chirishni tasdiqlaysizmi?')) {
            showNotification(`Foydalanuvchi ${userId} o\'chirildi`);
        }
    }

    function giveReward(userId) {
        showNotification(`Foydalanuvchi ${userId}ga mukofot berish oynasi ochilmoqda...`);
    }

    function adjustCoins(userId) {
        const amount = prompt('Coin miqdorini kiriting:');
        if (amount) {
            showNotification(`Foydalanuvchi ${userId}ga ${amount} coin qo\'shildi`);
        }
    }

    function addTask() {
        showNotification('Yangi topshiriq yaratish oynasi ochilmoqda...');
    }

    function editTask(taskId) {
        showNotification(`Topshiriq ${taskId} tahrirlash oynasi ochilmoqda...`);
    }

    function addGame() {
        showNotification('Yangi o\'yin qo\'shish oynasi ochilmoqda...');
    }

    function manageGame(gameId) {
        showNotification(`O\'yin ${gameId} boshqarish oynasi ochilmoqda...`);
    }

    function addReward() {
        showNotification('Yangi mukofot yaratish oynasi ochilmoqda...');
    }

    function saveReward(rewardId) {
        showNotification(`Mukofot ${rewardId} saqlandi`);
        closeModal('rewardModal');
    }

    function duplicateReward(rewardId) {
        showNotification(`Mukofot ${rewardId}dan nusxa yaratildi`);
    }

    function deleteReward(rewardId) {
        if (confirm('Mukofotni o\'chirishni tasdiqlaysizmi?')) {
            showNotification(`Mukofot ${rewardId} o\'chirildi`);
            closeModal('rewardModal');
        }
    }

    function parentalSettings() {
        showNotification('Ota-onalar nazorati sozlamalari ochilmoqda...');
    }

    function exportUsers() {
        showNotification('Foydalanuvchilar ro\'yxati eksport qilinmoqda...');
    }

    // Notification function
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

    // Close modals when clicking outside
    window.onclick = function(event) {
        const modals = document.querySelectorAll('.modal');
        modals.forEach(modal => {
            if (event.target === modal) {
                modal.style.display = 'none';
            }
        });
    }

    // Simulate real-time updates
    setInterval(() => {
        if (Math.random() < 0.2) {
            const activities = [
                'Yangi foydalanuvchi ro\'yxatdan o\'tdi',
                'Topshiriq bajarildi',
                'Mukofot sotib olindi',
                'Yangi badge berildi'
            ];
            const randomActivity = activities[Math.floor(Math.random() * activities.length)];
            // Update dashboard stats or show notification
        }
    }, 10000); // Every 10 seconds
</script>
</body>
</html>
